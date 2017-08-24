@extends('content.main')

@section('main-content')

@if ($errors->any())
    <div class="alert alert-danger">
        {{ $errors->first() }}
    </div>
@endif

@if (!isset($content))
    <form method="post" action="/contents">
@else
    <form method="post" action="/contents/{{$content->id}}">
        <input type="hidden" name="_method" value="PUT">
@endif

    {{ csrf_field() }}
    <div class="form-group">
        <label for="exampleInputEmail1">Title</label>
        <input type="name" name="title" value="{{$content->title or ''}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter title">
        <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Text</label>
        <input type="text" name="text" value="{{$content->text or ''}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter text">
        <small id="emailHelp"  class="form-text text-muted">We'll never share your email with anyone else.</small>
    </div>

    <div class="form-group">
        <label for="exampleFormControlSelect1">Type</label>
        <select name="type" class="form-control" id="exampleFormControlSelect1">
            @if(isset($content))
                <option value="0" @if($content->type==0) selected @endif >Text</option>
            @else
                <option value="0">Text</option>
            @endif

            @if(isset($content))
                <option value="1" @if($content->type==1) selected @endif >Image</option>
            @else
                <option value="1">Image</option>
            @endif

            @if(isset($content))
                <option value="2" @if($content->type==2) selected @endif >Video</option>
            @else
                <option value="2">Video</option>
            @endif
        </select>
     </div>

     <div class="form-group">
         <label for="exampleFormControlTextarea1">Url</label>
         <textarea name="url" value="" class="form-control" id="exampleFormControlTextarea1" rows="3">{{$content->url or ''}}</textarea>
     </div>





    <div class="row">
        <div class="col-10">

        </div>
        <div class="col-2">

            <button type="submit" class="btn btn-primary">
                @if (!isset($content))
                    Submit
                @else
                    Edit {{$content->name}}
                @endif

            </button>
        </div>

    </div>

</form>
@endsection
