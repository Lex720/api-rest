@extends('_layout')

@section('content')

<div class="container">

  <h2 align="center" style="margin:40px 0;">Showing user #{{ $user->id }}</h2>

  <table class="table">
  @if (count($user) > 0)
    <tr>
      <th>ID:</th>
      <td> {{ $user->id }} </td>
    </tr>
    <tr>
      <th>Name:</th>
      <td> {{ $user->name }} </td>
    </tr>
    <tr>
      <th>Email:</th>
      <td> {{ $user->email }} </td>
    </tr>
    <tr>
      <th>Action:</th>
      <td>
        <a href="{{url('user/'.$user->id.'/edit')}}">Edit</a>
      </td>
    </tr>
    <tr>
      <th>Delete:</th>
      <td>
        <form method="POST" action="{{url('/user/'.$user->id)}}">
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
      <td colspan="3">There is no records</td>
    </tr>
  @endif
  </table>

  <p align="center"><a href="{{url('user')}}">Back</a></p>

</div> <!-- /container -->

  

@endsection