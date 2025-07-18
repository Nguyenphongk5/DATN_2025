<form method="POST" action="{{ route('profile.update') }}" class="space-y-5">
    @csrf
    @method('PUT')

    {{-- Họ tên --}}
    <div>
        <label class="block mb-1 font-medium text-sm text-gray-700" for="name">Họ và tên</label>
        <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}"
            class="block w-full border-gray-300 rounded-xl py-3 px-4 @error('name') border-red-500 @enderror">
        @error('name')
            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
        @enderror
    </div>

    {{-- Email (không cho sửa) --}}
    <div>
        <label class="block mb-1 font-medium text-sm text-gray-700" for="email">Email</label>
        <input id="email" type="email" value="{{ $user->email }}" disabled
            class="block w-full bg-gray-100 text-gray-500 border-gray-300 rounded-xl py-3 px-4">
        <input type="hidden" name="email" value="{{ $user->email }}">
    </div>

    {{-- Tỉnh/Thành phố --}}
    <div>
        <label for="province" class="block mb-1 font-medium text-sm text-gray-700">Tỉnh/Thành phố</label>
        <select id="province" class="block w-full border-gray-300 rounded-xl py-3 px-4 @error('province') border-red-500 @enderror">
            <option value="">-- Chọn tỉnh/thành --</option>
        </select>
        <input type="hidden" name="province" id="province-hidden">
        @error('province')
            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
        @enderror
    </div>

    {{-- Quận/Huyện --}}
    <div>
        <label for="district" class="block mb-1 font-medium text-sm text-gray-700">Quận/Huyện</label>
        <select id="district" class="block w-full border-gray-300 rounded-xl py-3 px-4 @error('district') border-red-500 @enderror">
            <option value="">-- Chọn quận/huyện --</option>
        </select>
        <input type="hidden" name="district" id="district-hidden">
        @error('district')
            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
        @enderror
    </div>

    {{-- Phường/Xã --}}
    <div>
        <label for="ward" class="block mb-1 font-medium text-sm text-gray-700">Phường/Xã</label>
        <select id="ward" class="block w-full border-gray-300 rounded-xl py-3 px-4 @error('ward') border-red-500 @enderror">
            <option value="">-- Chọn phường/xã --</option>
        </select>
        <input type="hidden" name="ward" id="ward-hidden">
        @error('ward')
            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
        @enderror
    </div>

    {{-- Địa chỉ cụ thể --}}
    <div>
        <label for="address" class="block mb-1 font-medium text-sm text-gray-700">Địa chỉ cụ thể</label>
        <input name="address" id="address" type="text" value="{{ old('address', $user->address) }}"
            class="block w-full border-gray-300 rounded-xl py-3 px-4 @error('address') border-red-500 @enderror"
            placeholder="Số nhà, tên đường...">
        @error('address')
            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <button type="submit" class="bg-indigo-600 text-white py-3 px-6 rounded-xl hover:bg-indigo-700 transition">
            Cập nhật thông tin
        </button>
    </div>
