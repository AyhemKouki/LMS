@extends('users.admin.layout.layout')

@section('title' , 'Create Permission')

@section('content')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary bg-gradient text-white">
                        <h4 class="card-title mb-0">Create New Permission</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.permission.store') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Permission Name</label>
                                <input type="text"
                                       class="form-control @error('name') is-invalid @enderror"
                                       id="name"
                                       name="name"
                                       value="{{ old('name') }}"
                                       required
                                       autofocus>
                                @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">
                                    Create Permission
                                </button>
                                <a href="{{ route('admin.permission.index') }}" class="btn btn-outline-secondary">
                                    Cancel
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
