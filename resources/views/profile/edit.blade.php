@extends('layouts.app')
@section('content')

<div class="row">
<div class="col-md-6 col-md-offset-3">
  <h1 class="text-center">
    Edit Your Profile
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

  <form class="form" action="{{ route('profile.update', $profile->user_id) }}" method="post">
    {{ csrf_field() }}
    <input type="hidden" name="_method" value="PUT">

    <div class="form-group">
      <label for="about_me">About Me</label>
      <textarea rows="5" class="form-control" name="about_me" id="about_me">{{ $profile->about_me }}</textarea>
    </div>

    <div class="form-group">
      <label for="age_group">Age Group</label>
      <select class="form-control" name="age_group" id="age_group">
        <option {{( $profile->age_group == '18-25') ? 'selected':''}} >18-25</option>
        <option {{( $profile->age_group == '26-35') ? 'selected':''}} >26-35</option>
        <option {{( $profile->age_group == '36-45') ? 'selected':''}} >36-45</option>
        <option {{( $profile->age_group == 'Over 45') ? 'selected':''}}>Over 45</option>
      </select>
    </div>

    <div class="form-group">
      <label for="nationality">Nationality</label>
      <input value="{{ $profile->nationality }}" class="form-control" type="text" name="nationality" id="nationality">
    </div>

    <div class="form-group">
      <label for="looking_for">What I Am Looking For</label>
      <textarea rows="5" class="form-control" name="looking_for" id="looking_for">{{ $profile->looking_for }}</textarea>
    </div>

    <button class="btn btn-success btn-block" type="submit" name="button">Update</button>

  </form>
  <a style="position:relative; right:12px;" class="btn btn-link" href="{{ route('profile', $profile->user_id) }}">[ Cancel ]</a>


</div>
</div>

@endsection
