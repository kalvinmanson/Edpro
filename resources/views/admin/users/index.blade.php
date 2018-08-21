@extends('layouts.admin')

@section('content')
<div class="container-fluid">
  <h1>Users</h1>
  <table class="table table-striped">
    <tr>
      <th width="20">Id</th>
      <th>Name</th>
      <th>Info</th>
      <th>Role</th>
      <th>Avatar</th>
      <th>Timestamps</th>
    </tr>
    @foreach($users as $user)
    <tr>
      <td>{{ $user->id }}</td>
      <td>
        <a href="{{ route('admin.users.edit', $user->id) }}"><strong>{{ $user->name }}</strong></a><br>
        <small>{{ $user->email }}</small>
      </td>
      <td>
        Location: {{ $user->city }}, {{ $user->address }}<br>
        Phone:  {{ $user->phone }}
      </td>
      <td>{{ $user->role }}</td>
      <td><a href="{{ $user->avatar }}" data-fancybox="gallery">{{ $user->avatar }}</a></td>
      <td>
        <small>
          Created at {{ $user->created_at }},<br>
          Last update {{ $user->updated_at->diffForHumans() }}
        </small>
      </td>
    </tr>
    @endforeach
  </table>

  {{ $users->links() }}
</div>
@endsection
