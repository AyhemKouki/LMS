<div class="chat-messages p-3 d-flex flex-column-reverse">
    @foreach($messages as $message)
        <div
            class="d-flex {{ $message->user_id === auth()->id() ? 'justify-content-end' : 'justify-content-start' }} mb-3">
            <div
                class="message {{ $message->user_id === auth()->id() ? 'bg-primary text-white' : 'bg-white border' }} rounded-3 p-3 shadow-sm"
                style="max-width: 75%;">
                <div class="message-content">
                    <div class="message-text">{{ $message->content }}</div>
                </div>
                <div class="message-meta mt-1">
                    <span class="{{ $message->user_id === auth()->id() ? 'text-white-50' : 'text-muted' }} small">{{ $message->user->name }} • {{ $message->created_at->diffForHumans() }}</span>
                </div>
                </div>
            </div>
        @endforeach
</div>
