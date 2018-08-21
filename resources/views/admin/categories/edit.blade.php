@extends('layouts.admin')

@section('content')
<div class="container-fluid">
  <form action="{{ route('admin.categories.update', $category->id) }}" method="POST" class="card">
    <input type="hidden" name="_method" value="PUT">
    @csrf
    <div class="card-header">Edit category: {{ $category->name }}</div>
    <div class="card-body">
      <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" id="name" class="form-control form-control-lg" value="{{ old('name') ? old('name') : $category->name }}" required>
      </div>
      <div class="form-group">
        <input type="text" name="slug" id="slug" class="form-control form-control-sm" placeholder="slug-of-the-content" value="{{ old('slug') ? old('slug') : $category->slug }}" required>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label for="parent_id">Parent Category</label>
            <select name="parent_id" id="parent_id" class="form-control">
              <option value="0">Top category</option>
              @if($category->categories->count() == 0)
                @foreach($parentCategories as $parentCategory)
                  <option value="{{ $parentCategory->id }}" {{ $parentCategory->id == $category->parent_id ? 'selected' : ''}}>{{ $parentCategory->name }}</option>
                @endforeach
              @endif
            </select>
          </div>
          <div class="form-group">
            <label for="description">Description</label>
            <textarea type="text" name="description" id="description" class="form-control" rows="5">{{ old('description') ? old('description') : $category->description }}</textarea>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label for="picture">Picture</label>
            <upload-input name="picture" value="{{ old('picture') ? old('picture') : $category->picture }}"></upload-input>
          </div>
          <div class="form-group">
            <label for="weight">weight</label>
            <input type="number" name="weight" id="weight" class="form-control" value="{{ old('weight') ? old('weight') : $category->weight }}">
          </div>
        </div>
      </div>

      <div class="form-group">
        <label for="content">Content</label>
        <editor name="content" value="{{ old('content') ? old('content') : $category->content }}"></editor>
      </div>
    </div>
    <div class="card-footer">
      <a class="btn btn-danger btn-sm float-right" href="#" onclick="event.preventDefault(); document.getElementById('destroy-form').submit();">
          <i class="far fa-trash-alt"></i> Destroy
      </a>
      <button type="submit" class="btn btn-primary">Save</button>
    </div>
  </form>
</div>

<form id="destroy-form" action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" style="display: none;">
  @csrf
  <input type="hidden" name="_method" value="DELETE" />
</form>
@endsection
