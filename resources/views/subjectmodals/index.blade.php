<!-- jQuery CDN -->
<!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/jquery.dataTables.min.css"> -->
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <!-- <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script> -->

  <link rel="stylesheet" href="https://cdn.datatables.net/2.3.4/css/dataTables.dataTables.css" />
  
<script src="https://cdn.datatables.net/2.3.4/js/dataTables.js"></script>

<x-app-layout>

    <div class="container-xxl flex-grow-1 container-p-y mt-4">
              <div class="row">
                <!-- Bootstrap modals -->
                <div class="col-lg-12">
                 
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                     <div class="card">
                    <h5 class="card-header text-bg-danger">List of Subjects</h5>
                    <div class="col-lg-12" style="text-align: right;padding-right:20px;padding-top:10px;">
                               <button
                              type="button"
                              class="btn btn-success"
                              data-bs-toggle="modal"
                              data-bs-target="#backDropModal">
                              <i class="lni lni-add-files"></i><span> </span>  New Subject
                            </button>
                        </div>  
                    <div class="card-body">
                      <div class="row gy-3">
                         <div class="col-lg-12 mb-4 order-0">
                            <table id="myTable" class="table table-striped display " style="width:100%">
                                <thead>
                                    <tr>
                                    <th>Subject Code</th>
                                    <th>Subject Description</th>
                                    <th>Pre-requisite(s)</th>
                                    <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @foreach($results as $subject)
                                    <tr>
                                    <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{ $subject->course_code }}</strong></td>
                                    <td>{{ $subject->descriptive_title }}</td>
                                     <!-- <td>{{ $subject->total_units }}</td> -->
                                      <td>{{ $subject->pre_requisite }}</td>
                                                                      
                                        <td align="center">                               
                                         
                                            <a type="button" class="btn btn-info" id="view-subject" data-toggle="modal" data-id="{{ $subject->subject_id }}">
                                                <i class="lni lni-library"></i>   <span>View</span>
                                            </a>
                                           <button type="button" id="edit-subject" data-id="<?php echo $subject->subject_id;?>"  class="btn btn-warning " >
                                            <i class="lni lni-brush-alt"></i>   <span>Edit</span>
                                            </button>
                                             <a type="button" id="delSubj" data-id="<?php echo $subject->subject_id;?>" class="btn btn-danger" >
                                           <i class="lni lni-trash-can"></i>    <span>Delete</span>
                                        </a>
                                       
                                          
                                      </td> 

                                        
                                    </tr>
                                    @endforeach
                                </tbody>    


                            </table>
                           </div>
                          </div> 
                            <!-- Modal -->
                            <div class="modal fade" id="backDropModal" data-bs-backdrop="static" tabindex="-1">
                              <div class="modal-dialog modal-lg">
                                <form class="modal-content" method="POST" action="{{ route('subjectmodals.store') }}">
                                     @csrf
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="modal-title">Add New Subject</h5>
                                    <button type="button" class="btn-close"  data-bs-dismiss="modal" aria-label="Close"></button>
                                  </div>
                                  <div class="modal-body">
                                    <div class="row">
                                      <div class="col">
                                        <label for="nameBackdrop" class="form-label"><b>Subject Code</b></label>
                                        <input  type="text" name="course_code"id="course_code" class="form-control"  placeholder="Enter Subject Code" required/>
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="col">
                                        <label for="nameBackdrop" class="form-label"><b>Descriptive Title</b></label>
                                        <input  type="text" name="descriptive_title" id="descriptive_title" class="form-control"  placeholder="Enter Descriptive Title"  required/>
                                      </div>
                                    </div>
                                    <hr>
                                    <div class="row col-md-12">
                                        <label for="nameBackdrop" class="form-label"><b>Units</b></label>
                                      <div class="col-md-4 mb-3">
                                        <label for="nameBackdrop" class="form-label"><b>Lec Unit(s)</b></label>
                                        <input  type="number" name="led_units" id="led_units" class="form-control"  placeholder="Enter Unit(s)" required />
                                      </div>
                                      <div class="col-md-4 mb-3">
                                        <label for="nameBackdrop" class="form-label"><b>Lab Unit(s)</b></label>
                                        <input  type="number" name="lab_units" id="lab_units" class="form-control"  placeholder="Enter Unit(s)" required />
                                      </div>
                                      <div class="col-md-4 mb-3">
                                        <label for="nameBackdrop" class="form-label"><b>Total Unit(s)</b></label>
                                        <input  type="number" name="total_units" id="total_units" class="form-control"  placeholder="Enter Unit(s)" required/>
                                      </div>
                                    </div>
                                    <div class="row col-md-12">
                                      <div class="col-md-6 mb-3">
                                        <label for="nameBackdrop" class="form-label"><b>Co-Requisite</b></label>
                                        <select name="co_requisite" id="co_requisite" class="form-control" required> 
                                            <option value="" selected disabled>Select Co-Requisite</option>
                                            <option value="None">None</option>
                                            @foreach($results as $subject)
                                                <option value="{{ $subject->course_code }}">{{ $subject->course_code }} - {{ $subject->descriptive_title }}</option>
                                            @endforeach
                                        </select>
                                      </div>
                                      <div class="col-md-6 mb-3">
                                        <label for="nameBackdrop" class="form-label"><b>Pre-Requisite</b></label>
                                        <select name="pre_requisite" id="pre_requisite" class="form-control" required>
                                            <option value="" selected disabled>Select Pre-Requisite</option>
                                            <option value="None">None</option>
                                            @foreach($results as $subject)
                                                <option value="{{ $subject->course_code }}">{{ $subject->course_code }} - {{ $subject->descriptive_title }}</option>
                                            @endforeach
                                        </select>
                                      </div>
                                    </div>

                                
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">
                                      Close
                                    </button>
                                    <button type="submit" class="btn btn-primary">Save</button>
                                  </div>
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!--/ Bootstrap modals -->
                </div>
                </div>
                </div>
                <!-- DELETE MODAL -->
                <div class="modal fade" id="smallModal" tabindex="-1">
                  <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="defaultModalLabel">Delete Subject</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <p>Are you sure you want to delete this subject?</p>
                        </div>
                        <div class="modal-footer">
                        <form id="deleteForm" method="POST" action="">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">
                              Close
                            </button>
                            <button type="submit" class="btn btn-danger">Delete</button>
                          </form>
                        </div>  
                    </div>
                    </div>
                    </div>
                <!--/ DELETE MODAL -->

             

     
