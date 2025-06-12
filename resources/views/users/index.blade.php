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
                    <div class="overflow-x-auto">
                        <table class="w-full table-auto border-collapse text-center">
                            <thead class="bg-gray-100 text-gray-700">
                                <tr>
                                    <th class="px-6 py-3 text-left text-sm font-medium uppercase">ID</th>
                                    <th class="px-6 py-3 text-left text-sm font-medium uppercase">Name</th>
                                    <th class="px-6 py-3 text-left text-sm font-medium uppercase">Email</th>
                                    <th class="px-6 py-3 text-left text-sm font-medium uppercase">Role</th>
                                    <th class="px-6 py-3 text-left text-sm font-medium uppercase">Avatar</th>
                                    <th class="px-6 py-3 text-left text-sm font-medium uppercase">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach ($users as $user)
                                    <tr>
                                        <td class="px-6 py-4">{{ $user->id }}</td>
                                        <td class="px-6 py-4">{{ $user->name }}</td>
                                        <td class="px-6 py-4">{{ $user->email }}</td>
                                        <td class="px-6 py-4 capitalize">
                                            @if ($user->role == 0)
                                                <span class="text-green-600">Người Dùng</span>
                                            @elseif ($user->role == 1)
                                                <span class="text-blue-600">Nhân ViênViên</span>
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
                                                    class="text-blue-600 hover:underline btn btn-primary">Update</a>
                                                <a href="{{ route('users.show', $user->id) }}"
                                                    class="text-blue-600 hover:underline btn btn-success">Detail</a>
                                                <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                                    onsubmit="return confirm('Are you sure?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="text-blue-600 hover:underline btn btn-danger">Delete</button>
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
