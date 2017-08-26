@extends('body.main')

@section('main-content')

@if (count($bodies)>0)
<table class="table table-hover">
  <thead>
    <tr>
      <th>#</th>
      <th>Name</th>
      <th>Level</th>
      <th>
          -
      </th>
    </tr>
  </thead>
  <tbody>
      @foreach ($bodies as $body)
          <tr>
            <th scope="row">{{$body->id}}</th>
            <td>{{$body->name}}</td>
            <td>{{$body->level}}</td>
            <td>
                <div class="row" style="width:100px;">
                    <form class="col-6" action="bodies/{{$body->id}}/edit/" method="get">
                        <button type="submit" class="btn btn-primary">
                            <i class="material-icons md-18" style="font-size:16px;">mode_edit</i>
                        </button>
                    </form>
                    <form class="col-6" method="post" action="/bodies/{{$body->id}}">
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" class="btn btn-danger">
                            {{ csrf_field() }}
                            <i class="material-icons md-18" style="font-size:16px;">delete</i>
                        </button>
                    </form>
                </div>

            </td>
          </tr>
      @endforeach
  </tbody>
</table>

<nav aria-label="Page navigation example">
  <ul class="pagination justify-content-center">


    @if($bodies->currentPage()!=1)
        <li class="page-item">
          <a class="page-link" href="{{$bodies->previousPageUrl()}}" tabindex="-1">Previous</a>
        </li>
        <li class="page-item"><a class="page-link" hrebody->previousPageUrl()}}">{{$bodies->currentPage()-1}}</a></li>
    @else
        <li class="page-item disabled">
          <a class="page-link" href="#" tabindex="-1">Previous</a>
        </li>

    @endif
    <li class="page-item active">
      <a class="page-link" href="#">{{$bodies->currentPage()}}<span class="sr-only">(cuurent)</span></a>
    </li>

    @if($bodies->hasMorePages())
        <li class="page-item"><a class="page-link" href="{{$bodies->nextPageUrl()}}">{{$bodies->currentPage()+1}}</a></li>
        <li class="page-item">
          <a class="page-link" href="{{$bodies->nextPageUrl()}}">Next</a>
        </li>
    @else
        <li class="page-item disabled">
          <a class="page-link" href="#">Next</a>
        </li>
    @endif
  </ul>
<body
@else
    <div class="alert alert-warning">
        No Bodies available!
    </div>
@endif

@if (session('status'))
    <div class="alert alert-{{session('status')}}">
        {{ session('status_string') }}
    </div>
@endif
@endsection
