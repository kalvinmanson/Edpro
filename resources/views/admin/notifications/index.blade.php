@extends('layouts.admin')

@section('content')
<div class="container-fluid">
  <a href="{{ route('admin.notifications.create') }}" class="btn btn-warning float-right"><i class="fa fa-trash"></i> Clean notifications</a>
  <h1>Notifications</h1>
  <table class="table table-striped">
    <tr>
      <th width="20">Id</th>
      <th>User</th>
      <th>Action</th>
      <th>Data</th>
      <th>Timestamps</th>
    </tr>
    @foreach($notifications as $notification)
    <tr>
      <td>{{ $notification->id }}</td>
      <td>
        {{ $notification->user->name }}<br>
        <small>{{ $notification->user->email }}</small>
      </td>
      <td>
        {{ $notification->name }}
      </td>
      <td>
        {{ $notification->location }}<br>
        {{ $notification->data }}
      </td>
      <td>
        <small>
          Created at {{ $notification->created_at }},<br>
          Last update {{ $notification->updated_at->diffForHumans() }}
        </small>
      </td>
    </tr>
    @endforeach
  </table>

  {{ $notifications->links() }}
</div>
@endsection
