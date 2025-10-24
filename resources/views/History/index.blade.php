<x-app-layout>
  <div class="page-inner mt--5">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title">Transaction History</h4>
          </div>

          <div class="card-body">
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
                  @forelse ($histories as $index => $history)
                    <tr>
                      <td>{{ $index + 1 }}</td>
                      <td>{{ $history->user_name }}</td>
                      <td>{{ $history->book_title }}</td>
                      <td>{{ $history->date_borrowed ?? 'N/A' }}</td>
                      <td>{{ $history->date_returned ?? 'Not Returned' }}</td>
                      <td>
                        @if($history->date_returned)
                          <span class="badge bg-primary">Returned</span>
                        @else
                          <span class="badge bg-success">Borrowed</span>
                        @endif
                      </td>
                    </tr>
                  @empty
                    <tr>
                      <td colspan="6" class="text-center">No transactions yet.</td>
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
