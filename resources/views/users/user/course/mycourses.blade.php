@extends('users.user.layout.layout')

@section('content2')
    <div class="container-fluid">
        <h2 class="mb-4">My Courses</h2>
        <div class="row">
            @forelse($courses as $course)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card h-100">
                        <img src="{{ asset('storage/' . $course->thumbnail) }}" class="card-img-top"
                             alt="{{ $course->title }}" style="height: 200px; object-fit: cover;">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $course->title }}</h5>

                            <!-- Affichage de la note moyenne -->
                            <div class="mb-3">
                                @php
                                    $averageRating = $course->averageRating();
                                    $ratingsCount = $course->ratingsCount();
                                    $userRating = $course->getUserRating(auth()->id());
                                @endphp

                                <div class="d-flex align-items-center mb-2">
                                    <div class="stars me-2">
                                        @for($i = 1; $i <= 5; $i++)
                                            <span class="star text-warning {{ $i <= round($averageRating) ? 'fas' : 'far' }} fa-star"></span>
                                        @endfor
                                    </div>
                                    <small class="text-muted">
                                        {{ number_format($averageRating, 1) }}
                                        ({{ $ratingsCount }} {{ $ratingsCount > 1 ? 'évaluations' : 'évaluation' }})
                                    </small>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between align-items-center">
                                <div class="dropdown">
                                    <button class="btn btn-primary dropdown-toggle" type="button"
                                            id="lessonDropdown{{ $course->id }}" data-bs-toggle="dropdown"
                                            aria-expanded="false">
                                        View Lessons
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="lessonDropdown{{ $course->id }}">
                                        @forelse($course->lessons as $lesson)
                                            <li><a class="dropdown-item"
                                                   href="{{route('courses.watchLesson' , $lesson->id)}}">{{ $lesson->title }}</a>
                                            </li>
                                        @empty
                                            <li><span class="dropdown-item">No lessons available</span></li>
                                        @endforelse
                                    </ul>
                                </div>
                                <!-- Formulaire d'évaluation -->
                                <div class="mt-auto">
                                    <button class="btn btn-outline-secondary btn-sm" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#ratingForm{{ $course->id }}"
                                            aria-expanded="false">
                                        {{ $userRating ? 'Modifier mon évaluation' : 'Évaluer ce cours' }}
                                    </button>

                                    <div class="collapse mt-2" id="ratingForm{{ $course->id }}">
                                        <form action="{{ route('ratings.store', $course) }}" method="POST"
                                              class="card card-body rating-form">
                                            @csrf
                                            @method('POST')
                                            <div class="mb-2">
                                                <label class="form-label small">Note :</label>
                                                <div class="rating-input" data-course-id="{{ $course->id }}">
                                                    @for($i = 5; $i >= 1; $i--)
                                                        <input type="radio" name="rating" value="{{ $i }}"
                                                               id="rating{{ $course->id }}_{{ $i }}"
                                                               {{ $userRating && $userRating->rating == $i ? 'checked' : '' }}
                                                               onchange="submitRating(this)">
                                                        <label for="rating{{ $course->id }}_{{ $i }}" class="star-label">
                                                            <i class="fas fa-star"></i>
                                                        </label>
                                                    @endfor
                                                </div>
                                            </div>

                                            <div class="mb-2">
                                                <label for="comment{{ $course->id }}" class="form-label small">Commentaire (optionnel) :</label>
                                                <textarea class="form-control form-control-sm"
                                                          id="comment{{ $course->id }}"
                                                          name="comment"
                                                          rows="2"
                                                          placeholder="Votre commentaire...">{{ $userRating->comment ?? '' }}</textarea>
                                            </div>

                                            <div class="d-flex gap-2">
                                                <button type="submit" class="btn btn-primary btn-sm">
                                                    {{ $userRating ? 'Mettre à jour' : 'Évaluer' }}
                                                </button>
                                                @if($userRating)
                                                    <a href="{{ route('ratings.destroy', $course) }}"
                                                       class="btn btn-outline-danger btn-sm"
                                                       onclick="event.preventDefault(); document.getElementById('delete-rating-{{ $course->id }}').submit();">
                                                        Supprimer
                                                    </a>
                                                    <form id="delete-rating-{{ $course->id }}"
                                                          action="{{ route('ratings.destroy', $course) }}"
                                                          method="POST" style="display: none;">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                @endif
                                            </div>
                                        </form>
                                    </div>
                                </div>

                            </div>


                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <p class="text-center">No courses found</p>
                </div>
            @endforelse
        </div>
    </div>
    <style>
        .rating-input {
            display: flex;
            flex-direction: row-reverse;
            justify-content: flex-end;
        }

        .rating-input input[type="radio"] {
            display: none;
        }

        .star-label {
            color: #ddd;
            font-size: 1.2em;
            cursor: pointer;
            transition: color 0.2s;
        }

        .rating-input input[type="radio"]:checked ~ .star-label {
            color: #ffc107;
        }

        .rating-input:not(:hover) input[type="radio"]:checked ~ .star-label,
        .rating-input:hover .star-label:hover,
        .rating-input:hover .star-label:hover ~ .star-label {
            color: #ffc107;
        }

        .rating-input .star-label {
            padding: 0 2px;
            cursor: pointer;
        }

        .stars .star {
            font-size: 1em;
        }
    </style>

    <script>
        function submitRating(input) {
            const form = input.closest('form');
            const formData = new FormData(form);

            fetch(form.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            })
                .then(response => {
                    if (response.ok) {
                        window.location.reload();
                    }
                })
                .catch(error => console.error('Error:', error));
        }
    </script>
@endsection
