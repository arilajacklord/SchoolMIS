<x-app-layout>
<div class="page-inner mt--5">
        <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <h5 class="card-title" id="showBookModalLabel">Book Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
        <div class="modal-body">
          <form>
                <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ $book->title }}" disabled>
                </div>
                <div class="mb-3">
                <label for="author" class="form-label">Author</label>
                <input type="text" class="form-control" id="author" name="author" value="{{ $book->author }}" disabled>
                </div>
                <div class="mb-3">
                <label for="published_year" class="form-label">Published Year</label>
                <input type="number" class="form-control" id="published_year" name="published_year" value="{{ $book->published_year }}" disabled>
                </div>
                <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <input type="text" class="form-control" id="status" name="status" value="{{ $book->status }}" disabled>
                </div>
                <div class="mb-3">
                <label for="date_purchased" class="form-label">Date Purchased</label>
                <input type="date" class="form-control" id="date_purchased" name="date_purchased" value="{{ $book->date_purchased->format('Y-m-d') }}" disabled>
                </div>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </form>
        </div>
        </div>
        </div>
        </div>
        </div>
