<x-app-layout>
<div class="modal fade" id="editBookModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5>Edit Book</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form id="editBookForm" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="author" class="form-label">Author</label>
                <input type="text" class="form-control" id="editAuthor" name="author" required>
            </div>
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="editTitle" name="title" required>
            </div>
                 <div class="mb-3">
                <label for="date_pub" class="form-label">Date Publish</label>
                <input type="text" class="form-control" id="editDate_Pub" name="date_pub" required>
            </div>
                <div class="mb-3">
                    <label for="status{{ $book->id }}" class="form-label">Status</label>
                    <select class="form-select" id="status{{ $book->id }}" name="status" required>
                        <option value="Available" {{ $book->status == 'Available' ? 'selected' : '' }}>Available</option>
                        <option value="Checked Out" {{ $book->status == 'Checked Out' ? 'selected' : '' }}>Checked Out</option>
                    </select>
                </div>
               <div class="mb-3">
                <label for="date_purchased" class="form-label">Date Purchased</label>
                <input type="text" class="form-control" id="editDate_Purchased" name="date_purchased" required>
            </div>
                <button type="submit" class="btn btn-primary">Update Book</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
</x-app-layout>