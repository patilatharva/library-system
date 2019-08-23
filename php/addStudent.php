<script type="text/javascript">			
	$(document).on('click','#bt-addstud',function() {
		var sclass = document.forms["addStud-f"]["class"].value;
		var roll_no = document.forms["addStud-f"]["roll_no"].value;
		var name = document.forms["addStud-f"]["name"].value;

		if(sclass==""||roll_no==""||name=="") {
			alert("All fields must be filled out.");
		}
		else {
			runAjax();
		}
	})
		
	function runAjax() {
		var data = $("#addStudForm").serialize();
		$.ajax({
			data: data,
			type: "post",
			url: "addStudentAction.php",
			error: function(err) {
				alert(err);
			},
			success: function() {
				$('#students').DataTable().ajax.reload();
			}
		});
			
		$('#addstud').modal('hide');
	};
	
	function clearModal() {
		$('#addStudForm')[0].reset();
	}

</script>

<div id="addstud" class="modal fade" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Enter Student Details</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form id="addStudForm" name="addStud-f" method="post" autocomplete="off">
				<div class="modal-body">
					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text" id="basic-addon1" style="width: 108px">
								<i class="fas fa-chalkboard-teacher"></i> &nbsp;&nbsp; Class 
							</span>
						</div>
						<input name="class" type="text" class="form-control" aria-describedby="basic-addon1" spellcheck="false">
					</div>

					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text" id="basic-addon1" style="width: 108px">
								<i class="fas fa-list-ol"></i> &nbsp;&nbsp; Roll no. 
							</span>
						</div>
						<input name="roll_no" type="text" class="form-control" aria-describedby="basic-addon1" spellcheck="false">
					</div>	

					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text" id="basic-addon1" style="width: 108px">
								<i class="fas fa-user"></i></i> &nbsp;&nbsp; Name 
							</span>
						</div>
						<input name="name" type="text" class="form-control" aria-describedby="basic-addon1" spellcheck="false">
					</div>
				</div>	
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button id="bt-addstud" type="button" class="btn btn-primary">Add Student</button>
				</div>
			</form>
   		</div>
  	</div>
</div>