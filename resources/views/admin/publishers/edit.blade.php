@extends('layouts.admin')

@section('content')
<div class="container-fluid">
  <form action="{{ route('admin.publishers.update', $publisher->id) }}" method="POST" class="card" enctype="multipart/form-data">
    <input type="hidden" name="_method" value="PUT">
    @csrf
    <div class="card-header">Edit publisher: {{ $publisher->name }}</div>
    <div class="card-body">
      <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" id="name" class="form-control form-control-lg" value="{{ old('name') ? old('name') : $publisher->name }}" required>
      </div>
      <div class="form-group">
        <input type="text" name="slug" id="slug" class="form-control form-control-sm" placeholder="slug-of-the-content" value="{{ old('slug') ? old('slug') : $publisher->slug }}" required>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label for="description">Description</label>
            <textarea type="text" name="description" id="description" class="form-control" rows="5">{{ old('description') ? old('description') : $publisher->description }}</textarea>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label for="picture">Picture</label>
            <input type="file" name="picture" id="picture" class="form-control">
            @if($publisher->picture)
              <a href="{{ $publisher->picture }}" data-fancybox="gallery"><i class="far fa-image"></i> {{ $publisher->picture }}</a>
            @endif
          </div>
        </div>
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

<form id="destroy-form" action="{{ route('admin.publishers.destroy', $publisher->id) }}" method="POST" style="display: none;">
  @csrf
  <input type="hidden" name="_method" value="DELETE" />
</form>
@endsection
