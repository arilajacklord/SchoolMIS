<x-app-layout>
  <div class="page-inner mt--5">
    <div class="row">
      <div class="col-md-12">
        <div class="card bg-blue">
          <div class="card-header bg-blue">
            <h4 class="card-title">List of Users</h4>
          </div>

          <div class="card-body">
            @if (session('success'))
              <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="table-responsive">
              <table class="table table-striped table-hover">
                <thead>
                  <tr>
                    <th>ID Number</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Type</th>
                    <th>Date Created</th>
                    <th>Action</th>
                   
                  </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                        <tr>
                        <td>{{ $user->id_number }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ ucfirst($user->type) }}</td>
                        <td>{{ \Carbon\Carbon::parse($user->created_at)->format('M d, Y') }}</td>
                        <td>
                            <a href="{{ route('users.show', $user->id) }}" class="btn btn-info btn-sm">View</a>
                        </td>
                        </tr>
                    @empty
                        <tr>
                        <td colspan="6" class="text-center text-muted">No users found.</td>
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