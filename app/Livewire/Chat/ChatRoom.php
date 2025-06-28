<?php

namespace App\Livewire\Chat;

use App\Events\MessageSentEvent;
use App\Models\Message;
use App\Models\Room;
use Livewire\Attributes\Validate;
use Livewire\Component;

class ChatRoom extends Component
{

    public Room $room;

    #[Validate]
    public string $content = '';


    public function rules()
    {
        return [
            'content' => 'required|string'
        ];
    }

    public function save()
    {
        $data  = $this->validate();

        $data['room_id'] = $this->room->id;

        $data['user_id'] = auth()->id();

        $message = Message::create($data);

        broadcast(new MessageSentEvent($message->id , $this->room->id ))->toOthers();

        $this->dispatch('refresh-room-messages');

        $this->reset('content');

        $this->redirectRoute('chat-room' , $this->room->id);

    }
    public function render()
    {
        $messages = Message::where('room_id' , $this->room->id)->get();
        return view('livewire.chat.chat-room' , compact('messages'))->layoutData(['room'=> $this->room])->extends('users.user.layout.layout')->section('content2');
    }
}
