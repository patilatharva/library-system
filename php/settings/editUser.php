<script type="text/javascript">			
    $(document).on('click','#bt-edituser',function() {
        var email = document.forms["editUser-f"]["email"].value;
        var access = document.forms["editUser-f"]["access"].value;

		if(email==""||access=="") {
			alert("All fields must be filled out.");
        } else {
			editUserAjax();
		}
	});
		
	function editUserAjax() {
        var data = $("#editUserForm").serialize();
		$.ajax({
			data: data,
			type: "post",
			url: "settings/editUserAction.php",
			error: function(err) {
				alert(err);
			},
			success: function() {
                $('#users').DataTable().ajax.reload();
                $('#editUser').modal('hide');
			}
		});
	};
	
	function clearModal() {
		$('#editUserForm')[0].reset();
	}
</script>

<div id="editUser" class="modal fade" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Edit User</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
            </div>
            
			<form id="editUserForm" name="editUser-f" method="post" autocomplete="off">
				<div class="modal-body">
					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text" id="basic-addon1" style="width: 140px">
								<i class="fas fa-id-card"></i> &nbsp;&nbsp; User ID 
							</span>
						</div>
						<input id="userId" name="user_id" class="form-control" aria-describedby="basic-addon1" readonly>
                    </div>
                    
                    <div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text" id="basic-addon1" style="width: 140px">
								<i class="fas fa-calendar-check"></i> &nbsp;&nbsp; Date added 
							</span>
						</div>
						<input id="dateAdded" class="form-control" aria-describedby="basic-addon1" readonly>
					</div>

					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text" id="basic-addon1" style="width: 140px">
								<i class="fas fa-user-circle"></i> &nbsp;&nbsp; Username 
							</span>
						</div>
						<input id="username" class="form-control" aria-describedby="basic-addon1" readonly>
					</div>	

					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text" id="basic-addon1" style="width: 140px">
								<i class="fas fa-envelope"></i></i> &nbsp;&nbsp; Email 
							</span>
						</div>
						<input id="editEmail" name="email" class="form-control" aria-describedby="basic-addon1" spellcheck="false">
                    </div>
                    
                    <div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text" id="basic-addon1" style="width: 140px">
								<i class="fas fa-user-shield"></i></i> &nbsp;&nbsp; Access 
							</span>
						</div>
						<select name="access" class="custom-select" id="access">
                            <option value="user">User (view only)</option>
                            <option value="admin">Admin (full access)</option>
                        </select>
						<!--input id="access" name="access" class="form-control" aria-describedby="basic-addon1" spellcheck="false"-->
					</div>
				</div>	
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button id="bt-edituser" type="button" class="btn btn-primary">Save changes</button>
				</div>
			</form>
		</div>
	</div>
</div>