@extends('users.admin.dashboard.userManagement')
@section('instructorloop')
    @foreach($instructors as $instructor)
        <tr>
            <td>
                <div class="user-info">
                    @if($instructor->profile_image == "/images/avatar.jpg")
                        <img src="{{ asset($instructor->profile_image) }}"
                             class="user-avatar"
                             alt="image">
                    @else
                        <img src="{{ asset('storage/' . $instructor->profile_image) }}"
                             class="user-avatar"
                             alt="image">
                    @endif

                    <div>
                        <div class="user-name">{{ $instructor->name }}</div>
                        <div class="user-role">{{ $instructor->role }}</div>
                    </div>
                </div>
            </td>
            <td>{{ $instructor->email }}</td>


            <td>{{ $instructor->created_at }}</td>
            <td>
                <div class="action-buttons">
                    <a href="#" class="action-btn view"
                       title="View">
                        <i class="fas fa-eye"></i>
                    </a>

                    <form action="{{ route('admin.instructor.destroy', $instructor->id) }}" method="POST"
                          class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="action-btn delete" title="Delete"
                                onclick="return confirm('Are you sure you want to delete {{ $instructor->name }}?')">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </div>
            </td>
        </tr>
    @endforeach

@endsection
