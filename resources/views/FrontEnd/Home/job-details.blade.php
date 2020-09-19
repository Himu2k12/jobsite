@extends('FrontEnd.master')

@section('body')
    <div class="site-section bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-8 mb-5">
                    <div class="p-5 bg-white">
                        <div class="mb-4 mb-md-5 mr-5">
                            <div class="job-post-item-header d-flex align-items-center">
                                <h2 class="mr-3 text-black h4">{{$jobinfo->job_title}}</h2>
                                <div class="badge-wrap">
                                    <span class="bg-danger text-white badge py-2 px-4">Last Date: {{$jobinfo->last_application_date}}</span>
                                </div>
                            </div>
                            <div class="job-post-item-body d-block d-md-flex">
                                <div class="mr-3"><span class="fl-bigmug-line-portfolio23"></span> <a href="#">{{$companyInfo->business_name}}</a></div>
                                <div><span class="fl-bigmug-line-big104"></span> <span>{{$jobinfo->location}},{{$jobinfo->country}}</span></div>
                            </div>
                        </div>
                        <p>{{$jobinfo->job_description}}</p>
                        @can('isApplicant')
                            @if(($jobinfo->alreadyApplied($jobinfo->id,\Illuminate\Support\Facades\Auth::user()->id)->id)==null)
                        <p class="mt-5"><a href="{{url('apply_job/'.$jobinfo->slug)}}" class="btn btn-primary  py-2 px-4">Apply Job</a></p>
                            @else
                                <button class="btn btn-success py-2">Already Applied</button>
                            @endif
                            @endcan
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="p-4 mb-3 bg-white">
                        <h3 class="h5 text-black mb-3">Company Logo</h3>
                        <p>
                            @if($companyInfo->company_logo)
                            <img width="100px" src="{{asset($companyInfo->company_logo)}}">
                                @else
                                <img src="https://thumbs.dreamstime.com/b/no-image-available-icon-flat-vector-illustration-132483053.jpg" width="200px">
                            @endif
                        </p>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="py-5 bg-primary">
    @endsection
