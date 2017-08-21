@extends('tag.main')

@section('main-content')

@if (!isset($tag))
    <form method="post" action="/tags">
@else
    <form method="post" action="/tags/{{$tag->id}}">
        <input type="hidden" name="_method" value="PUT">
@endif

    {{ csrf_field() }}
    <div class="form-group">
        <label for="exampleInputEmail1">Name</label>
        <input type="name" name="name" value="{{$tag->name or ''}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter name">
        <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
    </div>

    <div class="form-group">
        <label for="exampleInputEmail1">Level</label>
        <input type="number" step="1" name="level" value="{{$tag->level or ''}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter level">
    </div>

    <div class="row">
        <div class="col-10">

        </div>
        <div class="col-2">

            <button type="submit" class="btn btn-primary">
                @if (!isset($tag))
                    Submit
                @else
                    Edit {{$tag->name}}
                @endif

            </button>
        </div>

    </div>

</form>
@endsection