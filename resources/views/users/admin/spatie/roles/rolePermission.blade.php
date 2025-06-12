@extends('users.admin.layout.layout')

@section('title', 'Role Permissions')

@section('content')
    <div class="container py-4">
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary bg-gradient text-white">
                        <h4 class="card-title mb-0">Manage Permissions for {{ $role->name }} role</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.manageRolePermission', $role) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label class="form-label">Permissions</label>
                                <div class="row g-3">
                                    @foreach($permissions as $permission)
                                        <div class="col-md-4">
                                            <div class="form-check">
                                                <input type="checkbox"
                                                       class="form-check-input"
                                                       name="permissions[]"
                                                       @checked(in_array($permission->id , $checkedPermissions))
                                                       value="{{ $permission->name }}"
                                                       id="rolePermission{{ $loop->index}}">
                                                <label class="form-check-label" for="rolePermission{{ $loop->index }}">
                                                    {{ $permission->name }}
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Update Permissions</button>
                            <a href="{{ route('admin.role.index') }}" class="btn btn-secondary">Back</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
