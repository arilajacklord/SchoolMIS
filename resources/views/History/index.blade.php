<x-app-layout>
    <div class="page-inner">
        <div class="card border-0 shadow-sm rounded-3">

            <div class="card-header bg-light">
                <h4 class="fw-bold mb-0">Borrow History</h4>
            </div>

            <div class="card-body">

                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>User</th>
                            <th>Book</th>
                            <th>Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody>
                        @php $row = 1; @endphp

                        @foreach ($borrows as $borrow)

                            {{-- Borrowed Row --}}
                            <tr>
                                <td>{{ $row++ }}</td>
                                <td>{{ $borrow->user->name }}</td>
                                <td>{{ $borrow->book->title }}</td>
                                <td>{{ \Carbon\Carbon::parse($borrow->date_borrowed)->format('M d, Y') }}</td>
                                <td class="text-primary fw-bold">Borrowed</td>
                            </tr>

                            {{-- Returned Row --}}
                            @if ($borrow->date_returned)
                                <tr>
                                    <td>{{ $row++ }}</td>
                                    <td>{{ $borrow->user->name }}</td>
                                    <td>{{ $borrow->book->title }}</td>
                                    <td>{{ \Carbon\Carbon::parse($borrow->date_returned)->format('M d, Y') }}</td>
                                    <td class="text-success fw-bold">Returned</td>
                                </tr>
                            @endif

                        @endforeach
                    </tbody>

                </table>

            </div>
        </div>
    </div>
</x-app-layout>
