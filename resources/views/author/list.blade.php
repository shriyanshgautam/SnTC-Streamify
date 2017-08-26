@extends('author.main')

@section('main-content')

@if (count($authors)>0)
<table class="table table-hover">
  <thead>
    <tr>
      <th>#</th>
      <th>-</th>
      <th>Name</th>
      <th>Email</th>
      <th>Contact</th>

      <th>
          -
      </th>
    </tr>
  </thead>
  <tbody>
      @foreach ($authors as $author)
          <tr>
            <th scope="row">{{$author->id}}</th>
            <td><img width="56px" height="56px" src="{{str_replace("www.dropbox.com","dl.dropboxusercontent.com",$author->image)}}" /></td>
            <td>{{$author->name}}</td>
            <td>{{$author->email}}</td>
            <td>{{$author->contact}}</td>
            <td>
                <form action="authors/{{$author->id}}/edit/" method="get">
                    <button type="submit" class="btn btn-primary">
                        <i class="material-icons md-18" style="font-size:16px;">mode_edit</i>
                    </button>
                </form>
                <form method="post" action="/authors/{{$author->id}}">
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


    @if($authors->currentPage()!=1)
        <li class="page-item">
          <a class="page-link" href="{{$authors->previousPageUrl()}}" tabindex="-1">Previous</a>
        </li>
        <li class="page-item"><a class="page-link" href="{{$authors->previousPageUrl()}}">{{$authors->currentPage()-1}}</a></li>
    @else
        <li class="page-item disabled">
          <a class="page-link" href="#" tabindex="-1">Previous</a>
        </li>

    @endif
    <li class="page-item active">
      <a class="page-link" href="#">{{$authors->currentPage()}}<span class="sr-only">(cuurent)</span></a>
    </li>

    @if($authors->hasMorePages())
        <li class="page-item"><a class="page-link" href="{{$authors->nextPageUrl()}}">{{$authors->currentPage()+1}}</a></li>
        <li class="page-item">
          <a class="page-link" href="{{$authors->nextPageUrl()}}">Next</a>
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
        No Authors available!
    </div>
@endif

@if (session('status'))
    <div class="alert alert-{{session('status')}}">
        {{ session('status_string') }}
    </div>
@endif
@endsection
