@extends('stream.main')

@section('main-content')

@if ($errors->any())
    <div class="alert alert-danger">
        {{ $errors->first() }}
    </div>
@endif

@if (!isset($stream))
    <form method="post" action="/streams" enctype="multipart/form-data">
@else
    <form method="post" action="/streams/{{$stream->id}}" enctype="multipart/form-data">
        <input type="hidden" name="_method" value="PUT">
@endif

    {{ csrf_field() }}
    <div class="form-group">
        <label for="exampleInputEmail1">Title</label>
        <input type="name" name="title" value="{{$stream->title or ''}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter title">
        <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
    </div>

    <div class="form-group">
        <label for="exampleInputEmail1">Subtitle</label>
        <input type="name" name="subtitle" value="{{$stream->subtitle or ''}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter subtitle">
        <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
    </div>

    <div class="form-group">
        <label for="exampleFormControlTextarea1">Description</label>
        <textarea name="description" value="" class="form-control" id="exampleFormControlTextarea1" rows="3">{{$stream->description or ''}}</textarea>
    </div>

    <div class="form-group">
        <label for="exampleInputFile">Image</label>
        <input type="file" name="image" class="form-control-file" id="exampleInputFile" aria-describedby="fileHelp">
        <small id="fileHelp" class="form-text text-muted">Must be square.</small>
    </div>

    <div class="form-group">
        <label for="exampleFormControlSelect1">Select Author</label>
        <select name="author_id" class="form-control" id="exampleFormControlSelect1">
            @foreach ($authors as $author)
                @if(isset($stream))
                    <option value="{{$author->id}}" @if($author->id == $stream->author->id) ? selected @endif >{{$author->name}}</option>
                @else
                    <option value="{{$author->id}}" >{{$author->name}}</option>
                @endif
            @endforeach
        </select>
     </div>


     <div class="form-group">
         <label for="exampleFormControlSelect1">Select Bodies</label>

         <select name="bodies[]" class="form-control" multiple id="exampleFormControlSelect1">
             @foreach ($bodies as $body)
                @if(isset($stream))
                    @foreach($stream->bodies as $streamBody)
                        <option value="{{$body->id}}" @if($body->id == $streamBody->id) selected @endif>{{$body->name}}</option>
                    @endforeach
                @else
                        <option value="{{$body->id}}">{{$body->name}}</option>
                @endif
             @endforeach
         </select>

      </div>


      <div class="form-group">
          <label for="exampleFormControlSelect1">Select Position Holders</label>

          <select name="position_holders[]" class="form-control" multiple id="exampleFormControlSelect1">
              @foreach ($position_holders as $position_holder)
                @if(isset($stream))
                    @foreach($stream->positionHolders as $streamPositionHolder)
                      <option value="{{$position_holder->id}}" @if($position_holder->id == $streamPositionHolder->id) selected @endif >{{$position_holder->name}} ({{$position_holder->position}})</option>
                    @endforeach
                @else
                    <option value="{{$position_holder->id}}">{{$position_holder->name}} ({{$position_holder->position}})</option>
                @endif
              @endforeach
          </select>

       </div>





    <div class="row">
        <div class="col-10">

        </div>
        <div class="col-2">

            <button type="submit" class="btn btn-primary">
                @if (!isset($stream))
                    Submit
                @else
                    Edit {{$stream->name}}
                @endif

            </button>
        </div>

    </div>

</form>
@endsection
