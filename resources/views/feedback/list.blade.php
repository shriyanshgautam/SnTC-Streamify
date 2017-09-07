@extends('feedback.main')

@section('main-content')
<div class="row">
    <div class="col-12">
        @if (count($feedbacks)>0)
        <table class="table table-hover">
          <thead>
            <tr>
              <th>#</th>
              <th>Stream</th>
              <th>Text</th>
              <th>User</th>
            </tr>
          </thead>
          <tbody>
              @foreach ($feedbacks as $feedback)
                  <tr>
                    <th scope="row">{{$feedback->id}}</th>
                    <td>{{$feedback->stream->title}}</td>
                    <td>{{$feedback->text}}</td>
                    <td>{{$feedback->appUser->name}}</td>

                    <td>
                        <form method="post" action="/feedbacks/{{$feedback->id}}">
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


            @if($feedbacks->currentPage()!=1)
                <li class="page-item">
                  <a class="page-link" href="{{$feedbacks->previousPageUrl()}}" tabindex="-1">Previous</a>
                </li>
                <li class="page-item"><a class="page-link" href="{{$feedbacks->previousPageUrl()}}">{{$feedbacks->currentPage()-1}}</a></li>
            @else
                <li class="page-item disabled">
                  <a class="page-link" href="#" tabindex="-1">Previous</a>
                </li>

            @endif
            <li class="page-item active">
              <a class="page-link" href="#">{{$feedbacks->currentPage()}}<span class="sr-only">(cuurent)</span></a>
            </li>

            @if($feedbacks->hasMorePages())
                <li class="page-item"><a class="page-link" href="{{$feedbacks->nextPageUrl()}}">{{$feedbacks->currentPage()+1}}</a></li>
                <li class="page-item">
                  <a class="page-link" href="{{$feedbacks->nextPageUrl()}}">Next</a>
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
            No Feedback available!
        </div>
    @endif

    @if (session('status'))
        <div class="alert alert-{{session('status')}}">
            {{ session('status_string') }}
        </div>
    @endif
</div>



@endsection
