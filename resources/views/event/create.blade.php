@extends('event.main')

@section('main-content')

@if ($errors->any())
    <div class="alert alert-danger">
        {{ $errors->first() }}
    </div>
@endif

@if (!isset($event))
    <form method="post" action="/events" enctype="multipart/form-data">
@else
    <form method="post" action="/events/{{$event->id}}" enctype="multipart/form-data">
        <input type="hidden" name="_method" value="PUT">
@endif
    {{ csrf_field() }}
    <div class="form-group">
        <label for="exampleInputEmail1">Title</label>
        <input required type="name" name="title" value="{{$event->title or ''}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter title">
        <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
    </div>

    <div class="form-group">
        <label for="exampleInputEmail1">Subtitle</label>
        <input required type="name" name="subtitle" value="{{$event->subtitle or ''}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter subtitle">
        <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
    </div>

    <div class="form-group">
        <label for="exampleFormControlTextarea1">Description</label>
        <textarea required name="description" value="" class="form-control" id="exampleFormControlTextarea1" rows="3">{{$event->description or ''}}</textarea>
    </div>

    <div class="form-group">
        <label for="exampleInputFile">Image</label>
        <input type="file" name="image" class="form-control-file" id="exampleInputFile" aria-describedby="fileHelp">
        <small id="fileHelp" class="form-text text-muted">Must be square.</small>
    </div>

    <div class="form-group">
        <label for="exampleInputEmail1">Time</label>
        <input required type="datetime-local" name="time" value="{{$event->time or ''}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter time">
        <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
    </div>

    <div class="form-group">
        <label for="exampleFormControlSelect1">Select Author</label>
        <select required name="author_id" class="form-control" id="exampleFormControlSelect1">
            @foreach ($authors as $author)
                @if(isset($event))
                    <option value="{{$author->id}}"  @if($author->id == $event->author->id) selected="selected" @endif >{{$author->name}}</option>
                @else
                    <option value="{{$author->id}}">{{$author->name}}</option>
                @endif
            @endforeach
        </select>
     </div>

     <div class="form-group">
         <label for="exampleFormControlSelect1">Select Location</label>
         <select required name="location_id" class="form-control" id="exampleFormControlSelect1">
             @foreach ($locations as $location)
                 @if(isset($event))
                     <option value="{{$location->id}}" @if($location->id == $event->location->id) selected @endif >{{$location->name}}</option>
                 @else
                     <option value="{{$location->id}}">{{$location->name}}</option>
                 @endif

             @endforeach
         </select>
      </div>

      <div class="form-group">
          <label for="exampleFormControlSelect1">Select Stream</label>
          <select required name="stream_id" class="form-control" id="exampleFormControlSelect1">
              @foreach ($streams as $stream)
                  @if(isset($event))
                    <option value="{{$stream->id}}" @if($stream->id == $event->stream->id) selected @endif >{{$stream->title}}</option>
                  @else
                    <option value="{{$stream->id}}" >{{$stream->title}}</option>
                  @endif
              @endforeach
          </select>
       </div>

       <div class="form-group">
           <label for="exampleFormControlSelect1">Select Tag</label>
           <select required name="tag_id" class="form-control" id="exampleFormControlSelect1">
               @foreach ($tags as $tag)
                    @if(isset($event))
                        <option value="{{$tag->id}}" @if($tag->id == $event->tag->id) selected @endif >{{$tag->name}}</option>
                    @else
                        <option value="{{$tag->id}}" >{{$tag->name}}</option>
                    @endif
               @endforeach
           </select>
        </div>

    <div class="row">
        <div class="col-10">

        </div>
        <div class="col-2">

            <button type="submit" class="btn btn-primary">
                @if (!isset($event))
                    Submit
                @else
                    Edit {{$event->title}}
                @endif

            </button>
        </div>

    </div>

</form>
@endsection
