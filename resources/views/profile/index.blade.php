@extends('layouts.app')
@section('content')

  <h1 class="text-center">
    Welcome {{ $profile->username }}
  </h1>
  <hr>

  <div class="row">

    <div class="col-md-6">
      @if (\Auth::user()->id == $profile->user_id)
        <a style="position:relative; left:2px;" class="btn btn-link" href="{{ route('profile.edit') }}">[ Edit Profile ]</a>
        <a style="position:relative; left:-10px" class="btn btn-link" href="{{ route('profile.upload_image')}}">[ Upload/Change Image ]</a>
      @endif

      <div class="row"> <!-- mini row  -->

        <div class="col-sm-6">
          <img class="img-thumbnail img-responsive" src="{{ route('profile.profile_pic', ['filename'=>$profile->image_name]) }}" alt="user-image" height="500" width="500">
        </div> <!-- end cols  -->

        <div class="col-sm-6">
          <div class="well" style="width:auto; height:250px;">
            <h4>{{ $profile->username }}</h4><hr>
            <p>Sex: {{ ucfirst($profile->sex) }} </p>
            <p>Age Group: {{ $profile->age_group }} </p>
            <p>Nationality: {{ $profile->nationality }}</p>
          </div>
        </div> <!-- end cols  -->

      </div> <!-- end mini row  -->

    </div> <!-- end cols  -->

  </div> <!-- end row  -->

  <div class="row">
    <div class="col-md-6">
      <div class="well">
        <h4 class="text-center">About Me</h4>
        <hr>
        <p class="">{{ $profile->about_me }}</p>
      </div>
    </div> <!-- end cols  -->

    <div class="col-md-6">
    </div> <!-- end cols  -->

  </div> <!-- end row  -->

  <div class="row">

    <div class="col-md-6">
      <div class="well">
        <h4 class="text-center">What I Am Looking For</h4>
        <hr>
        <p class="">{{ $profile->looking_for }}</p>
      </div>
    </div> <!-- end cols  -->

    <div class="col-md-6">
    </div> <!-- end cols  -->

  </div> <!-- end row  -->


@endsection
