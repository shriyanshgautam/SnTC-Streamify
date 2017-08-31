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
        <input required type="name" name="name" value="{{$body->name or ''}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter name">
        <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Level</label>
        <input required type="number" step="1" name="level" value="{{$body->level or ''}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter level">
        <small id="emailHelp"  class="form-text text-muted">We'll never share your email with anyone else.</small>
    </div>

    <div class="row">
        <div class="col-10">

        </div>
        <div class="col-2">

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
