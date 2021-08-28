<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeStudentTable2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('students', function (Blueprint $table) {
            $table->date("military_education_date")->nullable()->default(null)->comment("تاريخ اداء التربية العسكرية");
            $table->text("pob_gov")->nullable()->default(null)->comment("جهة الميلاد المحافظة");
            $table->text("three_numbers")->nullable()->default(null)->comment("الرقم الثلاثى");
            $table->text("military_location")->nullable()->default(null)->comment("منطقة التجنيد");
            $table->text("national_id_date")->nullable()->default(null)->comment("تاريخ صدور البطاقة");
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
            $table->dropColumn("military_education_date");
            $table->dropColumn("pob_gov");
            $table->dropColumn("three_numbers");
            $table->dropColumn("military_location");
            $table->dropColumn("national_id_date");
        });
    }
}
