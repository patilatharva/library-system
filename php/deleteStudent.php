<script type="text/javascript">			
	$(document).on('click','#bt-delstud',function() {
		var deleteData = $("#delStudForm").serialize();
		$.ajax({
			data: deleteData,
			type: "post",
			url: "deleteStudentAction.php",
			error: function(err) {
            	alert(err);
			},
			success: function() {
				$('#students').DataTable().ajax.reload();
			}
		});
			
		$('#deleteStudent').modal('hide');
	});
</script>
 
<div id="deleteStudent" class="modal fade" tabindex="-1" role="dialog">
  	<div class="modal-dialog" role="document">
    	<div class="modal-content">
      		<div class="modal-header">
				<h5 class="modal-title">Confirmation</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form id="delStudForm" name="delStud-f" method="post" autocomplete="off">
				<div class="modal-body">
				Are you sure you want to delete the following student?<br/><br/>
			
				<div class="input-group mb-3">
					<div class="input-group-prepend">
						<span class="input-group-text" id="basic-addon1" style="width: 109px;">
							<i class="fas fa-id-card"></i> &nbsp;&nbsp; ID
						</span>
					</div>
					<input id="del_srno" name="srno" type="text" class="form-control" aria-describedby="basic-addon1" readonly>
				</div>
				
				<div class="input-group mb-3">
					<div class="input-group-prepend">
						<span class="input-group-text" id="basic-addon1" style="width: 109px;">
							<i class="fas fa-user"></i> &nbsp;&nbsp; Name
						</span>
					</div>
					<input id="del_name" name="name" type="text" class="form-control" aria-describedby="basic-addon1" readonly>
				</div>

				<div class="input-group mb-3">
					<div class="input-group-prepend">
						<span class="input-group-text" id="basic-addon1" style="width: 109px;">
							<i class="fas fa-chalkboard-teacher"></i> &nbsp;&nbsp; Class
						</span>
					</div>
					<input id="del_class" name="class" type="text" class="form-control" aria-describedby="basic-addon1" readonly>
				</div>

				<div class="input-group mb-3">
					<div class="input-group-prepend">
						<span class="input-group-text" id="basic-addon1" style="width: 109px;">
							<i class="fas fa-list-ol"></i> &nbsp;&nbsp; Roll no.
						</span>
					</div>
					<input id="del_roll_no" name="roll_no" type="text" class="form-control" aria-describedby="basic-addon1" readonly>
				</div>	

				</div>	
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button id="bt-delstud" type="button" class="btn btn-danger">Delete Student</button>
				</div>
			</form>
   		</div>
  	</div>
</div>
