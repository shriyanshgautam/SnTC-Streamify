@extends('tag.main')

@section('main-content')
<div class="row">
    <div class="col-12">
        @if (count($tags)>0)
        <table class="table table-hover">
          <thead>
            <tr>
              <th>#</th>
              <th>Name</th>
              <th>Level</th>
               <th>-</th>
            </tr>
          </thead>
          <tbody>
              @foreach ($tags as $tag)
                  <tr>
                    <th scope="row">{{$tag->id}}</th>
                    <td>{{$tag->name}}</td>
                    <td>{{$tag->level}}</td>

                    <td>
                        <div class="row" style="width:100px;">
                        <form class="col-6" action="tags/{{$tag->id}}/edit/" method="get">
                            <button type="submit" class="btn btn-primary">
                                <i class="material-icons md-18" style="font-size:16px;">mode_edit</i>
                            </button>
                        </form>
                        <form class="col-6" method="post" action="/tags/{{$tag->id}}">
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" class="btn btn-danger">
                                {{ csrf_field() }}
                                <i class="material-icons md-18" style="font-size:16px;">delete</i>
                            </button>
                        </form>
                        </div>
                    </td>
                  </tr>
              @endforeach
          </tbody>
        </table>

        <nav aria-label="Page navigation example">
          <ul class="pagination justify-content-center">


            @if($tags->currentPage()!=1)
                <li class="page-item">
                  <a class="page-link" href="{{$tags->previousPageUrl()}}" tabindex="-1">Previous</a>
                </li>
                <li class="page-item"><a class="page-link" href="{{$tags->previousPageUrl()}}">{{$tags->currentPage()-1}}</a></li>
            @else
                <li class="page-item disabled">
                  <a class="page-link" href="#" tabindex="-1">Previous</a>
                </li>

            @endif
            <li class="page-item active">
              <a class="page-link" href="#">{{$tags->currentPage()}}<span class="sr-only">(cuurent)</span></a>
            </li>

            @if($tags->hasMorePages())
                <li class="page-item"><a class="page-link" href="{{$tags->nextPageUrl()}}">{{$tags->currentPage()+1}}</a></li>
                <li class="page-item">
                  <a class="page-link" href="{{$tags->nextPageUrl()}}">Next</a>
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
            No Tags available!
        </div>
    @endif

    @if (session('status'))
        <div class="alert alert-{{session('status')}}">
            {{ session('status_string') }}
        </div>
    @endif
</div>



@endsection
