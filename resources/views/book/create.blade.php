<x-app-layout>
<div class="page-inner mt--5">
        <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <h5 class="card-title" id="addBookModalLabel">Add New Book</h5>
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
              <label for="published_year" class="form-label">Published Year</label>
              <input type="number" class="form-control" id="published_year" name="published_year" required>
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
</div>
</x-app-layout>