@extends('_layout')

@section('content')

<!-- Main jumbotron for a primary marketing message or call to action -->
<div class="container text-center" style="margin-top:40px; margin-bottom:40px;">
  <h2>Hello, world!</h2>
  <p>This is the front end part of a RESTful API built with Laravel 5</p>
</div>

<div class="container">
@include('errors/success')
  
  <table class="table">
    <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th class="text-center">Action</th>
        <th class="text-center">Delete</th>
      </tr>
    </thead>
    <tbody>
    @if (count($users) > 0)
      @foreach ($users as $user)
        <tr>
          <td>{{ $user->id }}</td>
          <td>{{ $user->name }}</td>
          <td>{{ $user->email }}</td>
          <td class="text-center">
            <a href="{{url('user/'.$user->id)}}">Show</a>
            &nbsp;/&nbsp;
            <a href="{{url('user/'.$user->id.'/edit')}}">Edit</a>
          </td>
          <td class="text-center"> 
            <form method="POST" action="{{url('/user/'.$user->id)}}">
              <input name="_method" type="hidden" value="DELETE">
              <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
              <button type="submit" class="btn btn-default btn-xs">
                <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
              </button>
            </form>
          </td>
        </tr>
      @endforeach
    @else
      <tr>
        <td colspan="5">There is no records</td>
      </tr>
    @endif
    </tbody>
  </table>

</div> <!-- /container -->

@endsection