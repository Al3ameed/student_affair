<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->date("dob");
            $table->integer("qualification")
                ->comment("0 -> Secondry Scients,
                            1 -> Secondry Mathmatics ,
                            2 -> Technical Secondry ,
                            3 -> Arrivals ,
                            4 -> Stem ,
                            5 -> Others");
            $table->integer("qualification_year");
            $table->float("secondry_grade");
            $table->boolean("gender")->default("0")->comment(" 0 -> Male , 1 -> Female");
            $table->boolean("status")->default("1")->comment("1 -> active , 0 -> inactive");

            $table->boolean("nationality")->default("1")->comment("1 -> Egyptian , 0 -> Foreign");
            $table->integer("national_id");
            $table->integer("student_number");
            $table->integer("level");
            $table->string("university_email")->unique();
            $table->integer("student_id")->unique();
            $table->string("img");
            $table->string("father_name");
            $table->string("mother_name");
            $table->string("father_job");
            $table->string("mother_job");
            $table->text("Address");
            $table->integer("governorate");


            $table->integer("military_status");
            $table->text("military_reason")->nullable()->default(null);
            $table->date("military_date")->nullable()->default(null);
            $table->integer("military_number")->nullable()->default(null);
            $table->boolean("military_education")->default(0)->comment("0 InCompleted , 1 Completed");
            $table->softDeletes(); // <-- This will add a deleted_at field
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
        Schema::dropIfExists('students');
    }
}
