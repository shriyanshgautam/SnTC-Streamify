<html>
    <head>
        <title>SnTC Streamify: @yield('title')</title>
        <meta name="google-signin-client_id" content="954600717616-ccrfigdrmu2iqjh3t5j3cd7vtm6pjm8c.apps.googleusercontent.com">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css?family=Raleway:400,600" rel="stylesheet" type="text/css">
        <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
        <!-- <script src="{{ URL::asset('js/bootstrap-tagsinput.min.js') }}"></script> -->
        <!-- Location PIcker -->
        @if(isset($google_maps_api_key))
        <script type="text/javascript" src='http://maps.google.com/maps/api/js?sensor=false&libraries=places&key={{$google_maps_api_key}}'></script>
        @endif
        <script type="text/javascript" src="{{ URL::asset('js/locationpicker.jquery.min.js') }}"></script>


        <!-- <link rel="stylesheet" href="{{ URL::asset('css/bootstrap-tagsinput.css') }}"/> -->
        <link rel="stylesheet" href="{{ URL::asset('css/style.css') }}"/>
        <!-- Icons and Fonts -->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    </head>
    <body>
        <nav class="navbar navbar-toggleable-md navbar-inverse bg-primary app-nav">
          <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <a class="navbar-brand" href="#"><img style="height:45px;" src="{{ URL::to('/') }}/images/ic_logo1.png"/></a>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">

              <li class="nav-item active">
                <a class="nav-link" href="/app_users">Users</a>
              </li>
              <li class="nav-item active">
                <a class="nav-link" href="/streams">Streams</a>
              </li>
              <li class="nav-item active">
                <a class="nav-link" href="/notifications">Notifications</a>
              </li>
              <li class="nav-item active">
                <a class="nav-link" href="/events">Events</a>
              </li>
              <li class="nav-item dropdown active">
                <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Other Entries
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                  <a class="dropdown-item" href="/authors">Authors</a>
                  <a class="dropdown-item" href="/bodies">Bodies</a>
                  <a class="dropdown-item" href="/locations">Locations</a>
                  <a class="dropdown-item" href="/position_holders">Position Holders</a>
                  <a class="dropdown-item" href="/tags">Tags</a>
                  <a class="dropdown-item" href="/colleges">Colleges</a>
                </div>
              </li>
              <li class="nav-item active">
                <a class="nav-link" href="/contents">Contents</a>
              </li>
              <li class="nav-item active">
                <a class="nav-link" href="/feedbacks">Feedbacks</a>
              </li>
              <li class="nav-item active">
                <a class="nav-link" href="/app_posts">Posts</a>
              </li>
              <li class="nav-item active">
                <a class="nav-link" href="/app_feedbacks">App Feedbacks</a>
              </li>
            </ul>
            <form id="logoutForm" action="/logout" method="POST">
                {{ csrf_field() }}
              <input type="hidden" name="name" value="0">
              <button class="btn btn-outline-success my-2 my-sm-0" type="button" onclick="signOut()">Logout</button>
            </form>

          </div>
        </nav>

        <!-- @section('sidebar')
            This is the master sidebar.
        @show -->

        <div class="container">
            @yield('content')
        </div>
    </body>
    <script>

        function onLoad() {
          gapi.load('auth2', function() {
            gapi.auth2.init();
          });
        }

        function signOut() {
            var auth2 = gapi.auth2.getAuthInstance();
            auth2.signOut().then(function () {
              console.log('User signed out.');
              $('#logoutForm').submit();
            });

          }
    </script>
     <script src="https://apis.google.com/js/platform.js?onload=onLoad" async defer></script>
</html>
