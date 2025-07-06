<section class="mb-8">
    <div class="bg-white/90 shadow-xl rounded-2xl p-8">
        <h4 class="text-lg font-bold text-indigo-700 mb-2 flex items-center gap-2"><i class="fas fa-user-edit"></i>
            Profile Information</h4>
        <p class="text-gray-500 mb-4">Update your name and email address.</p>
        <form id="send-verification" method="post" action="{{ route('verification.send') }}">
            @csrf
        </form>
        <form method="POST" action="{{ route('profile.update') }}" class="space-y-6 mt-4">
            @csrf
            @method('patch')
            <!-- Name -->
            <div>
                <label for="name" class="block text-sm font-bold mb-2 text-indigo-700">Full Name</label>
                <input id="name" name="name" type="text"
                    class="w-full px-4 py-3 rounded-xl border border-indigo-200 focus:ring-2 focus:ring-sky-400 focus:outline-none shadow @error('name') border-red-500 @enderror"
                    value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
                @error('name')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>
            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-bold mb-2 text-indigo-700">Email Address</label>
                <input id="email" name="email" type="email"
                    class="w-full px-4 py-3 rounded-xl border border-indigo-200 focus:ring-2 focus:ring-sky-400 focus:outline-none shadow @error('email') border-red-500 @enderror"
                    value="{{ old('email', $user->email) }}" required autocomplete="username">
                @error('email')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                    <div class="mt-3">
                        <p class="text-sm text-yellow-600">
                            {{ __('Your email address is unverified.') }}
                            <button form="send-verification"
                                class="underline text-indigo-600 hover:text-indigo-800 font-semibold ml-2">{{ __('Click here to re-send the verification email.') }}</button>
                        </p>
                        @if (session('status') === 'verification-link-sent')
                            <p class="mt-2 text-green-600 text-sm font-semibold">
                                {{ __('A new verification link has been sent to your email address.') }}
                            </p>
                        @endif
                    </div>
                @endif
            </div>
            <!-- Submit -->
            <div class="flex justify-between items-center mt-6">
                <button type="submit"
                    class="bg-gradient-to-r from-sky-400 to-indigo-500 hover:from-indigo-500 hover:to-sky-400 text-white font-bold py-2 px-8 rounded-xl shadow-lg flex items-center gap-2 transition">Save</button>
                @if (session('status') === 'profile-updated')
                    <span class="text-green-600 text-sm font-semibold ml-4 flex items-center gap-1"><i
                            class="fas fa-check-circle"></i> Profile saved.</span>
                @endif
            </div>
        </form>
    </div>
</section>
