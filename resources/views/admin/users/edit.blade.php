@extends('layouts.admin')

@section('content')
<div class="container-fluid">
  <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="card">
    <input type="hidden" name="_method" value="PUT">
    @csrf
    <div class="card-header">Edit user: {{ $user->name }}</div>
    <div class="card-body">
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') ? old('name') : $user->name }}" required>
          </div>
          <div class="form-group">
            <label for="name">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email') ? old('email') : $user->email }}" readonly>
          </div>
          <div class="form-group">
            <label for="provider">Provider</label>
            <input type="text" name="provider" id="provider" class="form-control" value="{{ old('provider') ? old('provider') : $user->provider }}" readonly>
          </div>
          <div class="form-group">
            <label for="role">Role</label>
            <select name="role" id="role" class="form-control">
              <option value="User" {{ $user->role == 'User' ? 'selected' : '' }}>User</option>
              <option value="Admin" {{ $user->role == 'Admin' ? 'selected' : '' }}>Admin</option>
            </select>
          </div>
          <div class="form-group">
            <label for="gender">Gender</label>
            <select name="gender" id="gender" class="form-control">
              <option value="Male" {{ $user->gender == 'Male' ? 'selected' : '' }}>Male</option>
              <option value="Female" {{ $user->gender == 'Female' ? 'selected' : '' }}>Female</option>
            </select>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label for="avatar">Avatar</label>
            <upload-input name="avatar" value="{{ old('avatar') ? old('avatar') : $user->avatar }}"></upload-input>
          </div>
          <div class="form-group">
            <label for="city">City</label>
            <input type="text" name="city" id="city" class="form-control" value="{{ old('city') ? old('city') : $user->city }}">
          </div>
          <div class="form-group">
            <label for="address">Address</label>
            <input type="text" name="address" id="address" class="form-control" value="{{ old('address') ? old('address') : $user->address }}">
          </div>
          <div class="form-group">
            <label for="phone">Phone</label>
            <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone') ? old('phone') : $user->phone }}">
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

<form id="destroy-form" action="{{ route('admin.blocks.destroy', $user->id) }}" method="POST" style="display: none;">
  @csrf
  <input type="hidden" name="_method" value="DELETE" />
</form>
@endsection
