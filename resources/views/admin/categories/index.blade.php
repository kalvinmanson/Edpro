@extends('layouts.admin')

@section('content')
<div class="container-fluid">
  <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#addNew"><i class="fa fa-plus"></i> Add new</button>
  <h1>Categories</h1>
  <table class="table table-striped">
    <tr>
      <th width="20">Id</th>
      <th>Name</th>
      <th>Picture</th>
      <th>Pages</th>
      <th>Timestamps</th>
    </tr>
    @foreach($categories as $category)
    <tr>
      <td>{{ $category->id }}</td>
      <td>
        {{ $category->parent ? $category->parent->name.' / ' : '' }}<a href="{{ route('admin.categories.edit', $category->id) }}"><strong>{{ $category->name }}</strong></a><br>
        <small><a href="#">{{ $category->parent ? '/'.$category->parent->slug : '' }}/{{ $category->slug }}</a>
      </td>
      <td><a href="{{ $category->picture }}" data-fancybox="gallery">{{ $category->picture }}</a></td>
      <td>
        {{ $category->pages->count() }}
      </td>
      <td>
        <small>
          Created at {{ $category->created_at }},<br>
          Last update {{ $category->updated_at->diffForHumans() }}
        </small>
      </td>
    </tr>
    @endforeach
  </table>
</div>


<!-- Modal -->
<div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form action="{{ route('admin.categories.store') }}" method="POST" class="modal-content">
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
