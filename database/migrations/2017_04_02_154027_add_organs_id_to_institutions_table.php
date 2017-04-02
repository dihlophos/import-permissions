<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOrgansIdToInstitutionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('institutions', function (Blueprint $table) {
            $table->integer('organ_id')->unsigned()->default(0);
        });
        
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::table('institutions', function($table) {
            $table->foreign('organ_id')->references('id')->on('organs')->onDelete('cascade');
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
        Schema::table('institutions', function (Blueprint $table) {
            $table->dropForeign('institutions_organ_id_foreign');
        });

        Schema::table('institutions', function (Blueprint $table) {
            $table->dropColumn('organ_id');
        });
    }
}
