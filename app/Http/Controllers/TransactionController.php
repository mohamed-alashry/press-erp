<?php

namespace App\Http\Controllers;

use App\Models\Safe;
use App\Models\Transaction;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        request()->flash();
        $query = Transaction::query();

        if (request()->filled('desc')) {
            $query->where('desc', 'like', '%' . request('desc') . '%');
        }
        if (request()->filled('type')) {
            $query->where('type', request('type'));
        }

        $amountSum = $query->sum('amount');
        $transactions = $query->orderBy('created_at', 'desc')->paginate(10);

        $safe = Safe::first();

        return view('sections.transactions.index', compact('transactions', 'amountSum', 'safe'));
    }
}
