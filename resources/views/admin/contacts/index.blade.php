@extends('layouts.admin')

@section('content')
<div class="container-fluid">
  <h1>Contacts</h1>
  <table class="table table-striped">
    <tr>
      <th width="20">Id</th>
      <th>User</th>
      <th>contact Info</th>
      <th>Message</th>
      <th>Timestamps</th>
    </tr>
    @foreach($contacts as $contact)
    <tr>
      <td>{{ $contact->id }}</td>
      <td>
        <strong>{{ $contact->name }}</strong><br>
        Document: {{ $contact->document }}<br>
        Birthdate: {{ $contact->birthdate }}
      </td>
      <td>
        Location: {{ $contact->country }}, {{ $contact->address }}<br>
        Email: {{ $contact->email }}<br>
        Phone: {{ $contact->phone }}
      </td>
      <td>
        <a href="#info{{ $contact->id }}" data-fancybox="gallery">{{ $contact->subject }}</a><br>
        Referer: {{ $contact->referer }}
        <div id="info{{ $contact->id }}" style="display: none;">
          {!! $contact->content !!}
        </div>
      </td>
      <td>
        <small>
          Created at {{ $contact->created_at }},<br>
          Last update {{ $contact->updated_at->diffForHumans() }}
        </small>
      </td>
    </tr>
    @endforeach
  </table>
  {{ $contacts->links() }}
</div>
@endsection
