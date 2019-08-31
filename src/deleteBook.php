<script type="text/javascript">	

	function deleteModal(srno) {
		$.ajax({
			data: {srno: srno},
			url: "bookDetailsAction.php",
			type: "post",
			error: function(err) {
				alert(err);
			},
			success: function(data) {
				var details = JSON.parse(data);
				$("#deletebook input[name=title]").val(details.title);
				$("#deletebook input[name=author]").val(details.author);
				$("#deletebook input[name=isbn]").val(details.isbn);
				$("#deletebook input[name=copies]").val(details.stock);
				$("#deletebook textarea[name=description]").val(details.description);
				$("#deletebook input[name=pageCount]").val(details.pages);
				$("#deletebook input[name=categories]").val(details.categories);
				$("#deletebook input[name=publisher]").val(details.publisher);
				$("#deletebook input[name=publishedDate]").val(details.published_date);
				$("#deletebook input[name=srno]").val(details.srno);

				$("#deletebook img").attr("src", details.img);

			}
		});
	};

	$(document).on('click','#bt-deleteBook',function() {
		var srnoDel = $("#deletebook input[name=srno]").val();

		$.ajax({
			data: {srno: srnoDel},
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
	});
</script>

<div id="deletebook" class="modal book-modal fade" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Confirmation</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form id="deleteBookForm" name="deletebook-f" autocomplete="off">
			<div class="modal-body">
				<p>
					Are you sure you want to delete the following book? <b>It can always be restored from the Settings menu.</b>
				</p>
				<div class="input-container-1">
					<img class="book-thumbnail book-img" src="../book_thumbnail/default6.png" alt="Cover Image not available">
			
					<div style="position: absolute; width: 300px; bottom: 0px">
						<div class="input-group mb-3" style="margin-top: 40px">
							<div class="input-group-prepend">
								<span class="input-group-text" id="basic-addon1" style="width: 160px">
									<i class="fas fa-file-signature"></i> &nbsp;&nbsp; Publisher 
								</span>
							</div>
							<input name="publisher" type="text" class="form-control" aria-describedby="basic-addon1" disabled>
						</div>

						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text" id="basic-addon1" style="width: 160px">
									<i class="fas fa-calendar-check"></i> &nbsp;&nbsp; Published Year 
								</span>
							</div>
							<input name="publishedDate" type="text" class="form-control" aria-describedby="basic-addon1" disabled>
						</div>
					</div>
				</div>

				<div class="input-container-2">
					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text" id="basic-addon1" style="width: 160px">
								<i class="fas fa-globe" ></i>
								&nbsp;&nbsp; ISBN 
							</span>
						</div>
						<input id="add-isbn" name="isbn" type="text" class="form-control" aria-describedby="basic-addon1" disabled/>
					</div>

					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text" id="basic-addon1" style="width: 160px">
								<i class="fas fa-file-alt"></i> &nbsp;&nbsp; Title 
							</span>
						</div>
						<input name="title" type="text" class="form-control" aria-describedby="basic-addon1" disabled>
					</div>

					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text" id="basic-addon1" style="width: 160px">
								<i class="fas fa-user"></i> &nbsp;&nbsp; Author(s)
							</span>
						</div>
						<input name="author" type="text" class="form-control" aria-describedby="basic-addon1" disabled>
					</div>	

					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text" id="basic-addon1" style="width: 160px">
								<i class="fas fa-layer-group"></i> &nbsp;&nbsp; Copies 
							</span>
						</div>
						<input name="copies" type="text" class="form-control" aria-describedby="basic-addon1" value="1" disabled>
					</div>

					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text" id="basic-addon1" style="width: 160px">
								<i class="fas fa-book-open"></i> &nbsp;&nbsp; Description 
							</span>
						</div>
						<textarea name="description" class="form-control" rows="7" disabled></textarea>
					</div>

					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text" id="basic-addon1" style="width: 160px">
								<i class="fas fa-paperclip"></i> &nbsp;&nbsp; Page Count 
							</span>
						</div>
						<input name="pageCount" type="text" class="form-control" aria-describedby="basic-addon1" disabled>
					</div>

					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text" id="basic-addon1" style="width: 160px">
								<i class="fas fa-palette"></i> &nbsp;&nbsp; Categories 
							</span>
						</div>
						<input name="categories" type="text" class="form-control" aria-describedby="basic-addon1" disabled>
					</div>

					<input name="coverLink" type="hidden" value="default6.png">
					<input name="srno" type="hidden">
				</div>
			</div>
	
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button id="bt-deleteBook" type="button" class="btn btn-danger">Yes, delete book</button>
			</div>
			</form>
		</div>
	</div>
</div>