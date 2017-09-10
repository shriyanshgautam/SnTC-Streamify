@extends('body.main')

@section('main-content')

@if (!isset($body))
    <form method="post" action="/bodies">
@else
    <form method="post" action="/bodies/{{$body->id}}">
        <input type="hidden" name="_method" value="PUT">
@endif

    {{ csrf_field() }}
    <div class="form-group">
        <label for="exampleInputEmail1">Name</label>
        <input required type="name" name="name" value="{{$body->name or ''}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Body Name">
        <small id="emailHelp" class="form-text text-muted">Can be a parent body like SnTC for COPS.</small>
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Level</label>
        <input required type="number" step="1" name="level" value="{{$body->level or ''}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Body level">
        <small id="emailHelp"  class="form-text text-muted">This level will be used to order the bodies</small>
    </div>

    <div class="row">
        <div class="col-lg-10">

        </div>
        <div class="col-lg-2 col-md-12">

            <button type="submit" class="btn btn-primary">
                @if (!isset($body))
                    Submit
                @else
                    Edit {{$body->name}}
                @endif

            </button>
        </div>

    </div>

</form>
@endsection
