@extends('app')

@section('title', 'Page Title')

<!-- @section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection -->


@section('content')

    <div class="row" style="display:flex;flex:1">
        <div class="col-4 p-3" >
              <h3 class="p-2">Locations</h3>
              <ul class="list-group p-2">
                <li class="list-group-item"><a href="\locations">View Locations</a></li>
                <li class="list-group-item"><a href="\locations\create">Create Locations</a></li>
              </ul>
        </div>
        <div class="col-8 p-3" style="overflow-y:scroll;flex:1">
            @yield('main-content')

        </div>

    </div>
@endsection
