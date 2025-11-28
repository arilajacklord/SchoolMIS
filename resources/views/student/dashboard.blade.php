<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight flex items-center gap-2">
            <i class="fas fa-tachometer-alt text-indigo-600"></i>
            {{ __('Dashboard Overview') }}
        </h2>
    </x-slot>

    <div class="py-10 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- ✅ DASHBOARD CARDS --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
                @php
                    $cards = [
                        ['title'=>'Total Students','value'=>$students ?? 120,'icon'=>'fa-user-graduate','color'=>'indigo'],
                        ['title'=>'Total Teachers','value'=>$teachers ?? 25,'icon'=>'fa-chalkboard-teacher','color'=>'green'],
                        ['title'=>'Available Subjects','value'=>$subjects ?? 45,'icon'=>'fa-book-open','color'=>'yellow'],
                        ['title'=>'Courses Offered','value'=>$courses ?? 10,'icon'=>'fa-graduation-cap','color'=>'red'],
                    ];
                @endphp

                @foreach($cards as $card)
                    <div class="bg-white p-6 rounded-2xl shadow-md hover:shadow-lg transition-all duration-300 border-t-4 border-{{ $card['color'] }}-500">
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="text-sm font-semibold text-gray-500">{{ $card['title'] }}</p>
                                <h2 class="text-4xl font-extrabold text-{{ $card['color'] }}-600 mt-2">{{ $card['value'] }}</h2>
                            </div>
                            <div class="text-{{ $card['color'] }}-500 text-4xl opacity-80">
                                <i class="fas {{ $card['icon'] }}"></i>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- ✅ CHART SECTION --}}
            <div class="bg-white rounded-2xl shadow p-8 mb-10">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-bold text-gray-800 flex items-center gap-2">
                        <i class="fas fa-chart-bar text-indigo-600"></i> Enrollment Overview
                    </h3>
                    <select id="chartFilter" class="border-gray-300 rounded-lg text-sm px-2 py-1 focus:ring-indigo-500 focus:border-indigo-500">
                        <option>Current Semester</option>
                        <option>Last Semester</option>
                        <option>Last Year</option>
                    </select>
                </div>
                <canvas id="enrollmentChart" height="110"></canvas>
            </div>

            {{-- ✅ RECENT SUBJECTS TABLE --}}
            <div class="bg-white rounded-2xl shadow p-8">
                <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center gap-2">
                    <i class="fas fa-book text-yellow-500"></i> Recent Subjects
                </h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full table-auto border-collapse text-sm">
                        <thead>
                            <tr class="bg-gray-100 text-gray-700 uppercase">
                                <th class="py-3 px-4 text-left">Subject Code</th>
                                <th class="py-3 px-4 text-left">Subject Title</th>
                                <th class="py-3 px-4 text-left">Department</th>
                                <th class="py-3 px-4 text-left">Slots</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentSubjects ?? [
                                ['code'=>'ENG101', 'title'=>'English Grammar', 'dept'=>'Arts', 'slots'=>30],
                                ['code'=>'CS102', 'title'=>'Computer Programming', 'dept'=>'IT', 'slots'=>25],
                                ['code'=>'MATH203', 'title'=>'Advanced Algebra', 'dept'=>'Math', 'slots'=>40],
                                ['code'=>'PHY301', 'title'=>'Physics Fundamentals', 'dept'=>'Science', 'slots'=>35],
                            ] as $subject)
                                <tr class="border-b hover:bg-indigo-50 transition">
                                    <td class="py-3 px-4 font-medium text-gray-800">{{ $subject['code'] }}</td>
                                    <td class="py-3 px-4 text-gray-700">{{ $subject['title'] }}</td>
                                    <td class="py-3 px-4 text-gray-700">{{ $subject['dept'] }}</td>
                                    <td class="py-3 px-4 text-gray-700">{{ $subject['slots'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

    {{-- ✅ Chart.js --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('enrollmentChart').getContext('2d');
        const gradient = ctx.createLinearGradient(0, 0, 0, 400);
        gradient.addColorStop(0, 'rgba(99,102,241,0.8)');
        gradient.addColorStop(1, 'rgba(99,102,241,0.1)');

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['BSIT', 'BSBA', 'BSED', 'BEED', 'BSHM'],
                datasets: [{
                    label: 'Enrolled Students',
                    data: [120, 90, 75, 60, 45],
                    backgroundColor: gradient,
                    borderColor: '#6366F1',
                    borderWidth: 1,
                    borderRadius: 6,
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { color: '#4B5563' },
                        grid: { color: '#E5E7EB' }
                    },
                    x: {
                        ticks: { color: '#4B5563' },
                        grid: { display: false }
                    }
                },
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: '#111827',
                        titleColor: '#F9FAFB',
                        bodyColor: '#E5E7EB',
                        padding: 10,
                        borderColor: '#4F46E5',
                        borderWidth: 1
                    }
                }
            }
        });
    </script>

    {{-- ✅ Font Awesome --}}
    <script src="https://kit.fontawesome.com/a2e0e6ad00.js" crossorigin="anonymous"></script>
</x-app-layout>
