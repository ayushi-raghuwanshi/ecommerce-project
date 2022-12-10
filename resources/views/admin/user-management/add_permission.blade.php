@extends('admin.layouts.main')
@section('custom-css')
<style>
label.error { 
  float: none; color: red; 
}
 </style>​
@endsection
@section('content')
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">permission/</span>
        @if(!empty($permission->id))
          Update Permission
        @else
          Add Permission
        @endif
      </h4>
      <div class="row">
        <div class="col-xl">
            <div class="card mb-4">
              <div class="card-body">
                <form id="permission-form" action="{{route('store-permission')}}" method="post">
                  @csrf
                  <div class="mb-3">
                    <label class="form-label" for="basic-icon-default-fullname">Name</label>
                    <div class="input-group input-group-merge">
                      <span id="basic-icon-default-fullname2" class="input-group-text"
                        ><i class="bx bx-user"></i
                      ></span>
                      <input type="text" class="form-control" id="name" placeholder="Enter permission" aria-label="Enter permission"
                        aria-describedby="basic-icon-default-fullname2" name="name" value="{{old('name', @$permission->name)}}"/>
                      @if ($errors->has('name'))
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                      @endif
                    </div>
                  </div>
                  <div class="mb-3">
                    <label class="form-label" for="basic-icon-default-email">Status</label>
                    <select id="status" class="form-select" name="status">
                      <option value="">----Select Status----</option>
                      <option value="Active" {{ @$permission->status == 'Active' ? 'selected' : '' }}>Active</option>
                      <option value="Inactive" {{ @$permission->status == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                    @if ($errors->has('staus'))
                      <span class="text-danger">{{ $errors->first('status') }}</span>
                    @endif
                  </div>
                  <input type="hidden" name="id" value="{{@$permission->id}}">
                  <input type="submit" class="btn btn-primary" id="submit" value="Submit">
                </form>
              </div>
            </div>
          </div>
      </div>
    </div>
</div>
@endsection
@section('customscripts')
<script>
  $(function() {
    $("#permission-form").validate({
      errorElement:'div',
      rules: {
        name: "required",
        status: "required",
      },
      messages: {
        name: " Please enter name",
        status: " Please select status",
      },
    });
    if($("#permission-form").valid()){
      $('#submit').submit();
    }
  });
</script>
@endsection
