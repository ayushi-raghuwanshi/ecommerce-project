@extends('admin.layouts.main')
@section('content')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
                <div class="col-md-6">
                    <h4 class="fw-bold py-3 mb-4">Role List</h4>
                </div>
                <div class="col-md-6 d-flex justify-content-end">
                    <a href="{{ route('admin.role.create') }}" class="btn rounded-pill btn-primary mt-3 mb-4">
                        <span class="tf-icons bx bx-plus"></span>&nbsp; Add Role
                    </a>
                </div>
            </div>
            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-dismissible" role="alert">
                    {{ $message }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <!-- Basic Bootstrap Table -->
            <div class="card">
                <div class="table-responsive text-nowrap">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Role</th>
                                <th>Slug</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach ($roles as $key => $role)
                                <tr>
                                    <td><i class="fab fa-angular fa-lg text-danger me-3"></i>
                                        <strong>{{ $role->name }}</strong></td>
                                    <td>{{ $role->slug }}</td>
                                    <td>
                                        @if ($role->status == 'Active')
                                            <span class="badge bg-label-success me-1">Active</span>
                                        @else
                                            <span class="badge bg-label-danger me-1">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="demo-inline-spacing">
                                            <a href="{{ route('admin.role.edit', [$role->id]) }}"
                                                class="btn rounded-pill btn-icon btn-info">
                                                <span class="tf-icons bx bx-edit-alt"></span>
                                            </a>
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#deletepermissionModal"
                                                class="btn rounded-pill btn-icon btn-danger">
                                                <span class="tf-icons bx bx-trash"></span>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <div class="modal fade" id="deletepermissionModal" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel1">Delete Permission</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col mb-3">
                                                        <p>Do you want to Delete Permission?</p>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-outline-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <a href="{{ route('admin.role.destroy', [$role->id]) }}"
                                                        class="btn btn-primary">Delete</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- Basic Pagination -->
                <div class="demo-inline-spacing d-flex justify-content-end">
                    <nav aria-label="Page navigation">
                        <ul class="pagination">
                            {{ $roles->links() }}
                        </ul>
                    </nav>
                </div>
                <!--/ Basic Pagination -->
            </div>
            <!--/ Basic Bootstrap Table -->
        </div>
    </div>
@endsection
