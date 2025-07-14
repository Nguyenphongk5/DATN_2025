@extends('layouts.user')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100 py-8">
    <div class="w-full max-w-md bg-white rounded-3xl shadow-xl p-8">
        <div class="text-center mb-6">
            <h1 class="font-bold text-2xl mb-1 text-purple-700">Tạo tài khoản mới</h1>
            <p class="text-gray-500 text-base">Điền thông tin để đăng ký tài khoản.</p>
        </div>

        <form method="POST" action="{{ route('register') }}" class="space-y-5" id="register-form">
            @csrf

            {{-- Họ tên --}}
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Họ và tên</label>
                <input id="name" name="name" type="text" value="{{ old('name') }}"
                    class="block w-full rounded-xl border-gray-300 focus:border-purple-500 focus:ring focus:ring-purple-200 focus:ring-opacity-50 py-3 px-4 text-base @error('name') border-red-500 @enderror"
                    placeholder="Nguyễn Văn A">
                @error('name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Email --}}
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input id="email" name="email" type="email" value="{{ old('email') }}"
                    class="block w-full rounded-xl border-gray-300 focus:border-purple-500 focus:ring focus:ring-purple-200 focus:ring-opacity-50 py-3 px-4 text-base @error('email') border-red-500 @enderror"
                    placeholder="you@example.com">
                @error('email')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Mật khẩu --}}
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Mật khẩu</label>
                <input id="password" name="password" type="password"
                    class="block w-full rounded-xl border-gray-300 focus:border-purple-500 focus:ring focus:ring-purple-200 focus:ring-opacity-50 py-3 px-4 text-base @error('password') border-red-500 @enderror"
                    placeholder="••••••••">
                @error('password')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Nhập lại mật khẩu --}}
            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Nhập lại mật khẩu</label>
                <input id="password_confirmation" name="password_confirmation" type="password"
                    class="block w-full rounded-xl border-gray-300 focus:border-purple-500 focus:ring focus:ring-purple-200 focus:ring-opacity-50 py-3 px-4 text-base"
                    placeholder="••••••••">
            </div>

            {{-- Tỉnh/Thành phố --}}
            <div>
                <label for="province" class="block text-sm font-medium text-gray-700 mb-1">Tỉnh/Thành phố</label>
                <select name="province" id="province"
                    class="block w-full rounded-xl border-gray-300 focus:border-purple-500 focus:ring-purple-200 py-3 px-4 @error('province') border-red-500 @enderror">
                    <option value="">-- Chọn tỉnh/thành --</option>
                </select>
                @error('province')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Quận/Huyện --}}
            <div>
                <label for="district" class="block text-sm font-medium text-gray-700 mb-1">Quận/Huyện</label>
                <select name="district" id="district"
                    class="block w-full rounded-xl border-gray-300 focus:border-purple-500 focus:ring-purple-200 py-3 px-4 @error('district') border-red-500 @enderror">
                    <option value="">-- Chọn quận/huyện --</option>
                </select>
                @error('district')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Phường/Xã --}}
            <div>
                <label for="ward" class="block text-sm font-medium text-gray-700 mb-1">Phường/Xã</label>
                <select name="ward" id="ward"
                    class="block w-full rounded-xl border-gray-300 focus:border-purple-500 focus:ring-purple-200 py-3 px-4 @error('ward') border-red-500 @enderror">
                    <option value="">-- Chọn phường/xã --</option>
                </select>
                @error('ward')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Địa chỉ cụ thể --}}
            <div>
                <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Địa chỉ cụ thể</label>
                <input id="address" name="address" type="text" value="{{ old('address') }}"
                    class="block w-full rounded-xl border-gray-300 focus:border-purple-500 focus:ring focus:ring-purple-200 py-3 px-4 text-base @error('address') border-red-500 @enderror"
                    placeholder="Số nhà, tên đường...">
                @error('address')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Submit --}}
            <div>
                <button type="submit"
                    class="w-full py-3 px-4 bg-gradient-to-r from-purple-600 to-pink-600 text-white font-semibold rounded-xl shadow-md hover:from-purple-700 hover:to-pink-700 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-purple-400 focus:ring-opacity-50">
                    Đăng ký
                </button>
            </div>
        </form>

        <div class="text-center mt-6">
            <span class="text-gray-500">Đã có tài khoản?</span>
            <a href="{{ route('login') }}" class="text-purple-700 font-semibold hover:underline ml-1">Đăng nhập</a>
        </div>
    </div>
</div>

@if ($errors->any())
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const firstErrorField = document.querySelector('.border-red-500');
            if (firstErrorField) {
                firstErrorField.focus();
            }
        });
    </script>
@endif

<script>
    let provinces = document.getElementById("province");
    let districts = document.getElementById("district");
    let wards = document.getElementById("ward");

    let oldProvince = "{{ old('province') }}";
    let oldDistrict = "{{ old('district') }}";
    let oldWard = "{{ old('ward') }}";

    fetch("/vn-addresses.json")
        .then(res => res.json())
        .then(data => {
            data.data.forEach(province => {
                let option = new Option(province.name, province.name);
                provinces.add(option);
            });

            if (oldProvince) {
                provinces.value = oldProvince;
                provinces.dispatchEvent(new Event('change'));
            }
        });

    provinces.addEventListener("change", function () {
        districts.innerHTML = '<option value="">-- Chọn quận/huyện --</option>';
        wards.innerHTML = '<option value="">-- Chọn phường/xã --</option>';

        fetch("/vn-addresses.json")
            .then(res => res.json())
            .then(data => {
                const selectedProvince = data.data.find(p => p.name === provinces.value);
                if (selectedProvince) {
                    selectedProvince.level2s.forEach(district => {
                        let option = new Option(district.name, district.name);
                        districts.add(option);
                    });

                    if (oldDistrict) {
                        districts.value = oldDistrict;
                        districts.dispatchEvent(new Event('change'));
                    }
                }
            });
    });

    districts.addEventListener("change", function () {
        wards.innerHTML = '<option value="">-- Chọn phường/xã --</option>';

        fetch("/vn-addresses.json")
            .then(res => res.json())
            .then(data => {
                const selectedProvince = data.data.find(p => p.name === provinces.value);
                const selectedDistrict = selectedProvince?.level2s.find(d => d.name === districts.value);
                if (selectedDistrict) {
                    selectedDistrict.level3s.forEach(ward => {
                        let option = new Option(ward.name, ward.name);
                        wards.add(option);
                    });

                    if (oldWard) {
                        wards.value = oldWard;
                    }
                }
            });
    });
</script>
@endsection
