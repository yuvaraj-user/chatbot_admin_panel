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
                                        <h4 class="mb-sm-0 font-size-18"> TNH - B2B (for-enterprises) Popup </h4>
                                    </div>
                                </div>
                            </div>
                            <!-- end page title -->

<!-- Customer form -->
                            <div class="col-xl-12">
                                <div class="card">
                                    <div class="card-body">
                                        
                                            <div class="row mb-1">
												<label for="horizontal-firstname-input" class="col-sm-2 col-form-label required" style="width: 105px;" >From Date</label>
												<div class="col-sm-2">
													<input id="startDate" type="date" class="form-control" name="startDate" value="" onchange="setdate()" >
												</div>

												<label for="horizontal-firstname-input" class="col-sm-1 col-form-label required">To Date</label>
												<div class="col-sm-2">
													<input id="endDate" type="date" class="form-control" name="endDate" value="" onchange="setdate()" >
												</div>
												<div class="col-sm-1">
													<button type="submit" class="btn btn-success btn-md" onclick="searchData();"  >Search</button>
                                                </div>
                                            </div>
                                        
                                    </div>
                                    <!-- end card body -->
                                </div>
                                <!-- end card -->
                            </div>
                            <!-- end col -->
							
							<div class="col-xl-12">
                                <div class="card">
                                    <div class="card-body">
										<div style="overflow-x:auto;">
                                        <table id="datatable" class="table table-bordered dt-responsive nowrap w-100">
                                            <thead>
												<tr>
													<th>SNo</th>
													<th>Date</th>
													<th>Name</th>
													<th>E-Mail</th>
													<th>Mobile No</th>
													<th>Message </th>
												</tr>
                                            </thead>
											
											<tbody id="datalist" >
                                            
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

<?php  include('layout/footer-links.php'); ?> 

<script>  
function setdate() {
	if (startDate != "") {
		var startDate = $("#startDate").val();
		var endDate = $("#endDate").val();

		var today = new Date(startDate);
		var dd = today.getDate();
		var mm = today.getMonth() + 1; //January is 0!
		var yyyy = today.getFullYear();

		if (dd < 10) {
			dd = '0' + dd;
		}

		if (mm < 10) {
			mm = '0' + mm;
		}

		today = yyyy + '-' + mm + '-' + dd;
		document.getElementById("endDate").setAttribute("min", today);

	}
	if (endDate != "") {
		var etoday = new Date(endDate);
		var edd = etoday.getDate();
		var emm = etoday.getMonth() + 1; //January is 0!
		var eyyyy = etoday.getFullYear();

		if (edd < 10) {
			edd = '0' + edd;
		}

		if (emm < 10) {
			emm = '0' + emm;
		}

		etoday = eyyyy + '-' + emm + '-' + edd;
		document.getElementById("startDate").setAttribute("max", etoday);
	}
}

function searchData()
{
	var startDate = $("#startDate").val();
	var endDate = $("#endDate").val();
	
	if(startDate == '' || endDate == '')
	{
		alert("Please select From Date and To Date");
		return false;
	}
	
	$.ajax({
		url: "code/mazenet_b2bpopup.php",
		data: { startDate:startDate, endDate:endDate },
		type: 'POST',
		success: function (data) {
			$("#datalist").html('');
			$("#datalist").html(data);
			$('#datatable').DataTable();
		}
	});
}

$(document).ready(function() {
    // $('#datatable').DataTable( {
        // dom: 'Bfrtip',
        // buttons: [
            // 'copyHtml5',
            // 'excelHtml5',
            // 'csvHtml5',
            // 'pdfHtml5'
        // ]
    // } );
} );
</script>  