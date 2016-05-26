@extends('_layout')

@section('content')

@include('errors/validations')

<div class="container">

  <h2 align="center" style="margin:40px 0;">Create user</h2>
  
  <form method="POST" action="{{url('/user')}}">

    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

    <div class="form-group">
      <label for="name">Name</label>
      <input name="name" type="text" class="form-control" id="name" placeholder="Name">
    </div>

    <div class="form-group">
      <label for="email">Email</label>
      <input name="email" type="email" class="form-control" id="email" placeholder="Email">
    </div>

    <div class="form-group">
      <label for="password">Password</label>
      <input name="password" type="password" class="form-control" id="password" placeholder="Password">
    </div>

    <button type="submit" class="btn btn-default">Submit</button>

  </form>

  <p align="center"><a href="{{url('user')}}">Back</a></p>

</div> <!-- /container -->

@endsection