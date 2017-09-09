@extends('stream.main')

@section('main-content')
<div class="row">
    <div class="col-8">
        <h3 class="p-1">#{{$stream->id}} {{$stream->title}}</h3>
    </div>
    <div class="row col-4">
        <form action="/streams/{{$stream->id}}/edit/" method="get">
            <button type="submit" class="btn btn-primary">
                <i class="material-icons md-18" style="font-size:16px;">mode_edit</i>
            </button>
        </form>

        <form method="post" action="/streams/{{$stream->id}}">
            <input type="hidden" name="_method" value="DELETE">
            {{ csrf_field() }}
            <button type="submit" class="btn btn-danger">
                <i class="material-icons md-18" style="font-size:16px;">delete</i>
            </button>
        </form>
    </div>
</div>

<div class="row p-3">

    <div class="col-6 p-1">
        <b>Stream Title: </b>{{$stream->title}}
    </div>
    <div class="col-6 p-1">
        <b>Stream Subtitle: </b>{{$stream->subtitle}}
    </div>
    <div class="col-12 p-1">
        <b>Stream Description: </b>{{$stream->description}}
    </div>
    <div class="col-6 p-1">
        <b>Stream Author: </b>{{$stream->author->name}}
    </div>


    <div class="col-12 p-1">
        <b>Stream Bodies: </b>
        @foreach($stream->bodies as $body)
            {{$body->name}}({{$body->level}}),
        @endforeach
    </div>
    <div class="col-12 p-1">
        <b>Stream Position Holders: </b><br />
        @foreach($stream->positionHolders as $positionHolder)
            {{$positionHolder->name}}({{$positionHolder->email}}), {{$positionHolder->position}}<br />
        @endforeach
    </div>

    <div class="col-4 p-1">
        <b>Stream Subscribers: </b>{{$stream->appUsers->count()}}
    </div>
    <div class="col-4 p-1">
        <b>Stream Notifications: </b>{{$stream->notifications->count()}}
    </div>
    <div class="col-4 p-1">
        <b>Stream Events: </b>{{$stream->events->count()}}
    </div>

    <div class="col-12 p-3">
        <img style="max-height:500px;max-width:500px;" src="{{str_replace("www.dropbox.com","dl.dropboxusercontent.com",$stream->image)}}" />
    </div>

    <div class="col-12 p-1">
        <b>Stream Feedbacks: </b>
        @foreach($stream->feedbacks as $feedback)
            <br/>{{$feedback->id}} : {{$feedback->text}} ({{$feedback->appUser->name}}),
        @endforeach
    </div>

    <!-- Feedback -->

</div>
<div class="row p-3" >

</div>



@endsection
