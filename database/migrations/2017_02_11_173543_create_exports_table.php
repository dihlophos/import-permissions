<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exports', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('storage_id')->index()->unsigned();
            $table->integer('organization_id')->index();
            $table->date('permission_date')->nullable();
            $table->string('permission_num', 10)->nullable();
            $table->date('request_date')->nullable();
            $table->string('request_num', 15)->nullable();
            $table->integer('purpose_id')->index();
            $table->integer('region_id')->index();
            $table->integer('district_id')->index();
            $table->string('address', 150)->nullable();
            $table->integer('transport_id')->index();
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
        Schema::dropIfExists('exports');
    }
}
