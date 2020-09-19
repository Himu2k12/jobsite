<?php

namespace App\Http\Controllers;

use App\ApplicantProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Profiler\Profile;
use Image;

class ApplicantController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function profileForm(){
        $existingProfile=ApplicantProfile::where('applicant_id',Auth::id())->first();

        return view('FrontEnd.Profile.profile-form',['existingProfile'=>$existingProfile]);
    }
    public function createProfile(Request $request){
        $this->validate($request,[
           'skills'=>'required'
        ]);


            $logo = $request->file('profile_picture');
            $imageName = $logo->getClientOriginalName();
            $directory = 'images/';
            $temp = explode(".", $imageName);
            $newfilename = round(microtime(true)) . '.' . end($temp);
            $imgUrlSlide = $directory . $newfilename;
            Image::make($logo)->save($imgUrlSlide);

            $cv = $request->file('resume');
            $CVName = $cv->getClientOriginalName();
            $nam = explode('.', $CVName)[0];
            $destinationPath = public_path() . '/images/';
            $temp2 = explode(".", $CVName);
            $newCVname = round(microtime(true)) . '.' . end($temp2);
            $finalCVName = $nam . $newCVname;
            $cv->move($destinationPath, $finalCVName);


            $newprofile=new ApplicantProfile();
            $newprofile->profile_picture=$imgUrlSlide;
            $newprofile->applicant_id=Auth::id();
            $newprofile->resume=$finalCVName;
            $newprofile->skills=$request->skills;
            $newprofile->Save();

            return redirect('/profile')->with('Message','profile Info saved!');


    } public function UpdateProfile(Request $request)
{
    $this->validate($request, [
        'skills' => 'required'
    ]);
    $updateProfile=ApplicantProfile::find($request->id);
                if ($request->file('profile_picture')){
                    $logo = $request->file('profile_picture');
                $imageName = $logo->getClientOriginalName();
                $directory = 'images/';
                $temp = explode(".", $imageName);
                $newfilename = round(microtime(true)) . '.' . end($temp);
                $imgUrlSlide = $directory . $newfilename;
                Image::make($logo)->save($imgUrlSlide);
                $updateProfile->profile_picture=$imgUrlSlide;
            }
        if ($request->file('resume')) {
            $cv = $request->file('resume');
            $CVName = $cv->getClientOriginalName();
            $nam = explode('.', $CVName)[0];
            $destinationPath = public_path() . '/images/';
            $temp2 = explode(".", $CVName);
            $newCVname = round(microtime(true)) . '.' . end($temp2);
            $finalCVName = $nam . $newCVname;
            $cv->move($destinationPath, $finalCVName);
            $updateProfile->resume=$finalCVName;
        }


    $updateProfile->applicant_id=Auth::id();
    $updateProfile->skills=$request->skills;
    $updateProfile->Save();

            return redirect('/profile')->with('Message','profile Info Updated!');


    }
}
