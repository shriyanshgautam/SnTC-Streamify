@extends('content.main')

@section('main-content')

@if (count($contents)>0)
<table class="table table-hover">
  <thead>
    <tr>
      <th>#</th>
      <th>Title</th>
      <th>Text</th>
      <th>Type</th>
      <th>Url</th>
      <th>
          -
      </th>
    </tr>
  </thead>
  <tbody>
      @foreach ($contents as $content)
          <tr>
            <th scope="row">{{$content->id}}</th>
            <td>{{$content->title}}</td>
            <td>{{$content->text}}</td>
            <td>{{$content->type}}</td>
            <td>{{$content->url}}</td>
            <td>
                <form action="contents/{{$content->id}}/edit/" method="get">
                    <button type="submit" class="btn btn-primary">
                        <i class="material-icons md-18" style="font-size:16px;">mode_edit</i>
                    </button>
                </form>
                <form method="post" action="/contents/{{$content->id}}">
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" class="btn btn-danger">
                        {{ csrf_field() }}
                        <i class="material-icons md-18" style="font-size:16px;">delete</i>
                    </button>
                </form>
            </td>
          </tr>
      @endforeach
  </tbody>
</table>
@else
    <div class="alert alert-warning">
        No Contents available!
    </div>
@endif

@if (session('status'))
    <div class="alert alert-{{session('status')}}">
        {{ session('status_string') }}
    </div>
@endif
@endsection
