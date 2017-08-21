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
                <form action="bodies/{{$body->id}}/edit/" method="get">
                    <button type="submit" class="btn btn-primary">
                        <i class="material-icons md-18" style="font-size:16px;">mode_edit</i>
                    </button>
                </form>
                <form method="post" action="/bodies/{{$body->id}}">
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
        No Bodies available!
    </div>
@endif

@if (session('status'))
    <div class="alert alert-{{session('status')}}">
        {{ session('status_string') }}
    </div>
@endif
@endsection
