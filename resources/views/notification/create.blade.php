@extends('notification.main')

@section('main-content')

@if ($errors->any())
    <div class="alert alert-danger">
        {{ $errors->first() }}
    </div>
@endif

@if (!isset($notification))
    <form method="post" action="/notifications" enctype="multipart/form-data">
@else
    <form method="post" action="/notifications/{{$notification->id}}" enctype="multipart/form-data">
        <input type="hidden" name="_method" value="PUT">
@endif
    {{ csrf_field() }}
    <div class="form-group">
        <label for="exampleInputEmail1">Title</label>
        <input type="name" name="title" value="{{$notification->title or ''}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter title">
        <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
    </div>

    <div class="form-group">
        <label for="exampleInputEmail1">Subtitle</label>
        <input type="name" name="subtitle" value="{{$notification->subtitle or ''}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter subtitle">
        <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
    </div>

    <div class="form-group">
        <label for="exampleFormControlTextarea1">Description</label>
        <textarea name="description" value="" class="form-control" id="exampleFormControlTextarea1" rows="3">{{$notification->description or ''}}</textarea>
    </div>

    <div class="form-group">
        <label for="exampleFormControlTextarea1">Link</label>
        <textarea name="link" value="" class="form-control" id="exampleFormControlTextarea1" rows="3">{{$notification->link or ''}}</textarea>
    </div>

    <div class="form-group">
        <label for="exampleFormControlSelect1">Type</label>
        <select name="type" class="form-control" id="exampleFormControlSelect1">
            @if(isset($notification))
                <option value="0" @if($notification->type==0) selected @endif >Text</option>
            @else
                <option value="0">Text</option>
            @endif

            @if(isset($notification))
                <option value="1" @if($notification->type==1) selected @endif >Image</option>
            @else
                <option value="1">Image</option>
            @endif

            @if(isset($notification))
                <option value="2" @if($notification->type==2) selected @endif >Video</option>
            @else
                <option value="2">Video</option>
            @endif
        </select>
     </div>

    <div class="form-group">
        <label for="exampleInputFile">Image</label>
        <input type="file" name="image" class="form-control-file" id="exampleInputFile" aria-describedby="fileHelp">
        <small id="fileHelp" class="form-text text-muted">Must be square.</small>
    </div>

    <div class="form-group">
        <label for="exampleInputEmail1">Time</label>
        <input type="datetime-local" name="time" value="{{$notification->time or ''}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter time">
        <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
    </div>

    <div class="form-group">
        <label for="exampleFormControlSelect1">Select Author</label>
        <select name="author_id" class="form-control" id="exampleFormControlSelect1">
            @foreach ($authors as $author)
                @if(isset($notification))
                    <option value="{{$author->id}}"  @if($author->id == $notification->author->id) selected="selected" @endif >{{$author->name}}</option>
                @else
                    <option value="{{$author->id}}">{{$author->name}}</option>
                @endif
            @endforeach
        </select>
     </div>

      <div class="form-group">
          <label for="exampleFormControlSelect1">Select Stream</label>
          <select name="stream_id" class="form-control" id="exampleFormControlSelect1">
              @foreach ($streams as $stream)
                  @if(isset($notification))
                    <option value="{{$stream->id}}" @if($stream->id == $notification->stream->id) selected @endif >{{$stream->title}}</option>
                  @else
                    <option value="{{$stream->id}}" >{{$stream->title}}</option>
                  @endif
              @endforeach
          </select>
       </div>

       <div class="form-group">
           <label for="exampleFormControlSelect1">Select Tag</label>
           <select name="tag_id" class="form-control" id="exampleFormControlSelect1">
               @foreach ($tags as $tag)
                    @if(isset($notification))
                        <option value="{{$tag->id}}" @if($tag->id == $notification->tag->id) selected @endif >{{$tag->name}}</option>
                    @else
                        <option value="{{$tag->id}}" >{{$tag->name}}</option>
                    @endif
               @endforeach
           </select>
        </div>

        <div class="form-group">
            <label for="exampleFormControlSelect1">Select Content</label>
            <select name="content_ids[]" class="form-control" multiple id="exampleFormControlSelect1">
                @foreach ($contents as $content)
                     @if(isset($notification))
                         <option value="{{$content->id}}" @if($content->id == $notification->contents->id) selected @endif >{{$content->name}}</option>
                     @else
                         <option value="{{$content->id}}" >{{$content->title}}</option>
                     @endif
                @endforeach
            </select>
         </div>

    <div class="row">
        <div class="col-10">

        </div>
        <div class="col-2">

            <button type="submit" class="btn btn-primary">
                @if (!isset($notification))
                    Submit
                @else
                    Edit {{$notification->title}}
                @endif

            </button>
        </div>

    </div>

</form>
@endsection
