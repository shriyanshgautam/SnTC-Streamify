@extends('notification.main')

@section('main-content')
<div class="row">
    @if (count($notifications)>0)
    <div class="col-12">
        <table class="table table-hover table-responsive">
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
    </div>
    <div class="col-12">
        <nav aria-label="Page navigation example">
          <ul class="pagination justify-content-center">


            @if($notifications->currentPage()!=1)
                <li class="page-item">
                  <a class="page-link" href="{{$notifications->previousPageUrl()}}" tabindex="-1">Previous</a>
                </li>
                <li class="page-item"><a class="page-link" href="{{$notifications->previousPageUrl()}}">{{$notifications->currentPage()-1}}</a></li>
            @else
                <li class="page-item disabled">
                  <a class="page-link" href="#" tabindex="-1">Previous</a>
                </li>

            @endif
            <li class="page-item active">
              <a class="page-link" href="#">{{$notifications->currentPage()}}<span class="sr-only">(cuurent)</span></a>
            </li>

            @if($notifications->hasMorePages())
                <li class="page-item"><a class="page-link" href="{{$notifications->nextPageUrl()}}">{{$notifications->currentPage()+1}}</a></li>
                <li class="page-item">
                  <a class="page-link" href="{{$notifications->nextPageUrl()}}">Next</a>
                </li>
            @else
                <li class="page-item disabled">
                  <a class="page-link" href="#">Next</a>
                </li>
            @endif
          </ul>
        </nav>
    </div>



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
</div>
@endsection
