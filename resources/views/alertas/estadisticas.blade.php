<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-800">Estadísticas de Alertas</h2>
    </x-slot>

    <div class="max-w-6xl mx-auto py-6 grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-yellow-100 text-yellow-800 rounded-xl shadow p-6">
            <h3 class="text-lg font-semibold mb-2">Pendientes</h3>
            <p class="text-3xl font-bold">{{ $pendientes }}</p>
            <p class="text-sm">({{ round($porcentajePendientes, 2) }}%) del total</p>
        </div>

        <div class="bg-green-100 text-green-800 rounded-xl shadow p-6">
            <h3 class="text-lg font-semibold mb-2">Atendidas</h3>
            <p class="text-3xl font-bold">{{ $atendidas }}</p>
            <p class="text-sm">({{ round($porcentajeAtendidas, 2) }}%) del total</p>
        </div>

        <div class="col-span-1 md:col-span-2 mt-6">
            <canvas id="alertasChart" class="w-full"></canvas>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('alertasChart').getContext('2d');
        const chart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Pendientes', 'Atendidas'],
                datasets: [{
                    data: [{{ $pendientes }}, {{ $atendidas }}],
                    backgroundColor: ['#facc15', '#22c55e'],
                }]
            },
            options: {
                responsive: true,
                plugins: { legend: { position: 'bottom' } }
            }
        });
    </script>
</x-app-layout>
