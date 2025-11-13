<x-app-layout>
  <div class="page-inner mt--5">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Borrowed Books</h4>
          </div>

          <div class="card-body">
            @if (session('success'))
              <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="table-responsive">
              <table class="table table-striped table-hover">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>User</th>
                    <th>Book</th>
                    <th>Date Borrowed</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse ($borrowedbooks as $index => $borrowedbook)
                    <tr>
                      <td>{{ $index + 1 }}</td>
                      <td>{{ $borrowedbook->user->name ?? 'Unknown' }}</td>
                      <td>{{ $borrowedbook->book->title ?? 'Unknown' }}</td>
                      <td>{{ \Carbon\Carbon::parse($borrowedbook->date_borrowed)->format('M d, Y') }}</td>
                      <td><span class="badge bg-warning text-dark">Borrowed</span></td>
                    </tr>
                  @empty
                    <tr>
                      <td colspan="5" class="text-center text-muted">No borrowed books yet.</td>
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