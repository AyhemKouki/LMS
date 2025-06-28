<div class="container mt-4">
    <div class="card shadow-sm rounded-lg">
        <div class="card-header bg-white p-4 border-bottom">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0 text-primary font-weight-bold">Chat Rooms</h5>
                <div class="d-flex gap-3">

                    <a href="{{ route('room-form-manager.create') }}" class="btn btn-primary rounded-pill">
                        <i class="fas fa-plus"></i> Create Room
                    </a>
                    <div class="search-box position-relative">
                        <i class="fas fa-search position-absolute text-muted" style="left: 15px; top: 12px;"></i>
                        <input wire:model.live="search" type="text" class="form-control pl-5 py-2 rounded-pill"
                               placeholder="Search rooms..." style="padding-left: 40px;">
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="bg-light">
                    <tr>
                        <th scope="col" class="px-4 py-3">#</th>
                        <th scope="col" class="px-4 py-3">Name</th>
                        <th scope="col" class="px-4 py-3">Created At</th>
                        <th scope="col" class="px-4 py-3">Updated At</th>
                        <th scope="col" class="px-4 py-3">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($rooms as $room)
                        <tr class="border-bottom">
                            <td class="px-4 py-3">{{ $room->id }}</td>
                            <td class="px-4 py-3 font-weight-medium">{{ $room->name }}</td>
                            <td class="px-4 py-3 text-muted">{{ $room->created_at->format('Y-m-d H:i:s') }}</td>
                            <td class="px-4 py-3 text-muted">{{ $room->updated_at->format('Y-m-d H:i:s') }}</td>
                            <td class="px-4 py-3">
                                <div class="d-flex gap-2">
                                    <a href="{{ route('room-form-manager.edit', $room) }}"
                                       class="btn btn-sm btn-outline-secondary rounded-pill px-3">
                                        <i class="fas fa-edit mr-1"></i> Edit
                                    </a>
                                    <a  href="{{route('chat-room' , $room->id)}}"  class="btn btn-sm btn-outline-primary rounded-pill px-3">
                                    <i class="fas fa-comments mr-1"></i> Join
                                    </a>
                                    <button wire:click="delete({{ $room->id }})"
                                            wire:confirm="Are you sure you want to delete this room?"
                                            class="btn btn-sm btn-outline-danger rounded-pill px-3">
                                        <i class="fas fa-trash mr-1"></i> Delete
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Create Room Modal -->
    <div class="modal fade" id="createRoomModal" tabindex="-1" aria-labelledby="createRoomModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createRoomModalLabel">Create New Room</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit="createRoom">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="roomName" class="form-label">Room Name</label>
                            <input type="text" class="form-control" id="roomName" wire:model="roomName" required>
                            @error('roomName') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Create Room</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

