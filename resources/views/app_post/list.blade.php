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

<nav aria-label="Page navigation example">
  <ul class="pagination justify-content-center">


    @if($app_posts->currentPage()!=1)
        <li class="page-item">
          <a class="page-link" href="{{$app_posts->previousPageUrl()}}" tabindex="-1">Previous</a>
        </li>
        <li class="page-item"><a class="page-link" href="{{$app_posts->previousPageUrl()}}">{{$app_posts->currentPage()-1}}</a></li>
    @else
        <li class="page-item disabled">
          <a class="page-link" href="#" tabindex="-1">Previous</a>
        </li>

    @endif
    <li class="page-item active">
      <a class="page-link" href="#">{{$app_posts->currentPage()}}<span class="sr-only">(cuurent)</span></a>
    </li>

    @if($app_posts->hasMorePages())
        <li class="page-item"><a class="page-link" href="{{$app_posts->nextPageUrl()}}">{{$app_posts->currentPage()+1}}</a></li>
        <li class="page-item">
          <a class="page-link" href="{{$app_posts->nextPageUrl()}}">Next</a>
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
        No Posts available!
    </div>
@endif

@if (session('status'))
    <div class="alert alert-{{session('status')}}">
        {{ session('status_string') }}
    </div>
@endif
@endsection
