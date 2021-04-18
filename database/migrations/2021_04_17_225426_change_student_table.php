<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeStudentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('students', function (Blueprint $table) {
            if (Schema::hasColumn('students', 'qualification_year_from')) {
                $table->dropColumn("qualification_year_from");
            }
            if (Schema::hasColumn('students', 'qualification_year_to')) {
                $table->dropColumn("qualification_year_to");
            }
            $table->integer("qualification_year")->nullable()->default(null);
            $table->boolean("medical_exam")->nullable()->default(1)->comment("1 -> fit , 0 -> not fit");
            $table->string("foreign_nationality")->nullable()->default(null);
            $table->boolean("religion")->nullable()->default(1)->comment("1 muslim , 0 Christian");

            $table->String("pob")->nullable()->default(null)->comment("جهة الميلاد");
            $table->String("civil_registry")->nullable()->default(null)->comment("السجل المدنى");
            $table->String("secondry_school")->nullable()->default(null);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('students', function (Blueprint $table) {
            $table->dropColumn("secondry_school");
            $table->dropColumn("civil_registry");
            $table->dropColumn("pob");
            $table->dropColumn("religion");
            $table->dropColumn("foreign_nationality");
            $table->dropColumn("medical_exam");
            $table->dropColumn("qualification_year");

            $table->integer("qualification_year_from")->nullable()->default(null);
            $table->integer("qualification_year_to")->nullable()->default(null);
        });
    }
}
