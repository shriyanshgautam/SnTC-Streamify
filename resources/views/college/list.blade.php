@extends('college.main')

@section('main-content')
<div class="row">
    <div class="col-12">
        @if (count($colleges)>0)
        <table class="table table-hover">
          <thead>
            <tr>
              <th>#</th>
              <th>Name</th>
              <th>Code</th>
            </tr>
          </thead>
          <tbody>
              @foreach ($colleges as $college)
                  <tr>
                    <th scope="row">{{$college->id}}</th>
                    <td>{{$college->name}}</td>
                    <td>{{$college->code}}</td>

                    <td>
                        <form action="colleges/{{$college->id}}/edit/" method="get">
                            <button type="submit" class="btn btn-primary">
                                <i class="material-icons md-18" style="font-size:16px;">mode_edit</i>
                            </button>
                        </form>
                        <form method="post" action="/colleges/{{$college->id}}">
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


            @if($colleges->currentPage()!=1)
                <li class="page-item">
                  <a class="page-link" href="{{$colleges->previousPageUrl()}}" tabindex="-1">Previous</a>
                </li>
                <li class="page-item"><a class="page-link" href="{{$colleges->previousPageUrl()}}">{{$colleges->currentPage()-1}}</a></li>
            @else
                <li class="page-item disabled">
                  <a class="page-link" href="#" tabindex="-1">Previous</a>
                </li>

            @endif
            <li class="page-item active">
              <a class="page-link" href="#">{{$colleges->currentPage()}}<span class="sr-only">(cuurent)</span></a>
            </li>

            @if($colleges->hasMorePages())
                <li class="page-item"><a class="page-link" href="{{$colleges->nextPageUrl()}}">{{$colleges->currentPage()+1}}</a></li>
                <li class="page-item">
                  <a class="page-link" href="{{$colleges->nextPageUrl()}}">Next</a>
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
            No Colleges available!
        </div>
    @endif

    @if (session('status'))
        <div class="alert alert-{{session('status')}}">
            {{ session('status_string') }}
        </div>
    @endif
</div>



@endsection
