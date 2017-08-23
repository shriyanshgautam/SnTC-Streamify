@extends('event.main')

@section('main-content')
<div class="row">
    <div class="col-8">
        <h3 class="p-1">{{$event->title}}</h3>
    </div>
    <div class="row col-4">
    </div>
</div>

<div class="row p-3">

    <div class="col-6 p-1">
        <b>Event Id: </b>{{$event->id}}
    </div>
    <div class="col-6 p-1">
        <b>Event Tag: </b>{{$event->tag->name}}
    </div>
    <div class="col-6 p-1">
        <b>Event Title: </b>{{$event->title}}
    </div>
    <div class="col-6 p-1">
        <b>Event Stream: </b>{{$event->stream->title}}
    </div>
    <div class="col-6 p-1">
        <b>Event Subtitle: </b>{{$event->subtitle}}
    </div>
    <div class="col-6 p-1">
        <b>Event Description: </b>{{$event->description}}
    </div>
    <div class="col-6 p-1">
        <b>Event Author: </b>{{$event->author->name}}
    </div>
    <div class="col-6 p-1">
        <b>Event Time: </b>{{Carbon\Carbon::parse($event->time)->diffForHumans()}}
    </div>
    <div class="col-6 p-1">
        <b>Event Location: </b>{{$event->location->name}}
    </div>
    <div class="col-6 p-1">
        <b>Event Subscribers: </b>{{$event->appUsers->count()}}
    </div>

</div>
<div class="row p-3" >

</div>



@endsection
