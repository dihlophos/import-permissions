<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class OrgansAddHeadJobHeadNameRegion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('organs', function (Blueprint $table) {
            $table->string('head_job', 150)->default("");
            $table->string('head_name', 150)->default("");
            $table->integer('region_id')->unsigned()->default(0);
        });
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::table('organs', function($table) {
            $table->foreign('region_id')->references('id')->on('regions');
        });
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('organs', function (Blueprint $table) {
            $table->dropForeign('organs_region_id_foreign');
        });

        Schema::table('organs', function (Blueprint $table) {
            $table->dropColumn('head_job');
            $table->dropColumn('head_name');
            $table->dropColumn('region_id');
        });
    }
}
