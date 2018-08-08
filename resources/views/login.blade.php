<html>
    <head>
        <title>SnTC Streamify</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
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
    </head>
    <body class="bg-dark">
        <!-- <nav class="navbar navbar-toggleable-md navbar-inverse bg-dark app-nav">
          <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <a class="navbar-brand" href="#"><img style="height:45px;" src="{{ URL::to('/') }}/images/ic_logo1.png"/></a>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">




          </div>
        </nav> -->

        <!-- @section('sidebar')
            This is the master sidebar.
        @show -->
        <div class="flex-container">

            <div class="custom_row">
                <a class="navbar-brand flex-item" href="#"><img style="height:55px;margin" src="{{ URL::to('/') }}/images/ic_logo1.png"/></a>
                <div id="my-signin2" class="flex-item"></div>
                <div id="msg" class="flex-item">
                    @if (session('status'))
                        <div class="alert alert-{{session('status')}}" class="flex-item">
                            <h4>{{ session('status_string') }}</h4>
                        </div>
                    @endif
                </div>
            </div>
            <form id="auth_form" action="\login" method="POST" >
                {!! csrf_field() !!}
                <input id="google_token" type="hidden" name="google_token"  />
                <input id="user_email" type="hidden" name="user_email"  />
            </form>

        </div>

        <!-- <div class="container">

        </div> -->
    </body>
    <script>
    function onSuccess(googleUser) {

      @if (session('status'))
         logout();
         console.log('Logged in as: ' + googleUser.getBasicProfile().getName());
         $('#msg').html('<h4>Hi, '+googleUser.getBasicProfile().getName()+"</h4><br/><h5>logging you in...</h5>");
         $('#my-signin2').hide();
         var id_token = googleUser.getAuthResponse().id_token;
         $('#google_token').val(id_token);
         $('#user_email').val(googleUser.getBasicProfile().getEmail());
         $('#auth_form').submit();
      @else
          console.log('Logged in as: ' + googleUser.getBasicProfile().getName());
          $('#msg').html('<h4>Hi, '+googleUser.getBasicProfile().getName()+"</h4><br/><h5>logging you in...</h5>");
          $('#my-signin2').hide();
          var id_token = googleUser.getAuthResponse().id_token;
          $('#google_token').val(id_token);
          $('#user_email').val(googleUser.getBasicProfile().getEmail());
          $('#auth_form').submit();
      @endif

    }
    function onFailure(error) {
      console.log(error);
      $('#msg').html('<h4>Sorry, '+error+"</h4><br/><h5>error in logging in</h5>");
    }

    function logout(){
        gapi.load('auth2', function() {
          gapi.auth2.init();

          var auth2 = gapi.auth2.getAuthInstance();
          auth2.signOut().then(function () {
            console.log('User signed out.');
          });
        });
    }

    function renderButton() {
          gapi.signin2.render('my-signin2', {
            'scope': 'profile email',
            'width': 240,
            'height': 50,
            'longtitle': true,
            'theme': 'dark',
            'onsuccess': onSuccess,
            'onfailure': onFailure
          });

    }
  </script>

  <script src="https://apis.google.com/js/platform.js?onload=renderButton" async defer></script>
</html>
