@extends('layouts.app')
@section('content')

  <h1 class="text-center">
    Welcome {{ $profile->username }}
  </h1>
  <hr>

  <div class="row" id="row-1">
    <div class="col-md-6">
      @if (\Auth::user()->id == $profile->user_id)
        <a class="center-block btn btn-link" href="{{ route('profile.edit') }}">[ Edit Profile ]</a>
      @endif

      <div class="well" style="width:auto; height:250px;">
        <h4 class="text-center">{{ $profile->username }}</h4><hr>
        <p>Sex: {{ ucfirst($profile->sex) }} </p>
        <p>Age Group: {{ $profile->age_group }} </p>
        <p>Nationality: {{ $profile->nationality }}</p>
      </div>

    </div> <!-- end cols -->

    <div class="col-md-6">
      @if (\Auth::user()->id == $profile->user_id)
        <a class="center-block btn btn-link" href="{{ route('profile.upload_image')}}">[ Upload/Change Image ]</a>
      @endif

      {{-- <img class="img-thumbnail img-responsive center-block" src="{{ route('profile.profile_pic', ['filename'=>$profile->image_name]) }}" alt="user-image" style="max-height:250px; width:auto;"> --}}

      <img class="img-thumbnail img-responsive center-block"
        src="{{ asset(
          'images/profile_pics/'.\Auth::user()->id.'/'.$profile->image_name
          ) }}"
      alt="user-image">

    </div> <!-- end cols  -->

  </div> <!-- end row 1 -->
  <hr>
  <div class="row" id="row-2">
    <div class="col-md-6">
      <div class="well">
        <h4 class="text-center">About Me</h4>
        <hr>
        <p class="">{{ $profile->about_me }}</p>
      </div>
    </div> <!-- end cols  -->

    <div class="col-md-6">
      <div class="well">
        hello from row 2
      </div>
    </div> <!-- end cols  -->

  </div> <!-- end row 2 -->

  <div class="row" id="row-3">
    <div class="col-md-6">
      <div class="well">
        <h4 class="text-center">What I Am Looking For</h4>
        <hr>
        <p class="">{{ $profile->looking_for }}</p>
      </div>
    </div> <!-- end cols  -->

    <div class="col-md-6">
      <div class="well">
        hello from row 3
      </div>
    </div> <!-- end cols  -->
  </div> <!-- end row 3  -->


@endsection
