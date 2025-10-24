  <x-app-layout>
  <div class="page-inner mt--5">
      <div class="row">
          <div class="col-md-12">
              <div class="card">
                  <div class="card-header">
                      <h4 class="card-title">Book List</h4>
                      <button type="button" class="btn btn-primary float-right" data-bs-toggle="modal" data-bs-target="#addBookModal">
                          Add New Book
                      </button>
                  </div>

                  @if ($errors->any())
                      <div class="alert alert-danger">
                          <ul>
                              @foreach ($errors->all() as $error)
                                  <li>{{ $error }}</li>
                              @endforeach
                          </ul>
                      </div>
                  @endif

                  <div class="card-body">
                      <div class="table-responsive">
                          <table id="basic-datatables" class="display table table-striped table-hover">
                              <thead>
                                  <tr>
                                      <th>ID</th>
                                      <th>Title</th>
                                      <th>Author</th>
                                      <th>Date Published</th>
                                      <th>Status</th>
                                      <th>Date Purchased</th>
                                      <th>Actions</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  @foreach($books as $book)
                                      <tr>
                                          <td>{{ $book->book_id }}</td>
                                          <td>{{ $book->title }}</td>
                                          <td>{{ $book->author }}</td>
                                          <td>{{ $book->date_pub }}</td>
                                          <td>{{ $book->status }}</td>
                                          <td>{{ $book->date_purchased }}</td>
                                          <td>
                                              <!-- Edit button -->
                                              <button type="button" class="btn btn-warning btn-sm"
                                                  data-bs-toggle="modal" data-bs-target="#editBookModal{{ $book->book_id }}">
                                                  Edit
                                              </button>

                                              <!-- View button -->
                                              <button type="button" class="btn btn-info btn-sm"
                                                  data-bs-toggle="modal" data-bs-target="#viewBookModal{{ $book->book_id }}">
                                                  View
                                              </button>

                                              <!-- Delete -->
                                              <form action="{{ route('books.destroy', $book->book_id) }}" method="POST" style="display:inline-block;">
                                                  @csrf
                                                  @method('DELETE')
                                                  <button type="submit" class="btn btn-danger btn-sm"
                                                      onclick="return confirm('Are you sure you want to delete this book?')">
                                                      Delete
                                                  </button>
                                              </form>
                                          </td>
                                      </tr>
                                  @endforeach
                              </tbody>
                          </table>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>

  <!-- ADD BOOK MODAL -->
<div class="modal fade" id="addBookModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content border-0 shadow-lg rounded-3">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title fw-bold">➕ Add New Book</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <form method="POST" action="{{ route('books.store') }}">
        @csrf
        <div class="modal-body px-4 py-3">
          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label fw-semibold">Title</label>
              <input type="text" class="form-control" name="title" placeholder="Enter book title" required>
            </div>
            <div class="col-md-6">
              <label class="form-label fw-semibold">Author</label>
              <input type="text" class="form-control" name="author" placeholder="Enter author name" required>
            </div>
            <div class="col-md-6">
              <label class="form-label fw-semibold">Date Published</label>
              <input type="date" class="form-control" name="date_pub" required>
            </div>
            <div class="col-md-6">
              <label class="form-label fw-semibold">Status</label>
              <select class="form-select" name="status" required>
                <option value="Available">Available</option>
                <option value="Checked Out">Checked Out</option>
              </select>
            </div>
            <div class="col-md-6">
              <label class="form-label fw-semibold">Date Purchased</label>
              <input type="date" class="form-control" name="date_purchased" required>
            </div>
          </div>
        </div>
        <div class="modal-footer d-flex justify-content-end gap-2 px-4 py-3">
          <button type="button" class="btn btn-light border" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Save Book</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- EDIT & VIEW MODALS -->
@foreach($books as $book)
  <!-- EDIT BOOK MODAL -->
  <div class="modal fade" id="editBookModal{{ $book->book_id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content border-0 shadow-lg rounded-3">
        <div class="modal-header bg-warning text-dark">
          <h5 class="modal-title fw-bold">✏️ Edit Book</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <form method="POST" action="{{ route('books.update', $book->book_id) }}">
          @csrf
          @method('PUT')
          <div class="modal-body px-4 py-3">
            <div class="row g-3">
              <div class="col-md-6">
                <label class="form-label fw-semibold">Title</label>
                <input type="text" class="form-control" name="title" value="{{ $book->title }}" required>
              </div>
              <div class="col-md-6">
                <label class="form-label fw-semibold">Author</label>
                <input type="text" class="form-control" name="author" value="{{ $book->author }}" required>
              </div>
              <div class="col-md-6">
                <label class="form-label fw-semibold">Date Published</label>
                <input type="date" class="form-control" name="date_pub" value="{{ $book->date_pub }}" required>
              </div>
              <div class="col-md-6">
                <label class="form-label fw-semibold">Status</label>
                <select class="form-select" name="status" required>
                  <option value="Available" {{ $book->status == 'Available' ? 'selected' : '' }}>Available</option>
                  <option value="Checked Out" {{ $book->status == 'Checked Out' ? 'selected' : '' }}>Checked Out</option>
                </select>
              </div>
              <div class="col-md-6">
                <label class="form-label fw-semibold">Date Purchased</label>
                <input type="date" class="form-control" name="date_purchased" value="{{ $book->date_purchased }}" required>
              </div>
            </div>
          </div>
          <div class="modal-footer d-flex justify-content-end gap-2 px-4 py-3">
            <button type="button" class="btn btn-light border" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-warning text-dark">Update Book</button>
          </div>
        </form>
      </div>
    </div>
  </div>

 <!-- View Modal -->
<div class="modal fade" id="viewBookModal{{ $book->book_id }}" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content shadow-lg border-0 rounded-3">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title">
          <i class="fas fa-book-open me-2"></i> Book Details
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body p-4">
        <div class="row">
          <div class="col-md-6 mb-3">
            <div class="card border-0 bg-light p-3 h-100 shadow-sm">
              <h6 class="text-muted mb-1">Title</h6>
              <h5 class="fw-semibold">{{ $book->title }}</h5>
            </div>
          </div>
          <div class="col-md-6 mb-3">
            <div class="card border-0 bg-light p-3 h-100 shadow-sm">
              <h6 class="text-muted mb-1">Author</h6>
              <h5 class="fw-semibold">{{ $book->author }}</h5>
            </div>
          </div>
          <div class="col-md-6 mb-3">
            <div class="card border-0 bg-light p-3 h-100 shadow-sm">
              <h6 class="text-muted mb-1">Date Published</h6>
              <h5 class="fw-semibold">{{ \Carbon\Carbon::parse($book->date_pub)->format('F d, Y') }}</h5>
            </div>
          </div>
          <div class="col-md-6 mb-3">
            <div class="card border-0 bg-light p-3 h-100 shadow-sm">
              <h6 class="text-muted mb-1">Status</h6>
              @if($book->status == 'Available')
                <span class="badge bg-success p-2">Available</span>
              @else
                <span class="badge bg-danger p-2">Checked Out</span>
              @endif
            </div>
          </div>
          <div class="col-md-12 mb-3">
            <div class="card border-0 bg-light p-3 h-100 shadow-sm">
              <h6 class="text-muted mb-1">Date Purchased</h6>
              <h5 class="fw-semibold">{{ \Carbon\Carbon::parse($book->date_purchased)->format('F d, Y') }}</h5>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer bg-light">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
          <i class="fas fa-times me-1"></i> Close
        </button>
      </div>
    </div>
  </div>
</div>

@endforeach

  </x-app-layout>
