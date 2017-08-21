@extends('location.main')

@section('main-content')

@if (count($locations)>0)
<table class="table table-hover">
  <thead>
    <tr>
      <th>#</th>
      <th>Name</th>
      <th>Address</th>
      <th>Description</th>
      <th>Latitude</th>
      <th>Longitude</th>
      <th>Zoom</th>
    </tr>
  </thead>
  <tbody>
      @foreach ($locations as $location)
          <tr>
            <th scope="row">{{$location->id}}</th>
            <td>{{$location->name}}</td>
            <td>{{$location->address}}</td>
            <td>{{$location->description}}</td>
            <td>{{$location->latitude}}</td>
            <td>{{$location->longitude}}</td>
            <td>{{$location->zoom}}</td>
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
@endsection
