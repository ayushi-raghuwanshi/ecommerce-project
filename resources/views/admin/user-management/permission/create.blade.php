@extends('admin.layouts.main')
@section('content')
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">permission/</span>
                @if (!empty($permission->id))
                    Update Permission
                @else
                    Add Permission
                @endif
            </h4>
            <div class="row">
                <div class="col-xl">
                    <div class="card mb-4">
                        <div class="card-body">
                            <form id="permission-form" role="form" action="{{ route('admin.permission.store') }}"
                                method="post">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label" for="name">Name</label>
                                    <input type="text" name="name"
                                        class="form-control @error('name') is-invalid @enderror" id="name"
                                        placeholder="Enter Permission" required=""
                                        value="{{ old('name', @$permission?->name ?? '') }}" autocomplete="off">
                                    @if ($errors->has('name'))
                                        <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="status">Status</label>
                                    <select class="form-select @error('status') is-invalid @enderror" id="status"
                                        name="status" required="">
                                        <option value="">Select Status</option>
                                        <option value="Active" @selected(@$permission?->status == 'Active')>Active</option>
                                        <option value="Inactive" @selected(@$permission?->status == 'Inactive')>Inactive</option>
                                    </select>
                                    @if ($errors->has('status'))
                                        <div class="invalid-feedback">{{ $errors->first('status') }}</div>
                                    @endif
                                </div>
                                <input type="hidden" name="id" value="{{ @$permission?->id ?? '' }}">
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
                errorElement: 'div',
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                    $(element).next("div").addClass("feedback-invalid");
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-valid').removeClass('is-invalid');
                    $(element).parents("div").addClass("feedback-valid")
                        .removeClass("feedback-invalid");
                },
                rules: {
                    name: "required",
                    status: "required",
                },
                messages: {
                    name: "Please enter permission name",
                    status: "Please select the permission status",
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
        });
    </script>
@endsection
