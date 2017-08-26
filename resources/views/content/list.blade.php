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

<nav aria-label="Page navigation example">
  <ul class="pagination justify-content-center">


    @if($contents->currentPage()!=1)
        <li class="page-item">
          <a class="page-link" href="{{$contents->previousPageUrl()}}" tabindex="-1">Previous</a>
        </li>
        <li class="page-item"><a class="page-link" href="{{$contents->previousPageUrl()}}">{{$contents->currentPage()-1}}</a></li>
    @else
        <li class="page-item disabled">
          <a class="page-link" href="#" tabindex="-1">Previous</a>
        </li>

    @endif
    <li class="page-item active">
      <a class="page-link" href="#">{{$contents->currentPage()}}<span class="sr-only">(cuurent)</span></a>
    </li>

    @if($contents->hasMorePages())
        <li class="page-item"><a class="page-link" href="{{$contents->nextPageUrl()}}">{{$contents->currentPage()+1}}</a></li>
        <li class="page-item">
          <a class="page-link" href="{{$contents->nextPageUrl()}}">Next</a>
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
        No Contents available!
    </div>
@endif

@if (session('status'))
    <div class="alert alert-{{session('status')}}">
        {{ session('status_string') }}
    </div>
@endif
@endsection
