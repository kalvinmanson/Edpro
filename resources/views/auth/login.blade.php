@extends('layouts.app')

@section('content')
<div class="container">
  <div class="lineTitle">
    <h2>
      <small>Cuenta de usuario</small>
      Mi cuenta
    </h2>
  </div>
    <div class="row">
      <div class="col-md-6 m-auto">
        <ul class="nav nav-tabs" id="authTab" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="login-tab" data-toggle="tab" href="#login" role="tab" aria-controls="login" aria-selected="true">Entrar</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="register-tab" data-toggle="tab" href="#register" role="tab" aria-controls="register" aria-selected="false">Registrarme</a>
          </li>
        </ul>
        <div class="tab-content" id="authTabContent">
          <div class="tab-pane fade show active" id="login" role="tabpanel" aria-labelledby="login-tab">
            <div class="card">
              <div class="card-body">
                <p>Ingresa fácilmente usando tus cuentas de:</p>
                <p class="text-center">
                  <a href="{{ route('oauth', 'facebook') }}" class="btn btn-outline-primary"><i class="fab fa-facebook-f"></i> Facebook</a>
                  <a href="{{ route('oauth', 'google') }}" class="btn btn-outline-danger"><i class="fab fa-google-plus-g"></i> Google</a>
                </p>
                <p>O si tiene un usuario registrado:</p>
                @include('partials.auth.login')
              </div>
            </div>
          </div>
          <div class="tab-pane fade" id="register" role="tabpanel" aria-labelledby="register-tab">
            <div class="card">
              <div class="card-body">
                <p>Registrate fácilmente usando tus cuentas de:</p>
                <p class="text-center">
                  <a href="{{ route('oauth', 'facebook') }}" class="btn btn-outline-primary"><i class="fab fa-facebook-f"></i> Facebook</a>
                  <a href="{{ route('oauth', 'google') }}" class="btn btn-outline-danger"><i class="fab fa-google-plus-g"></i> Google</a>
                </p>
                <p>O crea un usuario registrado:</p>
                @include('partials.auth.register')
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection
