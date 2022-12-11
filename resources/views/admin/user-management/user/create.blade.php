@extends('admin.layouts.main')
@section('content')
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">User/</span>
                @if (!empty($user->id))
                    Update User
                @else
                    Add User
                @endif
            </h4>
            <div class="row">
                <div class="col-xl">
                    <div class="card mb-4">
                        <div class="card-body">
                            <form id="permission-form" role="form" action="{{ route('admin.user.store') }}" method="post">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label" for="name">Name</label>
                                    <input type="text" name="name"
                                        class="form-control @error('name') is-invalid @enderror" id="name"
                                        placeholder="Enter Name" required=""
                                        value="{{ old('name', @$user?->name ?? '') }}" autocomplete="off">
                                    @if ($errors->has('name'))
                                        <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="email">Email</label>
                                    <input type="email" name="email"
                                        class="form-control @error('email') is-invalid @enderror" id="email"
                                        placeholder="Enter Email" required=""
                                        value="{{ old('email', @$user?->email ?? '') }}" autocomplete="off">
                                    @if ($errors->has('email'))
                                        <div class="invalid-feedback">{{ $errors->first('email') }}</div>
                                    @endif
                                </div>
                                @if(empty($user?->password))
                                <div class="mb-3">
                                    <label class="form-label" for="password">Password</label>
                                    <input type="password" name="password"
                                        class="form-control @error('password') is-invalid @enderror" id="password"
                                        placeholder="Enter password" required=""
                                        value="{{ old('password', @$user?->password ?? '') }}" autocomplete="off">
                                    @if ($errors->has('password'))
                                        <div class="invalid-feedback">{{ $errors->first('password') }}</div>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="password_confirmation">Confirm Password</label>
                                    <input type="password" name="password_confirmation"
                                        class="form-control @error('password_confirmation') is-invalid @enderror"
                                        id="password_confirmation" placeholder="Enter password" required=""
                                        value="{{ old('password_confirmation', @$user?->password_confirmation ?? '') }}"
                                        autocomplete="off">
                                    @if ($errors->has('password_confirmation'))
                                        <div class="invalid-feedback">{{ $errors->first('password_confirmation') }}</div>
                                    @endif
                                </div>
                                @endif
                                <div class="mb-3">
                                    <label class="form-label" for="status">Status</label>
                                    <select class="form-select @error('status') is-invalid @enderror" id="status"
                                        name="status" required="">
                                        <option value="">Select Status</option>
                                        <option value="Active" @selected(@$user?->status == 'Active')>Active</option>
                                        <option value="Inactive" @selected(@$user?->status == 'Inactive')>Inactive</option>
                                    </select>
                                    @if ($errors->has('status'))
                                        <div class="invalid-feedback">{{ $errors->first('status') }}</div>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="role_id">Role</label>
                                    <select
                                        class="form-select select2 form-select form-select-lg"
                                        id="role_id"  name="role_id" required="">
                                        <option value="">Select Role</option>
                                        @foreach ($roles ?? [] as $key => $value)
                                            <option value="{{ $value->id }}" @selected(@$user?->role_id == $value->id)>
                                                {{ $value->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <input type="hidden" name="id" value="{{ @$user?->id ?? '' }}">
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
        $(document).ready(function() {
            $('.select2').select2();
        });
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
                    email: {
                        required: true,
                        email: true
                    },
                    password: {
                        minlength: 6,
                    },
                    password_confirmation: {
                        minlength: 6,
                        equalTo: "#password"
                    }
                },
                messages: {
                    name: "Please enter name",
                    email: "Please enter email",
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
        });
    </script>
@endsection
