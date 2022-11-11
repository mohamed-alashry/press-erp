<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Client;
use App\Models\ClientPayment;
use Illuminate\Support\Facades\DB;
use App\Services\TransactionService;
use App\Http\Requests\ClientPaymentRequest;

class ClientPaymentController extends Controller
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
        $query = ClientPayment::with('client');

        if (request()->filled('name')) {
            $query->where('name', 'like', '%' . request('name') . '%');
        }

        $clientPayments = $query->paginate(10);

        return view('sections.client_payments.index', compact('clientPayments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clients = Client::get();

        return view('sections.client_payments.create', compact('clients'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ClientPaymentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClientPaymentRequest $request)
    {
        DB::beginTransaction();
        try {
            $creditAmount = Order::where('client_id', request('client_id'))->sum('total_price');
            $paidAmount = ClientPayment::where('client_id', request('client_id'))->sum('amount');
            $totalAmount  = $paidAmount + request('amount');
            if ($totalAmount <= $creditAmount) {
                $clientPayment = ClientPayment::create($request->all());

                $this->transactionService->saveTransaction($clientPayment, $clientPayment->amount, 'add', __('lang.client_payments'));
            } else {
                return back()->withErrors(['status' => __('lang.exceed_credit_amount', ['total' => $creditAmount])])->withInput();
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            // throw $e;
            return back()->withErrors(['status' => __('lang.exceed_safe_balance')])->withInput();
        }

        return redirect()->route('admin.clientPayments.index')->with('status', __('lang.created'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ClientPayment  $clientPayment
     * @return \Illuminate\Http\Response
     */
    public function show(ClientPayment $clientPayment)
    {
        return view('sections.client_payments.show', compact('clientPayment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ClientPayment  $clientPayment
     * @return \Illuminate\Http\Response
     */
    public function edit(ClientPayment $clientPayment)
    {
        return view('sections.client_payments.edit', compact('clientPayment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\ClientPaymentRequest  $request
     * @param  \App\Models\ClientPayment  $clientPayment
     * @return \Illuminate\Http\Response
     */
    public function update(ClientPaymentRequest $request, ClientPayment $clientPayment)
    {
        $creditAmount = Order::where('client_id', $clientPayment->client_id)->sum('total_price');
        $paidAmount = ClientPayment::where('client_id', $clientPayment->client_id)->sum('amount');
        $totalAmount  = $paidAmount + request('amount');
        if ($totalAmount <= $creditAmount) {
            $clientPayment->update($request->all());
        } else {
            return back()->withErrors(['status' => __('lang.exceed_credit_amount', ['total' => $creditAmount])])->withInput();
        }

        return redirect()->route('admin.clientPayments.index')->with('status', __('lang.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ClientPayment  $clientPayment
     * @return \Illuminate\Http\Response
     */
    public function destroy(ClientPayment $clientPayment)
    {
        $clientPayment->delete();

        return back()->with('status', __('lang.deleted'));
    }
}
