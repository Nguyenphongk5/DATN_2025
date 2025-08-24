<x-app-layout>
    <div class="p-8 space-y-12 bg-gradient-to-br from-white via-blue-50 to-cyan-50 min-h-screen">
        <div
            class="flex items-center gap-3 bg-gradient-to-r from-indigo-500 via-sky-500 to-cyan-400 rounded-2xl shadow-xl px-8 py-6 mb-10">
            <i class="fas fa-tachometer-alt text-3xl text-white drop-shadow-lg animate-pulse"></i>
            <h2 class="font-extrabold text-3xl text-white tracking-wide drop-shadow-lg">Bảng điều khiển</h2>
        </div>

        {{-- Form lọc --}}
        <form method="GET" action="{{ route('admin.dashboard') }}"
            class="flex flex-col md:flex-row items-center justify-center gap-6 mb-10">
            <div>
                <label for="from_date" class="block mb-1 text-sm font-bold text-indigo-700">Từ ngày:</label>
                <input type="date" name="from_date" id="from_date" value="{{ request('from_date') }}"
                    class="border border-indigo-200 rounded-xl px-4 py-2 shadow">
            </div>
            <div>
                <label for="to_date" class="block mb-1 text-sm font-bold text-indigo-700">Đến ngày:</label>
                <input type="date" name="to_date" id="to_date" value="{{ request('to_date') }}"
                    class="border border-indigo-200 rounded-xl px-4 py-2 shadow">
            </div>
            <div class="pt-5">
                <button type="submit"
                    class="bg-gradient-to-r from-sky-400 to-indigo-500 hover:from-indigo-500 hover:to-sky-400 text-white font-bold px-8 py-2 rounded-xl shadow-lg flex items-center gap-2 transition">
                    <i class="fas fa-filter"></i> Lọc
                </button>
            </div>
        </form>

        {{-- Biểu đồ --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
            <div class="bg-white/90 shadow-2xl rounded-3xl p-8">
                <h3 class="font-extrabold text-lg text-indigo-600 mb-4"><i class="fas fa-chart-line"></i> Doanh thu theo
                    tháng</h3>
                <canvas id="revenueChart" height="200"></canvas>
            </div>
            <div class="bg-white/90 shadow-2xl rounded-3xl p-8">
                <h3 class="font-extrabold text-lg text-indigo-600 mb-4"><i class="fas fa-clipboard-list"></i> Trạng thái
                    đơn hàng</h3>
                <canvas id="orderStatusChart" height="200"></canvas>
            </div>
            <div class="bg-white/90 shadow-2xl rounded-3xl p-8">
                <h3 class="font-extrabold text-lg text-indigo-600 mb-4"><i class="fas fa-crown"></i> Top sản phẩm bán
                    chạy</h3>
                <canvas id="topProductChart" height="200"></canvas>
            </div>
            <div class="bg-white/90 shadow-2xl rounded-3xl p-8">
                <h3 class="font-extrabold text-lg text-indigo-600 mb-4"><i class="fas fa-palette"></i> Số lượng theo màu
                </h3>
                <canvas id="colorChart" height="200"></canvas>
            </div>
        </div>

        {{-- Bảng tồn kho --}}
        <div class="bg-white/90 shadow-2xl rounded-3xl p-8 mt-12">
            <h3 class="font-extrabold text-lg text-indigo-600 mb-6"><i class="fas fa-boxes"></i> Bảng tồn kho</h3>
            <div class="overflow-x-auto rounded-2xl">
                <table class="w-full border-collapse shadow-xl rounded-2xl overflow-hidden">
                    <thead class="bg-gradient-to-r from-indigo-100 via-sky-100 to-cyan-100 text-indigo-700">
                        <tr>
                            <th class="px-6 py-3">Sản phẩm</th>
                            <th class="px-6 py-3">Màu</th>
                            <th class="px-6 py-3">Size</th>
                            <th class="px-6 py-3">Tồn kho</th>
                            <th class="px-6 py-3">Trạng thái</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-indigo-100 text-center">
                        @foreach ($stockData as $item)
                            <tr class="{{ $item->quantity < 10 ? 'bg-red-100' : '' }}">
                                <td class="px-6 py-3">{{ $item->product_name }}</td>
                                <td class="px-6 py-3">{{ $item->color_name }}</td>
                                <td class="px-6 py-3">{{ $item->size }}</td>
                                <td class="px-6 py-3">{{ number_format($item->quantity) }}</td>
                                <td class="px-6 py-3">
                                    @if ($item->quantity < 10)
                                        <span class="text-red-600 font-bold">Sắp hết hàng</span>
                                    @else
                                        <span class="text-green-600 font-bold">Còn hàng</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Tỉ lệ đơn hàng --}}
        <div class="bg-white/90 shadow-2xl rounded-3xl p-8 mt-12">
            <h3 class="font-extrabold text-lg text-indigo-600 mb-6"><i class="fas fa-percentage"></i> Tỉ lệ đã giao /
                hủy / hoàn (%)</h3>
            <ul class="space-y-2">
                @foreach ($percentStatus as $status => $percent)
                    <li>{{ ucfirst($status) }}: <strong>{{ $percent }}%</strong></li>
                @endforeach
            </ul>
        </div>
    </div>

    {{-- ChartJS --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Doanh thu
            new Chart(document.getElementById('revenueChart'), {
                type: 'bar',
                data: {
                    labels: {!! json_encode($months ?? []) !!},
                    datasets: [{
                        label: 'Doanh thu (VNĐ)',
                        data: {!! json_encode($revenues ?? []) !!},
                        backgroundColor: 'rgba(75, 192, 192, 0.6)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 2
                    }]
                },
                options: {
                    plugins: {
                        datalabels: {
                            anchor: 'end',
                            align: 'top',
                            formatter: v => v.toLocaleString('vi-VN') + ' ₫',
                            color: '#000',
                            font: {
                                weight: 'bold'
                            }
                        }
                    },
                    scales: {
                        y: {
                            ticks: {
                                callback: v => v.toLocaleString('vi-VN') + ' ₫'
                            }
                        }
                    }
                },
                plugins: [ChartDataLabels]
            });

            // Trạng thái đơn hàng
            new Chart(document.getElementById('orderStatusChart'), {
                type: 'pie',
                data: {
                    labels: {!! json_encode(array_keys($orderStatusCounts ?? [])) !!},
                    datasets: [{
                        data: {!! json_encode(array_values($orderStatusCounts ?? [])) !!},
                        backgroundColor: ['#36A2EB', '#FFCE56', '#FF6384', '#4BC0C0', '#9966FF']
                    }]
                },
                options: {
                    plugins: {
                        datalabels: {
                            formatter: v => v,
                            color: '#fff',
                            font: {
                                weight: 'bold'
                            }
                        },
                        legend: {
                            position: 'bottom'
                        }
                    }
                },
                plugins: [ChartDataLabels]
            });

            // Top sản phẩm
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
                    plugins: {
                        datalabels: {
                            anchor: 'end',
                            align: 'right',
                            formatter: v => v.toLocaleString('vi-VN'),
                            color: '#000',
                            font: {
                                weight: 'bold'
                            }
                        }
                    },
                    scales: {
                        x: {
                            ticks: {
                                callback: v => v.toLocaleString('vi-VN')
                            }
                        }
                    }
                },
                plugins: [ChartDataLabels]
            });

            // Số lượng theo màu
            new Chart(document.getElementById('colorChart'), {
                type: 'bar',
                data: {
                    labels: {!! json_encode($colors ?? []) !!},
                    datasets: [{
                        label: 'Số lượng',
                        data: {!! json_encode($colorQuantities ?? []) !!},
                        backgroundColor: 'rgba(255, 159, 64, 0.6)',
                        borderColor: 'rgba(255, 159, 64, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    plugins: {
                        datalabels: {
                            anchor: 'end',
                            align: 'top',
                            formatter: v => v.toLocaleString('vi-VN'),
                            color: '#000',
                            font: {
                                weight: 'bold'
                            }
                        }
                    },
                    scales: {
                        y: {
                            ticks: {
                                callback: v => v.toLocaleString('vi-VN')
                            }
                        }
                    }
                },
                plugins: [ChartDataLabels]
            });
        });
    </script>
</x-app-layout>
