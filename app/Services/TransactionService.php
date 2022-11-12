<?php

namespace App\Services;

use Exception;
use App\Models\Safe;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TransactionService
{
    /**
     * Save a transaction.
     *
     * @return \Illuminate\Http\Response
     */
    public function saveTransaction($instance, $amount, $type, $desc = null)
    {
        DB::beginTransaction();
        try {
            $safe = Safe::first();

            $currentBalance = $safe->balance;
            if ($type == 'add') {
                $currentBalance += $amount;
            } else {
                $currentBalance -= $amount;
                $amount = -$amount;
            }

            if ($currentBalance < 0) {
                throw new Exception(__('lang.exceed_safe_balance'));
            }

            $instance->transactions()->create([
                'amount' => $amount,
                'type' => $type,
                'prev_balance' => $safe->balance,
                'current_balance' => $currentBalance,
                'action_by' => auth('admin')->id(),
                'desc' => $desc,
            ]);

            $safe->balance = $currentBalance;
            $safe->save();
            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            Log::error('save transaction failed', ['message' => $exception->getMessage(), 'exception' => $exception]);
            throw $exception;
        }
    }
}
