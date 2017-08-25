@extends('app_user.main')

@section('main-content')

@if (count($app_users)>0)
<table class="table table-hover">
  <thead>
    <tr>
      <th>#</th>
      <th>Name</th>
      <th>Email</th>
      <th>Contact</th>
      <th>Year</th>
      <th>Branch</th>
    </tr>
  </thead>
  <tbody>
      @foreach ($app_users as $app_user)
          <tr>
            <th scope="row">{{$app_user->id}}</th>
            <td>{{$app_user->name}}</td>
            <td>{{$app_user->email}}</td>
            <td>{{$app_user->contact}}</td>
            <td>{{$app_user->year}}</td>
            <td>{{$app_user->branch}}</td>
            <td>
                <!-- <form action="app_users/{{$app_user->id}}/edit/" method="get">
                    <button type="submit" class="btn btn-primary">
                        <i class="material-icons md-18" style="font-size:16px;">mode_edit</i>
                    </button>
                </form> -->
                <form method="post" action="/app_users/{{$app_user->id}}">
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
        No App Users available!
    </div>
@endif

@if (session('status'))
    <div class="alert alert-{{session('status')}}">
        {{ session('status_string') }}
    </div>
@endif
@endsection
