<?php

namespace App\Livewire\Chat;

use App\Models\Room;
use Livewire\Attributes\Validate;
use Livewire\Component;

class RoomFormManager extends Component
{

    #[Validate]
    public string $name ;

    public bool $isShow = false;
    public Room $room;


    public function mount(Room $room)
    {
        $this->isShow = request()->routeIs('rooms-form-manager.show');
        $this->room = $room;

        if($this->room->exists)
        {
            $this->name = $this->room->name;
        }
    }

    public function rules()
    {
        return [
            'name' => 'required|min:3|max:255',
        ];
    }

    public function save()
    {
        $data = $this->validate();

        Room::updateOrCreate(['id' => $this->room->id], $data);

        flash()->options(['position'=>'bottom-right'])->success('Room created successfully.');

        $this->reset();

        $this->redirectRoute('rooms-table');
    }


    public function render()
    {
        return view('livewire.chat.room-form-manager')->extends('users.user.layout.layout')->section('content2');
    }
}
