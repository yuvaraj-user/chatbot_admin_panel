<?php  include('layout/header.php'); ?>
<style>
[type=button]:not(:disabled), [type=reset]:not(:disabled), [type=submit]:not(:disabled), button:not(:disabled) {
    cursor: pointer;
    padding: 5px !important;
}
.table-nowrap td, .table-nowrap th {
    padding: 4px 10px;
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
                                        <h4 class="mb-sm-0 font-size-18">Customer Rate</h4>
                                    </div>
                                </div>
                            </div>
                            <!-- end page title -->

                            <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">

                                    <div class="row mb-1">
                                       &nbsp;&nbsp;&nbsp; <label for="horizontal-firstname-input" class="col-sm-2 col-form-label">Customer Group</label>
                                        <div class="col-sm-3">
                                            <select class="form-control"  >
                                                <option>SSC</option>
                                            </select>
                                        </div>
                                    </div>
                                    <br>

                                        <div class="table-responsive">
                                            <table class="table table-editable table-nowrap align-middle table-edits">
                                                <thead>
                                                    <tr>
                                                        <th>Material Name</th>
                                                        <th>Original Rate</th>
                                                        <th>Cust Rate</th>
                                                        <th>Edit</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr data-id="1">
                                                        <td data-field="name">David McHenry</td>
                                                        <td data-field="age">24</td>
                                                        <td data-field="gender">24</td>
                                                        <td style="width: 100px">
                                                            <a class="btn btn-outline-secondary btn-sm edit" title="Edit">
                                                                <i class="fas fa-pencil-alt"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <tr data-id="2">
                                                        <td data-field="name">Frank Kirk</td>
                                                        <td data-field="age">22</td>
                                                        <td data-field="gender">24</td>
                                                        <td>
                                                            <a class="btn btn-outline-secondary btn-sm edit" title="Edit">
                                                                <i class="fas fa-pencil-alt"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <tr data-id="3">
                                                        <td data-field="name">Rafael Morales</td>
                                                        <td data-field="age">26</td>
                                                        <td data-field="gender">24</td>
                                                        <td>
                                                            <a class="btn btn-outline-secondary btn-sm edit" title="Edit">
                                                                <i class="fas fa-pencil-alt"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <tr data-id="4">
                                                        <td data-field="name">Mark Ellison</td>
                                                        <td data-field="age">32</td>
                                                        <td data-field="gender">24</td>
                                                        <td>
                                                            <a class="btn btn-outline-secondary btn-sm edit" title="Edit">
                                                                <i class="fas fa-pencil-alt"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <tr data-id="5">
                                                        <td data-field="name">Minnie Walter</td>
                                                        <td data-field="age">27</td>
                                                        <td data-field="gender">24</td>
                                                        <td>
                                                            <a class="btn btn-outline-secondary btn-sm edit" title="Edit">
                                                                <i class="fas fa-pencil-alt"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                                </table>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-1">
                                                <div>
                                                    <button type="submit" class="btn btn-secondary w-xs">Print</button>
                                                </div>
                                            </div>
                                            <div class="col-sm-1">
                                                <div>
                                                    <button type="submit" class="btn btn-info w-xs">Email</button>
                                                </div>
                                            </div>
                                            <div class="col-sm-1">
                                                <div>
                                                    <button type="submit" class="btn btn-primary w-xs">Excel</button>
                                                </div>
                                            </div>
                                        </div>
        
                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div> <!-- end row -->

                          
                            <?php  include('layout/footer.php'); ?>
                         </div>
                         <!-- end main content-->
                    </div>
                    <!-- END layout-wrapper -->
            </div>
            
<?php  include('layout/footer-links.php'); ?>   

  <!-- Table Editable plugin -->
  <script src="assets/libs/table-edits/build/table-edits.min.js"></script>

<script src="assets/js/pages/table-editable.int.js"></script> 