<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_histories', function (Blueprint $table) {
            $table->id();
            
            $table->string('paymentId');
            $table->string('createTime');
            $table->string('updateTime');
            $table->string('trxID');
            $table->string('transactionStatus');
            $table->string('amount');
            $table->string('currency');
            $table->string('intent');
            $table->string('merchantInvoiceNumber');
            $table->integer('user_id');
            $table->longText('data');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment_histories');
    }
}
