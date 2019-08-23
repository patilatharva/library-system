<script type="text/javascript">			
	$(document).on('click','#bt-editstud',function() {
		var name = document.forms["editStudent-f"]["name"].value;
		var sclass = document.forms["editStudent-f"]["class"].value;
		var roll_no = document.forms["editStudent-f"]["roll_no"].value;

		if(name==""||sclass==""||roll_no=="") {
			alert("All fields must be filled out.");
		}
		else {
			runEditAjax();
		}
	})
		
	function runEditAjax() {
		var editData = $("#editStudentForm").serialize();
		$.ajax({
			data: editData,
			type: "post",
			url: "editStudentAction.php",
			error: function(err) {
            	alert(err);
			},
			success: function() {
				$('#students').DataTable().ajax.reload();
			}
		});
		$('#editstudent').modal('hide');
	};
</script>

<div id="editstudent" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Student Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
	  </div>
	  <form id="editStudentForm" name="editStudent-f" autocomplete="off">
      <div class="modal-body">
				<div class="input-group mb-3">
					<div class="input-group-prepend">
						<span class="input-group-text" id="basic-addon1" style="width: 109px;">
							<i class="fas fa-id-card"></i> &nbsp;&nbsp; ID
						</span>
					</div>
					<input id="srno_php" name="srno" type="text" class="form-control" aria-describedby="basic-addon1" readonly>
				</div>

				<div class="input-group mb-3">
					<div class="input-group-prepend">
						<span class="input-group-text" id="basic-addon1" style="width: 108px">
							<i class="fas fa-user"></i> &nbsp;&nbsp; Name
						</span>
					</div>
					<input id="name" name="name" type="text" class="form-control" aria-describedby="basic-addon1" spellcheck="false">
				</div>
				
				<div class="input-group mb-3">
					<div class="input-group-prepend">
						<span class="input-group-text" id="basic-addon1" style="width: 108px">
							<i class="fas fa-chalkboard-teacher"></i> &nbsp;&nbsp; Class
						</span>
					</div>
					<input id="class" name="class" type="text" class="form-control" aria-describedby="basic-addon1" spellcheck="false">
				</div>

				<div class="input-group mb-3">
					<div class="input-group-prepend">
						<span class="input-group-text" id="basic-addon1" style="width: 108px">
							<i class="fas fa-list-ol"></i> &nbsp;&nbsp; Roll no.
						</span>
					</div>
					<input id="roll_no" name="roll_no" type="text" class="form-control" aria-describedby="basic-addon1" spellcheck="false">
				</div>

				<!--button type="submit" class="btn btn-info">Update</button--> <!--data-dismiss="modal"-->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button id="bt-editstud" type="button" class="btn btn-primary">Save changes</button>
	  </div>
	</form>
    </div>
  </div>
</div>