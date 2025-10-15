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
                                        <td>{{ $book->id }}</td>
                                        <td>{{ $book->title }}</td>
                                        <td>{{ $book->author }}</td>
                                        <td>{{ $book->date_pub }}</td>
                                        <td>{{ $book->status }}</td>
                                        <td>{{ $book->date_purchased }}</td>
                                        <td>
                                            <!-- Edit button -->
                                            <button type="button" class="btn btn-warning btn-sm"
                                                data-bs-toggle="modal" data-bs-target="#editBookModal{{ $book->id }}">
                                                Edit
                                            </button>

                                            <!-- View button -->
                                            <button type="button" class="btn btn-info btn-sm"
                                                data-bs-toggle="modal" data-bs-target="#viewBookModal{{ $book->id }}">
                                                View
                                            </button>

                                            <!-- Delete -->
                                            <form action="{{ route('books.destroy', $book->book_id) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Are you sure?')">
                                                    Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>

                                    <!-- Edit Modal -->
                                    <div class="modal fade" id="editBookModal{{ $book->id }}" tabindex="-1" aria-hidden="true">
                                      <div class="modal-dialog">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <h5 class="modal-title">Edit Book</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                          </div>
                                          <div class="modal-body">
                                            <form method="POST" action="{{ route('books.update', $book->book_id) }}">
                                              @csrf
                                              @method('PUT')

                                              <div class="mb-3">
                                                <label class="form-label">Title</label>
                                                <input type="text" class="form-control" name="title" value="{{ $book->title }}" required>
                                              </div>

                                              <div class="mb-3">
                                                <label class="form-label">Author</label>
                                                <input type="text" class="form-control" name="author" value="{{ $book->author }}" required>
                                              </div>

                                              <div class="mb-3">
                                                <label class="form-label">Date Published</label>
                                                <input type="date" class="form-control" name="date_pub" value="{{ $book->date_pub }}" required>
                                              </div>

                                              <div class="mb-3">
                                                <label class="form-label">Status</label>
                                                <select class="form-select" name="status" required>
                                                  <option value="Available" {{ $book->status == 'Available' ? 'selected' : '' }}>Available</option>
                                                  <option value="Checked Out" {{ $book->status == 'Checked Out' ? 'selected' : '' }}>Checked Out</option>
                                                </select>
                                              </div>

                                              <div class="mb-3">
                                                <label class="form-label">Date Purchased</label>
                                                <input type="date" class="form-control" name="date_purchased" value="{{ $book->date_purchased }}" required>
                                              </div>

                                              <button type="submit" class="btn btn-primary">Update Book</button>
                                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            </form>
                                          </div>
                                        </div>
                                      </div>
                                    </div>

                                    <!-- View Modal -->
                                    <div class="modal fade" id="viewBookModal{{ $book->id }}" tabindex="-1" aria-hidden="true">
                                      <div class="modal-dialog">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <h5 class="modal-title">Book Details</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                          </div>
                                          <div class="modal-body">
                                            <form>
                                              <div class="mb-3">
                                                <label class="form-label">Title</label>
                                                <input type="text" class="form-control" value="{{ $book->title }}" disabled>
                                              </div>
                                              <div class="mb-3">
                                                <label class="form-label">Author</label>
                                                <input type="text" class="form-control" value="{{ $book->author }}" disabled>
                                              </div>
                                              <div class="mb-3">
                                                <label class="form-label">Date Published</label>
                                                <input type="date" class="form-control" value="{{ $book->date_pub }}" disabled>
                                              </div>
                                              <div class="mb-3">
                                                <label class="form-label">Status</label>
                                                <input type="text" class="form-control" value="{{ $book->status }}" disabled>
                                              </div>
                                              <div class="mb-3">
                                                <label class="form-label">Date Purchased</label>
                                                <input type="date" class="form-control" value="{{ $book->date_purchased }}" disabled>
                                              </div>
                                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            </form>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Book Modal -->
<div class="modal fade" id="addBookModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add New Book</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{ route('books.store') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label">Title</label>
                <input type="text" class="form-control" name="title" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Author</label>
                <input type="text" class="form-control" name="author" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Date Published</label>
                <input type="date" class="form-control" name="date_pub" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Status</label>
                <select class="form-select" name="status" required>
                    <option value="Available">Available</option>
                    <option value="Checked Out">Checked Out</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Date Purchased</label>
                <input type="date" class="form-control" name="date_purchased" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Book</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </form>
      </div>
    </div>
  </div>
</div>
</x-app-layout>