<?php

namespace App\Http\Controllers;

use App\Models\ClientPayment;
use App\Models\Expense;
use App\Models\Order;
use App\Models\PartnerPayment;
use App\Models\Safe;
use App\Models\SupplierPayment;
use App\Models\Supply;

class SafeController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $safeBalance = Safe::value('balance');
        $ordersSum = Order::sum('total_price');
        $suppliesSum = Supply::sum('total_price');
        $clientPaymentsSum = ClientPayment::sum('amount');
        $supplierPaymentsSum = SupplierPayment::sum('amount');
        $partnerPaymentsSum = PartnerPayment::sum('amount');
        $expensesSum = Expense::sum('amount');

        return view('sections.safe.show', compact(
            'safeBalance',
            'ordersSum',
            'suppliesSum',
            'clientPaymentsSum',
            'supplierPaymentsSum',
            'partnerPaymentsSum',
            'expensesSum',
        ));
    }
}
