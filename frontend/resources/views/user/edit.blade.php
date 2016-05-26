@extends('_layout')

@section('content')

@include('errors/validations')

<div class="container">

  <h2 align="center" style="margin:40px 0;">Edit user #{{ $id }}</h2>
  
  <form method="POST" action="{{url('/user/'.$id)}}">

    <input name="_method" type="hidden" value="PUT">
    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

    @if (count($user) > 0)
      <div class="form-group">
        <label for="name">Name</label>
        <input name="name" type="text" class="form-control" id="name" placeholder="Name" value="{{ $user->name }}">
      </div>
      <div class="form-group">
        <label for="email">Email</label>
        <input name="email" type="email" class="form-control" id="email" placeholder="Email" value="{{ $user->email }}">
      </div>
    @else
      <div class="form-group">
        <label for="name">Name</label>
        <input name="name" type="text" class="form-control" id="name" placeholder="Name" value="">
      </div>
      <div class="form-group">
        <label for="email">Email</label>
        <input name="email" type="email" class="form-control" id="email" placeholder="Email" value="">
      </div>
    @endif
      <div class="form-group">
        <label for="password">Password</label>
        <input name="password" type="password" class="form-control" id="password" placeholder="Password" value="">
      </div>

    <button type="submit" class="btn btn-default">Submit</button>

  </form>

  <p align="center"><a href="{{url('user')}}">Back</a></p>

</div> <!-- /container -->

@endsection