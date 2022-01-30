<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string("payment_method");
            $table->string("shipping_method");
            $table->unsignedBigInteger("customer_id")->nullable();
            $table->unsignedBigInteger("company_id")->nullable();
            $table->enum("type",["pending","approved","declined"]);
            $table->unsignedBigInteger("billing_address_id")->nullable();
            $table->unsignedBigInteger("shipping_address_id")->nullable();
            $table->string("total");
            $table->nullableTimestamps();

            $table->foreign('customer_id')->references('id')->on('customers');
            $table->foreign('billing_address_id')->references('id')->on('addresses');
            $table->foreign('shipping_address_id')->references('id')->on('addresses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
