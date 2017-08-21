@extends('location.main')

@section('main-content')

@if (!isset($location))
    <form method="post" action="/locations">
@else
    <form method="post" action="/locations/{{$location->id}}">
        <input type="hidden" name="_method" value="PUT">
@endif

    {{ csrf_field() }}
    <div class="form-group">
        <label for="exampleInputEmail1">Name</label>
        <input type="name" name="name" value="{{$location->name or ''}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter name">
        <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
    </div>

    <div class="form-group">
        <label for="exampleFormControlTextarea1">Address</label>
        <textarea name="address" value="" class="form-control" id="exampleFormControlTextarea1" rows="3">{{$location->address or ''}}</textarea>
    </div>

    <div class="form-group">
        <label for="exampleFormControlTextarea1">Description</label>
        <textarea name="description" value="" class="form-control" id="exampleFormControlTextarea1" rows="3">{{$location->description or ''}}</textarea>
    </div>

    <div class="form-group">
        <label for="exampleInputEmail1">Latitude</label>
        <input type="number" name="latitude" step="any" value="{{$location->latitude or ''}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter latitude">
    </div>

    <div class="form-group">
        <label for="exampleInputEmail1">Longitude</label>
        <input type="number" name="longitude" step="any" value="{{$location->longitude or ''}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter longitude">
    </div>

    <div class="form-group">
        <label for="exampleInputEmail1">Zoom Level</label>
        <input type="number" step="1" name="zoom" value="{{$location->zoom or ''}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter zoom">
    </div>

    <div class="row">
        <div class="col-10">

        </div>
        <div class="col-2">

            <button type="submit" class="btn btn-primary">
                @if (!isset($location))
                    Submit
                @else
                    Edit {{$location->name}}
                @endif

            </button>
        </div>

    </div>

</form>
@endsection
