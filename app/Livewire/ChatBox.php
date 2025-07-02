<?php
namespace App\Livewire;

use Livewire\Component;
use App\Models\Message;

class ChatBox extends Component
{
    public $messages = [];
    public $newMessage = '';

    protected $listeners = ['echo:chat.{auth()->id()},MessageSent' => 'loadNewMessage'];

    public function mount()
    {
        $this->messages = auth()->check() ? Message::where('user_id', auth()->id())->with('user')->get()->toArray() : [];
    }

    public function loadNewMessage($event)
    {
        $this->messages[] = $event['message'];
    }

    public function sendMessage()
    {
        $this->validate(['newMessage' => 'required|string|max:1000']);
        $this->dispatch('sendMessage', ['content' => $this->newMessage]);
        $this->newMessage = '';
    }

    public function render()
    {
        return view('livewire.chat-box');
    }
}