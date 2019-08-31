<script type="text/javascript">			
	function restoreBookAjax() {
        var data = $("#restoreBookForm").serialize();
		$.ajax({
			data: data,
			type: "post",
			url: "settings/restoreBookAction.php",
			error: function(err) {
            	alert(err);
			},
			success: function() {
                $('#books').DataTable().ajax.reload();
                $('#restoreBook').modal('hide');
			}
		});
	};
	
	function clearModal() {
		$('#restoreBookForm')[0].reset();
	}

</script>
 
<div id="restoreBook" class="modal fade" tabindex="-1" role="dialog">
  	<div class="modal-dialog" role="document">
    	<div class="modal-content">
      		<div class="modal-header">
				<h5 class="modal-title">Recover deleted book</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
            </div>
            
			<form id="restoreBookForm" name="restoreBook-f" method="post" autocomplete="off">
				<div class="modal-body">
                    Are you sure you want to recover this book?<br/>

					<div class="input-group mb-3" style="margin-top: 15px">
						<div class="input-group-prepend">
							<span class="input-group-text" id="basic-addon1" style="width: 138px">
								<i class="fas fa-id-card"></i> &nbsp;&nbsp; Book ID 
							</span>
						</div>
						<input id="restb-srno" name="srno" class="form-control" aria-describedby="basic-addon1" readonly>
                    </div>

					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text" id="basic-addon1" style="width: 138px">
								<i class="fas fa-file-alt"></i> &nbsp;&nbsp; Title 
							</span>
						</div>
						<input id="restb-title" class="form-control" aria-describedby="basic-addon1" readonly>
					</div>	

					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text" id="basic-addon1" style="width: 138px">
								<i class="fas fa-user"></i></i> &nbsp;&nbsp; Author 
							</span>
						</div>
						<input id="restb-author" class="form-control" aria-describedby="basic-addon1" readonly>
                    </div>
                    
                    <div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text" id="basic-addon1" style="width: 138px">
								<i class="fas fa-globe"></i></i> &nbsp;&nbsp; ISBN 
							</span>
						</div>
						<input id="restb-isbn" class="form-control" aria-describedby="basic-addon1" readonly>
                    </div>

                    <div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text" id="basic-addon1" style="width: 138px">
								<i class="fas fa-layer-group"></i> &nbsp;&nbsp; Stock 
							</span>
						</div>
						<input id="restb-stock" class="form-control" aria-describedby="basic-addon1" readonly>
					</div>
                    
                    <div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text" id="basic-addon1" style="width: 138px">
								<i class="fas fa-calendar-check"></i> &nbsp;&nbsp; Date added 
							</span>
						</div>
						<input id="restb-dateAdded" class="form-control" aria-describedby="basic-addon1" readonly>
					</div>
                </div>	
                
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button onclick="restoreBookAjax(); return false;" type="button" class="btn btn-info">Recover book</button>
				</div>
			</form>
   		</div>
  	</div>
</div>