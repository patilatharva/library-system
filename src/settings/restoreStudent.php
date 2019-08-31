<script type="text/javascript">			
	function restoreStudentAjax() {
        var data = $("#restoreStudentForm").serialize();
		$.ajax({
			data: data,
			type: "post",
			url: "settings/restoreStudentAction.php",
			error: function(err) {
				alert(err);
			},
			success: function() {
                $('#students').DataTable().ajax.reload();
                $('#restoreStudent').modal('hide');
			}
		});
	};
	
	function clearModal() {
		$('#restoreStudentForm')[0].reset();
	}

</script>

<div id="restoreStudent" class="modal fade" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Recover deleted student</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
            </div>
            
			<form id="restoreStudentForm" name="restoreStudent-f" method="post" autocomplete="off">
				<div class="modal-body">
                    Are you sure you want to recover this student?<br/>

					<div class="input-group mb-3" style="margin-top: 15px">
						<div class="input-group-prepend">
							<span class="input-group-text" id="basic-addon1" style="width: 140px">
								<i class="fas fa-id-card"></i> &nbsp;&nbsp; Student ID 
							</span>
						</div>
						<input id="rest-srno" name="srno" class="form-control" aria-describedby="basic-addon1" readonly>
                    </div>

					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text" id="basic-addon1" style="width: 140px">
								<i class="fas fa-user"></i> &nbsp;&nbsp; Name 
							</span>
						</div>
						<input id="rest-name" class="form-control" aria-describedby="basic-addon1" readonly>
					</div>	

					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text" id="basic-addon1" style="width: 140px">
								<i class="fas fa-chalkboard-teacher"></i></i> &nbsp;&nbsp; Class 
							</span>
						</div>
						<input id="rest-class" class="form-control" aria-describedby="basic-addon1" readonly>
                    </div>
                    
                    <div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text" id="basic-addon1" style="width: 140px">
								<i class="fas fa-list-ol"></i></i> &nbsp;&nbsp; Roll no. 
							</span>
						</div>
						<input id="rest-rollNo" class="form-control" aria-describedby="basic-addon1" readonly>
                    </div>

                    <div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text" id="basic-addon1" style="width: 140px">
								<i class="fas fa-calendar-check"></i> &nbsp;&nbsp; Date added 
							</span>
						</div>
						<input id="rest-dateAdded" class="form-control" aria-describedby="basic-addon1" readonly>
					</div>
                </div>	
                
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button onclick="restoreStudentAjax(); return false;" type="button" class="btn btn-info">Recover student</button>
				</div>
			</form>
		</div>
	</div>
</div>