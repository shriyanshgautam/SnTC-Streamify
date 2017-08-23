@extends('notification.main')

@section('main-content')

@if (count($notifications)>0)
<table class="table table-hover">
  <thead>
    <tr>
      <th>#</th>
      <th>Title</th>
      <th>Subtitle</th>
      <th>Time</th>
      <th>Author</th>
      <th>Stream</th>
      <th>-</th>


    </tr>
  </thead>
  <tbody>
      @foreach ($notifications as $notification)
          <tr>
            <th scope="row">{{$notification->id}}</th>
            <td>{{$notification->title}}</td>
            <td>{{$notification->subtitle}}</td>
            <td>{{Carbon\Carbon::parse($notification->time)->diffForHumans()}}</td>
            <td>{{$notification->author->name}}</td>
            <td>{{$notification->stream->title}}</td>
            <td>

                <form method="get" action="/notifications/{{$notification->id}}">
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
        No Notifications available!
    </div>
@endif

@if (session('status'))
    <div class="alert alert-{{session('status')}}">
        {{ session('status_string') }}
    </div>
@endif
@endsection
