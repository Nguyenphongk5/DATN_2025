<div x-data="{ open: false }" class="fixed bottom-4 right-4 w-80 bg-white shadow-lg rounded-lg z-50">
    <button @click="open = !open" class="w-full bg-blue-500 text-white p-2 rounded-t-lg flex justify-between items-center">
        <span>Chat với hỗ trợ</span>
        <span x-show="open" class="text-sm">✖</span>
    </button>
    <div x-show="open" class="p-4 h-64 overflow-y-auto border-t">
        @forelse($messages as $message)
            <div class="mb-2 {{ $message['user_id'] == auth()->id() ? 'text-right' : 'text-left' }}">
                <p class="bg-gray-200 p-2 rounded-lg inline-block max-w-xs break-words">
                    {{ $message['content'] }}
                </p>
                <small class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($message['created_at'])->format('H:i') }}</small>
            </div>
        @empty
            <p class="text-center text-gray-500">Chưa có tin nhắn. Hãy bắt đầu cuộc trò chuyện!</p>
        @endforelse
    </div>
    <div x-show="open" class="p-2 border-t flex">
        <input wire:model="newMessage" class="w-full p-2 border rounded-l-lg focus:outline-none" placeholder="Nhập tin nhắn...">
        <button wire:click="sendMessage" class="bg-green-500 text-white p-2 rounded-r-lg hover:bg-green-600 transition">
            Gửi
        </button>
    </div>
</div>