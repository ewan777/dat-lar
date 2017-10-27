<nav class="navbar navbar-inverse" style="border-radius:0;">

  <div class="container">

    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="/">LB Dating</a>
    </div>

    <div id="navbar" class="collapse navbar-collapse">

      <ul class="nav navbar-nav">
        <li><a href="/">Home</a></li>
        <li><a href="/about">About</a></li>
      </ul>

      <ul class="nav navbar-nav navbar-right">
        @if(Auth::check())
          <li>
            <a href="{{ route('payment') }}">VIP</a>
          </li>
          <li>
            <a href="{{ route('user.profile') }}"><span class="glyphicon glyphicon-user"></span> Profile</a>
          </li>
          <li>
            <a href="{{ route('user.logout') }}"><span class="glyphicon glyphicon-log-out"></span> Logout</a>
          </li>
        @else
          <li>
            <a href="{{ route('user.signup') }}"><span class="glyphicon glyphicon-user"></span> Sign Up</a>
          </li>
          <li>
            <a href="{{ route('user.login') }}"><span class="glyphicon glyphicon-log-in"></span> Login</a>
          </li>
        @endif
      </ul>

    </div><!--/.nav-collapse -->

  </div>

</nav>
