<x-app-layout>



    <canvas id="myChart" width="400" height="200"></canvas>
    <canvas id="revenueChart" width="400" height="200"></canvas>
    <canvas id="orderStatusChart" width="400" height="200"></canvas>
    <canvas id="topProductChart" width="400" height="200"></canvas>



    <!-- Thêm Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Script -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Chart 1: Bar chart
            new Chart(document.getElementById('myChart'), {
                type: 'bar',
                data: {
                    labels: ['Red', 'Blue', 'Yellow', 'Green'],
                    datasets: [{
                        label: 'Số lượng',
                        data: [12, 19, 3, 5],
                        backgroundColor: ['rgba(255,99,132,0.5)', 'rgba(54,162,235,0.5)',
                            'rgba(255,206,86,0.5)', 'rgba(75,192,192,0.5)'
                        ],
                        borderColor: ['rgba(255,99,132,1)', 'rgba(54,162,235,1)',
                            'rgba(255,206,86,1)', 'rgba(75,192,192,1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            // Chart 2: Line chart - Doanh thu
            new Chart(document.getElementById('revenueChart'), {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May'],
                    datasets: [{
                        label: 'Doanh thu (triệu VND)',
                        data: [20, 30, 25, 35, 40],
                        backgroundColor: 'rgba(75,192,192,0.4)',
                        borderColor: 'rgba(75,192,192,1)',
                        tension: 0.4
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            // Chart 3: Pie chart - Trạng thái đơn hàng
            new Chart(document.getElementById('orderStatusChart'), {
                type: 'pie',
                data: {
                    labels: ['Đã giao', 'Đang xử lý', 'Đã hủy'],
                    datasets: [{
                        data: [50, 30, 20],
                        backgroundColor: ['#36A2EB', '#FFCE56', '#FF6384'],
                        borderWidth: 1
                    }]
                }
            });

            // Chart 4: Horizontal bar - Sản phẩm bán chạy
            new Chart(document.getElementById('topProductChart'), {
                type: 'bar',
                data: {
                    labels: ['Sản phẩm A', 'Sản phẩm B', 'Sản phẩm C'],
                    datasets: [{
                        label: 'Số lượng bán',
                        data: [100, 80, 60],
                        backgroundColor: 'rgba(153,102,255,0.6)',
                        borderColor: 'rgba(153,102,255,1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    indexAxis: 'y',
                    scales: {
                        x: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>
</x-app-layout>
