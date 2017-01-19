@extends('_layout')

@section('content')

<!-- Main jumbotron for a primary marketing message or call to action -->
<div class="container text-center" style="margin-top:40px; margin-bottom:40px;">
  <h2>Priorities</h2>
</div>

<div class="container">

<div class="row">
  @include('errors/success')
</div>

<div class="row">
  <p align="left"><a href="{{url('priorities/create')}}"><b>Create new priority</b></a></p>
  <br>
</div>
  
  <table class="table">
    <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th class="text-center">Action</th>
        <th class="text-center">Delete</th>
      </tr>
    </thead>
    <tbody>
    @if (count($priorities) > 0)
      @foreach ($priorities as $priority)
        <tr>
          <td>{{ $priority->id }}</td>
          <td>{{ $priority->name }}</td>
          <td class="text-center">
            <a href="{{url('priorities/'.$priority->id)}}">Show</a>
            &nbsp;/&nbsp;
            <a href="{{url('priorities/'.$priority->id.'/edit')}}">Edit</a>
          </td>
          <td class="text-center"> 
            <form method="POST" action="{{url('/priorities/'.$priority->id)}}">
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
        <td colspan="4">There is no records</td>
      </tr>
    @endif

    </tbody>
  </table>

</div> <!-- /container -->

@endsection