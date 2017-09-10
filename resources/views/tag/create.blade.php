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
        <input required type="name" name="name" value="{{$tag->name or ''}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter name">
        <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
    </div>

    <div class="form-group">
        <label for="exampleInputEmail1">Level</label>
        <input required type="number" step="1" name="level" value="{{$tag->level or ''}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter level">
        <small id="emailHelp" class="form-text text-muted">This will be used to order the tags in a notification or event.</small>
    </div>

    <div class="row">
        <div class="col-lg-10">

        </div>
        <div class="col-lg-2 col-md-12">

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
