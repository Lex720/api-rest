@if(Session::has('success'))
  <div class="col-md-4 col-md-offset-4 text-center">
      <div class="alert alert-success">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <p><strong>{{ Session::get('success', '') }}</strong></p>
      </div>
  </div>
@endif
