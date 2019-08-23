<!------------- Import Books Modal ------------------->
		
<div id="import" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="importBookAction.php" method="post" enctype="multipart/form-data">
            
            <div class="modal-header">
                <h5 class="modal-title">Import Book Data through Excel</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
                <div class="modal-body" style="width: 550px;">
                    <b>Step 1: </b>Enter book data in MS Excel in four columns: <i>Title</i>, <i>Author</i>, <i>ISBN</i> and <i>Stock</i>, in precisely that order.<br/><br/>
                    <b>Step 2: </b>Save the file as a CSV file through the Save As option in MS Excel.<br/><br/>
                    <b>Step 3: </b>Click on the Choose File button below and select the file.<br/><br/>
                                    
                    <div class="input-group mb-3" style="width: 70%;">
                        <div class="custom-file">
                            <input class="custom-file-input" id="inputGroupFile01" type="file" name="filename" accept=".csv" required >
                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                        </div>
                    </div>

                </div>	
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="import" class="btn btn-success">
                        <i class="fas fa-upload"></i>&nbsp;&nbsp;Import
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

<script>
    $('#inputGroupFile01').on('change',function(){
        //get the file name
        var fileName = $(this).val();
        if(fileName.substring(0,12)=="C:\\fakepath\\")
            fileName = fileName.substring(12);

        //replace the "Choose a file" label
        $(this).next('.custom-file-label').html(fileName);
    })
</script>
