@extends('location.main')

@section('main-content')

<div class="row">
    <div class="col-12">
        @if (count($locations)>0)

        <table class="table table-hover">
          <thead>
            <tr>
              <th>#</th>
              <th>Name</th>
              <th>Address</th>
              <th>Description</th>
              <th>Map</th>
              <th>-</th>
            </tr>
          </thead>
          <tbody>
              @foreach ($locations as $location)
                  <tr>
                    <th scope="row">{{$location->id}}</th>
                    <td>{{$location->name}}</td>
                    <td>{{$location->address}}</td>
                    <td>{{$location->description}}</td>
                    <td><iframe width="200" height="200" frameborder="0" style="border:0"
                    src="https://www.google.com/maps/embed/v1/place?zoom={{$location->zoom}}&q={{$location->latitude}},{{$location->longitude}}&key={{$google_maps_api_key}}" allowfullscreen></iframe>
                    </td>
                    <td>
                        <form action="locations/{{$location->id}}/edit/" method="get">
                            <button type="submit" class="btn btn-primary">
                                <i class="material-icons md-18" style="font-size:16px;">mode_edit</i>
                            </button>
                        </form>
                        <form method="post" action="/locations/{{$location->id}}">
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" class="btn btn-danger">
                                {{ csrf_field() }}
                                <i class="material-icons md-18" style="font-size:16px;">delete</i>
                            </button>
                        </form>
                    </td>
                  </tr>
              @endforeach
          </tbody>
        </table>

        <nav aria-label="Page navigation example">
          <ul class="pagination justify-content-center">


            @if($locations->currentPage()!=1)
                <li class="page-item">
                  <a class="page-link" href="{{$locations->previousPageUrl()}}" tabindex="-1">Previous</a>
                </li>
                <li class="page-item"><a class="page-link" href="{{$locations->previousPageUrl()}}">{{$locations->currentPage()-1}}</a></li>
            @else
                <li class="page-item disabled">
                  <a class="page-link" href="#" tabindex="-1">Previous</a>
                </li>

            @endif
            <li class="page-item active">
              <a class="page-link" href="#">{{$locations->currentPage()}}<span class="sr-only">(cuurent)</span></a>
            </li>

            @if($locations->hasMorePages())
                <li class="page-item"><a class="page-link" href="{{$locations->nextPageUrl()}}">{{$locations->currentPage()+1}}</a></li>
                <li class="page-item">
                  <a class="page-link" href="{{$locations->nextPageUrl()}}">Next</a>
                </li>
            @else
                <li class="page-item disabled">
                  <a class="page-link" href="#">Next</a>
                </li>
            @endif
          </ul>
        </nav>
    </div>
    @else
        <div class="alert alert-warning">
            No Locations available!
        </div>
    @endif

    @if (session('status'))
        <div class="alert alert-{{session('status')}}">
            {{ session('status_string') }}
        </div>
    @endif
</div>



@endsection
