@extends('layouts.admin')

@section('content')
<div class="container-fluid">
  <form action="{{ route('admin.blocks.update', $block->id) }}" method="POST" class="card">
    <input type="hidden" name="_method" value="PUT">
    @csrf
    <div class="card-header">Edit block: {{ $block->name }}</div>
    <div class="card-body">
      <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" id="name" class="form-control form-control-lg" value="{{ old('name') ? old('name') : $block->name }}" required>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label for="description">Description</label>
            <textarea type="text" name="description" id="description" class="form-control" rows="5">{{ old('description') ? old('description') : $block->description }}</textarea>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label for="picture">Picture</label>
            <upload-input name="picture" value="{{ old('picture') ? old('picture') : $block->picture }}"></upload-input>
          </div>
          <div class="form-group">
            <label for="weight">weight</label>
            <input type="number" name="weight" id="weight" class="form-control" value="{{ old('weight') ? old('weight') : $block->weight }}">
          </div>
          <div class="form-group">
            <label for="link">Link</label>
            <input type="text" name="link" id="link" class="form-control" value="{{ old('link') ? old('link') : $block->link }}">
          </div>
        </div>
      </div>

      <div class="form-group">
        <label for="content">Content</label>
        <editor name="content" value="{{ old('content') ? old('content') : $block->content }}"></editor>
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

<form id="destroy-form" action="{{ route('admin.blocks.destroy', $block->id) }}" method="POST" style="display: none;">
  @csrf
  <input type="hidden" name="_method" value="DELETE" />
</form>
@endsection
