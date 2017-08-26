@extends('stream.main')

@section('main-content')

@if (count($streams)>0)
<table class="table table-hover">
  <thead>
    <tr>
      <th>#</th>
      <th>Title</th>
      <th>Subtitle</th>
      <th>Description</th>
      <th>Author</th>
      <th>Subscribers</th>
    </tr>
  </thead>
  <tbody>
      @foreach ($streams as $stream)
          <tr>
            <th scope="row">{{$stream->id}}</th>
            <td>{{$stream->title}}</td>
            <td>{{$stream->subtitle}}</td>
            <td>{{$stream->description}}</td>
            <td>{{$stream->author->name}}</td>
            <td>{{$stream->appUsers->count()}}</td>
            <!-- Accessing foriegn key table values -->

            <td>
                <!-- <form action="streams/{{$stream->id}}/edit/" method="get">
                    <button type="submit" class="btn btn-primary">
                        <i class="material-icons md-18" style="font-size:16px;">mode_edit</i>
                    </button>
                </form> -->
                <form method="get" action="/streams/{{$stream->id}}">
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


    @if($streams->currentPage()!=1)
        <li class="page-item">
          <a class="page-link" href="{{$streams->previousPageUrl()}}" tabindex="-1">Previous</a>
        </li>
        <li class="page-item"><a class="page-link" href="{{$streams->previousPageUrl()}}">{{$streams->currentPage()-1}}</a></li>
    @else
        <li class="page-item disabled">
          <a class="page-link" href="#" tabindex="-1">Previous</a>
        </li>

    @endif
    <li class="page-item active">
      <a class="page-link" href="#">{{$streams->currentPage()}}<span class="sr-only">(cuurent)</span></a>
    </li>

    @if($streams->hasMorePages())
        <li class="page-item"><a class="page-link" href="{{$streams->nextPageUrl()}}">{{$streams->currentPage()+1}}</a></li>
        <li class="page-item">
          <a class="page-link" href="{{$streams->nextPageUrl()}}">Next</a>
        </li>
    @else
        <li class="page-item disabled">
          <a class="page-link" href="#">Next</a>
        </li>
    @endif
  </ul>
</nav>

@else
    <div class="alert alert-warning">
        No Streams available!
    </div>
@endif

@if (session('status'))
    <div class="alert alert-{{session('status')}}">
        {{ session('status_string') }}
    </div>
@endif
@endsection
