@extends('feedback.main')

@section('main-content')

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
@endsection
