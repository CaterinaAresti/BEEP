<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('subscriptions')) 
        {
            Schema::create('subscriptions', function (Blueprint $table) {
                $table->increments('id')->index();
                $table->integer('user_id')->unsigned();
                $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
                $table->integer('plan_type_id')->unsigned();
                $table->foreign('plan_type_id')->references('id')->on('plan_types')->onUpdate('cascade')->onDelete('cascade'); 
                $table->date('start_date')->nullable();
                $table->date('end_date')->nullable();
                $table->enum('status', ['active', 'canceled', 'expired'])->default('active');
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
        Schema::dropIfExists('subscriptions');
    }
}
