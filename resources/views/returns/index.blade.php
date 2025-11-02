<x-app-layout>
  <div class="page-inner mt--5">
    <div class="row">
      <div class="col-md-12">
        <div class="card border-0 shadow-lg rounded-4">
          <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
            <h4 class="card-title fw-bold mb-0">
              <i class="bi bi-arrow-return-left text-primary me-2"></i> Returned Books
            </h4>
          </div>

          <div class="card-body">
            @if (session('success'))
              <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="table-responsive">
              <table class="table table-striped table-hover align-middle">
                <thead class="table-light">
                  <tr>
                    <th>#</th>
                    <th>Borrower</th>
                    <th>Book Title</th>
                    <th>Date Borrowed</th>
                    <th>Date Returned</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse ($returns as $index => $return)
                    <tr>
                      <td>{{ $index + 1 }}</td>
                      <td>{{ $return->user->name ?? 'Unknown' }}</td>
                      <td>{{ $return->book->title ?? 'Unknown' }}</td>
                      <td>{{ \Carbon\Carbon::parse($return->date_borrowed)->format('M d, Y') }}</td>
                      <td>{{ \Carbon\Carbon::parse($return->date_returned)->format('M d, Y') }}</td>
                      <td><span class="badge bg-success">Returned</span></td>
                    </tr>
                  @empty
                    <tr>
                      <td colspan="6" class="text-center text-muted">No returned books yet.</td>
                    </tr>
                  @endforelse
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
