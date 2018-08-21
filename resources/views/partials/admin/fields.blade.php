<ul class="nav nav-tabs" id="Type" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="text-tab" data-toggle="tab" href="#text" role="tab" aria-controls="text" aria-selected="true">Text</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="image-tab" data-toggle="tab" href="#image" role="tab" aria-controls="image" aria-selected="false">Image</a>
  </li>
</ul>
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="text" role="tabpanel" aria-labelledby="text-tab">
    <form action="{{ route('admin.fields.store') }}" method="POST">
      @csrf
      <input type="hidden" name="page_id" value="{{ $page->id }}">
      <input type="hidden" name="format" value="Text">
      <div class="form-group">
        <label>Name</label>
        <admin-fields name="name"></admin-fields>
      </div>
      <div class="form-group">
        <label>Content</label>
        <textarea name="content" class="form-control" required></textarea>
      </div>
      <div class="form-group">
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text">Weight</span>
          </div>
          <input type="number" class="form-control" name="weight" value="0" min="0" max="100">
        </div>
      </div>
      <div class="form-group">
        <button type="submit" class="btn btn-primary">Save</button>
      </div>
    </form>
  </div>
  <div class="tab-pane fade" id="image" role="tabpanel" aria-labelledby="image-tab">
    <form action="{{ route('admin.fields.store') }}" method="POST">
      @csrf
      <input type="hidden" name="page_id" value="{{ $page->id }}">
      <input type="hidden" name="format" value="Image">
      <div class="form-group">
        <label>Name</label>
        <admin-fields name="name"></admin-fields>
      </div>
      <div class="form-group">
        <label>Content</label>
        <upload-input name="content"></upload-input>
      </div>
      <div class="form-group">
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text">Weight</span>
          </div>
          <input type="number" class="form-control" name="weight" value="0" min="0" max="100">
        </div>
      </div>
      <div class="form-group">
        <button type="submit" class="btn btn-primary">Save</button>
      </div>
    </form>
  </div>
</div>
<hr>
@foreach($page->fields as $field)
  <div class="card">
    <div class="card-body">
      <form method="POST" action="{{ route('admin.fields.destroy', $field->id )}}" class="float-right">
        @csrf
        <input type="hidden" name="_method" value="DELETE">
        <button type="submit" class="btn btn-sm btn-link text-danger"><i class="far fa-trash-alt"></i></button>
      </form>
      <span class="badge badge-secondary float-right">{{ $field->weight }}</span>
      <strong>{{ $field->name }}</strong> ({{ $field->format }}):
      {{ $field->content }}
    </div>
  </div>
@endforeach
