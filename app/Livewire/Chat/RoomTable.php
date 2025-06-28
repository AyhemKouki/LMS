<?php

namespace App\Livewire\Chat;

use App\Models\Room;
use Livewire\Component;

class RoomTable extends Component
{
    public string $search = '';
    private function getRooms()
    {
        return Room::where('name' , 'like' , '%' . $this->search . '%')->get();
    }


    public function delete(Room $room)
    {
        flash()->options(["position" => "bottom-right"])->success('Room Deleted Successfully');
        $room->delete();
    }
    public function render()
    {
        $rooms = $this->getRooms();
        return view('livewire.chat.room-table' , compact('rooms'))
            ->extends('users.user.layout.layout')
            ->section('content2');
    }
}
