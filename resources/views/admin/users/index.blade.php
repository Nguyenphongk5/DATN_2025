<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot>

    <div class="py-12" >
        <h1 class="font-semibold text-gray-800 leading-tight" style="text-align: center; margin: 0 0 2rem 0; font-size: 2rem;">
            {{ __('List Users') }}
        </h1>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="overflow-x-auto" >
                        <form action="{{ route('users.index') }}" method="GET">
                            <select name="role" id="roleFilter" style="margin-bottom: 1rem" onchange="this.form.submit()">
                                <option value="">All Roles</option>
                                <option value="user" {{ request('role') == 'user' ? 'selected' : '' }}>User</option>
                                <option value="staff" {{ request('role') == 'staff' ? 'selected' : '' }}>Staff</option>
                                <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                            </select>
                        </form>
                        <table class="w-full table-auto border-collapse">
                            <thead class="bg-gray-100 text-gray-700">
                                <tr>
                                    <th class="px-6 py-3 text-center text-sm font-medium uppercase">STT</th>
                                    <th class="px-6 py-3 text-center text-sm font-medium uppercase">Name</th>
                                    <th class="px-6 py-3 text-center text-sm font-medium uppercase">Email</th>
                                    <th class="px-6 py-3 text-center text-sm font-medium uppercase">Role</th>
                                    <th class="px-6 py-3 text-center text-sm font-medium uppercase">Avatar</th>
                                    <th class="px-6 py-3 text-center text-sm font-medium uppercase">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 text-center">
                                @foreach ($users as $key => $user)
                                    <tr>
                                        <td class="px-6 py-4">{{ $key + 1 }}</td>
                                        <td class="px-6 py-4">{{ $user->name }}</td>
                                        <td class="px-6 py-4">{{ $user->email }}</td>
                                        <td class="px-6 py-4 capitalize">
                                            @if ($user->role == 'user')
                                                <span class="text-green-600">Người Dùng</span>
                                            @elseif ($user->role == 'staff')
                                                <span class="text-blue-600">Nhân Viên</span>
                                            @else
                                                <span class="text-red-600">Quản Trị Viên</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4">
                                            @if ($user->avatar)
                                                <img src="{{ asset('storage/' . $user->avatar) }}" width="60px" alt="Avatar"
                                                    class="w-12 h-12 rounded-full object-cover">
                                            @else
                                                <span class="text-gray-400 italic">No Avatar</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex gap-4 justify-center">
                                                <a href="{{ route('users.edit', $user->id) }}"
                                                    class=" hover:underline btn btn-primary">Update</a>
                                                <a href="{{ route('users.show', $user->id) }}"
                                                    class=" hover:underline btn btn-success">Detail</a>
                                                <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                                    onsubmit="return confirm('Are you sure?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class=" hover:underline btn btn-danger">Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $users->links('pagination::tailwind') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
