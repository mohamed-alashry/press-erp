<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Partner;
use App\Models\PartnerPayment;
use Illuminate\Support\Facades\DB;
use App\Services\TransactionService;
use App\Http\Requests\PartnerPaymentRequest;

class PartnerPaymentController extends Controller
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
        $query = PartnerPayment::with('partner');

        if (request()->filled('name')) {
            $query->where('name', 'like', '%' . request('name') . '%');
        }

        $partnerPayments = $query->paginate(10);

        return view('sections.partner_payments.index', compact('partnerPayments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $partners = Partner::get();

        return view('sections.partner_payments.create', compact('partners'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\PartnerPaymentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PartnerPaymentRequest $request)
    {
        DB::beginTransaction();
        try {
            $partnerPayment = PartnerPayment::create($request->all());

            $this->transactionService->saveTransaction($partnerPayment, $partnerPayment->amount, 'deduct', __('lang.partner_payments'));
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            // throw $e;
            return back()->withErrors(['status' => __('lang.exceed_safe_balance')])->withInput();
        }

        return redirect()->route('admin.partnerPayments.index')->with('status', __('lang.created'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PartnerPayment  $partnerPayment
     * @return \Illuminate\Http\Response
     */
    public function show(PartnerPayment $partnerPayment)
    {
        return view('sections.partner_payments.show', compact('partnerPayment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PartnerPayment  $partnerPayment
     * @return \Illuminate\Http\Response
     */
    public function edit(PartnerPayment $partnerPayment)
    {
        return view('sections.partner_payments.edit', compact('partnerPayment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\PartnerPaymentRequest  $request
     * @param  \App\Models\PartnerPayment  $partnerPayment
     * @return \Illuminate\Http\Response
     */
    public function update(PartnerPaymentRequest $request, PartnerPayment $partnerPayment)
    {
        $partnerPayment->update($request->all());

        return redirect()->route('admin.partnerPayments.index')->with('status', __('lang.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PartnerPayment  $partnerPayment
     * @return \Illuminate\Http\Response
     */
    public function destroy(PartnerPayment $partnerPayment)
    {
        $partnerPayment->delete();

        return back()->with('status', __('lang.deleted'));
    }
}
