@extends('layouts.app')
@section('content')

  <h1 class="text-center">
    Welcome {{ Auth::user()->username }}
  </h1>
  <hr>

  <div class="row">

    <div class="col-md-6">
      <div class="well">
        <h4 class="text-center">Pic</h4>
        <hr>
        <p class="lead">Your Pic</p>
      </div>
    </div> <!-- end cols  -->

    <div class="col-md-6">
      <div class="row">
        <div class="col-md-4">
          <div class="well">
            <h4 class="text-center">Username</h4>
            <hr>
            <p class="">{{ Auth::user()->username }}</p>
          </div>
        </div> <!-- end cols  -->

        <div class="col-md-4">
          <div class="well">
            <h4 class="text-center">Age Group</h4>
            <hr>
            <p class="">{{ Auth::user()->profile->age_group }}</p>
          </div>
        </div> <!-- end cols  -->

        <div class="col-md-4">
          <div class="well">
            <h4 class="text-center">Nationality</h4>
            <hr>
            <p class="">{{ Auth::user()->profile->nationality }}</p>
          </div>
        </div> <!-- end cols  -->

      </div> <!-- end row  -->
    </div> <!-- end cols  -->

  </div> <!-- end row  -->

  <div class="row">
    <div class="col-md-6">
    </div> <!-- end cols  -->

    <div class="col-md-6">
      <div class="well">
        <h4 class="text-center">About Me</h4>
        <hr>
        <p class="">{{ Auth::user()->profile->about_me }}</p>
      </div>
    </div> <!-- end cols  -->

  </div> <!-- end row  -->

  <div class="row">
    <div class="col-md-6">
    </div> <!-- end cols  -->

    <div class="col-md-6">
      <div class="well">
        <h4 class="text-center">What I Am Looking For</h4>
        <hr>
        <p class="">{{ Auth::user()->profile->looking_for }}</p>
      </div>
    </div> <!-- end cols  -->

  </div> <!-- end row  -->


@endsection
