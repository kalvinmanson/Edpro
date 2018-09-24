@if(Auth::check())
  <div class="card">
    <div class="card-body">
      <form method="POST" action="{{ route('addcomment', $book->slug) }}">
        @csrf
        <div class="form-group">
          <textarea name="content" class="form-control" placeholder="Escribe tu comentario..." required></textarea>
        </div>
        <div class="form-group">
          <button type="submit" class="btn btn-success">Enviar</button>
        </div>

      </form>
    </div>
  </div>
@else
@endif
