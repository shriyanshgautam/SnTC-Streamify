@extends('position_holder.main')

@section('main-content')

@if (count($position_holders)>0)
<table class="table table-hover">
  <thead>
    <tr>
      <th>#</th>
      <th>Name</th>
      <th>Position</th>
      <th>Email</th>
      <th>Contact</th>
      <th>Image</th>
    </tr>
  </thead>
  <tbody>
      @foreach ($position_holders as $position_holder)
          <tr>
            <th scope="row">{{$position_holder->id}}</th>
            <td>{{$position_holder->name}}</td>
            <td>{{$position_holder->position}}</td>
            <td>{{$position_holder->email}}</td>
            <td>{{$position_holder->contact}}</td>
            <td>{{$position_holder->image}}</td>
            <td>
                <form action="position_holders/{{$position_holder->id}}/edit/" method="get">
                    <button type="submit" class="btn btn-primary">
                        <i class="material-icons md-18" style="font-size:16px;">mode_edit</i>
                    </button>
                </form>
                <form method="post" action="/position_holders/{{$position_holder->id}}">
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
        No Position Holders available!
    </div>
@endif

@if (session('status'))
    <div class="alert alert-{{session('status')}}">
        {{ session('status_string') }}
    </div>
@endif
@endsection
