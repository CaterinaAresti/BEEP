<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('payment_history')) 
        {
            Schema::create('payment_history', function (Blueprint $table) {
                $table->increments('id')->index();
                $table->integer('user_id')->unsigned();
                $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
                $table->integer('subscription_id')->unsigned();
                $table->foreign('subscription_id')->references('id')->on('subscriptions')->onUpdate('cascade')->onDelete('cascade');
                $table->decimal('amount', 8, 2);
                $table->enum('status', ['successful', 'failed', 'refunded']);
                $table->timestamp('transaction_date');
                $table->string('payment_method');
                $table->string('stripe_payment_id')->nullable();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment_history');
    }
}
