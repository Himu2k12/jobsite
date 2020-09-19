<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicantOnJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applicant_on_jobs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('job_id');
            $table->unsignedBigInteger('company_id');
            $table->unsignedBigInteger('applicant_id');
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
        Schema::dropIfExists('applicant_on_jobs');
    }
}
