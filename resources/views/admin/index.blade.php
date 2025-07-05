<x-app-layout>
    <div class="p-6 space-y-10">
        <h2 class="text-2xl font-bold text-center">Bảng điều khiển</h2>

        {{-- Form lọc theo ngày --}}
        <form method="GET" action="{{ route('admin.dashboard') }}" class="flex flex-col md:flex-row items-center justify-center gap-4 mb-6">
            <div>
                <label for="from_date" class="block mb-1 text-sm">Từ ngày:</label>
                <input type="date" name="from_date" id="from_date" value="{{ request('from_date') }}" class="border rounded px-3 py-2">
            </div>
            <div>
                <label for="to_date" class="block mb-1 text-sm">Đến ngày:</label>
                <input type="date" name="to_date" id="to_date" value="{{ request('to_date') }}" class="border rounded px-3 py-2">
            </div>
            <div class="pt-5">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Lọc</button>
            </div>
        </form>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
            {{-- Biểu đồ doanh thu --}}
            <div class="bg-white shadow p-4 rounded-lg">
                <h3 class="text-lg font-semibold text-center mb-2">Doanh thu theo tháng</h3>
                <canvas id="revenueChart" height="200"></canvas>
            </div>

            {{-- Trạng thái đơn hàng --}}
            <div class="bg-white shadow p-4 rounded-lg">
                <h3 class="text-lg font-semibold text-center mb-2">Trạng thái đơn hàng</h3>
                <canvas id="orderStatusChart" height="200"></canvas>
            </div>

            {{-- Top sản phẩm bán chạy --}}
            <div class="bg-white shadow p-4 rounded-lg">
                <h3 class="text-lg font-semibold text-center mb-2">Top sản phẩm bán chạy</h3>
                <canvas id="topProductChart" height="200"></canvas>
            </div>

            {{-- Màu sản phẩm phổ biến --}}
            <div class="bg-white shadow p-4 rounded-lg">
                <h3 class="text-lg font-semibold text-center mb-2">Số lượng theo màu</h3>
                <canvas id="colorChart" height="200"></canvas>
            </div>
        </div>

        {{-- Bảng: Tồn kho --}}
        <div class="bg-white shadow p-4 rounded-lg">
            <h3 class="text-lg font-semibold mb-4">Bảng tồn kho</h3>
            <div class="overflow-x-auto">
                <table class="w-full table-auto border">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="px-3 py-2">Sản phẩm</th>
                            <th class="px-3 py-2">Màu</th>
                            <th class="px-3 py-2">Size</th>
                            <th class="px-3 py-2">Tồn kho</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @foreach ($stockData as $item)
                            <tr>
                                <td class="px-3 py-2">{{ $item->product_name }}</td>
                                <td class="px-3 py-2">{{ $item->color_name }}</td>
                                <td class="px-3 py-2">{{ $item->size }}</td>
                                <td class="px-3 py-2">{{ $item->quantity }}</td>
                            </tr>
                        @endforeach --}}
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Tỷ lệ đã giao / huỷ / hoàn --}}
        <div class="bg-white shadow p-4 rounded-lg">
            <h3 class="text-lg font-semibold mb-4">Các lệnh đã giao / huỷ / hoàn (%)</h3>
            <ul class="space-y-1">
                {{-- @foreach ($percentStatus as $status => $percent)
                    <li>{{ ucfirst($status) }}: <strong>{{ $percent }}%</strong></li>
                @endforeach --}}
            </ul>
        </div>
    </div>

    {{-- ChartJS --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            new Chart(document.getElementById('revenueChart'), {
                type: 'line',
                data: {
                    labels: {!! json_encode($months ?? []) !!},
                    datasets: [{
                        label: 'Doanh thu (VNĐ)',
                        data: {!! json_encode($revenues ?? []) !!},
                        backgroundColor: 'rgba(75, 192, 192, 0.3)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 2,
                        tension: 0.3,
                        fill: true
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: value => value.toLocaleString('vi-VN') + ' ₫'
                            }
                        }
                    }
                }
            });

            new Chart(document.getElementById('orderStatusChart'), {
                type: 'pie',
                data: {
                    labels: {!! json_encode(array_keys($orderStatusCounts ?? [])) !!},
                    datasets: [{
                        data: {!! json_encode(array_values($orderStatusCounts ?? [])) !!},
                        backgroundColor: ['#36A2EB', '#FFCE56', '#FF6384', '#4BC0C0', '#9966FF']
                    }]
                },
                options: { plugins: { legend: { position: 'bottom' } } }
            });

            new Chart(document.getElementById('topProductChart'), {
                type: 'bar',
                data: {
                    labels: {!! json_encode($topProductNames ?? []) !!},
                    datasets: [{
                        label: 'Số lượng bán',
                        data: {!! json_encode($topProductQuantities ?? []) !!},
                        backgroundColor: 'rgba(153, 102, 255, 0.6)',
                        borderColor: 'rgba(153, 102, 255, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    indexAxis: 'y',
                    scales: { x: { beginAtZero: true } }
                }
            });

            new Chart(document.getElementById('colorChart'), {
                type: 'bar',
                data: {
                    labels: {!! json_encode($colors ?? []) !!},
                    datasets: [{
                        label: 'Số lượng theo màu',
                        data: {!! json_encode($colorQuantities ?? []) !!},
                        backgroundColor: 'rgba(255, 159, 64, 0.5)',
                        borderColor: 'rgba(255, 159, 64, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: { y: { beginAtZero: true } }
                }
            });
        });
    </script>
</x-app-layout>
