@if(session()->has('alert'))
  <div class="alert alert-success alert-dismissable fade show">
    {{session()->get('alert')}}
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
  </div>
  @endif
