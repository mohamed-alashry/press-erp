<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->morphs('transactionable');
            $table->decimal('amount');
            $table->enum('type', ['add', 'deduct']);
            $table->decimal('prev_balance');
            $table->decimal('current_balance');
            $table->unsignedBigInteger('action_by');
            $table->string('desc')->nullable();
            $table->timestamps();

            $table->foreign('action_by')->references('id')->on('admins')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
};
