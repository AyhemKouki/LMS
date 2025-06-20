@extends('users.admin.dashboard.userManagement')
@section('userloop')
    @foreach($users as $user)
        <tr>
            <td>
                <div class="user-info">
                    @if($user->profile_image == "/images/avatar.jpg")
                        <img src="{{ asset($user->profile_image) }}"
                             class="user-avatar"
                             alt="image">
                    @else
                        <img src="{{ asset('storage/' . $user->profile_image) }}"
                             class="user-avatar"
                             alt="image">
                    @endif

                    <div>
                        <div class="user-name">{{ $user->name }}</div>
                        <div class="user-role">{{ $user->role }}</div>
                    </div>
                </div>
            </td>
            <td>{{ $user->email }}</td>


            <td>{{ $user->created_at }}</td>
            <td>
                <div class="action-buttons">

                    <form action="{{ route('admin.student.destroy', $user->id) }}" method="POST"
                          class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="action-btn delete" title="Delete"
                                onclick="return confirm('Are you sure you want to delete {{ $user->name }}?')">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </div>
            </td>
        </tr>
    @endforeach

@endsection
