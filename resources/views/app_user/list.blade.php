@extends('app_user.main')

@section('main-content')
<div class="row">
    <div class="col-12">
        @if (count($app_users)>0)
        <table class="table table-hover">
          <thead>
            <tr>
              <th>#</th>
              <th>Name</th>
              <th>Email</th>
              <th>Contact</th>
              <th>Joined</th>
            </tr>
          </thead>
          <tbody>
              @foreach ($app_users as $app_user)
                  <tr>
                    <th scope="row">{{$app_user->id}}</th>
                    <td>{{$app_user->name}}</td>
                    <td>{{$app_user->email}}</td>
                    <td>{{$app_user->contact}}</td>
                    <td>{{Carbon\Carbon::parse($app_user->created_at)->diffForHumans()}}</td>
                    <!-- <td>
                        <form action="app_users/{{$app_user->id}}/edit/" method="get">
                            <button type="submit" class="btn btn-primary">
                                <i class="material-icons md-18" style="font-size:16px;">mode_edit</i>
                            </button>
                        </form>
                        <form method="post" action="/app_users/{{$app_user->id}}">
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" class="btn btn-danger">
                                {{ csrf_field() }}
                                <i class="material-icons md-18" style="font-size:16px;">delete</i>
                            </button>
                        </form>
                    </td> -->
                  </tr>
              @endforeach
          </tbody>
        </table>

        <nav aria-label="Page navigation example">
          <ul class="pagination justify-content-center">


            @if($app_users->currentPage()!=1)
                <li class="page-item">
                  <a class="page-link" href="{{$app_users->previousPageUrl()}}" tabindex="-1">Previous</a>
                </li>
                <li class="page-item"><a class="page-link" href="{{$app_users->previousPageUrl()}}">{{$app_users->currentPage()-1}}</a></li>
            @else
                <li class="page-item disabled">
                  <a class="page-link" href="#" tabindex="-1">Previous</a>
                </li>

            @endif
            <li class="page-item active">
              <a class="page-link" href="#">{{$app_users->currentPage()}}<span class="sr-only">(cuurent)</span></a>
            </li>

            @if($app_users->hasMorePages())
                <li class="page-item"><a class="page-link" href="{{$app_users->nextPageUrl()}}">{{$app_users->currentPage()+1}}</a></li>
                <li class="page-item">
                  <a class="page-link" href="{{$app_users->nextPageUrl()}}">Next</a>
                </li>
            @else
                <li class="page-item disabled">
                  <a class="page-link" href="#">Next</a>
                </li>
            @endif
          </ul>
        </nav>
    </div>
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
</div>




@endsection
