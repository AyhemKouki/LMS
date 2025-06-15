
@extends('users.admin.layout.layout')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2><i class="bi bi-person-check"></i> Instructor Requests</h2>
            <div class="badge bg-info">{{ $requests->total() }} total request(s)</div>
        </div>

        <div class="card">
            <div class="card-body">
                @if($requests->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>User</th>
                                <th>Email</th>
                                <th>Request Date</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($requests as $request)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-sm bg-light rounded-circle d-flex align-items-center justify-content-center me-2">
                                                <i class="bi bi-person"></i>
                                            </div>
                                            {{ $request->user->name }}
                                        </div>
                                    </td>
                                    <td>{{ $request->user->email }}</td>
                                    <td>{{ $request->created_at->format('d/m/Y H:i') }}</td>
                                    <td>
                                        <span class="badge bg-{{ $request->status_color }}">
                                            {{ ucfirst($request->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.instructor-requests.show', $request) }}"
                                           class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-eye"></i> View
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{ $requests->links() }}
                @else
                    <div class="text-center py-5">
                        <i class="bi bi-inbox display-1 text-muted"></i>
                        <p class="text-center text-muted mt-2">No instructor requests found.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
