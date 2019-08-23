<script type="text/javascript">			
	$(document).on('click','#bt-addbook',function() {
		var title = document.forms["addBook-f"]["title"].value;
		var author = document.forms["addBook-f"]["author"].value;
		var copies = document.forms["addBook-f"]["copies"].value;

		if(title==""||author==""||copies=="") {
			alert("All fields must be filled out.");
		}
		else {
			runAjax();
		}
	})
		
	function runAjax() {
		var data = $("#addBookForm").serialize();
		$.ajax({
			data: data,
			type: "post",
			url: "addBookAction.php",
			error: function(err) {
				alert(err);
			},
			success: function() {
				$('#booklist').DataTable().ajax.reload();
			}
		});
		$('#addbook').modal('hide');
	};
	
	function clearModal() {
		document.getElementsByClassName("book-thumbnail")[2].setAttribute("src", "../book_thumbnail/default6.png");
		$('#addBookForm')[0].reset();
	}

</script>

<div id="addbook" class="modal book-modal fade" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Enter Book Details</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form id="addBookForm" name="addBook-f" method="post" autocomplete="off">
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
							<input id="add-isbn" name="isbn" type="text" class="form-control" aria-describedby="basic-addon1" />
							<div class="input-group-append">
								<button class="btn btn-outline-info" id="isbn-button" 
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
					</div>
				</div>	
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button id="bt-addbook" type="button" class="btn btn-primary">Add Book</button>
				</div>
			</form>
   		</div>
  	</div>
</div>