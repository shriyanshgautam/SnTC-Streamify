@extends('notification.main')

@section('main-content')
<div class="row">
    <div class="col-8">
        <h3 class="p-1">{{$notification->title}}</h3>
    </div>
    <div class="row col-4">
    </div>
</div>

<div class="row p-3">

    <div class="col-6 p-1">
        <b>Notification Id: </b>{{$notification->id}}
    </div>
    <div class="col-6 p-1">
        <b>Notification Tag: </b>{{$notification->tag->name}}
    </div>
    <div class="col-6 p-1">
        <b>Notification Title: </b>{{$notification->title}}
    </div>
    <div class="col-6 p-1">
        <b>Notification Stream: </b>{{$notification->stream->title}}
    </div>
    <div class="col-6 p-1">
        <b>Notification Subtitle: </b>{{$notification->subtitle}}
    </div>
    <div class="col-6 p-1">
        <b>Notification Description: </b>{{$notification->description}}
    </div>
    <div class="col-6 p-1">
        <b>Notification Author: </b>{{$notification->author->name}}
    </div>
    <div class="col-6 p-1">
        <b>Notification Time: </b>{{Carbon\Carbon::parse($notification->time)->diffForHumans()}}
    </div>
    <div class="col-6 p-1">
        <b>Notification Link: </b>{{$notification->link}}
    </div>
    <div class="col-6 p-1">
        <b>Notification Type: </b>{{$notification->type}}
    </div>
    <div class="col-6 p-1">
        <b>Notification Likes: </b>{{$notification->appUsers->count()}}
    </div>

</div>
<div class="row p-3" >

</div>



@endsection
