@extends('app')

@section('title', 'Page Title')

<!-- @section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection -->


@section('content')
    <h3 class="p-3">Content</h3>
    <div class="row">
        <div class="col-4 p-3" >
              <ul class="list-group">
                <li class="list-group-item"><a href="\contents">View Contents</a></li>
                <li class="list-group-item"><a href="\contents\create">Create Contents</a></li>
              </ul>
        </div>
        <div class="col-8 p-3">
            @yield('main-content')

        </div>

    </div>
@endsection
