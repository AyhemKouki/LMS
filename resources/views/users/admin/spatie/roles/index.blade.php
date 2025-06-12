@extends('users.admin.layout.layout')

@section('title' , 'Roles')

@section('content')
    <div class="container py-4">
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div
                        class="card-header bg-primary bg-gradient text-white d-flex justify-content-between align-items-center">
                        <h4 class="card-title mb-0">Roles</h4>
                        <a href="{{ route('admin.role.create') }}" class="btn btn-light">Create New Role</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Permissions</th>
                                    <th>Created At</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($roles as $role)
                                    <tr>
                                        <td>{{ $role->id }}</td>
                                        <td>{{ $role->name }}</td>
                                        <td>
                                            <span class="badge text-bg-success">{{ $role->permissions->pluck('name')->implode(', ') }}</span>
                                        </td>
                                        <td>{{ $role->created_at->format('Y-m-d H:i') }}</td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                <a href="{{ route('admin.role.edit', $role) }}"
                                                   class="btn btn-sm btn-outline-warning">
                                                    <i class="fas fa-edit"></i> Edit
                                                </a>
                                                <a href="{{ route('admin.rolePermission', $role->id) }}"
                                                   class="btn btn-sm btn-outline-info">
                                                    <i class="fas fa-edit"></i> manage permissions
                                                </a>
                                                <form action="{{ route('admin.role.destroy', $role) }}"
                                                      method="POST"
                                                      class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                            class="btn btn-sm btn-outline-danger"
                                                            onclick="return confirm('Are you sure you want to delete this permission?')">
                                                        <i class="fas fa-trash"></i> Delete
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

