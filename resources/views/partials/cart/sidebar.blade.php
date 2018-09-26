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
        @include('partials.auth.register')
      </div>
    </div>
  </div>
  <div class="tab-pane fade" id="login" role="tabpanel" aria-labelledby="login-tab">
    <div class="card">
      <div class="card-body">
        @include('partials.auth.login')
      </div>
    </div>
  </div>
</div>
@endif
