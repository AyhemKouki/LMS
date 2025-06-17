@extends('users.user.layout.layout')

@section('title', 'lessons')

@section('content2')

    {{-- begin container --}}
    <div class="container my-3">

        <div class="card">

            {{-- card header --}}
            <div class="card-header fs-4 fw-bold">All {{ Str::plural('lesson') }}</div>

            {{-- card body --}}
            <div class="card-body">

                {{-- button trashes + button create --}}
                <div class="row mb-3 justify-content-center">
                    <div class="col-12 d-flex justify-content-end">
                        @can('create lesson')
                        <a class="btn btn-sm btn-primary" href="{{ route('lesson.create')  }}">Create</a>
                        @endcan
                    </div>
                </div>

                {{-- listing all resources --}}
                @foreach( $lessons as $lesson)
                    <div class="row mb-2 align-items-center">
                        {{-- lesson order --}}
                        <div class="col-md-1">
                            <span class="badge bg-secondary">#{{ $lesson->lesson_order }}</span>
                        </div>

                        {{-- lesson title --}}
                        <div class="col-md-2">
                        <h5 class="mb-0">{{ $lesson->title }}</h5>
                        </div>

                        {{-- lesson content --}}
                        <div class="col-md-3">
                            <p class="mb-0 text-muted">{{ Str::limit($lesson->content, 100) }}</p>
                        </div>

                        {{-- course title --}}
                        <div class="col-md-3">
                            <span class="badge bg-info">{{ $lesson->course->title }}</span>
                        </div>

                        {{-- actions --}}
                        <div class="col-md-auto d-flex justify-content-end gap-2">

                            @can('view lesson')
                                <a class="btn btn-sm btn-outline-secondary" href="{{ route('lesson.show', $lesson->id)  }}">
                                    show
                                </a>
                            @endcan

                            @can('edit lesson')
                                <a class="btn btn-sm btn-outline-secondary" href="{{ route('lesson.edit', $lesson->id)  }}">
                                    edit
                                </a>
                            @endcan

                            @can('destroy lesson')
                                <form action="{{ route('lesson.destroy', $lesson->id)  }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-secondary">destroy</button>
                                </form>
                            @endcan

                        </div>
                    </div>
                @endforeach

            </div>

            {{-- card footer --}}
            <div class="card-footer"></div>


        </div>

    </div>
    {{-- end container --}}

@endsection
