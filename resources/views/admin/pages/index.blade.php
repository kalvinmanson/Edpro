@extends('layouts.admin')

@section('content')
<div class="container-fluid">
  <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#addNew"><i class="fa fa-plus"></i> Add new</button>
  <h1>Pages</h1>
  <table class="table table-striped">
    <tr>
      <th width="20">Id</th>
      <th>Name</th>
      <th>Category</th>
      <th>Picture</th>
      <th>Timestamps</th>
    </tr>
    @foreach($pages as $page)
    <tr>
      <td>{{ $page->id }}</td>
      <td>
        <a href="{{ route('admin.pages.edit', $page->id) }}"><strong>{{ $page->name }}</strong></a><br>
        <small><a href="#">/{{ $page->slug }}</a>
      </td>
      <td>
        @foreach($page->categories as $category)
          {{ $category->name }},
        @endforeach
      </td>
      <td><a href="{{ $page->picture }}" data-fancybox="gallery">{{ $page->picture }}</a></td>
      <td>
        <small>
          Created at {{ $page->created_at }},<br>
          Last update {{ $page->updated_at->diffForHumans() }}
        </small>
      </td>
    </tr>
    @endforeach
  </table>
  {{ $pages->links() }}
</div>


<!-- Modal -->
<div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form action="{{ route('admin.pages.store') }}" method="POST" class="modal-content">
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
