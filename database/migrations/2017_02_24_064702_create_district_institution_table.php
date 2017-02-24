<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDistrictInstitutionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('district_institution', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('district_id')->index()->unsigned();
            $table->integer('institution_id')->index()->unsigned();
            $table->timestamps();
        });

        Schema::table('district_institution', function($table) {
            $table->foreign('district_id')->references('id')->on('districts')->onDelete('cascade');
            $table->foreign('institution_id')->references('id')->on('institutions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('district_institution');
    }
}
