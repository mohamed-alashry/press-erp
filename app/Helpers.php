<?php

function getTransactionTypeUrl($transaction)
{
    $url = '';
    switch ($transaction->transactionable_type) {
        case 'App\Models\ClientPayment':
            $url = route('admin.clientPayments.show', $transaction->transactionable_id);
            break;

        case 'App\Models\SupplierPayment':
            $url = route('admin.supplierPayments.show', $transaction->transactionable_id);
            break;

        case 'App\Models\PartnerPayment':
            $url = route('admin.partnerPayments.show', $transaction->transactionable_id);
            break;

        case 'App\Models\Expense':
            $url = route('admin.expenses.show', $transaction->transactionable_id);
            break;

        default:
            $url = route('dashboard.home');
            break;
    }

    return $url;
}
