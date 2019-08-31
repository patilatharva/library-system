<!------------- Borrow Book Modal ------------------->
		
<div id="borrowBook" class="modal fade" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Issue Book</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
				<div class="modal-body" style="width: 550px;">
					<form name="borrowBook" action="borrowBookAction.php" method="POST" autocomplete="off">
					
					<div class="row">
						<div class="form-group col-xs-6 input-group mb-3" style="width: 200px; margin-left: 15px">
							<div class="input-group-prepend">
								<span class="input-group-text" id="basic-addon1" width: ><i class="fas fa-hourglass-start"></i>&nbsp;&nbsp;Period</span>
							</div>
							<input type="text" name="period" value="1" class="form-control" aria-label="Text input" style="text-align: center">
						</div>
						&emsp;
						<div class="form-group col-xs-6 input-group mb-3" style="width: 110px" >
                            <select name="type" class="custom-select">
                                <option value = "week" selected>Week(s)</option>
                                <option value = "month">Month(s)</option>
                            </select>
                        </div>
					</div>

						<div style="width: 325px">
							<div class="input-group mb-3" >
								<input type="text" class="form-control" placeholder="Scan ISBN" aria-describedby="basic-addon2">
								<div class="input-group-append">
									<button class="btn btn-primary" type="button">Enter</button>
								</div>
							</div>
						</div>

						<input id="srno" type="hidden" name="s_srno"/>

						<button class="btn-link" type="submit" formaction="borrowBookTitle.php">No ISBN on book? Select by title</button>
					</form>
				</div>	
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				</div>
		</div>
	</div>
</div>