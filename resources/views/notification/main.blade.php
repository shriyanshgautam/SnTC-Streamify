@extends('app')

@section('title', 'Page Title')

<!-- @section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection -->


@section('content')

    <div class="row" style="display:flex;flex:1">
        <div class="col-4 p-3" >
              <h3 class="p-2">Notifications</h3>
              <ul class="list-group p-2">
                <li class="list-group-item"><a href="\notifications">View Notifications</a></li>
                <li class="list-group-item"><a href="\notifications\create">Create New Notifications</a></li>
              </ul>
        </div>
        <div class="col-8 p-3">
            @yield('main-content')

        </div>

    </div>
@endsection
