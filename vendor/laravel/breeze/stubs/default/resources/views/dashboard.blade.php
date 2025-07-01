<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
            </nav>
        </aside>

        <!-- Main content -->
        <main class="flex-1 p-6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-900">
                <p>{{ __("You're logged in!") }}</p>

                <a href="{{ route('admin.index') }}"
                    class="inline-block mt-6 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                    Go to User Management
                </a>
            </div>
        </main>
    </div>

    <!-- Alpine.js (cần để chạy dropdown) -->
    <script src="//unpkg.com/alpinejs" defer></script>
</x-app-layout>
