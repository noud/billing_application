<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceProductDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_product_detail', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('Invoice_ID')->nullable();
            $table->string('Product_name');
            $table->integer('tax');
            $table->float('tax_amount');
            $table->float('qty');
            $table->string('unit');
            $table->float('price');
            $table->float('item_total');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoice_product_detail');
    }
}
