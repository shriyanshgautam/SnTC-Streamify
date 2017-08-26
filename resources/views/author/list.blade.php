@extends('author.main')

@section('main-content')

@if (count($authors)>0)
<table class="table table-hover">
  <thead>
    <tr>
      <th>#</th>
      <th>Name</th>
      <th>Email</th>
      <th>Contact</th>
      <th>Image</th>
      <th>
          -
      </th>
    </tr>
  </thead>
  <tbody>
      @foreach ($authors as $author)
          <tr>
            <th scope="row">{{$author->id}}</th>
            <td>{{$author->name}}</td>
            <td>{{$author->email}}</td>
            <td>{{$author->contact}}</td>
            <td><img width="64px" height="64px" src="{{str_replace("www.dropbox.com","dl.dropboxusercontent.com",$author->image)}}" /></td>
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
