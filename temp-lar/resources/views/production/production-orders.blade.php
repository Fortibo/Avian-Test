<x-layout>

    <div class="mb-6 flex justify-between">
        <h1 class="text-2xl font-bold text-emerald-900 sm:text-3xl">
            Production Orders
        </h1>

        <a href="/production-results" class=" px-4 py-2 rounded-lg text-white  bg-green-600 hover:bg-green-700 font-bold">Input Data</a>
        <!-- <p class="mt-1 text-sm text-slate-500">
            Monitor dan managemen production work orders
        </p> -->
    </div>


    <!-- filter -->
    <section class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">

        <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-4">

            <!-- search -->
            <div class="lg:col-span-2">
                <label class="mb-1 block text-sm font-medium text-slate-700">
                    Search
                </label>

                <input
                    id="search"
                    type="text"
                    placeholder="Search WO number or product..."
                    class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm focus:border-green-500 focus:ring-green-500">
            </div>

            <!-- prod -->
            <div>
                <label class="mb-1 block text-sm font-medium text-slate-700">
                    Product
                </label>

                <input
                    id="product"
                    type="text"
                    placeholder="Product code/name"
                    class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm">
            </div>

            <!-- mesin -->
            <div>
                <label class="mb-1 block text-sm font-medium text-slate-700">
                    Machine
                </label>

                <input
                    id="machine"
                    type="text"
                    placeholder="Machine code"
                    class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm">
            </div>

            <!-- stats-->
            <div>
                <label class="mb-1 block text-sm font-medium text-slate-700">
                    Status
                </label>

                <select
                    id="status"
                    class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm">
                    <option value="">All Status</option>
                    <option value="RUNNING">RUNNING</option>
                    <option value="FINISHED">FINISHED</option>
                </select>
            </div>

            <!-- tanggal -->
            <div>
                <label class="mb-1 block text-sm font-medium text-slate-700">
                    Plan Date
                </label>

                <input
                    id="date"
                    type="date"
                    class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm">
            </div>

            <!-- sort -->
            <div>
                <label class="mb-1 block text-sm font-medium text-slate-700">
                    Sort
                </label>

                <select
                    id="sort"
                    class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm">
                    <option value="plan_start">Plan Start</option>
                    <option value="wo_number">WO Number</option>
                    <option value="target_qty">Target Qty</option>
                    <option value="plan_finish">Plan Finish</option>
                    <option value="status">Status</option>
                </select>
            </div>

            <!-- sort dir -->
            <div>
                <label class="mb-1 block text-sm font-medium text-slate-700">
                    Direction
                </label>

                <select
                    id="dir"
                    class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm">
                    <option value="desc">Descending</option>
                    <option value="asc">Ascending</option>
                </select>
            </div>

        </div>


        <div class="mt-4 flex justify-end gap-2">

            <button
                id="resetBtn"
                type="button"
                class="rounded-lg border border-slate-300 px-4 py-2 text-sm font-medium text-slate-700 hover:bg-slate-50">
                Reset
            </button>

            <button
                id="searchBtn"
                type="button"
                class="rounded-lg bg-green-600 px-4 py-2 text-sm font-medium text-white hover:bg-green-700">
                Search
            </button>

        </div>

    </section>


    <!-- Table -->
    <section class="mt-6 rounded-xl border border-slate-200 bg-white shadow-sm">

        <div class="overflow-x-auto">

            <table class="w-full text-left text-sm">

                <thead class="border-b border-slate-200 bg-slate-50 text-xs uppercase text-emerald-700">

                    <tr>
                        <th class="px-5 py-3">WO Number</th>
                        <th class="px-5 py-3">Product</th>
                        <th class="px-5 py-3">Machine</th>
                        <th class="px-5 py-3">Employee</th>
                        <th class="px-5 py-3">Shift</th>
                        <th class="px-5 py-3 text-right">Target</th>
                        <th class="px-5 py-3">Plan Start</th>
                        <th class="px-5 py-3">Plan Finish</th>
                        <th class="px-5 py-3">Status</th>
                    </tr>

                </thead>

                <tbody id="ordersTable">
                </tbody>

            </table>

        </div>


        <!-- Pagination -->
        <div
            id="pagination"
            class="flex flex-col gap-3 border-t border-slate-200 px-5 py-4 sm:flex-row sm:items-center sm:justify-between">
        </div>

    </section>


    @push('scripts')

    <script>
        let currPage = 1;

        const formatNumber = (val) => {
            return new Intl.NumberFormat('en-US').format(val)
        };

        function formatDate(date) {

            if (!date) return '-';

            return new Date(date).toLocaleString('id-ID', {
                dateStyle: 'medium',
                timeStyle: 'short'
            });
        }

        function getParams(page = 1) {
            const params = new URLSearchParams();

            const search = document.getElementById('search').value;
            const product = document.getElementById('product').value;
            const machine = document.getElementById('machine').value;
            const status = document.getElementById('status').value;
            const date = document.getElementById('date').value;
            const sort = document.getElementById('sort').value;
            const dir = document.getElementById('dir').value;

            if (search) params.set('search', search);
            if (product) params.set('product', product);
            if (machine) params.set('machine', machine);
            if (status) params.set('status', status);
            if (date) params.set('date', date);

            params.set('sort', sort);
            params.set('dir', dir);
            params.set('per_page', 20);
            params.set('page', page);

            return params;
        };

        async function loadOrders(page = 1) {

            currPage = page;

            const params = getParams(page);

            const res = await fetch(`/api/production-orders?${params.toString()}`);

            const data = await res.json();

            const pagination = data.orders;
            renderOrders(pagination.data);

            renderPagination(pagination);

        }

        function renderOrders(orders) {

            const tbody = document.getElementById('ordersTable');

            if (!orders || orders.length === 0) {

                tbody.innerHTML = `
            <tr>
                <td
                    colspan="9"
                    class="px-5 py-10 text-center text-slate-500"
                >
                    No production orders found.
                </td>
            </tr>
        `;

                return;
            }


            tbody.innerHTML = orders.map(order => {

                let statusClass = 'bg-slate-100 text-slate-700';

                if (order.status === 'RUNNING') {
                    statusClass = 'bg-blue-100 text-blue-700';
                }

                if (order.status === 'FINISHED') {
                    statusClass = 'bg-green-100 text-green-700';
                }


                return `
            <tr class="border-b border-slate-100 hover:bg-slate-50">

                <td class="px-5 py-4 font-semibold text-emerald-900">
                    ${order.wo_number}
                </td>

                <td class="px-5 py-4">
                    <div class="font-medium text-emerald-700">
                        ${order.product?.product_name ?? '-'}
                    </div>

                    <div class="text-xs text-slate-400">
                        ${order.product_code}
                    </div>
                </td>

                <td class="px-5 py-4">
                    <div class="font-medium text-emerald-700">
                        ${order.machine?.machine_name ?? '-'}
                    </div>

                    <div class="text-xs text-slate-400">
                        ${order.machine_code}
                    </div>
                </td>

                <td class="px-5 py-4">
                    <div class="font-medium text-emerald-700">
                        ${order.employee?.full_name ?? '-'}
                    </div>

                    <div class="text-xs text-slate-400">
                        ${order.employee_no}
                    </div>
                </td>

                <td class="px-5 py-4 text-emerald-700">
                    ${order.shift}
                </td>

                <td class="px-5 py-4 text-right font-medium text-emerald-900">
                    ${formatNumber(order.target_qty)}
                </td>

                <td class="px-5 py-4 whitespace-nowrap text-emerald-900">
                    ${formatDate(order.plan_start)}
                </td>

                <td class="px-5 py-4 whitespace-nowrap text-emerald-900">
                    ${formatDate(order.plan_finish)}
                </td>

                <td class="px-5 py-4">

                    <span
                        class="inline-flex rounded-full px-2.5 py-1 text-xs font-semibold ${statusClass}"
                    >
                        ${order.status}
                    </span>

                </td>

            </tr>
        `;

            }).join('');
        }



        function renderPagination(data) {

            const container = document.getElementById('pagination');

            if (!container) return;

            if (!data || data.total === 0) {
                container.innerHTML = '';
                return;
            }

            const current = data.current_page;
            const last = data.last_page;

            let pages = [];


            pages.push(1);


            let start = Math.max(2, current - 2);
            let end = Math.min(last - 1, current + 2);


            if (start > 2) {
                pages.push('...');
            }


            for (let page = start; page <= end; page++) {
                pages.push(page);
            }


            if (end < last - 1) {
                pages.push('...');
            }


            if (last > 1) {
                pages.push(last);
            }


            // Previous button
            let html = ` <button
        type = "button"
        onclick = "loadOrders(${current - 1})"
        ${
            current <= 1 ? 'disabled' : ''
        }
        class = "rounded-lg border border-slate-300 px-3 py-2 text-sm
        text-slate-700 hover:bg-slate-50
        disabled:cursor-not-allowed disabled:opacity - 40 " >
        Previous </button>
        `;


            // Page buttons
            pages.forEach(page => {

                if (page === '...') {

                    html += ` <span class = "px-2 text-sm text-slate-400" >
        ...
        </span>
        `;

                    return;
                }


                const active = page === current;

                html += ` <button
        type = "button"
        onclick = "loadOrders(${page})"
        class = "rounded-lg border px-3 py-2 text-sm
        ${
            active
                ?
                'border-green-600 bg-green-600 text-white' :
                'border-slate-300 text-slate-700 hover:bg-slate-50'
        }
        ">
        ${
            page
        } </button>
        `;
            });


            // Next button
            html += ` <button
        type = "button"
        onclick = "loadOrders(${current + 1})"
        ${
            current >= last ? 'disabled' : ''
        }
        class = "rounded-lg border border-slate-300 px-3 py-2 text-sm
        text-slate-700 hover:bg-slate-50
        disabled:cursor-not-allowed disabled:opacity-40 " >
        Next </button>
        `;


            container.innerHTML = ` <div class = "text-sm py-2 text-slate-500" >
        Showing
            <span class = "font-semibold text-slate-900" >
            ${
                data.from ?? 0
            } </span> - <span class = "font-semibold text-slate-900" >
            ${
                data.to ?? 0
            } </span> of <span class = "font-semibold text-slate-900" >
            ${
                data.total ?? 0
            } </span> </
            div >

            <div class = "flex flex-wrap items-center gap-1" >
            ${
                html
            } </div>
        `;
        }






        document.getElementById('searchBtn').addEventListener('click', () => {
            loadOrders(1);
        });

        document.getElementById('resetBtn').addEventListener('click', () => {
            document.getElementById('search').value = '';
            document.getElementById('product').value = '';
            document.getElementById('machine').value = '';
            document.getElementById('status').value = '';
            document.getElementById('date').value = '';
            document.getElementById('sort').value = 'plan_start';
            document.getElementById('dir').value = 'desc';

            loadOrders(1);
        });


        loadOrders();
    </script>
    @endpush
</x-layout>