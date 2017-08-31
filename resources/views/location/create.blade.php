@extends('location.main')

@section('main-content')

@if (!isset($location))
    <form method="post" action="/locations">
@else
    <form method="post" action="/locations/{{$location->id}}">
        <input type="hidden" name="_method" value="PUT">
@endif

    {{ csrf_field() }}
    <div class="row">
        <div class="col-6">
            <div class="form-group">
                <label for="exampleInputEmail1">Name</label>
                <input required type="name" name="name" id="name" value="{{$location->name or ''}}" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter name">
                <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
            </div>

            <div class="form-group">
                <label for="exampleFormControlTextarea1">Address</label>
                <textarea required name="address" value="" class="form-control" id="exampleFormControlTextarea1" required ows="3">{{$location->address or ''}}</textarea>
            </div>

            <div class="form-group">
                <label for="exampleFormControlTextarea1">Description</label>
                <textarea name="description" value="" class="form-control" id="exampleFormControlTextarea1" required rows="3">{{$location->description or ''}}</textarea>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Latitude</label>
                <input required type="number" name="latitude" step="any" id="latitude" required value="{{$location->latitude or ''}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter latitude">
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">Longitude</label>
                <input required type="number" name="longitude" step="any" id="longitude" required value="{{$location->longitude or ''}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter longitude">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Zoom Level</label>
                <input required type="number" step="1" name="zoom" id="zoom" required value="{{$location->zoom or ''}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter zoom">
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">Radius</label>
                <input type="number" step="1" name="radius" id="radius"  class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter zoom">
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <div id="google_map_location_picker_widget" style="height: 600px;"></div>
            </div>
        </div>

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

<script>
    $('#google_map_location_picker_widget').locationpicker({
        @if(isset($location))
        location: {latitude: {{$location->latitude}}, longitude: {{$location->longitude}}},
        zoom: {{$location->zoom}},
        @else
        location: {latitude: 25.262354, longitude: 82.9893569999999},
        zoom: 15,
        @endif
        locationName: "IIT BHU",
        radius: 500,

        scrollwheel: true,
        inputBinding: {
            latitudeInput: $('#latitude'),
            longitudeInput: $('#longitude'),
            radiusInput: $('#radius'),
            zoomInput: $('#zoom')
        },
        enableAutocomplete: true,
        enableReverseGeocode: true,
    });

</script>
@endsection
