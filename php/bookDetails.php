<script>
    function bookDetails(srno) {

        $.ajax({
            data: {srno: srno},
            type: "post",
            url: "bookDetailsAction.php",
            error: function(err) {
                alert(err);
            },
            success: function(data) {
                var details = JSON.parse(data);
                $("#details-title").html(details.title);
                $("#details-author").html(details.author);
                $("#details-line-1").html(details.published_date + "&emsp;" + details.pages + " pages&emsp;" + details.publisher);
                $("#details-line-2").html("<b>ISBN: </b>" + details.isbn);
                $("#details-description").html(details.description);
                
                var categories = '<span class="badge badge-primary">' + details.categories + '</span>';
                categories = categories.replace(/,/g, '</span>&nbsp;<span class="badge badge-primary">');

                $("#details-categories").html(categories);
                $("#details-copies").html(details.stock + (details.stock==="1"? " copy": " copies" + "&emsp;<b>First added: </b>" + details.date_added));
                $("#details-img").attr("src", details.img);
                $("#details-srno").html(details.srno);
            }
        });
    };
</script>

<div id="bookDetails" class="modal book-modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Book details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            
                <div class="input-container-1">
                    <img id="details-img" class="book-thumbnail" src="../book_thumbnail/default6.png" alt="Cover Image Unavailable">
                </div>

                <div class="input-container-2">
                    <div id="details-title"></div>
                    <div id="details-author"></div>
                    <div id="details-line-1"></div>
                    <div id="details-line-2"></div>
                    <div id="details-line-3"></div>
                    <hr/>
                    <div id="details-description"></div>
                    <div id="details-categories"></div>
                    <div id="details-copies"></div>
                    <div id="details-srno">-1</div>
                </div>

                <div class="accordion" id="accordionHistory">
                    <div class="card">
                        <div class="card-header" id="collapseHeading">
                            <h2 class="mb-0">
                                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseHistory" aria-expanded="false" aria-controls="collapseHistory">
                                View issue history
                                </button>
                            </h2>
                        </div>
                        <div id="collapseHistory" class="collapse" aria-labelledby="collapseHeading" data-parent="#accordionHistory">
                            <div class="card-body">
                                <table id="bookHistory" class="display" border=1 rules=none>
                                    <thead>
                                        <tr>
                                            <th>Action ID</th>
                                            <th>Class</th>
                                            <th>Student</th>
                                            <th>Date borrowed</th>
                                            <th>Date due</th>
                                            <th>Date returned</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Action ID</th>
                                            <th>Class</th>
                                            <th>Student</th>
                                            <th>Date borrowed</th>
                                            <th>Date due</th>
                                            <th>Date returned</th>
                                        </tr>
                                    </tfoot>						
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    /*================================================================
        History DataTable
    *=================================================================*/

    //$(document).ready( function () {
    $('#bookDetails').on('shown.bs.modal', function (e)  {
        if ( ! $.fn.DataTable.isDataTable( '#bookHistory' ) ) {
            // Setup - add a text input to each footer cell
        
            $('#bookHistory thead tr').clone(true).appendTo( '#bookHistory thead' );
            $('#bookHistory thead tr:eq(1) th').each( function (i) {
                var title = $(this).text();

                if(i!=0&&i<6)
                    $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
                else
                    $(this).html('');
        
                $( 'input', this ).on( 'keyup change', function () {
                    if ( historyTable.column(i).search() !== this.value ) {
                        historyTable
                            .column(i)
                            .search( this.value )
                            .draw();
                    }
                } ); 
            } );
            var b_srno = -1;

            var historyTable = $('#bookHistory').DataTable({
                'order': [[ 0, "desc" ]],
                "lengthMenu": [5, 10, 25, 50],
                'orderCellsTop': true,
                "language": {
                    "emptyTable": "This book hasn't been borrowed yet"
                },
                'ajax': {
                    'type': 'POST',
                    'url': 'serverside/bookHistoryServerSide.php',
                    'data': {
                        b_srno: function (d) {
                            return $("#details-srno").html();
                        }
                    }
                }
            });
        } else {
            $('#bookHistory').DataTable().ajax.reload();
        }
        
    });

     // collapse accordion on closing modal
    $('#bookDetails').on('hidden.bs.modal', function () {
        $('#collapseHistory').collapse('hide')
    });
</script>