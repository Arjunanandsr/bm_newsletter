@extends('layouts.admin')

@section('pageTitle', 'Newsletter')

@section('content')
  <div class="row">
    @if( count($newsletter) > 0)
    
      <div class="col xs-12">
        <h3>Subscribers</h3>
      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th><input type="checkbox" id="selectall"></th>
              <th>Name</th>
              <th>Email</th>
              <th>Created At</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach($newsletter as $subscriber)
            <tr>
              <td><input type="checkbox" name="subscribers[]" class="subcheck" value="{{$subscriber->id}}" form="sendmailer"></td>
              <td>{{$subscriber->name}}</td>
              <td>{{$subscriber->email}}</td>
              <td>{{$subscriber->created_at}}</td>
              <td>
                <form class="deleteaction" action="{{ route('newsletter.destroy', $subscriber->id)}}" method="post">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-sm btn-danger" type="submit">Delete</button>
                </form>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
        @else
        <div class="alert alert-warning">
          No subscribers found.
        </div>
        @endif

      </div>
      <div class="col xs-12">
        <h3>Compose Mail</h3>
        <form class="" method="post" action="{{ route('sendnewsletter')}}" id="sendmailer">
          @csrf
          @method('POST')
          <div class="form-group">
            <label for="subject">Subject</label>
            <input type="text" class="form-control" id="subject" name="subject" aria-describedby="emailHelp" placeholder="subject" required>
          </div>
          <div class="form-group">
            <label for="content">Content</label>
            <textarea  class="form-control" name="content" id="content" required></textarea>
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div> 
  @endsection