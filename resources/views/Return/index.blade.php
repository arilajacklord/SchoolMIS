<x-app-layout>
  <div class="page-inner mt--5">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Returned Books</h4>
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
                      <td><span class="badge bg-primary">Returned</span></td>
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
