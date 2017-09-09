@extends('app_feedback.main')

@section('main-content')
<div class="row">
    <div class="col-12">
        @if (count($app_feedbacks)>0)
        <table class="table table-hover">
          <thead>
            <tr>
              <th>#</th>
              <th>Text</th>
              <th>User</th>
              <th>At</th>

            </tr>
          </thead>
          <tbody>
              @foreach ($app_feedbacks as $app_feedback)
                  <tr>
                    <th scope="row">{{$app_feedback->id}}</th>
                    <td>{{$app_feedback->text}}</td>
                    <td>{{$app_feedback->appUser->name}}</td>
                    <td>{{Carbon\Carbon::parse($app_feedback->created_at)->diffForHumans()}}</td>

                    <td>
                        <form method="post" action="/app_feedbacks/{{$app_feedback->id}}">
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


            @if($app_feedbacks->currentPage()!=1)
                <li class="page-item">
                  <a class="page-link" href="{{$app_feedbacks->previousPageUrl()}}" tabindex="-1">Previous</a>
                </li>
                <li class="page-item"><a class="page-link" href="{{$app_feedbacks->previousPageUrl()}}">{{$app_feedbacks->currentPage()-1}}</a></li>
            @else
                <li class="page-item disabled">
                  <a class="page-link" href="#" tabindex="-1">Previous</a>
                </li>

            @endif
            <li class="page-item active">
              <a class="page-link" href="#">{{$app_feedbacks->currentPage()}}<span class="sr-only">(cuurent)</span></a>
            </li>

            @if($app_feedbacks->hasMorePages())
                <li class="page-item"><a class="page-link" href="{{$app_feedbacks->nextPageUrl()}}">{{$app_feedbacks->currentPage()+1}}</a></li>
                <li class="page-item">
                  <a class="page-link" href="{{$app_feedbacks->nextPageUrl()}}">Next</a>
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
            No App Feedback available!
        </div>
    @endif

    @if (session('status'))
        <div class="alert alert-{{session('status')}}">
            {{ session('status_string') }}
        </div>
    @endif
</div>



@endsection
