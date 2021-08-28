<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeStudentGrades extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('student_grades', function (Blueprint $table) {
            $table->tinyInteger("student_Status")->nullable()->default(null)->comment("قيد الطالب");
            $table->tinyInteger("excellence_award")->nullable()->default(null)->comment("مكافاة التفوق");
            $table->boolean("excellence_award_recieved")->nullable()->default(null)->comment("الحصول على مكأفاة التفوق");
            $table->boolean("is_success")->nullable()->default(null)->comment("هل نجح ؟ ");

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('student_grades', function (Blueprint $table) {
            $table->dropColumn("student_Status");
            $table->dropColumn("excellence_award");
            $table->dropColumn("excellence_award_recieved");
            $table->dropColumn("is_success");
        });
    }
}
