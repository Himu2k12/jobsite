<div class="site-wrap">

    <div class="site-mobile-menu">
        <div class="site-mobile-menu-header">
            <div class="site-mobile-menu-close mt-3">
                <span class="icon-close2 js-menu-toggle"></span>
            </div>
        </div>
        <div class="site-mobile-menu-body"></div>
    </div> <!-- .site-mobile-menu -->


    <header class="site-navbar py-1" role="banner">

        <div class="container">
            <div class="row align-items-center">

                <div class="col-6 col-xl-2">
                    <h1 class="mb-0"><a href="index.html" class="text-black h2 mb-0">Job<strong>start</strong></a></h1>
                </div>

                <div class="col-10 col-xl-10 d-none d-xl-block">
                    <nav class="site-navigation text-right" role="navigation">

                        <ul class="site-menu js-clone-nav mr-auto d-none d-lg-block">
                            <li class="active"><a href="{{url('/')}}">Home</a></li>
                            @if(!\Illuminate\Support\Facades\Auth::check())
                            <li class="has-children">
                                <a href="#">Register</a>
                                <ul class="dropdown">
                                    <li><a href="{{url('register-company')}}">As Company</a></li>
                                    <li><a href="{{route('register')}}">As Applicant</a></li>
                                </ul>
                            </li>
                            @endif
                            @can('isApplicant')
                            <li><a href="">Profile</a></li>
                            @endcan
                            @can('isCompany')
                            <li><a href="">DashBoard</a></li>
                            <li><a href="{{url('job-form')}}">Create Job</a></li>
                            @endcan
                            @if(Auth::check())
                                <li> <a class="" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
({{Auth::user()->first_name}})-{{ __('Logout') }}
                                </a></li>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            @else
                                <li><a href="{{url('login')}}">Login</a></li>
                                @endif
                            <li><a href="new-post.html"><span class="rounded bg-primary py-2 px-3 text-white"><span class="h5 mr-2">+</span> Post a Job</span></a></li>
                        </ul>
                    </nav>
                </div>

                <div class="col-6 col-xl-2 text-right d-block">

                    <div class="d-inline-block d-xl-none ml-md-0 mr-auto py-3" style="position: relative; top: 3px;"><a href="#" class="site-menu-toggle js-menu-toggle text-black"><span class="icon-menu h3"></span></a></div>

                </div>

            </div>
        </div>

    </header>
