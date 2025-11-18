  <x-app-layout>
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <div class="page-inner mt--5">
      <div class="row">
        <div class="col-md-12">
          <div class="card border-0 shadow-lg rounded-4">
            <div class="card-header d-flex justify-content-between align-items-center bg-white border-0">
              <h4 class="card-title fw-bold mb-0">
                <i class="bi bi-book me-2 text-primary"></i> Book List
              </h4>
              <div>
                <button type="button" class="btn btn-success me-2" data-bs-toggle="modal" data-bs-target="#borrowBookModal">
                  <i class="bi bi-journal-arrow-down me-1"></i> Borrow Book
                </button>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addBookModal">
                  <i class="bi bi-plus-lg me-1"></i> Add New Book
                </button>
              </div>
            </div>

            @if ($errors->any())
              <div class="alert alert-danger m-3">
                <ul class="mb-0">
                  @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
            @endif

            <div class="card-body">
              <div class="table-responsive">
                <table id="basic-datatables" class="display table table-striped table-hover align-middle">
                  <thead class="table-light">
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
                        <td>
                          @if($book->status == 'Available')
                            <span class="badge bg-success">Available</span>
                          @else
                            <span class="badge bg-danger">Checked Out</span>
                          @endif
                        </td>
                        <td>{{ $book->date_purchased }}</td>
                        <td>
                          <div class="d-flex gap-1">
                            <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editBookModal{{ $book->book_id }}">
                              <i class="bi bi-pencil"></i>
                            </button>
                            <button type="button" class="btn btn-info btn-sm text-white" data-bs-toggle="modal" data-bs-target="#viewBookModal{{ $book->book_id }}">
                              <i class="bi bi-eye"></i>
                            </button>
                            <form action="{{ route('books.destroy', $book->book_id) }}" method="POST" style="display:inline-block;">
                              @csrf
                              @method('DELETE')
                              <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this book?')">
                                <i class="bi bi-trash"></i>
                              </button>
                            </form>
                          </div>
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

    <!-- ====================== ADD BOOK MODAL ====================== -->
  <div class="modal fade" id="addBookModal" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg rounded-3">
          <div class="modal-header bg-primary text-white">
            <h5 class="modal-title fw-bold"><i class="bi bi-plus-lg me-2"></i> Add New Book</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
          </div>
          <form method="POST" action="{{ route('books.store') }}">
            @csrf
            <div class="modal-body px-4 py-3">
              <div class="row g-3">
                <div class="col-md-6">
                  <label class="form-label fw-semibold">Title</label>
                  <input type="text" class="form-control" name="title" required>
                </div>
                <div class="col-md-6">
                  <label class="form-label fw-semibold">Author</label>
                  <input type="text" class="form-control" name="author" required>
                </div>
                <div class="col-md-6">
                  <label class="form-label fw-semibold">Date Published</label>
                  <input type="date" class="form-control" name="date_pub" required>
                </div>
                <div class="col-md-6">
                  <label class="form-label fw-semibold">Status</label>
                  <select class="form-select" name="status" required>
                    <option value="Available" selected>Available</option>
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
              <button type="submit" class="btn btn-primary">Add Book</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  <!-- 🍎 Borrow Book Modal -->
  <div class="modal fade" id="borrowBookModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
      <div class="modal-content border-0 shadow-lg rounded-4">
        <div class="modal-header bg-success text-white">
          <h5 class="modal-title fw-bold">
            <i class="bi bi-journal-arrow-down me-2"></i> Borrow a Book
          </h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body p-4">

          <!-- 🔍 Search Bar -->
          <div class="mb-3">
            <input type="text" id="searchBook" class="form-control" placeholder="Search book...">
          </div>

          <!-- 📚 Table -->
          <div class="table-responsive">
            <table class="table table-striped table-hover align-middle">
              <thead class="table-success">
                <tr>
                  <th>ID</th>
                  <th>Title</th>
                  <th>Author</th>
                  <th>Date Published</th>
                  <th>Status</th>
                  <th>Date Purchased</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody id="bookList">
                @foreach($books as $book)
                  @if($book->status == 'Available')
                    <tr>
                      <td>{{ $book->book_id }}</td>
                      <td>{{ $book->title }}</td>
                      <td>{{ $book->author }}</td>
                      <td>{{ $book->date_pub }}</td>
                      <td><span class="badge bg-success">{{ $book->status }}</span></td>
                      <td>{{ $book->date_purchased }}</td>
                      <td>
                        <form action="{{ route('borrow.store') }}" method="POST">
                          @csrf
                          <input type="hidden" name="book_id" value="{{ $book->book_id }}">
                          <button type="submit" class="btn btn-success btn-sm">
                            <i class="bi bi-journal-arrow-down"></i> Borrow
                          </button>
                        </form>
                      </td>
                    </tr>
                  @endif
                @endforeach
              </tbody>
            </table>
          </div>

          <!-- 📄 Pagination Controls -->
          <div id="paginationControls" class="d-flex justify-content-between align-items-center mt-3">
            <button id="prevPage" class="btn btn-outline-secondary btn-sm" disabled>Previous</button>
            <span id="pageInfo" class="fw-semibold text-muted small"></span>
            <button id="nextPage" class="btn btn-outline-primary btn-sm">Next</button>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-light border" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <!-- 🧠 Pagination + Search Script -->
  <script>
  document.addEventListener('DOMContentLoaded', function () {
    const rows = Array.from(document.querySelectorAll('#bookList tr'));
    const rowsPerPage = 10;
    let currentPage = 1;
    const prevButton = document.getElementById('prevPage');
    const nextButton = document.getElementById('nextPage');
    const pageInfo = document.getElementById('pageInfo');
    const searchInput = document.getElementById('searchBook');

    function getFilteredRows() {
      const query = searchInput.value.toLowerCase();
      return rows.filter(row => row.innerText.toLowerCase().includes(query));
    }

    function showPage(page, filteredRows = null) {
      const data = filteredRows || getFilteredRows();
      const totalPages = Math.ceil(data.length / rowsPerPage);
      const start = (page - 1) * rowsPerPage;
      const end = start + rowsPerPage;

      rows.forEach(row => row.style.display = 'none');
      data.slice(start, end).forEach(row => row.style.display = '');

      prevButton.disabled = page === 1;
      nextButton.disabled = page >= totalPages;
      pageInfo.textContent = `Page ${page} of ${totalPages || 1}`;
    }

    prevButton.addEventListener('click', () => {
      if (currentPage > 1) {
        currentPage--;
        showPage(currentPage);
      }
    });

    nextButton.addEventListener('click', () => {
      const filteredRows = getFilteredRows();
      if (currentPage * rowsPerPage < filteredRows.length) {
        currentPage++;
        showPage(currentPage, filteredRows);
      }
    });

    searchInput.addEventListener('keyup', function () {
      currentPage = 1;
      showPage(currentPage);
    });

    showPage(currentPage);
  });
  </script>

    <!-- ====================== EDIT & VIEW MODALS ====================== -->
    @foreach($books as $book)
      <!-- Edit Modal -->
      <div class="modal fade" id="editBookModal{{ $book->book_id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
          <div class="modal-content border-0 shadow-lg rounded-3">
            <div class="modal-header bg-warning text-dark">
              <h5 class="modal-title fw-bold"><i class="bi bi-pencil-square me-2"></i> Edit Book</h5>
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
              <h5 class="modal-title"><i class="bi bi-eye me-2"></i> Book Details</h5>
              <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
              <div class="row">
                <div class="col-md-6 mb-3">
                  <div class="card border-0 bg-light p-3 shadow-sm">
                    <h6 class="text-muted mb-1">Title</h6>
                    <h5 class="fw-semibold">{{ $book->title }}</h5>
                  </div>
                </div>
                <div class="col-md-6 mb-3">
                  <div class="card border-0 bg-light p-3 shadow-sm">
                    <h6 class="text-muted mb-1">Author</h6>
                    <h5 class="fw-semibold">{{ $book->author }}</h5>
                  </div>
                </div>
                <div class="col-md-6 mb-3">
                  <div class="card border-0 bg-light p-3 shadow-sm">
                    <h6 class="text-muted mb-1">Date Published</h6>
                    <h5 class="fw-semibold">{{ \Carbon\Carbon::parse($book->date_pub)->format('F d, Y') }}</h5>
                  </div>
                </div>
                <div class="col-md-6 mb-3">
                  <div class="card border-0 bg-light p-3 shadow-sm">
                    <h6 class="text-muted mb-1">Status</h6>
                    @if($book->status == 'Available')
                      <span class="badge bg-success p-2">Available</span>
                    @else
                      <span class="badge bg-danger p-2">Checked Out</span>
                    @endif
                  </div>
                </div>
                <div class="col-md-12 mb-3">
                  <div class="card border-0 bg-light p-3 shadow-sm">
                    <h6 class="text-muted mb-1">Date Purchased</h6>
                    <h5 class="fw-semibold">{{ \Carbon\Carbon::parse($book->date_purchased)->format('F d, Y') }}</h5>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer bg-light">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                <i class="bi bi-x-lg me-1"></i> Close
              </button>
            </div>
          </div>
        </div>
      </div>
    @endforeach

    <!-- SEARCH FILTER SCRIPT -->
    <script>
      document.getElementById('searchBook').addEventListener('keyup', function() {
        const query = this.value.toLowerCase();
        document.querySelectorAll('#bookList tr').forEach(row => {
          const text = row.innerText.toLowerCase();
          row.style.display = text.includes(query) ? '' : 'none';
        });
      });
    </script>
  </x-app-layout>
