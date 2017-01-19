@extends('_layout')

@section('content')

@include('errors/validations')

<div class="container">

  <h2 align="center" style="margin:40px 0;">Edit priority #{{ $id }}</h2>
  
  <form method="POST" action="{{url('/priorities/'.$id)}}">

    <input name="_method" type="hidden" value="PUT">
    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

    @if (count($priority) > 0)
      <div class="form-group">
        <label for="name">Name</label>
        <input name="name" type="text" class="form-control" id="name" placeholder="First Name" value="{{ $priority->name }}">
      </div>
    @else
    @endif

    <button type="submit" class="btn btn-default">Submit</button>

  </form>

  <p align="right"><a href="{{url('priorities')}}">Back</a></p>

</div> <!-- /container -->

@endsection