@extends('layouts.admin')

@section('content')
<div class="container-fluid">
  <book-info isbn="{{ $book->isbn }}"></book-info>
  <form action="{{ route('admin.books.update', $book->id) }}" method="POST" class="card">
    <input type="hidden" name="_method" value="PUT">
    @csrf

    <div class="card-header">Edit book: {{ $book->name }}</div>
    <div class="card-body">
    <div class="row">
      <div class="col-md-8 col-lg-9">
          <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control form-control-lg" value="{{ old('name') ? old('name') : $book->name }}" required>
          </div>
          <div class="form-group">
            <input type="text" name="slug" id="slug" class="form-control form-control-sm" placeholder="slug-of-the-content" value="{{ old('slug') ? old('slug') : $book->slug }}" required>
          </div>
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label for="description">Description</label>
                <textarea type="text" name="description" id="description" class="form-control" rows="5">{{ old('description') ? old('description') : $book->description }}</textarea>
              </div>
              <div class="form-group">
                <label for="tags">Tags</label>
                <input type="text" name="tags" id="tags" class="form-control" value="{{ old('tags') ? old('tags') : $book->tags }}">
              </div>
              <div class="form-group">
                <label for="format">Format</label>
                <input type="text" name="format" id="format" class="form-control" value="{{ old('format') ? old('format') : $book->format }}">
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="publisher_id">Publisher</label>
                <select name="publisher_id" id="publisher_id" class="form-control">
                  @foreach($publishers as $publisher)
                    <option value="{{ $publisher->id }}" {{ $book->publisher_id == $publisher->id ? 'selected' : ''}}>{{ $publisher->name }}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label for="isbn">ISBN</label>
                <input type="text" name="isbn" id="isbn" class="form-control" value="{{ old('isbn') ? old('isbn') : $book->isbn }}">
              </div>
              <div class="form-group">
                <label for="picture">Picture</label>
                <upload-input name="picture" value="{{ old('picture') ? old('picture') : $book->picture }}"></upload-input>
              </div>
              <div class="row">
                <div class="col-sm-4">
                  <div class="form-group">
                    <label for="lang">Lang</label>
                    <select name="lang" id="lang" class="form-control">
                      <option value="es" {{ $book->lang == 'es' ? 'selected' : ''}}>Es</option>
                      <option value="en" {{ $book->lang == 'en' ? 'selected' : ''}}>En</option>
                    </select>
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="form-group">
                    <label for="pages">Pages</label>
                    <input type="number" name="pages" id="pages" class="form-control" value="{{ old('pages') ? old('pages') : $book->pages }}">
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="form-group">
                    <label for="year">Year</label>
                    <input type="number" name="year" id="year" class="form-control" value="{{ old('year') ? old('year') : $book->year }}">
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="topics">Topics</label>
                <select name="topics[]" id="topics" class="form-control" multiple>
                  @foreach($topics as $topic)
                    <option value="{{ $topic->id }}" {{ $book->topics->where('id', $topic->id)->first() ? 'selected' : ''}}>{{ $topic->parent ? $topic->parent->name.' / ' : '' }}{{ $topic->name }}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label for="authors">Authors</label>
                <select name="authors[]" id="authors" class="form-control" multiple>
                  @foreach($authors as $author)
                    <option value="{{ $author->id }}" {{ $book->authors->where('id', $author->id)->first() ? 'selected' : ''}}>{{ $author->name }}</option>
                  @endforeach
                </select>
              </div>
            </div>
          </div>

          <div class="form-group">
            <label for="content">Content</label>
            <editor name="content" value="{{ old('content') ? old('content') : $book->content }}"></editor>
          </div>
          <div class="form-group">
            <label for="content_table">Content Table</label>
            <editor name="content_table" value="{{ old('content_table') ? old('content_table') : $book->content_table }}"></editor>
          </div>
      </div>
      <div class="col-md-8 col-lg-3">
        <div class="form-group">
          <label for="stock">Stock</label>
          <input type="number" name="stock" id="stock" class="form-control" value="{{ old('stock') ? old('stock') : $book->stock }}">
        </div>
        <div class="form-group">
          <label for="old_price">Price Old</label>
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text">$</span>
            </div>
            <input type="number" name="old_price" id="old_price" class="form-control" value="{{ old('old_price') ? old('old_price') : $book->old_price }}">
            <div class="input-group-append">
              <span class="input-group-text">COP</span>
            </div>
          </div>
        </div>
        <div class="form-group">
          <label for="price">Price</label>
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text">$</span>
            </div>
            <input type="number" name="price" id="price" class="form-control" value="{{ old('price') ? old('price') : $book->price }}">
            <div class="input-group-append">
              <span class="input-group-text">COP</span>
            </div>
          </div>
        </div>
        <div class="custom-control custom-checkbox mb-2">
          <input type="checkbox" class="custom-control-input" id="promo" name="promo" value="1" {{ $book->promo ? 'checked' : '' }}>
          <label class="custom-control-label" for="promo">Book in promo</label>
        </div>
        <div class="form-group">
          <label for="year">Size W, H & D (cm)</label>
          <div class="input-group mb-3">
            <input type="number" name="size_w" id="size_w" class="form-control" value="{{ old('size_w') ? old('size_w') : $book->size_w }}">
            <input type="number" name="size_h" id="size_h" class="form-control" value="{{ old('size_h') ? old('size_h') : $book->size_h }}">
            <input type="number" name="size_d" id="size_d" class="form-control" value="{{ old('size_d') ? old('size_d') : $book->size_d }}">
          </div>
        </div>
        <div class="form-group">
          <label for="weight">Weight (g)</label>
          <input type="number" name="weight" id="weight" class="form-control" value="{{ old('weight') ? old('weight') : $book->weight }}">
        </div>
        <div class="form-group">
          <label for="preview">Preview (Issuu Id)</label>
          <input type="text" name="preview" id="preview" class="form-control" value="{{ old('preview') ? old('preview') : $book->preview }}">
        </div>
        <div class="form-group">
          <label for="video">Video (Youtube Id)</label>
          <input type="text" name="video" id="video" class="form-control" value="{{ old('video') ? old('video') : $book->video }}">
        </div>
        <div class="form-group">
          <label for="attachment">Attachment</label>
          <upload-input name="attachment" value="{{ old('attachment') ? old('attachment') : $book->attachment }}"></upload-input>
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

<form id="destroy-form" action="{{ route('admin.books.destroy', $book->id) }}" method="POST" style="display: none;">
  @csrf
  <input type="hidden" name="_method" value="DELETE" />
</form>
@endsection
