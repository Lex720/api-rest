@extends('_layout')

@section('content')

@include('errors/validations')

<div class="container">

  <h2 align="center" style="margin:40px 0;">Edit user #{{ $id }}</h2>
  
  <form method="POST" action="{{url('/users/'.$id)}}">

    <input name="_method" type="hidden" value="PUT">
    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

    @if (count($user) > 0)
      <div class="form-group">
        <label for="firstname">First Name</label>
        <input name="firstname" type="text" class="form-control" id="firstname" placeholder="First Name" value="{{ $user->firstname }}">
      </div>
      <div class="form-group">
        <label for="lastname">Last Name</label>
        <input name="lastname" type="text" class="form-control" id="firstname" placeholder="Last Name" value="{{ $user->lastname }}">
      </div>
      <div class="form-group">
        <label for="email">Email</label>
        <input name="email" type="email" class="form-control" id="email" placeholder="Email" value="{{ $user->email }}">
      </div>
      <div class="form-group">
        <label for="role">Role</label>
        <select name="role" class="form-control">
          <option value="admin">Admin</option>
          <option value="user">User</option>
        </select>
      </div>
    @else
    @endif

    <button type="submit" class="btn btn-default">Submit</button>

  </form>

  <p align="right"><a href="{{url('users')}}">Back</a></p>

</div> <!-- /container -->

@endsection