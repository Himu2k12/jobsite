<?php

namespace App\Http\Controllers;

use App\CompanyInfo;
use App\Job;
use App\User;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Image;


class WelcomeController extends Controller
{
    public function __construct(Guard $guard)
    {
        $this->user = $guard->user();
    }
    public function home(){
        $today=date('Y-m-d');
        $jobs=Job::whereDate('last_application_date','>=',$today)->simplePaginate(10);
        return view('FrontEnd.Home.home',['jobs'=>$jobs]);
    }
    public function registerCompany(){
        if (Auth::check()) {
            return redirect('/');
        }
        return view('FrontEnd.Register.register-company');
    }
    public function saveCompany(Request $request){
        $this->validate($request,[
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user=new User();
        $user->first_name=$request->first_name;
        $user->last_name=$request->last_name;
        $user->email=$request->email;
        $user->role=2;
        $user->password=Hash::make($request['password']);
        $user->Save();
        $id=$user->id;

        $companyInfo=new CompanyInfo();
        $companyInfo->company_id=$id;
        $companyInfo->business_name=$request->business_name;
        if ($request->file('company_logo')) {
            $logo = $request->file('company_logo');
            $imageName = $logo->getClientOriginalName();
            $directory = 'images/';
            $temp = explode(".", $imageName);
            $newfilename = round(microtime(true)) . '.' . end($temp);
            $imgUrlSlide = $directory . $newfilename;
            Image::make($logo)->resize(null, 530)->save($imgUrlSlide);
            $companyInfo->company_logo=$imgUrlSlide;
        }
       $companyInfo->save();
        Auth::loginUsingId($id);
       return redirect('login');
    }
    public function Detailsjob($slug){
        $jobinfo=Job::where('slug',$slug)->first();
        $companyInfo=CompanyInfo::where('company_id',$jobinfo->company_id)->first();
        return view('FrontEnd.Home.job-details',['jobinfo'=>$jobinfo,'companyInfo'=>$companyInfo]);
    }

}
