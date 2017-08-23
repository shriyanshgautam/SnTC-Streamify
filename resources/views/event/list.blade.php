@extends('event.main')

@section('main-content')

@if (count($events)>0)
<table class="table table-hover">
  <thead>
    <tr>
      <th>#</th>
      <th>Title</th>
      <th>Subtitle</th>


      <th>Time</th>
      <th>Author</th>
      <th>Location</th>
      <th>Stream</th>
      <th>-</th>


    </tr>
  </thead>
  <tbody>
      @foreach ($events as $event)
          <tr>
            <th scope="row">{{$event->id}}</th>
            <td>{{$event->title}}</td>
            <td>{{$event->subtitle}}</td>

            <td>{{Carbon\Carbon::parse($event->time)->diffForHumans()}}</td>
            <td>{{$event->author->name}}</td>
            <td>{{$event->location->name}}</td>
            <td>{{$event->stream->title}}</td>
            <td>

                <form method="get" action="/events/{{$event->id}}">
                    <button type="submit" class="btn btn-primary">
                        <i class="material-icons md-18" style="font-size:16px;">search</i>
                    </button>
                </form>
            </td>
          </tr>
      @endforeach
  </tbody>
</table>
@else
    <div class="alert alert-warning">
        No Events available!
    </div>
@endif

@if (session('status'))
    <div class="alert alert-{{session('status')}}">
        {{ session('status_string') }}
    </div>
@endif
@endsection
