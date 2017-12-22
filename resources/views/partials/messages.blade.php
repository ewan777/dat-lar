@if(Session::has('success'))
  <div class="alert alert-success alert-dismissable text-center">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    {{ Session::get('success') }}
  </div>
@endif

@if(Session::has('warning'))
  <div class="alert alert-danger alert-dismissable text-center">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    {{ Session::get('warning') }}
  </div>
@endif
