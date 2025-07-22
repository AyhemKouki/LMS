@extends('users.admin.layout.layout')

@section('title' , 'Roles')

@section('content')
    <div class="container py-4">
        <div class="row">
            <div class="col-12">
                <div class="card shadow">
                    <div
                        class="card-header bg-white border-bottom d-flex justify-content-between align-items-center p-4">
                        <div>
                            <h4 class="card-title text-primary mb-1">Roles Management</h4>
                            <p class="text-muted small mb-0">Manage and organize user roles</p>
                        </div>
                        <a href="{{ route('admin.role.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus-circle me-2"></i>Create New Role
                        </a>
                    </div>
                    <div class="card-body p-4">

                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Permissions</th>
                                    <th>Created At</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody id="rolesTableBody">
                                @foreach($roles as $role)
                                    <tr>
                                        <td>{{ $role->id }}</td>
                                        <td>{{ $role->name }}</td>
                                        <td>
                                            @foreach($role->permissions as $permission)
                                                <span
                                                    class="badge bg-light text-dark border me-1 mb-1">{{ $permission->name }}</span>
                                            @endforeach
                                        </td>
                                        <td>{{ $role->created_at->format('Y-m-d H:i') }}</td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                <a href="{{ route('admin.role.edit', $role) }}"
                                                   class="btn btn-sm btn-primary">
                                                    <i class="fas fa-edit me-1"></i> Edit
                                                </a>
                                                <a href="{{ route('admin.rolePermission', $role->id) }}"
                                                   class="btn btn-sm btn-info text-white">
                                                    <i class="fas fa-key me-1"></i> Permissions
                                                </a>
                                                <form action="{{ route('admin.role.destroy', $role) }}"
                                                      method="POST"
                                                      class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                            class="btn btn-sm btn-danger"
                                                            onclick="return confirm('Are you sure you want to delete this role?')">
                                                        <i class="fas fa-trash me-1"></i> Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

