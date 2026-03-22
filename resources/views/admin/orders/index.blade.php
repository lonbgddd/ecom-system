<x-app-layout>

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">
                    Quản lý hoá đơn
                </h2>

                <p class="text-sm text-gray-500">
                    Theo dõi đơn mua khoá học và doanh thu
                </p>
            </div>
        </div>
    </x-slot>


    <div class="p-6 space-y-6">

        {{-- TABS --}}
        <div class="flex gap-4 border-b pb-2">

            <button onclick="showTab('orders')"
                class="tab-btn font-medium text-blue-600">

                Danh sách hoá đơn

            </button>

            <button onclick="showTab('revenue')"
                class="tab-btn text-gray-500">

                Thống kê doanh thu

            </button>

        </div>


        {{-- ================= ORDERS TABLE ================= --}}
        <div id="ordersTab">

            <div class="overflow-hidden rounded-xl border bg-white shadow-sm">

                <table class="min-w-full divide-y">

                    <thead class="bg-gray-50">

                        <tr>

                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">
                                User
                            </th>

                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">
                                Khoá học
                            </th>

                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">
                                Giá
                            </th>

                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">
                                Trạng thái
                            </th>

                            <th class="px-6 py-3 text-center text-xs font-semibold text-gray-500 uppercase">
                                Hành động
                            </th>

                        </tr>

                    </thead>

                    <tbody class="divide-y">

                        @foreach($orders as $order)

                        <tr class="hover:bg-gray-50">

                            <td class="px-6 py-4">

                                <div class="font-medium">
                                    {{ $order->user->name }}
                                </div>

                                <div class="text-xs text-gray-500">
                                    {{ $order->user->email }}
                                </div>

                            </td>

                            <td class="px-6 py-4">
                                {{ $order->course->title }}
                            </td>

                            <td class="px-6 py-4">
                                {{ number_format($order->price) }} đ
                            </td>

                            <td class="px-6 py-4">

                                @if($order->status=='pending')

                                <span class="px-2 py-1 text-xs bg-yellow-100 text-yellow-700 rounded">
                                    Chờ duyệt
                                </span>

                                @endif

                                @if($order->status=='paid')

                                <span class="px-2 py-1 text-xs bg-green-100 text-green-700 rounded">
                                    Đã duyệt
                                </span>

                                @endif

                            </td>

                            <td class="px-6 py-4 text-center">

                                @if($order->status=='pending')

                                <form method="POST"
                                    action="{{ route('admin.orders.approve',$order->id) }}">

                                    @csrf

                                    <button
                                        class="px-3 py-1 bg-green-600 text-white text-xs rounded">
                                        Duyệt
                                    </button>

                                </form>

                                @endif

                            </td>

                        </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

            <div class="mt-4">
                {{ $orders->links() }}
            </div>

        </div>


        {{-- ================= REVENUE TAB ================= --}}
        <div id="revenueTab" class="hidden">

            <div class="bg-white p-6 rounded-xl border shadow">

                <h3 class="text-lg font-semibold mb-4">
                    Doanh thu theo tháng
                </h3>

                <canvas id="revenueChart"></canvas>

            </div>

        </div>


    </div>


    {{-- ================= CHART SCRIPT ================= --}}

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        function showTab(tab) {

            document.getElementById('ordersTab').classList.add('hidden')
            document.getElementById('revenueTab').classList.add('hidden')

            if (tab === 'orders') {
                document.getElementById('ordersTab').classList.remove('hidden')
            }

            if (tab === 'revenue') {
                document.getElementById('revenueTab').classList.remove('hidden')
            }

        }


        const ctx = document.getElementById('revenueChart')

        if (ctx) {

            new Chart(ctx, {

                type: 'bar',

                data: {

                    labels: [
                        'T1', 'T2', 'T3', 'T4', 'T5', 'T6',
                        'T7', 'T8', 'T9', 'T10', 'T11', 'T12'
                    ],

                    datasets: [{

                        label: 'Doanh thu',

                        data: @json($chartData),

                        borderWidth: 1

                    }]

                }

            })

        }
    </script>

</x-app-layout>