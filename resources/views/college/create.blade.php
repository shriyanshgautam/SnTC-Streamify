@extends('college.main')

@section('main-content')

@if (!isset($college))
    <form method="post" action="/colleges">
@else
    <form method="post" action="/colleges/{{$college->id}}">
        <input type="hidden" name="_method" value="PUT">
@endif

    {{ csrf_field() }}
    <div class="form-group">
        <label for="exampleInputEmail1">Name</label>
        <input type="name" name="name" value="{{$college->name or ''}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter name">
        <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
    </div>

    <div class="form-group">
        <label for="exampleInputEmail1">Code</label>
        <input type="number" step="1" name="code" value="{{$college->code or ''}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter code">
    </div>

    <div class="row">
        <div class="col-10">

        </div>
        <div class="col-2">

            <button type="submit" class="btn btn-primary">
                @if (!isset($college))
                    Submit
                @else
                    Edit {{$college->name}}
                @endif

            </button>
        </div>

    </div>

</form>
@endsection
