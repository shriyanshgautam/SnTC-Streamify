@extends('author.main')

@section('main-content')

@if ($errors->any())
    <div class="alert alert-danger">
        {{ $errors->first() }}
    </div>
@endif

@if (!isset($author))
    <form method="post" action="/authors" enctype="multipart/form-data">
@else
    <form method="post" action="/authors/{{$author->id}}" enctype="multipart/form-data">
        <input type="hidden" name="_method" value="PUT">
@endif

    {{ csrf_field() }}
    <div class="form-group">
        <label for="exampleInputEmail1">Name</label>
        <input required type="name" name="name" value="{{$author->name or ''}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Author's Name">
        <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Email address</label>
        <input required type="email" name="email" value="{{$author->email or ''}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Author's Email">
        <small id="emailHelp"  class="form-text text-muted">This email address will be visible to app users.</small>
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Contact</label>
        <input required type="text" name="contact" value="{{$author->contact or ''}}" class="form-control" id="exampleInputEmail1" aria-describedby="contantHelp" placeholder="Author's Contact">
        <small id="contactHelp"  class="form-text text-muted">This contact number will be visible to app users</small>
    </div>


    <div class="form-group">
        <label for="exampleInputFile">Author's Image</label>
        <input type="file" name="image" class="form-control-file" id="exampleInputFile" aria-describedby="fileHelp">
        <small id="fileHelp" class="form-text text-muted">Should not be more than 50 Kb in size.</small>
    </div>

    <div class="row">
        <div class="col-lg-10">

        </div>
        <div class="col-lg-2 col-md-12">

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
