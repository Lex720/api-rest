@extends('_layout')

@section('content')

@include('errors/validations')

<div class="container">

  <h2 align="center" style="margin:40px 0;">Create task</h2>
  
  <form method="POST" action="{{url('/tasks')}}">

    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

    <div class="form-group">
      <label for="id_user">Assigned to</label>
      <select name="id_user" class="form-control">
        @foreach($users as $user)
          <option value="{{$user->id}}">{{$user->firstname}}</option>
        @endforeach
      </select>
    </div>

    <div class="form-group">
      <label for="id_priority">Priority</label>
      <select name="id_priority" class="form-control">
        @foreach($priorities as $priority)
          <option value="{{$priority->id}}">{{$priority->name}}</option>
        @endforeach
      </select>
    </div>

    <div class="form-group">
      <label for="title">Title</label>
      <input name="title" type="text" class="form-control" id="title" placeholder="Title">
    </div>

    <div class="form-group">
      <label for="description">Description</label>
      <input name="description" type="text" class="form-control" id="description" placeholder="Description">
    </div>

    <div class="form-group">
      <label for="due_date">Due date</label>
      <input name="due_date" type="due_date" class="form-control" id="due_date" placeholder="Due date">
    </div>

    <button type="submit" class="btn btn-default">Submit</button>

  </form>

  <p align="right"><a href="{{url('tasks')}}">Back</a></p>

</div> <!-- /container -->

@endsection