@extends('FrontEnd.master')

@section('body')

    <div class="site-blocks-cover" style="background-image: url({{asset('Asset/')}}/images/hero_bg_1.jpg);" data-aos="fade" data-stellar-background-ratio="0.5">
        <div class="container">
            <div class="row row-custom align-items-center">
                <div class="col-md-10">
                    <h1 class="mb-2 text-black w-75"><span class="font-weight-bold">Largest Job</span> Site On The Net</h1>
                    <div class="job-search">
                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active py-3" id="pills-job-tab" data-toggle="pill" href="#pills-job" role="tab" aria-controls="pills-job" aria-selected="true">Find A Job</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link py-3" id="pills-candidate-tab" data-toggle="pill" href="#pills-candidate" role="tab" aria-controls="pills-candidate" aria-selected="false">Find A Candidate</a>
                            </li>
                        </ul>
                        <div class="tab-content bg-white p-4 rounded" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-job" role="tabpanel" aria-labelledby="pills-job-tab">
                                <form action="#" method="post">
                                    <div class="row">
                                        <div class="col-md-6 col-lg-3 mb-3 mb-lg-0">
                                            <input type="text" class="form-control" placeholder="eg. Web Developer">
                                        </div>
                                        <div class="col-md-6 col-lg-3 mb-3 mb-lg-0">
                                            <div class="select-wrap">
                                                <span class="icon-keyboard_arrow_down arrow-down"></span>
                                                <select name="" id="" class="form-control">
                                                    <option value="">Category</option>
                                                    <option value="fulltime">Full Time</option>
                                                    <option value="fulltime">Part Time</option>
                                                    <option value="freelance">Freelance</option>
                                                    <option value="internship">Internship</option>
                                                    <option value="internship">Termporary</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-3 mb-3 mb-lg-0">
                                            <input type="text" class="form-control form-control-block search-input" id="autocomplete" placeholder="Location" onFocus="geolocate()">
                                        </div>
                                        <div class="col-md-6 col-lg-3 mb-3 mb-lg-0">
                                            <input type="submit" class="btn btn-primary btn-block" value="Search">
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane fade" id="pills-candidate" role="tabpanel" aria-labelledby="pills-candidate-tab">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="site-section bg-light">
        <div class="container">
            <h4 style="text-align: center" class="text-success">{{ Session::get('Message') }}</h4>
            <div class="row justify-content-start text-left mb-5">
                <div class="col-md-9" data-aos="fade">
                    <h2 class="font-weight-bold text-black">Recent Jobs</h2>
                </div>

            </div>

            @foreach($jobs as $job)
            <div class="row" data-aos="fade">
                <div class="col-md-12">

                    <div class="job-post-item bg-white p-4 d-block d-md-flex align-items-center">

                        <div class="mb-4 mb-md-0 mr-5">
                            <div class="job-post-item-header d-flex align-items-center">
                               <a href="{{url('job-details/'.$job->slug)}}"> <h2 class="mr-3 text-black h4">{{$job->job_title}}</h2></a>
                                <div class="badge-wrap">
                                    <span class="bg-primary text-white badge py-2 px-4">Hot jobs</span>
                                </div>
                            </div>
                            <div class="job-post-item-body d-block d-md-flex">
                                <div class="mr-3"><span class="fl-bigmug-line-portfolio23"></span> <a href="#">{{$job->businessName($job->company_id)->business_name}}</a></div>
                                <div><span class="fl-bigmug-line-big104"></span> <span>{{$job->location}},{{$job->country}}</span></div>
                            </div>
                        </div>

                        <div class="ml-auto">
                             @can('isApplicant')
                                @if(!isset($job->alreadyApplied($job->id,\Illuminate\Support\Facades\Auth::user()->id)->id))
                            <a href="{{url('apply_job/'.$job->slug)}}" class="btn btn-primary py-2">Apply Job</a>
                                    @else
                                    <button class="btn btn-success py-2">Already Applied</button>
                                    @endif
                                @endcan
                        </div>
                    </div>

                </div>
            </div>
            @endforeach
            {{ $jobs->links() }}



        </div>
    </div>

@endsection
