<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Update Avater') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Update your avatar profile information.') }}
        </p>
    </header>

    <form method="post" action="{{ route('profile.avatar') }}" enctype="multipart/form-data" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <img src="{{ asset('storage/' . $user->avatar) }}" alt="Avatar" width="200" height="200"
            class="rounded-full mb-4">

        <div>
            <x-input-label for="avatar" :value="__('Avatar')" />
            <x-text-input id="avatar" name="avatar" type="file" class="mt-1 block w-full" :value="old('avatar', $user->avatar)"
                required autofocus autocomplete="avatar" />
            <x-input-error class="mt-2" :messages="$errors->get('avatar')" />
        </div>
        <div>
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'avatar-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600">{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
