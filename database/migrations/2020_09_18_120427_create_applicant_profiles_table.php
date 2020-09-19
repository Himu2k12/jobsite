<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicantProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applicant_profiles', function (Blueprint $table) {
            $table->id();
            $table->string('profile_picture');
            $table->unsignedInteger('applicant_id');
            $table->string('slug');
            $table->longText('skills');
            $table->string('resume');
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
        Schema::dropIfExists('applicant_profiles');
    }
}
