<script type="text/javascript">			
	function deleteUserAjax() {
        var data = $("#deleteUserForm").serialize();
		$.ajax({
			data: data,
			type: "post",
			url: "settings/deleteUserAction.php",
			error: function(err) {
				alert(err);
			},
			success: function() {
                $('#users').DataTable().ajax.reload();
                $('#deleteUser').modal('hide');
			}
		});
	};
	
	function clearModal() {
		$('#deleteUserForm')[0].reset();
	}

</script>

<div id="deleteUser" class="modal fade" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Delete user</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
            </div>
            
			<form id="deleteUserForm" name="deleteUser-f" method="post" autocomplete="off">
				<div class="modal-body">
                    Are you sure you want to delete this user?<br/>

					<div class="input-group mb-3" style="margin-top: 15px">
						<div class="input-group-prepend">
							<span class="input-group-text" id="basic-addon1" style="width: 140px">
								<i class="fas fa-id-card"></i> &nbsp;&nbsp; User ID 
							</span>
						</div>
						<input id="del-userId" name="user_id" class="form-control" aria-describedby="basic-addon1" readonly>
                    </div>
                    
                    <div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text" id="basic-addon1" style="width: 140px">
								<i class="fas fa-calendar-check"></i> &nbsp;&nbsp; Date added 
							</span>
						</div>
						<input id="del-dateAdded" class="form-control" aria-describedby="basic-addon1" readonly>
					</div>

					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text" id="basic-addon1" style="width: 140px">
								<i class="fas fa-user-circle"></i> &nbsp;&nbsp; Username 
							</span>
						</div>
						<input id="del-username" class="form-control" aria-describedby="basic-addon1" readonly>
					</div>	

					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text" id="basic-addon1" style="width: 140px">
								<i class="fas fa-envelope"></i></i> &nbsp;&nbsp; Email 
							</span>
						</div>
						<input id="del-email" class="form-control" aria-describedby="basic-addon1" readonly>
                    </div>
                    
                    <div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text" id="basic-addon1" style="width: 140px">
								<i class="fas fa-user-shield"></i></i> &nbsp;&nbsp; Access 
							</span>
						</div>
						<input id="del-access" class="form-control" aria-describedby="basic-addon1" readonly>
                    </div>
                    
                    This action <b>cannot</b> be reversed.
				</div>	
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button onclick="deleteUserAjax(); return false;" type="button" class="btn btn-danger">Delete user</button>
				</div>
			</form>
		</div>
	</div>
</div>