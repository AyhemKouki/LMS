@extends('users.admin.dashboard.userManagement')
@section('studentloop')
                    @foreach($students as $student)
                        <tr>
                            <td>
                                <div class="user-info">
                                    @if($student->profile_image == "/images/avatar.jpg")
                                        <img src="{{ asset($student->profile_image) }}"
                                             class="user-avatar"
                                             alt="image">
                                    @else
                                        <img src="{{ asset('storage/' . $student->profile_image) }}"
                                             class="user-avatar"
                                             alt="image">
                                    @endif

                                    <div>
                                        <div class="user-name">{{ $student->name }}</div>
                                        <div class="user-role">{{ $student->role }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $student->email }}</td>

                            <td>{{ $student->created_at }}</td>
                            <td>
                                <div class="action-buttons">
                                    <a href="#" class="action-btn view"
                                       title="View">
                                        <i class="fas fa-eye"></i>
                                    </a>

                                    <form action="{{ route('admin.student.destroy', $student->id) }}" method="POST"
                                          class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="action-btn delete" title="Delete"
                                                onclick="return confirm('Are you sure you want to delete {{ $student->name }}?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach

@endsection
