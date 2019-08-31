<script type="text/javascript">			
	function editModal(srno) {
		$.ajax({
			data: {srno: srno},
			url: "bookDetailsAction.php",
			type: "post",
			error: function(err) {
				alert(err);
			},
			success: function(data) {
				var details = JSON.parse(data);
				$("#editbook input[name=title]").val(details.title);
				$("#editbook input[name=author]").val(details.author);
				$("#editbook input[name=isbn]").val(details.isbn);
				$("#editbook input[name=copies]").val(details.stock);
				$("#editbook textarea[name=description]").val(details.description);
				$("#editbook input[name=pageCount]").val(details.pages);
				$("#editbook input[name=categories]").val(details.categories);
				$("#editbook input[name=publisher]").val(details.publisher);
				$("#editbook input[name=publishedDate]").val(details.published_date);
				$("#editbook input[name=srno]").val(details.srno);

				$("#editbook img").attr("src", details.img);

			}
		});
	};

	
	$(document).on('click','#bt-editbook',function() {
		var title = document.forms["editBook-f"]["title"].value;
		var author = document.forms["editBook-f"]["author"].value;
		var copies = document.forms["editBook-f"]["copies"].value;

		if(title==""||author==""||copies=="") {
			alert("All fields must be filled out.");
		}
		else {
			runEditAjax();
		}
	})
		
	function runEditAjax() {
		var editData = $("#editBookForm").serialize();
		$.ajax({
			data: editData,
			type: "post",
			url: "editBookAction.php",
			error: function(err) {
				alert(err);
			},
			success: function(dat) {
				$('#booklist').DataTable().ajax.reload(null, false);
			}
		});
			
		$('#editbook').modal('hide');
	};
</script>

<div id="editbook" class="modal book-modal fade" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Edit Book Details</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form id="editBookForm" name="editBook-f" autocomplete="off">
			<div class="modal-body">
					<div class="input-container-1">
						<img class="book-thumbnail book-img" src="../book_thumbnail/default6.png" alt="Cover Image not available">
				
						<div style="position: absolute; width: 300px; bottom: 0px">
							<div class="input-group mb-3" style="margin-top: 40px">
								<div class="input-group-prepend">
									<span class="input-group-text" id="basic-addon1" style="width: 160px">
										<i class="fas fa-file-signature"></i> &nbsp;&nbsp; Publisher 
									</span>
								</div>
								<input name="publisher" type="text" class="form-control" aria-describedby="basic-addon1">
							</div>

							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text" id="basic-addon1" style="width: 160px">
										<i class="fas fa-calendar-check"></i> &nbsp;&nbsp; Published Year 
									</span>
								</div>
								<input name="publishedDate" type="text" class="form-control" aria-describedby="basic-addon1">
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
							<input id="add-isbn" name="isbn" type="text" class="form-control" aria-describedby="basic-addon1"/>
							<div class="input-group-append">
								<button class="btn btn-outline-info" type="submit" id="isbn-button" 
									onclick="getBookDetails(this.form); return false;">Autofill
								</button>
							</div>
						</div>

						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text" id="basic-addon1" style="width: 160px">
									<i class="fas fa-file-alt"></i> &nbsp;&nbsp; Title 
								</span>
							</div>
							<input name="title" type="text" class="form-control" aria-describedby="basic-addon1">
						</div>

						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text" id="basic-addon1" style="width: 160px">
									<i class="fas fa-user"></i> &nbsp;&nbsp; Author(s)
								</span>
							</div>
							<input name="author" type="text" class="form-control" aria-describedby="basic-addon1">
						</div>	

						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text" id="basic-addon1" style="width: 160px">
									<i class="fas fa-layer-group"></i> &nbsp;&nbsp; Copies 
								</span>
							</div>
							<input name="copies" type="text" class="form-control" aria-describedby="basic-addon1" value="1">
						</div>

						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text" id="basic-addon1" style="width: 160px">
									<i class="fas fa-book-open"></i> &nbsp;&nbsp; Description 
								</span>
							</div>
							<textarea name="description" class="form-control" rows="7"></textarea>
						</div>

						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text" id="basic-addon1" style="width: 160px">
									<i class="fas fa-paperclip"></i> &nbsp;&nbsp; Page Count 
								</span>
							</div>
							<input name="pageCount" type="text" class="form-control" aria-describedby="basic-addon1">
						</div>

						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text" id="basic-addon1" style="width: 160px">
									<i class="fas fa-palette"></i> &nbsp;&nbsp; Categories 
								</span>
							</div>
							<input name="categories" type="text" class="form-control" aria-describedby="basic-addon1">
						</div>

						<input name="coverLink" type="hidden" value="default6.png">
						<input name="srno" type="hidden">
					</div>
				</div>
		
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button id="bt-editbook" type="button" class="btn btn-primary">Save changes</button>
				</div>
			</form>
		</div>
	</div>
</div>