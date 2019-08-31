<script type="text/javascript">			
    $(document).on('click','#bt-adduser',function() {
        var username = document.forms["addUser-f"]["username"].value;
        var email = document.forms["addUser-f"]["email"].value;
        var access = document.forms["addUser-f"]["access"].value;
        var pass1 = document.forms["addUser-f"]["pass1"].value;
        var pass2 = document.forms["addUser-f"]["pass2"].value;

		if(username==""||email==""||access==""||pass1==""||pass2=="") {
			alert("All fields must be filled out.");
        } else if(pass1!=pass2) {
            alert("Entered passwords do not match.")
        } else {
			addUserAjax();
		}
	});
		
	function addUserAjax() {
        var data = $("#addUserForm").serialize();
        alert(data);
		$.ajax({
			data: data,
			type: "post",
			url: "settings/addUserAction.php",
			error: function(err) {
				alert(err);
			},
			success: function() {
                $('#users').DataTable().ajax.reload();
                $('#addUser').modal('hide');
			}
		});
	};
	
	function clearModal() {
		$('#addUserForm')[0].reset();
	}	
</script>

<div id="addUser" class="modal fade" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Add User</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
            </div>
            
			<form id="addUserForm" name="addUser-f" method="post" autocomplete="off">
				<div class="modal-body">
					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text" id="basic-addon1" style="width: 135px">
								<i class="fas fa-user-circle"></i> &nbsp;&nbsp; Username 
							</span>
						</div>
						<input name="username" class="form-control" aria-describedby="basic-addon1" spellcheck="false">
					</div>	

					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text" id="basic-addon1" style="width: 135px">
								<i class="fas fa-envelope"></i></i> &nbsp;&nbsp; Email 
							</span>
						</div>
						<input name="email" class="form-control" aria-describedby="basic-addon1" spellcheck="false">
                    </div>
                    
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect01" style="width: 135px">
                                <i class="fas fa-user-shield"></i></i> &nbsp;&nbsp; Access
                            </label>
                        </div>
                        <select name="access" class="custom-select" id="inputGroupSelect01">
                            <option value="user" selected>User (view only)</option>
                            <option value="admin">Admin (full access)</option>
                        </select>
                    </div>

                    <div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text" id="basic-addon1" style="width: 135px">
								<i class="fas fa-key"></i> &nbsp;&nbsp; Password 
							</span>
						</div>
						<input name="pass1" type="password" class="form-control" aria-describedby="basic-addon1" spellcheck="false">
					</div>	

					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text" id="basic-addon1" style="width: 135px">
								<i class="fas fa-undo"></i></i> &nbsp;&nbsp; Enter Again 
							</span>
						</div>
						<input name="pass2" type="password" class="form-control" aria-describedby="basic-addon1" spellcheck="false">
					</div>

                </div>	
                
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button id="bt-adduser" type="button" class="btn btn-primary">Add user</button>
				</div>
			</form>
		</div>
	</div>
</div>