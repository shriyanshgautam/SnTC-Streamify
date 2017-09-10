@extends('content.main')

@section('main-content')

@if ($errors->any())
    <div class="alert alert-danger">
        {{ $errors->first() }}
    </div>
@endif

@if (!isset($content))
    <form method="post" action="/contents" enctype="multipart/form-data">
@else
    <form method="post" action="/contents/{{$content->id}}" enctype="multipart/form-data">
        <input type="hidden" name="_method" value="PUT">
@endif

    {{ csrf_field() }}
    <div class="form-group">
        <label for="exampleInputEmail1">Title</label>
        <input required type="name" name="title" value="{{$content->title or ''}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter title">
        <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Text</label>
        <input required type="text" name="text" value="{{$content->text or ''}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter text">
        <small id="emailHelp"  class="form-text text-muted">This will be shown as description of content in the gallery.</small>
    </div>

    <div class="form-group">
        <label for="exampleFormControlSelect1">Type</label>
        <select required name="type" class="form-control" id="exampleFormControlSelect1">
            @if(isset($content))
                <option value="2" @if($content->type==2) selected @endif >Image</option>
            @else
                <option value="2">Image</option>
            @endif

            @if(isset($content))
                <option value="3" @if($content->type==3) selected @endif >Video</option>
            @else
                <option value="3">Video</option>
            @endif
        </select>
        <small id="emailHelp"  style="color:#ff0000 !important;" class="form-text text-muted">Please select the type of content you need to create and correspondingly specify the video id in case of video or select image in case of image. Be carefull.</small>
     </div>

     <div class="form-group">
         <label for="exampleInputFile">Image</label>
         <input type="file" name="image" class="form-control-file" id="exampleInputFile" aria-describedby="fileHelp">
         <small id="fileHelp" style="color:#ff0000 !important;" class="form-text text-muted">Only upload image if you have selected type above as image. Size should be less than 50 Kb</small>
     </div>

     <div class="form-group">
         <label for="exampleInputEmail1">Youtube Video Id</label>
         <input type="name" name="video_id" value="{{$content->video_id or ''}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Video Id like kJQP7kiw5Fk">
         <small id="emailHelp" style="color:#ff0000 !important;" class="form-text text-muted">Only specify video id if you have selected type above as video. Do not put any other parameters. Just the id ie. after '=' and before any '? or &'. Ex. https://youtu.be/kJQP7kiw5Fk?t=21, here video id is only 'kJQP7kiw5Fk'</small>
     </div>

     <div class="form-group">
         <label for="exampleFormControlTextarea1">Url</label>
         <input readonly name="url" value="{{$content->url or ''}}" class="form-control" id="exampleFormControlTextarea1">
         <small id="fileHelp" class="form-text text-muted">Deprecated. Not required.</small>
     </div>





    <div class="row">
        <div class="col-lg-10">

        </div>
        <div class="col-lg-2 col-md-12">

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
