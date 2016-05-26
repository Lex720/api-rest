@if(Session::has('alert'))
<div style="margin:30px 0;">
 <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 col-lg-offset-2 col-md-offset-2">
  <div class="alert alert-warning">
   {{Session::get('alert')}}
  </div>
 </div>
</div>
@endif

@if(count($errors)>0)
 <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 col-lg-offset-2 col-md-offset-2">
  <div class="alert alert-danger">
   The next errors has appeared:
   <ul>
    @foreach($errors->all() as $error)
     <li>{{$error}}</li>
    @endforeach
   </ul>
  </div>
 </div>
@endif
