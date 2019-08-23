<script type="text/javascript">			
	$(document).on('click','#bt-editpass',function() {
		var newPass1 = document.forms["editPass-f"]["newPass1"].value;
		var newPass2 = document.forms["editPass-f"]["newPass2"].value;

		if(newPass1==""||newPass2=="") {
			alert("All fields must be filled out.");
        } else if(newPass1!=newPass2) {
            alert("Entered passwords do not match.");
        } else {
			editPassAjax();
		}
	});
		
	function editPassAjax() {
        var data = $("#editPassForm").serialize();
		$.ajax({
			data: data,
			type: "post",
			url: "settings/editPasswordAction.php",
			error: function(err) {
            	alert(err);
			},
			success: function() {
                var password = document.forms["editPass-f"]["newPass1"].value;
                var len = password.length;
                password = "";
                for(var i=0; i<len; i++) {
                    password += '*';
                }
                $("#pass").val(password);
			}
		});
			
		$('#editPassModal').modal('hide');
	};
	
	function clearModal() {
		$('#editPassForm')[0].reset();
	}

</script>
 
<div id="editPassModal" class="modal fade" tabindex="-1" role="dialog">
  	<div class="modal-dialog" role="document">
    	<div class="modal-content">
      		<div class="modal-header">
				<h5 class="modal-title">Change Password</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form id="editPassForm" name="editPass-f" method="post" autocomplete="off">
				<div class="modal-body">
					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text" id="basic-addon1" style="width: 160px">
								<i class="fas fa-key"></i> &nbsp;&nbsp; Old password 
							</span>
						</div>
						<input value="<?= $password ?>" type="password" class="form-control" aria-describedby="basic-addon1" spellcheck="false" readonly>
					</div>

					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text" id="basic-addon1" style="width: 160px">
								<i class="fas fa-key"></i> &nbsp;&nbsp; New Password 
							</span>
						</div>
						<input name="newPass1" type="password" class="form-control" aria-describedby="basic-addon1" spellcheck="false">
					</div>	

					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text" id="basic-addon1" style="width: 160px">
								<i class="fas fa-undo"></i></i> &nbsp;&nbsp; Enter Again 
							</span>
						</div>
						<input name="newPass2" type="password" class="form-control" aria-describedby="basic-addon1" spellcheck="false">
					</div>
				</div>	
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button id="bt-editpass" type="button" class="btn btn-primary">Change</button>
				</div>
			</form>
   		</div>
  	</div>
</div>