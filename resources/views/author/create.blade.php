@extends('author.main')

@section('main-content')

@if (!isset($author))
    <form method="post" action="/authors" enctype="multipart/form-data">
@else
    <form method="post" action="/authors/{{$author->id}}" enctype="multipart/form-data">
        <input type="hidden" name="_method" value="PUT">
@endif

    {{ csrf_field() }}
    <div class="form-group">
        <label for="exampleInputEmail1">Name</label>
        <input type="name" name="name" value="{{$author->name or ''}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter name">
        <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Email address</label>
        <input type="email" name="email" value="{{$author->email or ''}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
        <small id="emailHelp"  class="form-text text-muted">We'll never share your email with anyone else.</small>
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Contact</label>
        <input type="text" name="contact" value="{{$author->contact or ''}}" class="form-control" id="exampleInputEmail1" aria-describedby="contantHelp" placeholder="Enter contact">
        <small id="contactHelp"  class="form-text text-muted">We'll never share your contact with anyone else.</small>
    </div>


    <div class="form-group">
        <label for="exampleInputFile">Image</label>
        <input type="file" name="image" class="form-control-file" id="exampleInputFile" aria-describedby="fileHelp">
        <small id="fileHelp" class="form-text text-muted">Must be square.</small>
    </div>

    <div class="row">
        <div class="col-10">

        </div>
        <div class="col-2">

            <button type="submit" class="btn btn-primary">
                @if (!isset($author))
                    Submit
                @else
                    Edit {{$author->name}}
                @endif

            </button>
        </div>

    </div>

</form>
@endsection
