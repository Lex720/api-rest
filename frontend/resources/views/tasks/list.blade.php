@extends('_layout')

@section('content')

<!-- Main jumbotron for a primary marketing message or call to action -->
<div class="container text-center" style="margin-top:40px; margin-bottom:40px;">
  <h2>Tasks</h2>
</div>

<div class="container">

<div class="row">
  @include('errors/success')
</div>

<div class="row">
  <p align="left"><a href="{{url('tasks/create')}}"><b>Create new task</b></a></p>
  <br>
</div>
  
  <table class="table">
    <thead>
      <tr>
        <th>ID</th>
        <th>Assigned to</th>
        <th>Priority</th>
        <th>Title</th>
        <th>Description</th>
        <th>Due date</th>
        <th class="text-center">Action</th>
        <th class="text-center">Delete</th>
      </tr>
    </thead>
    <tbody>
    @if (count($tasks) > 0)
      @foreach ($tasks as $task)
        <tr>
          <td>{{ $task->id }}</td>
          <td>{{ $task->user->user }}</td>
          <td>{{ $task->priority->name }}</td>
          <td>{{ $task->title }}</td>
          <td>{{ $task->description }}</td>
          <td>{{ $task->due_date }}</td>
          <td class="text-center">
            <a href="{{url('tasks/'.$task->id)}}">Show</a>
            &nbsp;/&nbsp;
            <a href="{{url('tasks/'.$task->id.'/edit')}}">Edit</a>
          </td>
          <td class="text-center"> 
            <form method="POST" action="{{url('/tasks/'.$task->id)}}">
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