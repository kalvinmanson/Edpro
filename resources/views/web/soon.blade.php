@extends('layouts.blank')

@section('title', 'Ediciones El Profesional')
@section('description', 'Estamos trabajando para brindarte la mejor experiencia y poner a tu disposicion el catalogo de mejor calidad de libros especializados, técnicos y científicos disponibles en el país.')

@section('content')
<div class="soon">
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <div class="logo pt-5">
          <img src="/img/logo-mini.png" alt="Ediciones el Profesional LTDA" class="img-fluid float-left mr-3">
          <h1 class="pt-4">EDICIONES <br>EL PROFESIONAL LTDA.</h1>
          <address class="text-secondary">
            <i class="fa fa-phone"></i> 281 09 31 -  FAX: 243 07 39<br>
            <i class="fa fa-map-marker"></i> AVENIDA JIMENEZ No 12-42 OF. 602, Bogotá, Colombia
          </address>
          <p class="text-secondary">
            Estamos trabajando para brindarte la mejor experiencia y poner a tu disposicion el catalogo de mejor calidad de libros especializados, técnicos y científicos disponibles en el país.
          </p>
          <p class="text-secondary">
            Siguenos en <a href="https://www.facebook.com/edicioneselProfesionalLtda" target="_blank" title="Sigunos en facebook">facebook <i class="fab fa-facebook-f"></i></a> y si estas interesado en conocer nuestro catálogo, escríbenos.
          </p>

          @include('partials.errors')
          @include('flash::message')

          <form method="POST" action="{{ route('contact') }}">
            @csrf
            <input type="hidden" name="subject" value="Proximamente">
            <div class="form-group">
              <label for="name">¿Cómo te llamas?</label>
              <input type="text" name="name" id="name" class="form-control" placeholder="Nombre completo" required>
            </div>
            <div class="form-group">
              <label for="email">¿Cúal es tu email?</label>
              <input type="email" name="email" id="email" class="form-control" placeholder="Correo electrónico" required>
            </div>
            <div class="form-group">
              <label for="content">Mensaje</label>
              <textarea name="content" id="content" class="form-control" placeholder="Nombre completo" required></textarea>
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-success"><i class="fa fa-paper-plane"></i> Envianos tu mensaje</button>
            </div>
          </form>
          <p class="text-secondary mt-5">
            &copy; 2018 por Ediciones El Profesional LTDA. <br>
            Desarrollado por <a href="//droni.co" title="Desarrollo Inteligente">Droni.co</a>
          </p>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
