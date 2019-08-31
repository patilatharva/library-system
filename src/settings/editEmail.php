<script type="text/javascript">			
	$(document).on('click','#bt-editEmail',function() {
		var email = document.forms["editEmail-f"]["email"].value;

		if(email=="") {
			alert("Email cannot be empty.");
        } else {
			editEmailAjax();
		}
	});
		
	function editEmailAjax() {
        var data = $("#editEmailForm").serialize();
		$.ajax({
			data: data,
			type: "post",
			url: "settings/editEmailAction.php",
			error: function(err) {
            	alert(err);
			},
			success: function() {
                var email = document.forms["editEmail-f"]["email"].value;
                $("#email").val(email);
			}
		});
			
		$('#editEmailModal').modal('hide');
	};
	
	function clearModal() {
		$('#editEmailForm')[0].reset();
	}

</script>
 
<div id="editEmailModal" class="modal fade" tabindex="-1" role="dialog">
  	<div class="modal-dialog" role="document">
    	<div class="modal-content">
      		<div class="modal-header">
				<h5 class="modal-title">Change Email</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
            </div>
            
			<form id="editEmailForm" name="editEmail-f" method="post" autocomplete="off">
				<div class="modal-body">
					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text" id="basic-addon1" style="width: 155px">
								<i class="fas fa-envelope"></i> &nbsp;&nbsp; Current email 
							</span>
						</div>
						<input value="<?= $email ?>" class="form-control" aria-describedby="basic-addon1" spellcheck="false" readonly>
					</div>

					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text" id="basic-addon1" style="width: 155px">
								<i class="fas fa-envelope"></i> &nbsp;&nbsp; New email 
							</span>
						</div>
						<input name="email" class="form-control" aria-describedby="basic-addon1" spellcheck="false">
					</div>	

				</div>	
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button id="bt-editEmail" type="button" class="btn btn-primary">Change</button>
				</div>
			</form>
   		</div>
  	</div>
</div>