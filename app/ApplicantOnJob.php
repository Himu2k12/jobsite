<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ApplicantOnJob extends Model
{
    public function applicantsInfo($id){
        return ApplicantProfile::where('applicant_id',$id)->first();
    }
    public function Jobs($id){
        return Job::where('id',$id)->first();
    }
    public function userInfo($id){
        return User::where('id',$id)->first();
    }
}
