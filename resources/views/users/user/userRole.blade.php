@extends('users.admin.layout.layout')

@section('title', 'User Roles')

@section('content')
    <div class="container py-4">
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary bg-gradient text-white">
                        <h4 class="card-title mb-0">Manage Roles for {{ $user->name }} </h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.manageUserRole', $user) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label class="form-label">Roles</label>
                                <div class="row g-3">
                                    @foreach($roles as $role)
                                        <div class="col-md-4">
                                            <div class="form-check">
                                                <input type="checkbox"
                                                       class="form-check-input"
                                                       name="roles[]"
                                                       @checked(in_array($role->id , $checkedRoles))
                                                       value="{{ $role->name }}"
                                                       id="userRole{{ $loop->index}}">
                                                <label class="form-check-label" for="userRole{{ $loop->index }}">
                                                    {{ $role->name }}
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Update Roles</button>
                            <a href="{{ route('admin.user.list') }}" class="btn btn-secondary">Back</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