</form>
<script>
    let provinces = document.getElementById("province");
    let districts = document.getElementById("district");
    let wards = document.getElementById("ward");

    let provinceHidden = document.getElementById("province-hidden");
    let districtHidden = document.getElementById("district-hidden");
    let wardHidden = document.getElementById("ward-hidden");

    let oldProvince = @json(old('province', $user->province));
    let oldDistrict = @json(old('district', $user->district));
    let oldWard = @json(old('ward', $user->ward));

    fetch("/vn-addresses.json")
        .then(res => res.json())
        .then(data => {
            // Load province
            data.data.forEach(province => {
                const option = new Option(province.name, province.name);
                provinces.add(option);
            });

            if (oldProvince) {
                provinces.value = oldProvince;
                provinceHidden.value = oldProvince;
                provinces.dispatchEvent(new Event("change"));
            }
        });

    provinces.addEventListener("change", function () {
        provinceHidden.value = this.value;
        districts.innerHTML = '<option value="">-- Chọn quận/huyện --</option>';
        wards.innerHTML = '<option value="">-- Chọn phường/xã --</option>';
        districtHidden.value = '';
        wardHidden.value = '';

        fetch("/vn-addresses.json")
            .then(res => res.json())
            .then(data => {
                const province = data.data.find(p => p.name === provinces.value);
                if (province) {
                    province.level2s.forEach(district => {
                        const option = new Option(district.name, district.name);
                        districts.add(option);
                    });

                    if (oldDistrict) {
                        districts.value = oldDistrict;
                        districtHidden.value = oldDistrict;
                        districts.dispatchEvent(new Event("change"));
                    }
                }
            });
    });

    districts.addEventListener("change", function () {
        districtHidden.value = this.value;
        wards.innerHTML = '<option value="">-- Chọn phường/xã --</option>';
        wardHidden.value = '';

        fetch("/vn-addresses.json")
            .then(res => res.json())
            .then(data => {
                const province = data.data.find(p => p.name === provinces.value);
                const district = province?.level2s.find(d => d.name === districts.value);
                if (district) {
                    district.level3s.forEach(ward => {
                        const option = new Option(ward.name, ward.name);
                        wards.add(option);
                    });

                    if (oldWard) {
                        wards.value = oldWard;
                        wardHidden.value = oldWard;
                    }
                }
            });
    });

    wards.addEventListener("change", function () {
        wardHidden.value = this.value;
    });
</script>
<script>
    let provinces = document.getElementById("province");
    let districts = document.getElementById("district");
    let wards = document.getElementById("ward");

    let provinceHidden = document.getElementById("province-hidden");
    let districtHidden = document.getElementById("district-hidden");
    let wardHidden = document.getElementById("ward-hidden");

    let oldProvince = @json(old('province', $user->province));
    let oldDistrict = @json(old('district', $user->district));
    let oldWard = @json(old('ward', $user->ward));

    fetch("/vn-addresses.json")
        .then(res => res.json())
        .then(data => {
            // Load province
            data.data.forEach(province => {
                const option = new Option(province.name, province.name);
                provinces.add(option);
            });

            if (oldProvince) {
                provinces.value = oldProvince;
                provinceHidden.value = oldProvince;
                provinces.dispatchEvent(new Event("change"));
            }
        });

    provinces.addEventListener("change", function () {
        provinceHidden.value = this.value;
        districts.innerHTML = '<option value="">-- Chọn quận/huyện --</option>';
        wards.innerHTML = '<option value="">-- Chọn phường/xã --</option>';
        districtHidden.value = '';
        wardHidden.value = '';

        fetch("/vn-addresses.json")
            .then(res => res.json())
            .then(data => {
                const province = data.data.find(p => p.name === provinces.value);
                if (province) {
                    province.level2s.forEach(district => {
                        const option = new Option(district.name, district.name);
                        districts.add(option);
                    });

                    if (oldDistrict) {
                        districts.value = oldDistrict;
                        districtHidden.value = oldDistrict;
                        districts.dispatchEvent(new Event("change"));
                    }
                }
            });
    });

    districts.addEventListener("change", function () {
        districtHidden.value = this.value;
        wards.innerHTML = '<option value="">-- Chọn phường/xã --</option>';
        wardHidden.value = '';

        fetch("/vn-addresses.json")
            .then(res => res.json())
            .then(data => {
                const province = data.data.find(p => p.name === provinces.value);
                const district = province?.level2s.find(d => d.name === districts.value);
                if (district) {
                    district.level3s.forEach(ward => {
                        const option = new Option(ward.name, ward.name);
                        wards.add(option);
                    });

                    if (oldWard) {
                        wards.value = oldWard;
                        wardHidden.value = oldWard;
                    }
                }
            });
    });

    wards.addEventListener("change", function () {
        wardHidden.value = this.value;
    });
</script>
