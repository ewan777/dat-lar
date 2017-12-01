@extends('layouts.app')
@section('content')

  <div class="row">
  <div class="col-md-10 col-md-offset-1">

  <h1 class="text-center">
    Welcome {{ $profile->username }}
  </h1>
  <hr>

  <div class="row" id="row-1">
    <div class="col-md-6">
      @if (\Auth::user()->id == $profile->user_id)
        <a class="center-block btn btn-link"
          href="{{ route('profile.edit', $profile->user_id) }}">[ Edit Profile ]</a>
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
      <div style="background:#f5f5f5; padding:10px; border:1px solid #e3e3e3; border-radius:3px;">
        <img class="img-thumbnail img-responsive center-block"
          src="{{ asset(
            'images/profile_pics/'.$profile->id.'/'.$profile->image_name
            ) }}"
          alt="user-image">
      </div>

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
        <h4 class="text-center">What I Am Looking For</h4>
        <hr>
        <p class="">{{ $profile->looking_for }}</p>
      </div>
    </div> <!-- end cols  -->

  </div> <!-- end row 2 -->

  <hr>

  <div class="row" id="row-3">

    <div class="col-md-6">
      <div class="well">
        <h4 class="text-center">Become A Member</h4>
        <hr>
        <p>You are encouraged to become a privileged member, this will allow you to like, message and chat with other members</p>
        <p>Have a look at some recently joined members to the right</p>
      </div>
    </div> <!-- end cols  -->

    <div class="col-md-6">
      <div style="background:#f5f5f5; padding:10px; border:1px solid #e3e3e3; border-radius:3px;">
        <div class="center-block" style="width:325px; height:250px;">
            @include('partials.carousel')
        </div>
      </div>
    </div> <!-- end cols  -->

  </div> <!-- end row 3  -->
  <hr>
  <br>

  </div>
  </div>

@endsection
