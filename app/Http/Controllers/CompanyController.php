<?php

namespace App\Http\Controllers;

use App\ApplicantOnJob;
use App\ApplicantProfile;
use App\CompanyInfo;
use App\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function JobForm(){
        return view('FrontEnd.Job.job-form');
    }
    public function createJob(Request $request){
        $this->validate($request,[
           'job_title'=>'required|max:1000',
           'job_description'=>'required|max:20000',
           'salary'=>'required|numeric|digits_between:1,100000000',
           'location'=>'required|max:1000',
           'country'=>'required|string|max:1000',
           'last_application_date'=>'after:today',
        ]);
        $jobs=new Job();
        $jobs->job_title=$request->job_title;
        $jobs->company_id=Auth::id();
        $jobs->job_description=$request->job_description;
        $jobs->salary=$request->salary;
        $jobs->location=$request->location;
        $jobs->country=$request->country;
        $jobs->last_application_date=$request->last_application_date;
        $jobs->save();

        return redirect('job-form')->with('Message','Job published Successfully!');
    }
    public function applyjob($slug){
        $existProfile=ApplicantProfile::where('applicant_id',Auth::id())->first();
        if($existProfile==null){
            return redirect('profile')->with('MessageDanger','Please Complete resume First!');
        }
        $job=Job::where('slug',$slug)->first();
        $jobApplication=new ApplicantOnJob();
        $jobApplication->company_id=$job->company_id;
        $jobApplication->job_id=$job->id;
        $jobApplication->applicant_id=Auth::id();
        $jobApplication->save();

        return redirect('/')->with('Message','Application Confirmed!');
    }
    public function dashboard(){
        $jobApplications=ApplicantOnJob::where('company_id',Auth::user()->id)->get();
        return view('FrontEnd.Home.dashboard',['jobApplications'=>$jobApplications]);
    }
}
