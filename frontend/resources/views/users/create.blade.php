@extends('_layout')

@section('content')

@include('errors/validations')

<div class="container">

  <h2 align="center" style="margin:40px 0;">Create user</h2>
  
  <form method="POST" action="{{url('/users')}}">

    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

    <div class="form-group">
      <label for="firstname">First Name</label>
      <input name="firstname" type="text" class="form-control" id="firstname" placeholder="First Name">
    </div>

    <div class="form-group">
      <label for="lastname">Last Name</label>
      <input name="lastname" type="text" class="form-control" id="lastname" placeholder="Last Name">
    </div>

    <div class="form-group">
      <label for="email">Email</label>
      <input name="email" type="email" class="form-control" id="email" placeholder="Email">
    </div>

    <div class="form-group">
      <label for="role">Role</label>
      <select name="role" class="form-control">
        <option value="admin">Admin</option>
        <option value="user">User</option>
      </select>
    </div>

    <div class="form-group">
      <label for="user">User</label>
      <input name="user" type="text" class="form-control" id="user" placeholder="User">
    </div>

    <div class="form-group">
      <label for="password">Password</label>
      <input name="password" type="password" class="form-control" id="password" placeholder="Password">
    </div>

    <div class="form-group">
      <label for="password_confirmation">Repeat Password</label>
      <input name="password_confirmation" type="password" class="form-control" id="password_confirmation" placeholder="Repeat Password">
    </div>

    <button type="submit" class="btn btn-default">Submit</button>

  </form>

  <p align="right"><a href="{{url('users')}}">Back</a></p>

</div> <!-- /container -->

@endsection