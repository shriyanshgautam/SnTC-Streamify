@extends('app')

@section('title', 'Page Title')

<!-- @section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection -->


@section('content')
    <h3 class="p-3">Streams</h3>
    <div class="row">
        <div class="col-4 p-3" >
              <ul class="list-group">
                <li class="list-group-item"><a href="\streams">View Streams</a></li>
                <li class="list-group-item"><a href="\streams\create">Create New Streams</a></li>
              </ul>
        </div>
        <div class="col-8 p-3">
            @yield('main-content')

        </div>

    </div>
@endsection
