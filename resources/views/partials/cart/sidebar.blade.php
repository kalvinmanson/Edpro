@if(Auth::check())
  Si es usuario
@else
  <ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="register-tab" data-toggle="tab" href="#register" role="tab" aria-controls="register" aria-selected="true">Soy nuevo</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="login-tab" data-toggle="tab" href="#login" role="tab" aria-controls="login" aria-selected="false">Ingresar</a>
  </li>
</ul>
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="register" role="tabpanel" aria-labelledby="register-tab">
    <div class="card">
      <div class="card-body">
        <form method="POST" action="{{ route('register') }}" aria-label="{{ __('Register') }}">
          <div class="form-group">
            <label for="name">Nombre completo</label>
            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required>
          </div>
          <div class="form-group">
            <label for="email">Email</label>
            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
          </div>
          <div class="form-group">
            <label for="email">Contraseña</label>
            <input id="password" type="password" class="form-control" name="password" required>
          </div>
          <div class="form-group">
            <label for="email">Confirmación de contraseña</label>
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-primary">
                {{ __('Register') }}
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <div class="tab-pane fade" id="login" role="tabpanel" aria-labelledby="login-tab">
    @include('partials.auth.login')
  </div>
</div>
@endif
