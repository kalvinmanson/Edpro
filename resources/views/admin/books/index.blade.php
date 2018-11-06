@extends('layouts.admin')

@section('content')
<div class="container-fluid">
  <button type="button" class="btn btn-primary float-right ml-3" data-toggle="modal" data-target="#addNew"><i class="fa fa-plus"></i> Add new</button>

  <form method="GET" action="{{ route('admin.books.index')}}" class="float-right form-inline">
    <input type="text" class="form-control" role="search" name="q" placeholder="Search..." required>
    <button type="submit" class="btn btn-outline-success"><i class="fas fa-search"></i></button>
  </form>

  <h1>Books</h1>
  <table class="table table-striped">
    <tr>
      <th width="20">
        <a href="{{ route('admin.books.index', ['orderby' => 'id', 'order' => $nextOrder]) }}" class="btn btn-sm btn-link">
          <strong>Id</strong>
          {!! $nextOrder == 'asc' ? '<i class="fas fa-arrow-down"></i>' : '<i class="fas fa-arrow-up"></i>' !!}
        </a>
      </th>
      <th>
        <a href="{{ route('admin.books.index', ['orderby' => 'name', 'order' => $nextOrder]) }}" class="btn btn-sm btn-link">
          <strong>Name</strong>
          {!! $nextOrder == 'asc' ? '<i class="fas fa-arrow-down"></i>' : '<i class="fas fa-arrow-up"></i>' !!}
        </a>
      </th>
      <th>Book Info</th>
      <th>Topics</th>
      <th>Author</th>
      <th>Stock</th>
      <th>
        <a href="{{ route('admin.books.index', ['orderby' => 'price', 'order' => $nextOrder]) }}" class="btn btn-sm btn-link">
          <strong>Price</strong>
          {!! $nextOrder == 'asc' ? '<i class="fas fa-arrow-down"></i>' : '<i class="fas fa-arrow-up"></i>' !!}
        </a>
      </th>
      <th>
        <a href="{{ route('admin.books.index', ['orderby' => 'updated_at', 'order' => $nextOrder]) }}" class="btn btn-sm btn-link">
          <strong>Updated</strong>
          {!! $nextOrder == 'asc' ? '<i class="fas fa-arrow-down"></i>' : '<i class="fas fa-arrow-up"></i>' !!}
        </a>
      </th>
    </tr>
    @foreach($books as $book)
    <tr>
      <td>{{ $book->id }}</td>
      <td>
        @if($book->picture)
          <a href="{{ $book->picture }}" class="float-left" data-fancybox="gallery">
            <img src="{{ $book->picture }}" style="width: 70px;" class="pr-3 pb-2">
          </a>
        @endif
        <a href="{{ route('admin.books.edit', $book->id) }}"><strong>{{ $book->name }}</strong></a><br>
        <small><a href="#">/{{ $book->slug }}</a>
      </td>
      <td>
        Publisher: {{ $book->publisher->name }}<br>
        Year: {{ $book->year }}<br>
        Pages: {{ $book->pages }}
      </td>
      <td>
        @foreach($book->topics as $topic)
          {{ $topic->name }},
        @endforeach
      </td>
      <td>
        @foreach($book->authors as $author)
          {{ $author->name }},
        @endforeach
      </td>
      <td>{{ $book->stock }}</td>
      <td>
        <small><strike>$ {{ number_format($book->old_price) }} COP</strike></small><br>
        <strong>$ {{ number_format($book->price) }} COP</strong>
      </td>
      <td>
        <small>
          Created at {{ $book->created_at }},<br>
          Last update {{ $book->updated_at->diffForHumans() }}
        </small>
      </td>
    </tr>
    @endforeach
  </table>
  {{ $books->links() }}
</div>


<!-- Modal -->
<div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form action="{{ route('admin.books.store') }}" method="POST" class="modal-content">
      @csrf
      <div class="modal-header">
        <h5 class="modal-title" id="addNewLabel">Add new</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label for="publisher_id">Publisher</label>
          <select name="publisher_id" id="publisher_id" class="form-control">
            @foreach($publishers as $publisher)
              <option value="{{ $publisher->id }}">{{ $publisher->name }}</option>
            @endforeach
          </select>
        </div>
        <div class="form-group">
          <label for="name">Name</label>
          <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
        </div>
        <div class="form-group">
          <label for="name">ISBN</label>
          <input type="number" name="isbn" id="isbn" class="form-control" value="{{ old('isbn') }}" required>
        </div>
        <div class="form-group">
          <input type="text" name="slug" id="slug" class="form-control form-control-sm" placeholder="slug-of-the-content" value="{{ old('slug') }}" required>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
      </div>
    </form>
  </div>
</div>
@endsection
