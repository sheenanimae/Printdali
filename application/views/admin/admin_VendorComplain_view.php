<!-- Main content -->

<section class="content pt-5">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">DataTable Vendors Complain</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Shop Address</th>
                                    <th>Contact Number</th>
                                    <th>Email</th>
                                    <th>Username</th>
                                    <th>Status</th>
                                    <th>Business Permit</th>
                                    <th>Valid ID</th>
                                    <th>Update status</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($allvendor as $vendor){ ?>
                                <tr>
                                    <td><?=$vendor->user_fname ?>
                                        <?=!empty($vendor->user_mname)?$vendor->user_mname:" " ?>
                                        <?=$vendor->user_lname ?></td>
                                    <td><?=$vendor->user_storeaddress ?></td>
                                    <td><?=$vendor->user_contactnumber ?></td>
                                    <td><?=$vendor->user_email ?></td>
                                    <td><?=$vendor->user_username ?></td>
                                    <td><?=$vendor->status?></td>
                                    <td class="text-center">
                                        <p data-placement="top" data-toggle="tooltip" title="Edit">
                                            <button class="btn btn-warning btn-md">
                                                <i class="fas fa-money-check fa-lg"></i>
                                            </button>
                                        </p>
                                    </td>
                                    <td class="text-center">
                                        <p data-placement="top" data-toggle="tooltip" title="Edit">
                                            <button class="btn btn-primary btn-md">
                                                <i class="far fa-id-card fa-lg"></i>
                                            </button>
                                        </p>
                                    </td>
                                    <td class="text-center">
                                        <p data-placement="top" data-toggle="tooltip" title="Edit">
                                            <button class="btn btn-success btn-md">
                                                <i class="fas fa-edit fa-lg"></i>
                                            </button>
                                        </p>
                                    </td>
                                </tr>
                                <?php } ?>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->
<script>
$(document).ready(function() {
    $('#respondentMenu').removeClass('active');
    $('#shopMenu').removeClass('active');
    $('#applicationMenu').removeClass('active');
    $('#accountMenu').removeClass('active');
    $('#complainMenu').addClass('active')

    $('#dropdowncomplainMenu').addClass('menu-is-opening menu-open');
    $('#dropdownaccountMenu').removeClass('menu-is-opening menu-open');
    $('#dropdownapplicationMenu').removeClass('menu-is-opening menu-open');

    $('#complaindown1').addClass('active');
    $('#complaindown2').removeClass('active');
    $('#applicationdown1').removeClass('active');
    $('#applicationdown2').removeClass('active');
    $('#applicationdown3').removeClass('active');
    $('#accountdown2').removeClass('active');
    $('#accountdown1').removeClass('active');

});
</script>