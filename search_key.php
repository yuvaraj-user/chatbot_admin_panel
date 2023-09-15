<?php  include('layout/header.php'); ?>
<style>
[type=button]:not(:disabled), [type=reset]:not(:disabled), [type=submit]:not(:disabled), button:not(:disabled) {
    cursor: pointer;
    padding: 5px !important;
}
</style>
<?php  include('layout/sidemenu.php'); ?>



            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">

                    <div class="page-content">
                        <div class="container-fluid">

                            <!-- start page title -->
                            <div class="row">
                                <div class="col-12">
                                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                        <h4 class="mb-sm-0 font-size-18"> Keywords </h4>
										<a href="javascript:;" class="btn btn-primary" onclick="showForm(0);" >Add </a>
                                    </div>
                                </div>
                            </div>
                            <!-- end page title -->

<!-- Customer form -->
                           
							
							<div class="col-xl-12">
                                <div class="card">
                                    <div class="card-body">
										<div style="overflow-x:auto;">
                                        <table id="datatable" class="table table-bordered dt-responsive nowrap w-100">
                                            <thead>
												<tr>
													<th>Sno</th>
													<th width="25%" >Title</th>
													<th width="25%" >URL</th>
													<th width="25%" >Keywords</th>
													<th>Action</th>
												</tr>
                                            </thead>
											
											<tbody id="datalist" >
                                            <?php
											
											$sql = "select * from tbl_search_details where status = '1'";
											$query = mysqli_query($conn, $sql);
											
											$i = 1;
											while($row = mysqli_fetch_array($query)){ ?>
												<tr>
													<td><?php echo $i; ?></td>
													<td><?php echo $row['title']; ?></td>
													<td><?php echo $row['url']; ?></td>
													<td><?php
													$sql12 = "select * from tbl_search_keyword where search_id = '$row[id]' ";
													$query12 = mysqli_query($conn, $sql12);
													
													while($row12 = mysqli_fetch_array($query12)){ echo $row12['keywords'].', '; } ?></td>
													<td style="text-align:center;">
														<a href="javascript:;" onclick="showForm(<?php echo $row['id']; ?>);" ><i class="fas fa-edit"></i></a>&nbsp;&nbsp;&nbsp;
														<a href="javascript:;" onclick="deletekeywords(<?php echo $row['id']; ?>);" style="color:red;" ><i class="fa fa-trash" aria-hidden="true"></i></a>
													</td>  
												</tr>
											<?php $i++; } ?>
                                            </tbody>
                                        </table>
										</div>
                                    </div>
                                    <!-- end card body -->
                                </div>
                                <!-- end card -->
                            </div>
                            <!-- end col -->
							
							
							
                          
                            <?php  include('layout/footer.php'); ?>
                         </div>
                         <!-- end main content-->
                    </div>
                    <!-- END layout-wrapper -->
            </div>
<!--  Large modal example -->
<div class="modal fade supplierView" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="width: 1000px; left: -100px;" >
            <div class="modal-header">
                <h5 class="modal-title" id="myLargeModalLabel">Search Keywords</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
			<form method="POST" id="AddSearchDetails" action="code/savesearch.php" enctype="multipart/form-data">
				<div class="row">
					 <label for="horizontal-firstname-input" class="col-sm-2 col-form-label required">Title</label>
					 <div class="col-sm-4">
						<input id="title" type="text" class="form-control" name="title" value="" required >
						<input id="editId" type="hidden" class="form-control" name="editId" value="0" required >
					 </div>
					 
					 <label for="horizontal-firstname-input" class="col-sm-2 col-form-label required">URL</label>
					 <div class="col-sm-4">
						<input id="url" type="text" class="form-control" name="url" value="" required >
					 </div>
					 
					 <label for="horizontal-firstname-input" class="col-sm-2 col-form-label required">Type</label>
					 <div class="col-sm-4">
						<select class="form-control" name="type" id="type" required >
							<option value="" >Select</option>
							<option value="1" >Page</option>
							<option value="2" >Blog</option>
							<option value="3" >Case studies</option>
						</select>
					 </div>
					 
					 <label for="horizontal-firstname-input" class="col-sm-2 col-form-label required">Image</label>
					 <div class="col-sm-4">
						<input id="image" type="file" class="form-control" name="image" value="" required >
					 </div>
					 
					  <label for="horizontal-firstname-input" class="col-sm-2 col-form-label required">Description</label>
					 <div class="col-sm-4">
						<textarea id="desc" class="form-control" name="desc"  required ></textarea>
					 </div>
				</div>
				<br>
				<div class="row">
					 <label for="horizontal-firstname-input" class="col-sm-2 col-form-label required">Keywords</label>
					
				</div>
				<div id="moreFields" style="max-height: 182px;overflow: hidden;overflow-y: scroll;" >
					<div class="row">
						 <label for="horizontal-firstname-input" class="col-sm-2 col-form-label required">&nbsp;</label>
						 <div class="col-sm-9">
							<input id="keyword" type="text" class="form-control" name="keyword[]" value="" required >
						 </div>
						 <div class="col-sm-1">
							<button id="addMore" type="button" class="btn btn-success btn-sm" value="Add More" style="padding: 2px !important;font-size: 13px;" onclick="addMoreRow()" > <i class="fa fa-light fa-plus"></i> </button>
						 </div>
					</div>
				</div>
            </div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-success btn-sm" >
						Submit
				</button>					
				<a class="btn btn-danger btn-sm" onclick="location.reload()" >Cancel</a>
			</div>
			</form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal --> 
