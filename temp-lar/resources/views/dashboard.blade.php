<x-layout>
    <div class="mb-6 flex flex-col gap-2 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <!-- <p class="text-sm font-semibold uppercase tracking-wide text-green-700">Production Monitoring</p> -->
            <h1 class="text-2xl font-bold text-emerald-900 sm:text-3xl">Dashboard</h1>
        </div>
        <div class="inline-flex w-fit items-center rounded-lg border border-green-200 bg-green-50 px-3 py-2 text-sm font-medium text-green-800">
            API Summary
        </div>
    </div>

    <section class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-3">
        <x-kpi-card title="Total Machine" value="-" value_id="total-machine" color="green">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 3v1.5M4.5 8.25H3m18 0h-1.5M4.5 12H3m18 0h-1.5m-15 3.75H3m18 0h-1.5M8.25 19.5V21M12 3v1.5m0 15V21m3.75-18v1.5m0 15V21m-9-1.5h10.5a2.25 2.25 0 0 0 2.25-2.25V6.75a2.25 2.25 0 0 0-2.25-2.25H6.75A2.25 2.25 0 0 0 4.5 6.75v10.5a2.25 2.25 0 0 0 2.25 2.25Zm.75-12h9v9h-9v-9Z" />
            </svg>

        </x-kpi-card>

        <x-kpi-card title="Running Work Order" value="-" value_id="running-order" color="blue">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z" />
            </svg>


        </x-kpi-card>

        <x-kpi-card title="Finished Work Order" value="-" value_id="finished-order" color="emerald">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M11.35 3.836c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m8.9-4.414c.376.023.75.05 1.124.08 1.131.094 1.976 1.057 1.976 2.192V16.5A2.25 2.25 0 0 1 18 18.75h-2.25m-7.5-10.5H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V18.75m-7.5-10.5h6.375c.621 0 1.125.504 1.125 1.125v9.375m-8.25-3 1.5 1.5 3-3.75" />
            </svg>

        </x-kpi-card>

        <x-kpi-card title="Achievement" value="-" value_id="achievement" color="amber">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" />
            </svg>

        </x-kpi-card>
        <x-kpi-card title="Good Qty" value="-" value_id="good-qty" color="cyan">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 0 1-1.043 3.296 3.745 3.745 0 0 1-3.296 1.043A3.745 3.745 0 0 1 12 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 0 1-3.296-1.043 3.745 3.745 0 0 1-1.043-3.296A3.745 3.745 0 0 1 3 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 0 1 1.043-3.296 3.746 3.746 0 0 1 3.296-1.043A3.746 3.746 0 0 1 12 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 0 1 3.296 1.043 3.746 3.746 0 0 1 1.043 3.296A3.745 3.745 0 0 1 21 12Z" />
            </svg>

        </x-kpi-card>

        <x-kpi-card title="Reject Qty" value="-" value_id="reject-qty" color="rose">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
            </svg>

        </x-kpi-card>

    </section>
    <section class="mt-6 grid grid-cols-1 gap-4 lg:grid-cols-2">
        <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
            <h2 class="text-base font-semibold text-slate-900">Trend Produksi 7 Hari</h2>
            <div class="mt-4 h-72">
                <canvas id="trendChart"></canvas>
            </div>
        </div>

        <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
            <h2 class="text-base font-semibold text-slate-900">Status Work Order</h2>
            <div class="mt-4 h-72">
                <canvas id="statusChart"></canvas>
            </div>
            <div id="statusLegend" class="flex flex-col mt-2 justify-center gap-2">

            </div>
        </div>

        <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm lg:col-span-2">
            <h2 class="text-base font-semibold text-slate-900">Top 10 Machines (Good Qty)</h2>
            <div class="mt-4 h-80">
                <canvas id="topMachineChart"></canvas>
            </div>
        </div>
    </section>

    <table class="min-w-full mt-4">
        <thead>
            <tr class="border-b border-slate-200">
                <th class="px-4 py-3 text-left text-xs font-semibold uppercase text-emerald-700">
                    Rank
                </th>
                <th class="px-4 py-3 text-left text-xs font-semibold uppercase text-emerald-700">
                    Machine
                </th>
                <th class="px-4 py-3 text-left text-xs font-semibold uppercase text-emerald-700">
                    Code
                </th>
                <th class="px-4 py-3 text-right text-xs font-semibold uppercase text-emerald-700">
                    Good Qty
                </th>
            </tr>
        </thead>

        <tbody id="topMachineTable">
        </tbody>
    </table>


    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2"></script>
    <script>
        const statusColors = ['#2563eb', '#16a34a', '#f59e0b', '#e11d48'];
        const formatNumber = (value) => new Intl.NumberFormat('en-US').format(value ?? 0);

        function setText(id, value) {
            const element = document.getElementById(id);

            if (!element) {
                console.warn(`Element dengan id "${id}" tidak ditemukan`);
                return;
            }

            element.textContent = value;
        }

        fetch('/api/dashboard')
            .then((response) => response.json())
            .then((data) => {
                const summary = data.summary;

                setText('total-machine', summary.total_machine);
                setText('running-order', summary.running_order);
                setText('finished-order', summary.finished_order);
                setText('achievement', summary.achievement + '%');
                setText('good-qty', summary.today_good);
                setText('reject-qty', summary.today_reject);

                new Chart(document.getElementById('trendChart'), {
                    type: 'line',
                    data: {
                        labels: data.trend_7_days.map((item) => item.date),
                        datasets: [{
                                label: 'Good Qty',
                                data: data.trend_7_days.map((item) => item.good_qty),
                                borderColor: '#16a34a',
                                backgroundColor: 'rgba(22, 163, 74, 0.12)',
                                fill: true,
                                tension: 0.45,
                            },
                            {
                                label: 'Reject Qty',
                                data: data.trend_7_days.map((item) => item.reject_qty),
                                borderColor: '#e11d48',
                                backgroundColor: 'rgba(225, 29, 72, 0.12)',
                                fill: true,
                                tension: 0.45,
                            },
                        ],
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                    },
                });

                new Chart(document.getElementById('statusChart'), {
                    type: 'doughnut',
                    data: {
                        labels: (data.status_breakdown.map((item) => item.status)),
                        datasets: [{
                            data: data.status_breakdown.map((item) => item.total),
                            backgroundColor: ['#2563eb', '#16a34a', '#f59e0b', '#e11d48'],
                        }],
                    },
                    options: {

                        responsive: true,
                        maintainAspectRatio: false,

                    },
                });

                const statusLegend = document.getElementById('statusLegend');

                statusLegend.innerHTML = data.status_breakdown.map((item, index) => {
                    const color = statusColors[index] ?? '#64748b';

                    return `
                         <div class="flex items-center justify-between rounded-lg border border-slate-200 px-3 py-2">
                             <div class="flex items-center gap-2">
                                 <span class="h-3 w-3 rounded-full" style="background-color: ${color}"></span>
                                 <span class="text-sm font-medium text-slate-700">${item.status}</span>
                             </div>
                             <span class="text-sm font-bold text-slate-950">${item.total}</span>
                         </div>
                         `;
                }).join('');

                const topMachineTable = document.getElementById('topMachineTable');

                if (topMachineTable) {
                    topMachineTable.innerHTML = data.top_machines.map((machine, index) => {

                        return `
            <tr class="border-b border-slate-100 hover:bg-slate-50">

                <td class="px-4 py-3 text-sm font-semibold text-emerald-700">
                    ${index + 1}
                </td>

                <td class="px-4 py-3">
                    <div class="text-sm font-semibold text-emerald-900">
                        ${machine.machine_name}
                    </div>
                </td>

                <td class="px-4 py-3">
                    <span class="text-sm text-emerald-500">
                        ${machine.machine_code}
                    </span>
                </td>

                <td class="px-4 py-3 text-right">
                    <span class="text-sm font-bold text-emerald-900">
                        ${formatNumber(machine.good_qty)}
                    </span>
                </td>

            </tr>
        `;

                    }).join('');

                }

                new Chart(document.getElementById('topMachineChart'), {
                    type: 'bar',
                    data: {
                        labels: data.top_machines.map((item) => item.machine_name),
                        datasets: [{
                            label: 'Good Qty',
                            data: data.top_machines.map((item) => item.good_qty),
                            backgroundColor: '#0f766e',
                            borderRadius: 6,
                        }],
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                    },
                });
            })
            .catch((error) => {
                console.error('Gagal mengambil data dashboard:', error);
            });
    </script>

    @endpush
</x-layout>