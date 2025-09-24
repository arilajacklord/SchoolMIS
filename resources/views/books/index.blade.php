<x-app-layout>
<div class="page-inner mt--5">
        <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <h4 class="card-title">Book List</h4>
                    <button type="button" class="btn btn-primary float-right" data-bs-toggle="modal" data-bs-target="#addBookModal"> Add New Book </button>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table
                        id="basic-datatables"
                        class="display table table-striped table-hover"
                      >
                        <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Published Year</th>
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
        <td>{{ $book->published_year }}</td>
        <td>{{ $book->status }}</td>
        <td>{{ $book->date_purchased }}</td>
       <td>
    <form action="{{ route('books.destroy', $book->book_id) }}" method="POST" style="display:inline-block;">    
    <!-- Edit -->
    <a href="{{ route('books.edit', $book->book_id) }}" class="btn btn-warning btn-sm">Edit</a>

    <!-- View -->
    <a href="{{ route('books.show', $book->book_id) }}" class="btn btn-info btn-sm">View</a>

    <!-- Delete -->
    
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
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
<!-- Add Book Modal -->
<div class="modal fade" id="addBookModal" tabindex="-1" aria-labelledby="addBookModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addBookModalLabel">Add New Book</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
       <form method="POST" action="{{ route('books.store') }}">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="mb-3">
                <label for="author" class="form-label">Author</label>
                <input type="text" class="form-control" id="author" name="author" required>
            </div>
                <div class="mb-3">
                <label for="date_pub" class="form-label">Date Published</label>
                <input type="date" class="form-control" id="date_pub" name="date_pub" required>
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-select" id="status" name="status" required>
                    <option value="Available">Available</option>
                    <option value="Checked Out">Checked Out</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="date_purchased" class="form-label">Date Purchased</label>
                <input type="date" class="form-control" id="date_purchased" name="date_purchased" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Book</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </form>
      </div>
    </div>
  </div>
</div>
</x-app-layout>

