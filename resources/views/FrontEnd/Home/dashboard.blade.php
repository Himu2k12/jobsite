@extends('FrontEnd.master')

@section('body')




    <div class="site-section bg-light">
        <div class="container">
            <h4 style="text-align: center" class="text-success">{{ Session::get('Message') }}</h4>
            <div class="row justify-content-start text-left mb-5">
                <div class="col-md-9" data-aos="fade">
                    <h2 class="font-weight-bold text-black">Recent Jobs</h2>
                </div>
                <div class="col-md-3" data-aos="fade" data-aos-delay="200">
                    <a href="#" class="btn btn-primary py-3 btn-block"><span class="h5">+</span> Post a Job</a>
                </div>
            </div>
            @foreach($jobApplications as $job)
                <div class="row" data-aos="fade">
                    <div class="col-md-12">

                        <div class="job-post-item bg-white p-4 d-block d-md-flex align-items-center">

                            <div class="mb-4 mb-md-0 mr-5">
                                <div class="job-post-item-header d-flex align-items-center">
                                    <a href=""> <h2 class="mr-3 text-black h4">{{$job->Jobs($job->job_id)->job_title}}</h2></a>
                                    <div class="badge-wrap">
                                        <span class="bg-primary text-white badge py-2 px-4">Hot jobs</span>
                                    </div>
                                </div>
                                <div class="job-post-item-body d-block d-md-flex">
                                </div>
                                <div><b>First Name:</b> <span>{{$job->userInfo($job->applicant_id)->first_name}}</span></div>
                                <div><b>Last Name:</b><span>{{$job->userInfo($job->applicant_id)->last_name}}</span></div>
                                <div><b>Email:</b><span>{{$job->userInfo($job->applicant_id)->email}}</span></div>
                                <div><b>Profile Picture:</b><span><img src="{{$job->applicantsInfo($job->applicant_id)->profile_picture}}" width="200" height="200"> </span></div>
                                <div><b>CV:</b><a target="_blank" href="{{asset('/images/'.$job->applicantsInfo($job->applicant_id)->resume)}}"> <span>{{$job->applicantsInfo($job->applicant_id)->resume}}</span></a></div>
                            </div>

                            <div class="ml-auto">
                                <a href="#" class="btn btn-secondary rounded-circle btn-favorite text-gray-500"><span class="icon-heart"></span></a>
                                @can('isApplicant')
                                    <a href="{{url('apply_job/'.$job->slug)}}" class="btn btn-primary py-2">Apply Job</a>
                                @endcan
                            </div>
                        </div>

                    </div>
                </div>
            @endforeach
            <div class="row mt-5">
                <div class="col-md-12 text-center">
                    <div class="site-block-27">
                        <ul>
                            <li><a href="#"><i class="icon-keyboard_arrow_left h5"></i></a></li>
                            <li class="active"><span>1</span></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">4</a></li>
                            <li><a href="#">5</a></li>
                            <li><a href="#"><i class="icon-keyboard_arrow_right h5"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>


        </div>
    </div>

@endsection