<?php  include('layout/footer-links.php'); ?> 

<script>  
function addMoreRow()
{


	var html = '<div class="row">'+
					 '<label for="horizontal-firstname-input" class="col-sm-2 col-form-label required">&nbsp;</label>'+
					 '<div class="col-sm-9">'+
						'<input id="keyword" type="text" class="form-control" name="keyword[]" value="" required >'+
					 '</div>'+
					 '<div class="col-sm-1">'+
						'<button id="addMore" type="button" class="btn btn-danger btn-sm" value="Add More" style="padding: 2px !important;font-size: 11px;" onclick="removeRow(this)"> <i class="fa fa-solid fa-minus"></i> </button>'+
					 '</div>'+
				'</div>';
	 $("#moreFields").append(html);
}

function removeRow(e)
{
	$(e).closest('.row').remove();
}


$(document).ready(function (e) {
    $('#AddSearchDetails').on('submit',(function(e) {
        e.preventDefault();
        var formData = new FormData(this);

        $.ajax({
            type:'POST',
            url: $(this).attr('action'),
            data:formData,
            cache:false,
            contentType: false,
            processData: false,
            success:function(data){
				var resObj = JSON.parse(data);
               swal({title: "Thank You!", text: resObj.desc, type: "success"}) 
                       .then(function(){ location.reload();}); 
             //   location.reload();
            },
            error: function(data){
                console.log("error");
                console.log(data);
            }
        });
    }));

    // $("#ImageBrowse").on("change", function() {
        // $("#imageUploadForm").submit();
    // });
});

function deletekeywords(id)
{
	var conf = confirm("Are you sure want to delete?");
	if(conf)
	{
		
		$.ajax({
            type:'POST',
            url: "code/deleteSearchDet.php",
			data:{ id:id },
            success:function(data){
                alert("Deleted successfully");
               // location.reload();
            },
            error: function(data){
                console.log("error");
                console.log(data);
            }
        });
	}
}

function showForm(id)
{
	$(".supplierView").modal('show');
	//$("#AddSearchDetails").load(location.href+" #AddSearchDetails>*","");
	
	if( id != '0' )
	{
		$('#image').prop('required',false);
		$.ajax({
			type:'POST',
			url: "code/getSearchDet.php",
			data:{ id:id },
			success:function(data){
				var resObj = JSON.parse(data);
				console.log(resObj);
				console.log(resObj[0].result);
				console.log(resObj[0].keywords);
				
				$("#title").val(resObj[0].result.title);
				$("#editId").val(resObj[0].result.id);
				$("#url").val(resObj[0].result.url);
				$("#desc").val(resObj[0].result.description);
				$("#type").val(resObj[0].result.type);
				
				$("#moreFields").html('');
				$("#moreFields").append('<input id="imageone" type="hidden" class="form-control" name="imageone" value="'+ resObj[0].result.path +'" required >');
				for(var i =0; i < resObj[0].keywords.length; i++)
				{
					console.log(resObj[0].keywords[i]);
					if(i == 0){
						console.log(resObj[0].keywords[i]);
						$("#keyword").val(resObj[0].keywords[i]);
						
						var html = '<div class="row">'+
							 '<label for="horizontal-firstname-input" class="col-sm-2 col-form-label required">&nbsp;</label>'+
							 '<div class="col-sm-9">'+
								'<input id="keyword'+i+'" type="text" class="form-control" name="keyword[]" value="'+ resObj[0].keywords[i] +'" required >'+
							 '</div>'+
							 '<div class="col-sm-1">'+
								'<button id="addMore" type="button" class="btn btn-success btn-sm" value="Add More" style="padding: 2px !important;font-size: 13px;" onclick="addMoreRow()" > <i class="fa fa-light fa-plus"></i> </button>'+
							 '</div>'+
						'</div>';
						$("#moreFields").append(html);
					} else {
						var html = '<div class="row">'+
							 '<label for="horizontal-firstname-input" class="col-sm-2 col-form-label required">&nbsp;</label>'+
							 '<div class="col-sm-9">'+
								'<input id="keyword'+i+'" type="text" class="form-control" name="keyword[]" value="'+ resObj[0].keywords[i] +'" required >'+
							 '</div>'+
							 '<div class="col-sm-1">'+
								'<button id="addMore" type="button" class="btn btn-danger btn-sm" value="Add More" style="padding: 2px !important;font-size: 11px;" onclick="removeRow(this)"> <i class="fa fa-solid fa-minus"></i> </button>'+
							 '</div>'+
						'</div>';
						$("#moreFields").append(html);
					}
				}
				
				
				
			},
			error: function(data){
			}
		});
	} else {
		
		$("#AddSearchDetails").load(location.href+" #AddSearchDetails>*","");
		$('#image').prop('required',true);
	}
}

$(document).ready(function() {
    $('#datatable').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ]
    } );
} );
</script>  