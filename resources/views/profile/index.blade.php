@extends('layouts.app')
@section('content')

  <h1 class="text-center">
    Welcome {{ Auth::user()->username }}
  </h1>
  <hr>

  <div class="row">

    <div class="col-md-6">
      @if (Auth::user()->canModifyProfile())
        <a style="position:relative; right:10px;" class="btn btn-link" href="{{ route('profile.edit') }}">[ Edit Profile ]</a>
        <a style="position:relative; left: -30px" class="btn btn-link" href="{{ route('profile.edit') }}">[ Upload Image ]</a>
      @endif
      <div class="row"> <!-- mini row  -->

        <div class="col-sm-6">
            <img class="img-thumbnail img-responsive" src="http://lorempixel.com/500/500/" alt="user" height="250" width="250">
        </div> <!-- end cols  -->

        <div class="col-sm-6">
          <div class="well" style="width:auto; height:250px;">
            <h4>{{ Auth::user()->username }}</h4><hr>
            <p>Sex: {{ Auth::user()->sex}} </p>
            <p>Age Group: {{ Auth::user()->profile->age_group }} </p>
            <p>Nationality: {{ Auth::user()->profile->nationality }}</p>
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
        <p class="">{{ Auth::user()->profile->about_me }}</p>
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
        <p class="">{{ Auth::user()->profile->looking_for }}</p>
      </div>
    </div> <!-- end cols  -->

    <div class="col-md-6">
    </div> <!-- end cols  -->

  </div> <!-- end row  -->


@endsection
