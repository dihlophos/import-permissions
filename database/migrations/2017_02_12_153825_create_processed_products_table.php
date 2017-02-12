<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProcessedProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('processed_products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('exported_product_id')->index();
            $table->date('date')->nullable();
            $table->double('count', 15, 8)->default(0);
            $table->string('measure', 10);
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
        Schema::dropIfExists('processed_products');
    }
}
