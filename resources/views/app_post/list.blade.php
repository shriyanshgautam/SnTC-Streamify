@extends('app_post.main')

@section('main-content')

@if (count($app_posts)>0)
<table class="table table-hover">
  <thead>
    <tr>
      <th>#</th>
      <th>Title</th>
      <th>Content</th>
      <th>Type</th>
      <th>Time</th>
      <th>User</th>
    </tr>
  </thead>
  <tbody>
      @foreach ($app_posts as $app_post)
          <tr>
            <th scope="row">{{$app_post->id}}</th>
            <td>{{$app_post->title}}</td>
            <td>{{$app_post->content}}</td>
            <td>{{$app_post->type}}</td>
            <td>{{Carbon\Carbon::parse($app_post->time)->diffForHumans()}}</td>
            <td>{{$app_post->appUser->name}}</td>

            <td>
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
        No Posts available!
    </div>
@endif

@if (session('status'))
    <div class="alert alert-{{session('status')}}">
        {{ session('status_string') }}
    </div>
@endif
@endsection
