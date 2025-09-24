<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Student Registration') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            {{-- Flash success message --}}
            @if(session('success'))
                <div class="mb-4 p-4 rounded-md bg-green-100 text-green-700">
                    {{ session('success') }}
                </div>
            @endif

            <div class="mb-4 flex justify-end">
                <a href="{{ route('registration.create') }}"
                   class="px-4 py-2 bg-blue-600 text-white rounded-md shadow hover:bg-blue-700">
                    + New Registration
                </a>
            </div>

            <div class="overflow-x-auto bg-white shadow-md rounded-lg">
                <table class="min-w-full text-sm text-left text-gray-700">
                    <thead class="bg-gray-100 text-gray-800 uppercase text-xs font-bold">
                        <tr>
                            <th class="px-4 py-3">#</th>
                            <th class="px-4 py-3">Student Name</th>
                            <th class="px-4 py-3">Course Level</th>
                            <th class="px-4 py-3">Status</th>
                            <th class="px-4 py-3">Father</th>
                            <th class="px-4 py-3">Mother</th>
                            <th class="px-4 py-3 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($registration as $reg)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="px-4 py-3">{{ $loop->iteration }}</td>
                                <td class="px-4 py-3 font-medium">{{ $reg->student_name }}</td>
                                <td class="px-4 py-3">{{ $reg->course_level }}</td>
                                <td class="px-4 py-3">
                                    <span class="px-2 py-1 text-xs rounded 
                                        {{ $reg->student_status === 'active' ? 'bg-green-100 text-green-700' : 'bg-gray-200 text-gray-600' }}">
                                        {{ ucfirst($reg->student_status) }}
                                    </span>
                                </td>
                                <td class="px-4 py-3">
                                    {{ $reg->father_Fname }} {{ $reg->father_Lname }}
                                </td>
                                <td class="px-4 py-3">
                                    {{ $reg->mother_Fname }} {{ $reg->mother_Lname }}
                                </td>
                                <td class="px-4 py-3 text-right">
                                    <a href="{{ route('registration.show', $reg) }}" 
                                       class="text-blue-600 hover:underline">View</a> |
                                    <a href="{{ route('registration.edit', $reg) }}" 
                                       class="text-yellow-600 hover:underline">Edit</a> |
                                    <form action="{{ route('registration.destroy', $reg) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="text-red-600 hover:underline"
                                                onclick="return confirm('Are you sure you want to delete this registration?')">
                                            Delete
                                        </button>
                                    </form>
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