</x-app-layout>

    
    <script>
    $(document).ready(function() {
      $('#myTable').DataTable();
    });
  </script>
    <script>
        
    $(function(){
       // COURSE MODAL

    /* Add Course */
	    $('#addCourse').on('click', function () {
	        var color = $(this).data('color');        
	        $('#mdModal .modal-content').removeAttr('class').addClass('modal-content modal-col-' + color);
	        $('.courses').trigger("reset");
	        $('#defaultModalLabel').html("ADD NEW DEPARTMENT");    
	        $('.btnSave').html("CREATE DEPARTMENT");    
	        $('#mdModal').modal('show');
	    });

	/* Edit Course */
	    $(' #edit-subject').on('click', function () {     
            
		    var subject_id = $(this).data('id'); 
		    $.get('subjectmodals'+'/'+subject_id +'/edit', function (data) {
		    $('#defaultModalLabel').html("EDIT DEPARTMENT");    
		    $('#backDropModal').modal('show');
		    $('.btnSave').html("UPDATE");  
		    $('#btn-save').prop('disabled',false);    
            // Populate the form fields with the data returned from server
            $('#course_code').val(data.course_code);
            $('#descriptive_title').val(data.descriptive_title);
            $('#led_units').val(data.led_units);
            $('#lab_units').val(data.lab_units);
            $('#total_units').val(data.total_units);
            $('#co_requisite').val(data.co_requisite);
            $('#pre_requisite').val(data.pre_requisite);
            // Set the form action to the update route
            $('#backDropModal form').attr('action', 'subjectmodals/' + subject_id);
            $('#backDropModal form').append('<input name="_method" type="hidden" value="PUT">');
	    });
	    });
	    /* Delete COURSE */ 

 		$(' #delSubj').click(function () {
			       
			     
			        var course_id = $(this).data('id');
                                        var url = 'subjectmodals' + '/' + course_id;
                                        $('#deleteForm').attr('action', url);
                                         			     
			        $('#smallModal').modal('show');					         
			});
 	
    });
    </script>


