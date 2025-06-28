<div>
    <form wire:submit="save()" class="card shadow-sm rounded-lg">
        <div class="card-header bg-white p-4 border-bottom">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0 text-primary font-weight-bold">Create New Room</h5>
                <a href="{{ route('rooms-table') }}" class="btn btn-outline-secondary rounded-pill">
                    <i class="fas fa-arrow-left"></i> Back
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <label for="name" class="form-label">Room Name</label>
                <input type="text" class="form-control" id="name" wire:model="name" required>
                @error('name') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Create Room</button>
            </div>
        </div>
    </form>
</div>
