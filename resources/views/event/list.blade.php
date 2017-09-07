@extends('event.main')

@section('main-content')
<div class="row">
    <div class="col-12">
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

        <nav aria-label="Page navigation example">
          <ul class="pagination justify-content-center">


            @if($events->currentPage()!=1)
                <li class="page-item">
                  <a class="page-link" href="{{$events->previousPageUrl()}}" tabindex="-1">Previous</a>
                </li>
                <li class="page-item"><a class="page-link" href="{{$events->previousPageUrl()}}">{{$events->currentPage()-1}}</a></li>
            @else
                <li class="page-item disabled">
                  <a class="page-link" href="#" tabindex="-1">Previous</a>
                </li>

            @endif
            <li class="page-item active">
              <a class="page-link" href="#">{{$events->currentPage()}}<span class="sr-only">(cuurent)</span></a>
            </li>

            @if($events->hasMorePages())
                <li class="page-item"><a class="page-link" href="{{$events->nextPageUrl()}}">{{$events->currentPage()+1}}</a></li>
                <li class="page-item">
                  <a class="page-link" href="{{$events->nextPageUrl()}}">Next</a>
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
            No Events available!
        </div>
    @endif

    @if (session('status'))
        <div class="alert alert-{{session('status')}}">
            {{ session('status_string') }}
        </div>
    @endif
</div>



@endsection
