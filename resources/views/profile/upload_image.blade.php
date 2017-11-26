@extends('layouts.app')
@section('content')

<div class="row">
<div class="col-md-6 col-md-offset-3">
  <h1 class="text-center">
    Upload A Profile Image
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

  <form class="form" action="{{ route('profile.save_image') }}" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}

    <div class="form-group">
      <label for="image_upload">Select Image File</label>
      <input class="form-control" type="file" name="profile_pic" id="image_upload">
    </div>

    <button class="btn btn-success btn-block" type="submit" name="button">Upload Image</button>

  </form>




</div>
</div>

@endsection
