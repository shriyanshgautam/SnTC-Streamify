@extends('position_holder.main')

@section('main-content')
<div class="row">
    <div class="col-12">
        @if (count($position_holders)>0)
        <table class="table table-hover">
          <thead>
            <tr>
              <th>#</th>
              <th>-</th>
              <th>Name</th>
              <th>Position</th>
              <th>Level</th>
              <th>Email</th>
              <th>Contact</th>

              <th>-</th>
            </tr>
          </thead>
          <tbody>
              @foreach ($position_holders as $position_holder)
                  <tr>
                    <th scope="row">{{$position_holder->id}}</th>
                    <td><img width="56px" height="56px" src="{{str_replace("www.dropbox.com","dl.dropboxusercontent.com",$position_holder->image)}}" /></td>
                    <td>{{$position_holder->name}}</td>
                    <td>{{$position_holder->position}}</td>
                    <td>{{$position_holder->level}}</td>
                    <td>{{$position_holder->email}}</td>
                    <td>{{$position_holder->contact}}</td>

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

        <nav aria-label="Page navigation example">
          <ul class="pagination justify-content-center">


            @if($position_holders->currentPage()!=1)
                <li class="page-item">
                  <a class="page-link" href="{{$position_holders->previousPageUrl()}}" tabindex="-1">Previous</a>
                </li>
                <li class="page-item"><a class="page-link" href="{{$position_holders->previousPageUrl()}}">{{$position_holders->currentPage()-1}}</a></li>
            @else
                <li class="page-item disabled">
                  <a class="page-link" href="#" tabindex="-1">Previous</a>
                </li>

            @endif
            <li class="page-item active">
              <a class="page-link" href="#">{{$position_holders->currentPage()}}<span class="sr-only">(cuurent)</span></a>
            </li>

            @if($position_holders->hasMorePages())
                <li class="page-item"><a class="page-link" href="{{$position_holders->nextPageUrl()}}">{{$position_holders->currentPage()+1}}</a></li>
                <li class="page-item">
                  <a class="page-link" href="{{$position_holders->nextPageUrl()}}">Next</a>
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
            No Position Holders available!
        </div>
    @endif

    @if (session('status'))
        <div class="alert alert-{{session('status')}}">
            {{ session('status_string') }}
        </div>
    @endif
</div>


@endsection
