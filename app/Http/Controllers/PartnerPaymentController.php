<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Partner;
use App\Models\PartnerPayment;
use App\Http\Requests\PartnerPaymentRequest;

class PartnerPaymentController extends Controller
{
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
        $partnerPayment = PartnerPayment::create($request->all());

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
