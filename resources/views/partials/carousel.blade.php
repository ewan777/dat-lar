<div id="myCarousel" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
    <li data-target="#myCarousel" data-slide-to="1"></li>
    <li data-target="#myCarousel" data-slide-to="2"></li>
  </ol>

  <div class="carousel-inner" role="listbox">

    @foreach ($user_profiles as $i => $user_profile)

    <div class="item {{ ($i==0) ? 'active' : ''}} ">
      <img class="{{ $i }}-slide img-rounded img-responsive"
        src="{{ asset(
          'images/profile_pics/'.$user_profile->user_id.'/'.$user_profile->image_name
          ) }}"
        alt="">
      <div class="container">
        <div class="carousel-caption">
          <p><h4> {{ $user_profile->username }} </h4></p>
          <br>
          <p>
            <a class="btn btn-sm btn-primary" href="#" role="button">My Profile</a>
          </p>
          <br>
        </div> <!-- end caption -->
      </div> <!-- end container  -->
    </div>

    @endforeach

  </div> <!-- end carousel inner -->

  <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>

  <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>

</div><!-- /.carousel -->
