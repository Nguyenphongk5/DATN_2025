<x-app-layout>
    <x-slot name="header">
        <div
            class="flex items-center gap-3 bg-gradient-to-r from-indigo-500 via-sky-500 to-cyan-400 rounded-2xl shadow-xl px-6 py-4 mb-6">
            <i class="fas fa-comments text-3xl text-white drop-shadow-lg animate-pulse"></i>
            <h2 class="font-extrabold text-2xl text-white tracking-wide drop-shadow-lg">Quản lý chat với khách hàng</h2>
        </div>
    </x-slot>

    <div class="container mx-auto py-8">
        <div class="flex gap-6">
            <div class="w-1/3 bg-white rounded-2xl shadow p-4">
                <h3 class="font-semibold mb-4 text-lg">Khách hàng đã nhắn tin</h3>
                <ul id="user-list" class="space-y-2">
                    @foreach($users as $user)
                        <li>
                            <button id="user-btn-{{ $user->id }}"
                                class="w-full flex items-center gap-3 px-3 py-2 rounded-xl hover:bg-blue-100 transition border border-transparent"
                                onclick="loadMessages({{ $user->id }}, '{{ addslashes($user->name) }}', this)">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=4f8cff&color=fff"
                                    class="w-9 h-9 rounded-full shadow" alt="avatar">
                                <span class="font-medium text-gray-800">{{ $user->name }}</span>
                            </button>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="w-2/3 bg-white rounded-2xl shadow p-4 flex flex-col">
                <div class="mb-2 font-semibold text-lg flex items-center gap-2" id="chat-with-label">
                    <i class="fas fa-user-circle text-indigo-400"></i> Chọn khách hàng để chat
                </div>
                <div id="chat-messages" class="flex-1 overflow-y-auto border rounded-xl p-3 mb-2 bg-gray-50"
                    style="min-height:320px; max-height:420px;"></div>
                <form id="chat-form" class="flex gap-2 mt-2" style="display:none;">
                    <input type="hidden" id="chat-user-id">
                    <input type="text" id="chat-message"
                        class="flex-1 border rounded-2xl px-3 py-2 focus:ring-2 focus:ring-blue-400"
                        placeholder="Nhập tin nhắn...">
                    <button type="submit"
                        class="bg-gradient-to-r from-blue-500 to-indigo-500 text-white px-6 py-2 rounded-2xl font-semibold shadow hover:from-indigo-500 hover:to-blue-500 transition">Gửi</button>
                </form>
            </div>
        </div>
    </div>
    <script>
        let currentUserName = '';
        let currentUserBtn = null;
        function highlightUserBtn(btn) {
            if (currentUserBtn) currentUserBtn.classList.remove('bg-blue-100', 'border-blue-400');
            btn.classList.add('bg-blue-100', 'border-blue-400');
            currentUserBtn = btn;
        }
        function loadMessages(userId, userName, btn) {
            document.getElementById('chat-user-id').value = userId;
            document.getElementById('chat-form').style.display = 'flex';
            currentUserName = userName;
            document.getElementById('chat-with-label').innerHTML = `<i class='fas fa-user-circle text-indigo-400'></i> Chat với: <span class='text-indigo-600 font-bold'>${userName}</span>`;
            if (btn) highlightUserBtn(btn);
            fetch(`/admin/chat/messages/${userId}`)
                .then(res => res.json())
                .then(data => {
                    console.log(data); // debug xem có tin nhắn không
                    let html = '';
                    if (data.length === 0) {
                        html = `<div class='text-center text-gray-400 mt-10'>Chưa có tin nhắn nào với khách hàng này.</div>`;
                    } else {
                        data.forEach(msg => {
                            if (msg.is_admin) {
                                // Admin bên phải
                                html += `<div class=\"mb-3 flex justify-end\">
                                    <div class=\"max-w-[70%] flex items-start gap-2 flex-row-reverse\">
                                        <img src=\"https://ui-avatars.com/api/?name=Admin&background=845ec2&color=fff\" class=\"w-8 h-8 rounded-full shadow\" alt=\"avatar\">
                                        <div>
                                            <div class=\"chat-bubble admin bg-purple-100 text-gray-900 px-4 py-2 rounded-2xl font-medium shadow\">
                                                <div class=\"font-bold text-xs text-purple-700 mb-1 text-right\">Admin <span class=\"ml-2 text-[10px] text-purple-400\">${msg.created_at ? new Date(msg.created_at).toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' }) : ''}</span></div>
                                                ${msg.message}
                                            </div>
                                        </div>
                                    </div>
                                </div>`;
                            } else {
                                // User bên trái
                                html += `<div class=\"mb-3 flex justify-start\">
                                    <div class=\"max-w-[70%] flex items-start gap-2\">
                                        <img src=\"https://ui-avatars.com/api/?name=${encodeURIComponent(userName)}&background=4f8cff&color=fff\" class=\"w-8 h-8 rounded-full shadow\" alt=\"avatar\">
                                        <div>
                                            <div class=\"chat-bubble user bg-gradient-to-br from-pink-400 to-purple-400 text-white px-4 py-2 rounded-2xl font-medium shadow\">
                                                <div class=\"font-bold text-xs text-white mb-1\">Bạn <span class=\"ml-2 text-[10px] text-pink-200\">${msg.created_at ? new Date(msg.created_at).toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' }) : ''}</span></div>
                                                ${msg.message}
                                            </div>
                                        </div>
                                    </div>
                                </div>`;
                            }
                        });
                    }
                    const box = document.getElementById('chat-messages');
                    box.innerHTML = html;
                    setTimeout(() => { box.scrollTop = box.scrollHeight; }, 100);
                });
        }
        document.getElementById('chat-form').onsubmit = function (e) {
            e.preventDefault();
            const userId = document.getElementById('chat-user-id').value;
            const message = document.getElementById('chat-message').value;
            if (!message.trim()) return;
            fetch('/admin/chat/messages', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ user_id: userId, message: message })
            }).then(() => {
                loadMessages(userId, currentUserName, currentUserBtn);
                document.getElementById('chat-message').value = '';
            });
        };
        // Tự động chọn user đầu tiên nếu có
        document.addEventListener('DOMContentLoaded', function () {
            const firstBtn = document.querySelector('#user-list button');
            if (firstBtn) {
                firstBtn.click();
            }
        });
    </script>
    <style>
        .chat-bubble.admin {
            border-bottom-left-radius: 0.5rem;
        }

        .chat-bubble.user {
            border-bottom-right-radius: 0.5rem;
        }
    </style>
</x-app-layout>
