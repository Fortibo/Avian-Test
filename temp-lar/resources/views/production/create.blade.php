<x-layout>

    <div class="mb-6">
        <h1 class="text-2xl font-bold text-slate-950 sm:text-3xl">
            Production Result
        </h1>


    </div>


    <div class="max-w-3xl rounded-xl border border-slate-200 bg-white p-6 shadow-sm">

        <form id="productionForm">

            <div class="grid grid-cols-1 gap-5 md:grid-cols-2">


                <div class="md:col-span-2">

                    <label
                        for="wo_number"
                        class="mb-1 block text-sm font-medium text-slate-700">
                        Work Order
                    </label>

                    <input
                        id="wo_number"
                        name="wo_number"
                        type="text"
                        required
                        placeholder="Example: WO2026000914"
                        class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm focus:border-green-500 focus:ring-green-500">

                    <p class="mt-1 text-xs text-slate-500">
                        Hanya work orders yang berjalan (RUNNING) dapat menerima hasil produksi.
                    </p>

                </div>



                <div>

                    <label
                        for="qty_good"
                        class="mb-1 block text-sm font-medium text-slate-700">
                        Good Quantity
                    </label>

                    <input
                        id="qty_good"
                        name="qty_good"
                        type="number"
                        min="0"
                        required
                        class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm">

                </div>



                <div>

                    <label
                        for="qty_reject"
                        class="mb-1 block text-sm font-medium text-slate-700">
                        Reject Quantity
                    </label>

                    <input
                        id="qty_reject"
                        name="qty_reject"
                        type="number"
                        min="0"
                        required
                        class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm">

                </div>



                <div>

                    <label
                        for="production_date"
                        class="mb-1 block text-sm font-medium text-slate-700">
                        Production Date (Actual Start)
                    </label>

                    <input
                        id="production_date"
                        name="production_date"
                        type="datetime-local"
                        required
                        class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm">

                </div>



                <div>

                    <label
                        for="actual_finish"
                        class="mb-1 block text-sm font-medium text-slate-700">
                        Actual Finish
                    </label>

                    <input
                        id="actual_finish"
                        name="actual_finish"
                        type="datetime-local"
                        required
                        class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm">

                </div>



                <div>

                    <label
                        for="runtime_minutes"
                        class="mb-1 block text-sm font-medium text-slate-700">
                        Runtime (Minutes)
                    </label>

                    <input
                        id="runtime_minutes"
                        name="runtime_minutes"
                        type="number"
                        min="0"
                        required
                        class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm">

                </div>

            </div>



            <div
                id="errorMessage"
                class="mt-5 hidden rounded-lg border border-red-200 bg-red-50 p-4 text-sm text-red-700"></div>



            <div
                id="successMessage"
                class="mt-5 hidden rounded-lg border border-green-200 bg-green-50 p-4 text-sm text-green-700"></div>


            <div class="mt-6 flex justify-end gap-3">

                <a
                    href="/production-orders"
                    class="rounded-lg border border-slate-300 px-4 py-2 text-sm font-medium text-slate-700 hover:bg-slate-50">
                    Cancel
                </a>

                <button
                    type="submit"
                    id="submitBtn"
                    class="rounded-lg bg-green-600 px-4 py-2 text-sm font-medium text-white hover:bg-green-700 disabled:cursor-not-allowed disabled:opacity-50">
                    Save Result
                </button>

            </div>

        </form>

    </div>


    @push('scripts')

    <script>
        document
            .getElementById('productionForm')
            .addEventListener('submit', async function(event) {

                event.preventDefault();

                const form = event.target;

                const submitBtn = document.getElementById('submitBtn');
                const errorMessage = document.getElementById('errorMessage');
                const successMessage = document.getElementById('successMessage');

                errorMessage.classList.add('hidden');
                successMessage.classList.add('hidden');

                submitBtn.disabled = true;
                submitBtn.textContent = 'Saving...';


                const payload = {
                    wo_number: document.getElementById('wo_number').value,
                    qty_good: Number(document.getElementById('qty_good').value),
                    qty_reject: Number(document.getElementById('qty_reject').value),
                    production_date: document.getElementById('production_date').value,
                    actual_finish: document.getElementById('actual_finish').value,
                    runtime_minutes: Number(
                        document.getElementById('runtime_minutes').value
                    ),
                };


                try {

                    const response = await fetch(
                        '/api/production-results', {
                            method: 'POST',

                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                            },

                            body: JSON.stringify(payload),
                        }
                    );


                    const data = await response.json();


                    if (!response.ok) {

                        if (data.errors) {

                            const errors = Object.values(data.errors)
                                .flat()
                                .join('<br>');

                            errorMessage.innerHTML = errors;

                        } else {

                            errorMessage.textContent =
                                data.message ?? 'Failed to save production result.';
                        }

                        errorMessage.classList.remove('hidden');

                        return;
                    }


                    successMessage.innerHTML = `
                Production Result berhasil ditambahkan.
                Achievement:
                <strong>${data.data.achievement}%</strong>
            `;

                    successMessage.classList.remove('hidden');

                    form.reset();


                } catch (error) {

                    console.error(error);

                    errorMessage.textContent =
                        'Terjadi kesalahan saat menghubungi server.';

                    errorMessage.classList.remove('hidden');

                } finally {

                    submitBtn.disabled = false;
                    submitBtn.textContent = 'Save Production Result';

                }

            });
    </script>
    @endpush
</x-layout>