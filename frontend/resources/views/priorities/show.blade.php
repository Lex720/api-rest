@extends('_layout')

@section('content')

<div class="container">

  <h2 align="center" style="margin:40px 0;">Showing priority #{{ $priority->id }}</h2>

  <table class="table">
  @if (count($priority) > 0)
    <tr>
      <th>ID:</th>
      <td> {{ $priority->id }} </td>
    </tr>
    <tr>
      <th>Name:</th>
      <td> {{ $priority->name }} </td>
    </tr>
    <tr>
      <th>Action:</th>
      <td>
        <a href="{{url('priorities/'.$priority->id.'/edit')}}">Edit</a>
      </td>
    </tr>
    <tr>
      <th>Delete:</th>
      <td>
        <form method="POST" action="{{url('/priorities/'.$priority->id)}}">
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

  <p align="right"><a href="{{url('priorities')}}">Back</a></p>

</div> <!-- /container -->

@endsection