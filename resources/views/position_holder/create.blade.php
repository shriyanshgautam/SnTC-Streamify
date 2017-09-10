@extends('position_holder.main')

@section('main-content')

@if ($errors->any())
    <div class="alert alert-danger">
        {{ $errors->first() }}
    </div>
@endif

@if (!isset($position_holder))
    <form method="post" action="/position_holders" enctype="multipart/form-data">
@else
    <form method="post" action="/position_holders/{{$position_holder->id}}" enctype="multipart/form-data">
        <input type="hidden" name="_method" value="PUT">
@endif

    {{ csrf_field() }}
    <div class="form-group">
        <label for="exampleInputEmail1">Name</label>
        <input required type="name" name="name" value="{{$position_holder->name or ''}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter name">
        <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
    </div>

    <div class="form-group">
        <label for="exampleInputEmail1">Position</label>
        <input required type="name" name="position" value="{{$position_holder->position or ''}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter position">
        <small id="emailHelp" class="form-text text-muted">This will be shown to app user. Can be Secretary or General Secretary etc.</small>
    </div>

    <div class="form-group">
        <label for="exampleInputEmail1">Level</label>
        <input required type="number" name="level" value="{{$position_holder->level or ''}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter level">
        <small id="emailHelp" class="form-text text-muted">Level will be used to order the position holders in the stream detail page. Higher the post lower the level number. Ex. 1 For Gen Sec, 2 For Joint Gen Sec and 3 for Second Joint Gen Sec. Similarly it can be used for Secretaries also.</small>
    </div>

    <div class="form-group">
        <label for="exampleInputEmail1">Email</label>
        <input required type="email" name="email" value="{{$position_holder->email or ''}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
        <small id="emailHelp" class="form-text text-muted">This email will be visible to app users.</small>
    </div>

    <div class="form-group">
        <label for="exampleInputEmail1">Contact</label>
        <input required type="number" name="contact" value="{{$position_holder->contact or ''}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter contact">
        <small id="emailHelp" class="form-text text-muted">This contact number will be visible to app users.</small>
    </div>

    <div class="form-group">
        <label for="exampleInputFile">Image</label>
        <input type="file" name="image" class="form-control-file" id="exampleInputFile" aria-describedby="fileHelp">
        <small id="fileHelp" class="form-text text-muted">Should not be larger than 50 Kb in size.</small>
    </div>


    <div class="row">
        <div class="col-lg-10">

        </div>
        <div class="col-lg-2 col-md-12">

            <button type="submit" class="btn btn-primary">
                @if (!isset($position_holder))
                    Submit
                @else
                    Edit {{$position_holder->name}}
                @endif

            </button>
        </div>

    </div>

</form>
@endsection
