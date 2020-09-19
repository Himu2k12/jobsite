<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Cviebrock\EloquentSluggable\Sluggable;

class Job extends Model
{

    use Sluggable;

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'job_title'
            ]
        ];
    }
    public function businessName($id){
        return DB::table('company_infos')
            ->select('business_name')
            ->where('id',$id)
            ->first();
    }
    public function alreadyApplied($id,$applicantId){
        return DB::table('applicant_on_jobs')
            ->where('job_id',$id)
            ->where('applicant_id',$applicantId)
            ->select('id')
            ->first();
    }
}
