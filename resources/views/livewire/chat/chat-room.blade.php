<div class="container py-4" style="height: calc(100vh - 100px);">
    <div class="card shadow-sm h-100">
        <div class="card-header bg-white p-3 border-bottom">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0 text-primary fw-bold">{{ $room->name }}</h5>
                <a href="{{ route('rooms-table') }}" class="btn btn-outline-secondary btn-sm rounded-pill">
                    <i class="fas fa-arrow-left"></i> Back
                </a>
            </div>
        </div>
        <div class="card-body p-3"
             style="overflow-y: auto; max-height: calc(100vh - 280px); display: flex; flex-direction: column-reverse;">
        @livewire('chat.chat-messages-list', ['room' => $room])
        </div>
        <div class="card-footer bg-white p-3 border-top">
            <form wire:submit.prevent="save()" class="d-flex mt-auto">
            <input type="text" wire:model.live="content" class="form-control me-2"
                       placeholder="Type your message..." required>
                <button type="submit" class="btn btn-primary px-4">Send</button>
            </form>
        </div>
    </div>

    @if( isset($room) )
        <script type="module">
            const roomId = {{ json_encode($room->id) }};

            if( typeof Echo !== 'undefined' )
            {
                Echo.private(`room.${roomId}`)
                    .listen('MessageSentEvent', () => {
                        Livewire.dispatch('refresh-room-messages');
                    })
                    .error( error => {
                        console.error('Erreur de connexion au canal de chat:', error);
                    });
            }
            else{
                console.error('Laravel Echo n\'est pas défini');
            }
        </script>

    @endif

</div>

