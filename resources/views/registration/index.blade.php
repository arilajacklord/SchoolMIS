<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">
            {{ __('Student Registration') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            {{-- Flash success message --}}
            @if(session('success'))
                <div class="mb-4 px-4 py-2 rounded bg-green-100 text-green-700">
                    {{ session('success') }}
                </div>
            @endif

            <div class="mb-4 flex justify-end">
                <a href="{{ route('registration.create') }}" class="btn btn-primary">
                    New Registration
                </a>
            </div>

            <div class="overflow-x-auto bg-white border border-gray-200 rounded">
                <table class="min-w-full text-left text-gray-700">
                    <thead class="bg-gray-50 uppercase text-xs font-medium text-gray-600">
                        <tr>
                            <th class="px-4 py-2">#</th>
                            <th class="px-4 py-2">Student Name</th>
                            <th class="px-4 py-2">Course Level</th>
                            <th class="px-4 py-2">Status</th>
                            <th class="px-4 py-2">Address</th>
                            <th class="px-4 py-2">Citizenship</th>
                            <th class="px-4 py-2 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($registrations as $reg)
                            <tr class="border-t hover:bg-gray-50">
                                <td class="px-4 py-2">{{ $loop->iteration }}</td>
                                <td class="px-4 py-2 font-medium">{{ $reg->student_name }}</td>
                                <td class="px-4 py-2">{{ $reg->course_level }}</td>
                                <td class="px-4 py-2">{{ ucfirst($reg->student_status) }}</td>
                                <td class="px-4 py-2">{{ $reg->student_address }}</td>
                                <td class="px-4 py-2">{{ $reg->student_citizenship }} </td>
                               <td class="px-4 py-2 text-right">
    <div class="flex justify-end items-center space-x-1 flex-nowrap">
        <button type="button" 
                class="btn btn-info btn-sm"
                onclick="window.location='{{ route('registration.show', $reg) }}'">
            View
        </button>

        <button type="button" 
                class="btn btn-warning btn-sm"
                onclick="window.location='{{ route('registration.edit', $reg) }}'">
            Edit
        </button>

        <form action="{{ route('registration.destroy', $reg) }}" method="POST" class="inline">
            @csrf
            @method('DELETE')
            <button type="submit" 
                    class="btn btn-danger btn-sm"
                    onclick="return confirm('Are you sure you want to delete this registration?')">
                Delete
            </button>
        </form>
    </div>
</td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-4 py-3 text-center text-gray-500">
                                    No registrations found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
