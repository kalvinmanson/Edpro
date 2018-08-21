@extends('layouts.admin')

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-md-8 col-lg-9">
      <form action="{{ route('admin.pages.update', $page->id) }}" method="POST" class="card">
        <input type="hidden" name="_method" value="PUT">
        @csrf
        <div class="card-header">Edit page: {{ $page->name }}</div>
        <div class="card-body">
          <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control form-control-lg" value="{{ old('name') ? old('name') : $page->name }}" required>
          </div>
          <div class="form-group">
            <input type="text" name="slug" id="slug" class="form-control form-control-sm" placeholder="slug-of-the-content" value="{{ old('slug') ? old('slug') : $page->slug }}" required>
          </div>
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label for="description">Description</label>
                <textarea type="text" name="description" id="description" class="form-control" rows="5">{{ old('description') ? old('description') : $page->description }}</textarea>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="picture">Picture</label>
                <upload-input name="picture" value="{{ old('picture') ? old('picture') : $page->picture }}"></upload-input>
              </div>
              <div class="form-group">
                <label for="weight">weight</label>
                <input type="number" name="weight" id="weight" class="form-control" value="{{ old('weight') ? old('weight') : $page->weight }}">
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="categories">Categories</label>
                <select name="categories[]" id="categories" class="form-control" multiple>
                  @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $page->categories->where('id', $category->id)->first() ? 'selected' : ''}}>{{ $category->parent ? $category->parent->name.' / ' : '' }}{{ $category->name }}</option>
                  @endforeach
                </select>
              </div>
            </div>
          </div>

          <div class="form-group">
            <label for="content">Content</label>
            <editor name="content" value="{{ old('content') ? old('content') : $page->content }}"></editor>
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
    <div class="col-md-8 col-lg-3">
      @include('partials.admin.fields')
    </div>
  </div>
</div>

<form id="destroy-form" action="{{ route('admin.pages.destroy', $page->id) }}" method="POST" style="display: none;">
  @csrf
  <input type="hidden" name="_method" value="DELETE" />
</form>
@endsection
