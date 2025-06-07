@extends('users.admin.layout.layout')

@section('title', 'Edit Category')

@section('content')
    <div class="container-fluid px-4">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-sm border-0 rounded-lg mt-4">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
                        <h4 class="mb-0">
                            <i class="bi bi-pencil-square me-2"></i>Edit Category
                        </h4>
                        <a href="{{ route('admin.category.index') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-left me-1"></i> Back
                        </a>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.category.update', $category) }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                            @csrf
                            @method('PUT')

                            <!-- Name Field -->
                            <div class="mb-4">
                                <label for="name" class="form-label fw-semibold">Category Name <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-card-heading"></i></span>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                           id="name" name="name" value="{{ old('name', $category->name) }}"
                                           placeholder="Enter category name" required>
                                    @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Slug Field -->
                            <div class="mb-4">
                                <label for="slug" class="form-label fw-semibold">Slug <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-link-45deg"></i></span>
                                    <input type="text" class="form-control @error('slug') is-invalid @enderror"
                                           id="slug" name="slug" value="{{ old('slug', $category->slug) }}"
                                           placeholder="category-slug" required>
                                    @error('slug')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <small class="text-muted">URL-friendly version of the name</small>
                            </div>

                            <!-- Description Field -->
                            <div class="mb-4">
                                <label for="description" class="form-label fw-semibold">Description</label>
                                <textarea class="form-control @error('description') is-invalid @enderror"
                                          id="description" name="description" rows="3"
                                          placeholder="Enter category description">{{ old('description', $category->description) }}</textarea>
                                @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Parent Category Field -->
                            <div class="mb-4">
                                <label for="parent_id" class="form-label fw-semibold">Parent Category</label>
                                <select class="form-select @error('parent_id') is-invalid @enderror"
                                        id="parent_id" name="parent_id">
                                    <option value="">Select parent category (optional)</option>
                                    @foreach($categories as $cat)
                                        <option value="{{ $cat->id }}" {{ (old('parent_id', $category->parent_id) == $cat->id) ? 'selected' : '' }}>
                                            {{ $cat->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('parent_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Image Upload Field -->
                            <div class="mb-4">
                                <label for="image" class="form-label fw-semibold">Category Image</label>

                                <!-- Current Image Display -->
                                @if($category->image)
                                    <div class="mb-3">
                                        <p class="text-muted mb-1">Current Image:</p>
                                        <img src="{{ asset('storage/' . $category->image) }}"
                                             class="img-thumbnail mb-3"
                                             style="max-height: 200px; object-fit: contain;">
                                    </div>
                                @endif

                                <div class="card border-dashed p-3">
                                    <div class="d-flex flex-column align-items-center">
                                        <input type="file" class="form-control @error('image') is-invalid @enderror"
                                               id="image" name="image" accept="image/*"
                                               onchange="previewImage(this)">
                                        <small class="text-muted mt-2">Upload a new image to replace the current one</small>
                                        <img id="image-preview" src="#" alt="Preview"
                                             class="img-fluid rounded mb-3 d-none"
                                             style="max-height: 200px; object-fit: contain;">
                                        @error('image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Status Field -->
                            <div class="mb-4">
                                <label class="form-label fw-semibold">Status</label>
                                <div class="form-check form-switch ps-0">
                                    <div class="d-flex align-items-center">
                                        <input type="hidden" name="is_active" value="0">
                                        <input class="form-check-input ms-0 me-2" type="checkbox"
                                               id="is_active" name="is_active" value="1"
                                            {{ old('is_active', $category->is_active) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_active">
                                            {{ old('is_active', $category->is_active) ? 'Active (Visible to users)' : 'Inactive (Hidden from users)' }}
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <!-- Form Actions -->
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                                <button type="reset" class="btn btn-outline-secondary me-md-2">
                                    <i class="bi bi-arrow-counterclockwise me-1"></i> Reset
                                </button>
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-save me-1"></i> Update Category
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Image preview function
        function previewImage(input) {
            const preview = document.getElementById('image-preview');
            const file = input.files[0];

            if (file) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('d-none');
                    preview.classList.add('d-block');
                }

                reader.readAsDataURL(file);
            } else {
                preview.src = '#';
                preview.classList.remove('d-block');
                preview.classList.add('d-none');
            }
        }

        // Form validation
        (function () {
            'use strict'

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            const forms = document.querySelectorAll('.needs-validation')

            // Loop over them and prevent submission
            Array.from(forms).forEach(form => {
                form.addEventListener('submit', event => {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }

                    form.classList.add('was-validated')
                }, false)
            })
        })()
    </script>

    <style>
        .border-dashed {
            border: 2px dashed #dee2e6;
            border-radius: 0.375rem;
        }
        .form-switch .form-check-input {
            width: 2.5em;
            height: 1.5em;
            cursor: pointer;
        }
        .form-switch .form-check-input:checked {
            background-color:  #0d6efd;
            border-color:  #0d6efd;
        }
        .card {
            border: none;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        }
        .img-thumbnail {
            border: 1px solid #dee2e6;
            padding: 0.25rem;
            background-color: #fff;
        }
    </style>
@endsection
