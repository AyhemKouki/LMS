@extends('users.admin.layout.layout')

@section('title', 'edit Category')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin.category.update' , $category) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="name" class="form-label">update Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                       name="name" value="{{ old('name', $category->name) }}" required>
                                @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="slug" class="form-label">update Slug</label>
                                <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug"
                                       name="slug" value="{{ old('slug' , $category->slug) }}" required>
                                @error('slug')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">update Description</label>
                                <textarea class="form-control @error('description') is-invalid @enderror"
                                          id="description" name="description"
                                          rows="3">{{ old('description', $category->description) }}</textarea>
                                @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="parent_id" class="form-label">update Parent Category</label>
                                <select class="form-select @error('parent_id') is-invalid @enderror" id="parent_id" name="parent_id">
                                    <option value="">None</option>
                                    @foreach($categories as $cat)
                                        <option
                                            value="{{ $cat->id }}" {{ (old('parent_id', $category->parent_id) == $cat->id) ? 'selected' : '' }}>
                                            {{ $cat->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('parent_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="image" class="form-label">update Image</label>
                                <input type="file" class="form-control @error('image') is-invalid @enderror" id="image"
                                       name="image"  accept="image/*" onchange="previewImage(this)">
                                @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="mt-2">
                                    <img id="image-preview" src="#" alt="Preview"
                                         style="max-width: 200px; display: none;">
                                </div>
                            </div>

                            <div class="mb-3">
                                <!-- Display current image if it exists -->
                                @if($category->image)
                                    <div class="mb-2">
                                        <p class="text-muted">Current Image:</p>
                                        <img src="{{ asset('storage/' . $category->image) }}"
                                             alt="Current category image"
                                             style="max-height: 200px;">
                                    </div>
                                @endif
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Status</label>
                                <div class="form-check form-switch">
                                    <input type="hidden" name="is_active" value="0">
                                    <input class="form-check-input" type="checkbox" role="switch"
                                           id="is_active" name="is_active" value="1"
                                        {{ old('is_active', $category->is_active) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_active">
                                        {{ $category->is_active ? 'Active' : 'Inactive' }}
                                    </label>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">update Category</button>

                            <a href="{{ route('admin.category.index') }}" class="btn btn-secondary">Back</a>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function previewImage(input) {
            const preview = document.getElementById('image-preview');
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                }
                reader.readAsDataURL(input.files[0]);
            } else {
                preview.src = '#';
                preview.style.display = 'none';
            }
        }
    </script>
@endsection
