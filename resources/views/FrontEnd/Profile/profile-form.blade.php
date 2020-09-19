@extends('FrontEnd.master')

@section('body')
    <div class="unit-5 overlay" style="background-image: url('{{asset('/Asset/')}}/images/hero_bg_2.jpg');">
        <div class="container text-center">
            <h2 class="mb-0">Profile</h2>
            <p class="mb-0 unit-6"><a href="">Home</a> <span class="sep">></span> <span>Update your Profile</span></p>
        </div>
    </div>
    <div class="site-section bg-light">
        <div class="container">
            <div class="row">

                <div class="col-md-12 col-lg-12 mb-5">
                    <h4 style="text-align: center" class="text-success">{{ Session::get('Message') }}</h4>
                    <h4 style="text-align: center" class="text-danger">{{ Session::get('MessageDanger') }}</h4>
                    @if(isset($existingProfile))
                    <form action="{{route('update-profile')}}" method="post" class="p-5 bg-white" enctype="multipart/form-data">
                        @else
                    <form action="{{route('create-profile')}}" method="post" class="p-5 bg-white" enctype="multipart/form-data">
                        @endif
                        @csrf
                        <div class="row form-group">
                            <div class="col-md-12 mb-3 mb-md-0">
                                <label class="font-weight-bold" for="fullname">Profile Picture</label>
                                <input type="file"  @if(!isset($existingProfile)) required @endif accept="images/*" onchange="readProfilePic(this)" class="form-control" name="profile_picture">
                                @if(isset($existingProfile))
                               <input type="hidden" name="id" value="{{$existingProfile->id}}">
                                @endif
                                    <img id="profilePic">
                                @if(isset($existingProfile))
                                    <img id="newpic" src="{{asset($existingProfile->profile_picture)}}" height="200" width="200">
                                    @endif
                                @error('profile_picture')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-12">
                                <label class="font-weight-bold" for="email">Skills</label>
                                <textarea id="summernote" required name="skills" class="form-control">  @if(isset($existingProfile)) {{$existingProfile->skills}}@else {{old('skills')}} @endif</textarea>
                                @error('skills')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-12">
                                <label class="font-weight-bold">Resume</label>
                                <input type="file" accept=".pdf,.doc,.docx" @if(!isset($existingProfile)) required @endif class="form-control" name="resume">
                                @error('resume')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            @if(isset($existingProfile))  <a target="_blank" href="{{asset('/images/'.$existingProfile->resume)}}"> {{$existingProfile->resume}}</a>@endif
                        </div>

                        <div class="row form-group">
                            <div class="col-md-12">
                                @if(isset($existingProfile))
                                <input type="submit" value="Update" class="btn btn-primary  py-2 px-4">
                                    @else
                                    <input type="submit" value="Create" class="btn btn-primary  py-2 px-4">
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

<script>
    $('#summernote').summernote({
        placeholder: 'Enter Skills here',
        tabsize: 4,
        height: 200,
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'underline', 'clear']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['insert', ['link', 'picture', 'video']],
            ['view', ['fullscreen', 'codeview', 'help']]
        ]
    });

    function readProfilePic(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#newpic').hide();
                $('#profilePic')
                    .attr('src', e.target.result)
                    .width(200)
                    .height(200);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

@endsection
