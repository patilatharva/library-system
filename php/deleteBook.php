<script type="text/javascript">			
	function runDeleteAjax() {
		var deleteData = $("#delete-book-form").serialize();
		$.ajax({
			data: deleteData,
			type: "post",
			url: "deleteBookAction.php",
			error: function(err) {
            	alert(err);
			},
			success: function() {
				$('#booklist').DataTable().ajax.reload();
			}
		});
			
		$('#deletebook').modal('hide');
	};
</script>

<div id="deletebook" class="modal fade" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
			<h5 class="modal-title">Confirmation</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form id="delete-book-form" autocomplete="off">
				<div class="modal-body">
					Are you sure you want to delete <b>all</b> copies of this book?<br/><br/>
					
					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text" id="basic-addon1" style="width: 120px;">
								<i class="fas fa-file-alt"></i> &nbsp;&nbsp; Title
							</span>
						</div>
						<input id="title_del" type="text" class="form-control" aria-describedby="basic-addon1" readonly>
					</div>
					
					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text" id="basic-addon1" style="width: 120px;">
								<i class="fas fa-user"></i> &nbsp;&nbsp; Author(s)
							</span>
						</div>
						<input id="author_del" type="text" class="form-control" aria-describedby="basic-addon1" readonly>
					</div>

					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text" id="basic-addon1" style="width: 120px;">
								<i class="fas fa-globe"></i> &nbsp;&nbsp; ISBN
							</span>
						</div>
						<input id="isbn_del" type="text" class="form-control" aria-describedby="basic-addon1" readonly>
					</div>

					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text" id="basic-addon1" style="width: 120px;">
								<i class="fas fa-layer-group"></i> &nbsp;&nbsp; Copies
							</span>
						</div>
						<input id="stock_del" type="text" class="form-control" aria-describedby="basic-addon1" readonly>
					</div>

					<input id="srno_del" name="srno" type="hidden" />
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button onclick="runDeleteAjax(); return false;" class="btn btn-danger">Delete Book</button>
				</div>
			</form>
		</div>
	</div>
</div>