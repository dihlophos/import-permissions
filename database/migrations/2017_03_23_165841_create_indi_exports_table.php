<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIndiExportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('indi_exports', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('institution_id')->index();
            $table->integer('storage_id')->index();
            $table->string('individual', 150);
            $table->date('permission_date')->nullable();
            $table->string('permission_num', 10)->nullable();
            $table->date('request_date')->nullable();
            $table->string('request_num', 15)->nullable();
            $table->integer('purpose_id')->index()->unsigned();
            $table->integer('region_id')->index()->unsigned();
            $table->integer('district_id')->index()->unsigned();
            $table->integer('dest_district_id')->index()->unsigned();
            $table->string('address', 150)->nullable();
            $table->integer('transport_id')->index()->unsigned();
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
        Schema::dropIfExists('indi_exports');
    }
}
