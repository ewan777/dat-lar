@extends('layouts.app')
@section('content')

<div class="row">
<div class="col-md-6 col-md-offset-3">
  <h1 class="text-center">
    Create Your Profile
  </h1>
  <hr>

  @if(count($errors) > 0)
    <div class="alert alert-danger alert-dismissable">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      @foreach ($errors->all() as $error)
        <ul>
          <li>{{$error}}</li>
        </ul>
      @endforeach
    </div>
  @endif

  <form class="form" action="{{ route('profile.create') }}" method="post">
    {{ csrf_field() }}

    <div class="form-group">
      <label for="about_me">About Me</label>
      <textarea class="form-control" name="about_me" id="about_me"></textarea>
    </div>

    <div class="form-group">
      <label for="age_group">Age Group</label>
      <select class="form-control" name="age_group" id="age_group">
        <option>18-25</option>
        <option>26-35</option>
        <option>36-45</option>
        <option>Over 45</option>
      </select>
    </div>

    <div class="form-group">
      <label for="nationality">Nationality</label>
      <input class="form-control" type="text" name="nationality" id="nationality">
    </div>

    <div class="form-group">
      <label for="looking_for">What I Am Looking For</label>
      <textarea class="form-control" name="looking_for" id="looking_for"></textarea>
    </div>

    <button class="btn btn-success btn-block" type="submit" name="button">Create Your Profile</button>

  </form>

</div>
</div>

@endsection
