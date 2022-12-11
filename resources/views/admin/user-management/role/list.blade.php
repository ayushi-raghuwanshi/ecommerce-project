@extends('admin.layouts.main')
@section('content')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-2">Roles List</h4>
            @if ($message = Session::get('success'))
            <div class="alert alert-success alert-dismissible" role="alert">
                {{ $message }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            <p>A role provided access to predefined menus and features so that depending on <br> assigned role an
                administrator can have access to what user needs.</p>
            <!-- Role cards -->
            <div class="row g-4">
                @foreach ($roles ?? [] as $role)
                    <div class="col-xl-4 col-lg-6 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between mb-2">
                                    <h6 class="fw-normal">Total {{ $role?->users_count }} users</h6>
                                    <ul class="list-unstyled d-flex align-items-center avatar-group mb-0">
                                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                            class="avatar avatar-sm pull-up" aria-label="Vinnie Mostowy">
                                            <img class="rounded-circle" src="https://ui-avatars.com/api/?name=Test+user"
                                                alt="Avatar">
                                        </li>
                                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                            class="avatar avatar-sm pull-up" aria-label="Vinnie Mostowy">
                                            <img class="rounded-circle" src="https://ui-avatars.com/api/?name=Demo+user"
                                                alt="Avatar">
                                        </li>
                                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                            class="avatar avatar-sm pull-up" aria-label="Vinnie Mostowy">
                                            <img class="rounded-circle" src="https://ui-avatars.com/api/?name=Ayushi+user"
                                                alt="Avatar">
                                        </li>
                                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                            class="avatar avatar-sm pull-up" aria-label="Vinnie Mostowy">
                                            <img class="rounded-circle" src="https://ui-avatars.com/api/?name=Ayushi+user"
                                                alt="Avatar">
                                        </li>
                                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                            class="avatar avatar-sm pull-up" aria-label="Vinnie Mostowy">
                                            <img class="rounded-circle" src="https://ui-avatars.com/api/?name=Ayushi+user"
                                                alt="Avatar">
                                        </li>
                                        
                                    </ul>
                                   
                                </div>
                                <div class="role-heading">
                                    <h4 class="mb-1">{{ $role->name }}</h4>
                                </div>
                                <div class="d-flex justify-content-between align-items-end">
                                    <div class="demo-inline-spacing">
                                        <a href="{{ route('admin.role.edit',$role->id) }}"
                                            class="btn rounded-pill btn-icon btn-info">
                                            <span class="tf-icons bx bx-edit-alt"></span>
                                        </a>
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#deletepermissionModal"
                                            class="btn rounded-pill btn-icon btn-danger">
                                            <span class="tf-icons bx bx-trash"></span>
                                        </a>
                                    </div>
                                </div>
                                <div class="modal fade" id="deletepermissionModal" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel1">Delete Role</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col mb-3">
                                                        <p>Do you want to Delete Role?</p>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-outline-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <a href="{{ route('admin.role.destroy',$role->id) }}"
                                                        class="btn btn-primary">Delete</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="col-xl-4 col-lg-6 col-md-6">
                    <div class="card h-100">
                        <div class="row h-100">
                            <div class="col-sm-5">
                                <div class="d-flex align-items-end h-100 justify-content-center mt-sm-0 mt-3">
                                    <img src="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/assets/img/illustrations/sitting-girl-with-laptop-light.png"
                                        class="img-fluid" alt="Image" width="120"
                                        data-app-light-img="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/assets/img/illustrations/sitting-girl-with-laptop-light.png"
                                        data-app-dark-img="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/assets/img/illustrations/sitting-girl-with-laptop-light.png">
                                </div>
                            </div>
                            <div class="col-sm-7">
                                <div class="card-body text-sm-end text-center ps-sm-0">
                                    <a href="{{ route('admin.role.create') }}"
                                        class="btn btn-primary mb-3 text-nowrap add-new-role">Add New Role</a>
                                    <p class="mb-0">Add role, if it does not exist</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!--/ Role cards -->
        </div>
    </div>
@endsection
