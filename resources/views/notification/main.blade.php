@extends('app')

@section('title', 'Notifications')

<!-- @section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection -->


@section('content')

    <div class="row">
        <div class="col-lg-4 col-md-12 p-3 " >
              <h3 class="p-2">Notifications</h3>
              <ul class="list-group">
                <li class="list-group-item"><a href="\notifications">View Notifications</a></li>
                <li class="list-group-item"><a href="\notifications\create">Create New Notifications</a></li>
              </ul>
        </div>

        <div class="col-lg-8 col-md-12 p-3" style="overflow-y:scroll;flex:1">
            @yield('main-content')
        </div>

    </div>
@endsection
