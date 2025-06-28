<?php

namespace App\Livewire\Chat;

use App\Models\Message;
use App\Models\Room;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\On;
use Livewire\Component;

class ChatMessagesList extends Component
{

    public Room $room;

    public Collection $messages;


    public function mount()
    {
        $this->loadMessages();
    }

    #[On('refresh-room-messages')]
    public function refreshMessages(): void
    {
        $this->loadMessages();
    }

    private function loadMessages(): void
    {
        $this->messages = $this->room->messages()->latest()->get();
    }
    public function render()
    {
        return view('livewire.chat.chat-messages-list');
    }
}
