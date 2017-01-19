@extends('_layout')

@section('content')

<div class="container">

  <h2 align="center" style="margin:40px 0;">Showing task #{{ $task->id }}</h2>

  <table class="table">
  @if (count($task) > 0)
    <tr>
      <th>ID:</th>
      <td> {{ $task->id }} </td>
    </tr>
    <tr>
      <th>Assigned to:</th>
      <td> {{ $task->user->user }} </td>
    </tr>
    <tr>
      <th>Priority:</th>
      <td> {{ $task->priority->name }} </td>
    </tr>
    <tr>
      <th>Title:</th>
      <td> {{ $task->title }} </td>
    </tr>
    <tr>
      <th>Description:</th>
      <td> {{ $task->description }} </td>
    </tr>
    <tr>
      <th>Due date:</th>
      <td> {{ $task->due_date }} </td>
    </tr>
    <tr>
      <th>Action:</th>
      <td>
        <a href="{{url('tasks/'.$task->id.'/edit')}}">Edit</a>
      </td>
    </tr>
    <tr>
      <th>Delete:</th>
      <td>
        <form method="POST" action="{{url('/tasks/'.$task->id)}}">
          <input name="_method" type="hidden" value="DELETE">
          <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
          <button type="submit" class="btn btn-default btn-xs">
            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
          </button>
        </form>
      </td>
    </tr>
  @else
    <tr>
      <td colspan="5">There is no records</td>
    </tr>
  @endif
  </table>

  <p align="right"><a href="{{url('tasks')}}">Back</a></p>

</div> <!-- /container -->

@endsection