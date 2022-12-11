@extends('admin.layouts.main')
@section('content')
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Role/</span>
                @if (!empty($role->id))
                    Update Role
                @else
                    Add Role
                @endif
            </h4>
            <div class="row">
                <div class="col-xl">
                    <div class="card mb-4">
                        <div class="card-body">
                            <form id="role-form" role="form" action="{{ route('admin.role.store') }}" method="post">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label" for="name">Name</label>
                                    <input type="text" name="name"
                                        class="form-control @error('name') is-invalid @enderror" id="name"
                                        placeholder="Enter Permission" required=""
                                        value="{{ old('name', @$role?->name ?? '') }}" autocomplete="off">
                                    @error('name')
                                        <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="status">Status</label>
                                    <select class="form-select @error('status') is-invalid @enderror" id="status"
                                        name="status" required="">
                                        <option value="">Select Status</option>
                                        <option value="Active" @selected(@$role?->status == 'Active')>Active</option>
                                        <option value="Inactive" @selected(@$role?->status == 'Inactive')>Inactive</option>
                                    </select>
                                    @if ($errors->has('status'))
                                        <div class="invalid-feedback">{{ $errors->first('status') }}</div>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <h4>Permissions</h4>
                                    <!-- Permission table -->
                                    <div class="table-responsive">
                                        <table class="table table-flush-spacing">
                                            <thead>
                                                <tr>
                                                    <td>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" id="selectAll" @if(isset($role)) @checked($role?->permissions->count() == $permissions->count()) @endif>
                                                            <label class="form-check-label" for="selectAll">
                                                                Select All
                                                            </label>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr class="d-flex justify-content-start align-items-center flex-wrap">
                                                    @foreach ($permissions ?? [] as $permission)
                                                        <td width="25%" style="padding-left:0">
                                                            <div class="d-flex">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        name="permissions[]"
                                                                        id="permission_{{ $permission->id }}"
                                                                        value="{{ $permission->id }}"
                                                                        @if(isset($role))  @checked($role?->permissions->contains($permission->id)) @endif>
                                                                    <label class="form-check-label"
                                                                        for="permission_{{ $permission->id }}">
                                                                        {{ $permission->name }}
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    @endforeach

                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- Permission table -->
                                </div>
                                <div class="mb-3">
                                    <input type="hidden" name="id" value="{{ @$role?->id ?? '' }}">
                                    <input type="submit" class="btn btn-primary" id="submit" value="Submit">
                                </div>
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
            $("#role-form").validate({
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
                    name: "Please enter role name",
                    status: "Please select the role status",
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
        });
        document.addEventListener("DOMContentLoaded", function(e) {
            {
                const t = document.querySelector("#selectAll"),
                    o = document.querySelectorAll('[type="checkbox"]');
                t.addEventListener("change", t => {
                    o.forEach(e => {
                        e.checked = t.target.checked
                    })
                })
            }
        });
    </script>
@endsection
