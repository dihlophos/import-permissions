<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForeignConstraints extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('exported_products', function (Blueprint $table) {
            $table->dropIndex(['export_id']);
            $table->integer('export_id', false, true)->change();
            $table->foreign('export_id')
                  ->references('id')->on('exports')
                  ->onDelete('cascade');
        });

        Schema::table('processed_products', function (Blueprint $table) {
            $table->dropIndex(['exported_product_id']);
            $table->integer('exported_product_id', false, true)->change();
            $table->foreign('exported_product_id')
                  ->references('id')->on('exported_products')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('exported_products', function (Blueprint $table) {
            $table->dropForeign(['export_id']);

        });
        Schema::table('exported_products', function (Blueprint $table) {
            $table->integer('export_id', false, false)->change();
            $table->index(['export_id']);
        });
        Schema::table('processed_products', function (Blueprint $table) {
            $table->dropForeign(['exported_product_id']);
        });
        Schema::table('processed_products', function (Blueprint $table) {
            $table->integer('exported_product_id', false, false)->change();
            $table->index(['exported_product_id']);
        });
    }
}
