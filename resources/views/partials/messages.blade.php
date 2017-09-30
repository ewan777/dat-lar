@if(Session::has('flash_message'))
  <div class="alert alert-success alert-dismissable text-center">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    {{ Session::get('flash_message') }}
  </div>
@endif

@if(Session::has('flash_warning'))
  <div class="alert alert-danger alert-dismissable text-center">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    {{ Session::get('flash_warning') }}
  </div>
@endif
