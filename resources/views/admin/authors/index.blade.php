@extends('layouts.admin')

@section('content')
<div class="container-fluid">
  <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#addNew"><i class="fa fa-plus"></i> Add new</button>
  <h1>Authors</h1>
  <table class="table table-striped">
    <tr>
      <th width="20">Id</th>
      <th>Name</th>
      <th>Picture</th>
      <th>Pages</th>
      <th>Timestamps</th>
    </tr>
    @foreach($authors as $author)
    <tr>
      <td>{{ $author->id }}</td>
      <td>
        <a href="{{ route('admin.authors.edit', $author->id) }}"><strong>{{ $author->name }}</strong></a><br>
        <small><a href="#">/{{ $author->slug }}</a>
      </td>
      <td><a href="{{ $author->picture }}" data-fancybox="gallery">{{ $author->picture }}</a></td>
      <td>
        {{ $author->books->count() }}
      </td>
      <td>
        <small>
          Created at {{ $author->created_at }},<br>
          Last update {{ $author->updated_at->diffForHumans() }}
        </small>
      </td>
    </tr>
    @endforeach
  </table>
  {{ $authors->links() }}
</div>


<!-- Modal -->
<div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form action="{{ route('admin.authors.store') }}" method="POST" class="modal-content">
      @csrf
      <div class="modal-header">
        <h5 class="modal-title" id="addNewLabel">Add new</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label for="name">Name</label>
          <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
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
