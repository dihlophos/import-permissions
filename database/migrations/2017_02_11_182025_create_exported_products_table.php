<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExportedProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exported_products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('export_id')->index();
            $table->integer('product_type_id')->index();
            $table->string('measure', 10);
            $table->double('count', 15, 8)->default(0);
            $table->string('manufacturer', 255);
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
        Schema::dropIfExists('exported_products');
    }
}
