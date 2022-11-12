<?php

namespace App\Http\Controllers;

use App\Models\Supply;
use App\Models\Supplier;
use App\Models\SupplierPayment;
use Illuminate\Support\Facades\DB;
use App\Services\TransactionService;
use App\Http\Requests\SupplierPaymentRequest;

class SupplierPaymentController extends Controller
{
    private $transactionService;

    public function __construct(TransactionService $transactionService)
    {
        $this->transactionService = $transactionService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        request()->flash();
        $query = SupplierPayment::with('supplier');

        if (request()->filled('supplier_id')) {
            $query->where('supplier_id', request('supplier_id'));
        }
        if (request()->filled('from') && request()->filled('to')) {
            $query->whereBetween('date', [request('from'), request('to')]);
        }

        $totalSum = $query->sum('amount');
        $supplierPayments = $query->orderBy('created_at', 'desc')->paginate(10);

        $suppliers = Supplier::pluck('name', 'id');

        return view('sections.supplier_payments.index', compact('supplierPayments', 'totalSum', 'suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $suppliers = Supplier::get();

        return view('sections.supplier_payments.create', compact('suppliers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\SupplierPaymentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SupplierPaymentRequest $request)
    {
        DB::beginTransaction();
        try {
            $creditAmount = Supply::where('supplier_id', request('supplier_id'))->sum('total_price');
            $paidAmount = SupplierPayment::where('supplier_id', request('supplier_id'))->sum('amount');
            $totalAmount  = $paidAmount + request('amount');
            if ($totalAmount <= $creditAmount) {
                $supplierPayment = SupplierPayment::create($request->all());

                $this->transactionService->saveTransaction($supplierPayment, $supplierPayment->amount, 'deduct', __('lang.supplier_payments'));
            } else {
                return back()->withErrors(['status' => __('lang.exceed_credit_amount', ['total' => $creditAmount])])->withInput();
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            // throw $e;
            return back()->withErrors(['status' => __('lang.exceed_safe_balance')])->withInput();
        }

        return redirect()->route('admin.supplierPayments.index')->with('status', __('lang.created'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SupplierPayment  $supplierPayment
     * @return \Illuminate\Http\Response
     */
    public function show(SupplierPayment $supplierPayment)
    {
        return view('sections.supplier_payments.show', compact('supplierPayment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SupplierPayment  $supplierPayment
     * @return \Illuminate\Http\Response
     */
    public function edit(SupplierPayment $supplierPayment)
    {
        return view('sections.supplier_payments.edit', compact('supplierPayment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\SupplierPaymentRequest  $request
     * @param  \App\Models\SupplierPayment  $supplierPayment
     * @return \Illuminate\Http\Response
     */
    public function update(SupplierPaymentRequest $request, SupplierPayment $supplierPayment)
    {
        $creditAmount = Supply::where('supplier_id', $supplierPayment->supplier_id)->sum('total_price');
        $paidAmount = SupplierPayment::where('supplier_id', $supplierPayment->supplier_id)->sum('amount');
        $totalAmount  = $paidAmount + request('amount');
        if ($totalAmount <= $creditAmount) {
            $supplierPayment->update($request->all());
        } else {
            return back()->withErrors(['status' => __('lang.exceed_credit_amount', ['total' => $creditAmount])])->withInput();
        }

        return redirect()->route('admin.supplierPayments.index')->with('status', __('lang.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SupplierPayment  $supplierPayment
     * @return \Illuminate\Http\Response
     */
    public function destroy(SupplierPayment $supplierPayment)
    {
        $supplierPayment->delete();

        return back()->with('status', __('lang.deleted'));
    }
}
