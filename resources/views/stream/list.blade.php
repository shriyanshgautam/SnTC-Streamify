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
      <th>Image</th>
      <th>Author</th>
    </tr>
  </thead>
  <tbody>
      @foreach ($streams as $stream)
          <tr>
            <th scope="row">{{$stream->id}}</th>
            <td>{{$stream->title}}</td>
            <td>{{$stream->subtitle}}</td>
            <td>{{$stream->description}}</td>
            <td>{{$stream->image}}</td>
            <!-- Accessing foriegn key table values -->
            <td>{{$stream->author->name}}</td>
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
