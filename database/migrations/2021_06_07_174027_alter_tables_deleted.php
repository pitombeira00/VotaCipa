<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTablesDeleted extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('funcionarios', function (Blueprint $table) {

            $table->boolean('deleted')->default(false);
        });

        Schema::table('candidatos', function (Blueprint $table) {

            $table->boolean('deleted')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('funcionarios', function (Blueprint $table) {
            $table->dropColumn('deleted');
        });

        Schema::table('candidatos', function (Blueprint $table) {
            $table->dropColumn('deleted');
        });
    }
}
