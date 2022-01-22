<!-- Main content -->

<section class="content pt-5">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Accounts Shop</h3>
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
                                        <p data-placement="top" data-toggle="tooltip" title="bpermit">
                                            <button class="btn btn-warning btn-md" data-title="bpermit"
                                                onclick="bpermitF('<?=$vendor->user_id ?>')" data-toggle="modal"
                                                data-target="#bpermit">
                                                <i class="fas fa-image fa-lg"></i>
                                            </button>
                                        </p>
                                    </td>
                                    <td class="text-center">
                                        <p data-placement="top" data-toggle="tooltip" title="validID">
                                            <button class="btn btn-primary btn-md" data-title="validID"
                                                onclick="validIDF('<?=$vendor->user_id ?>')" data-toggle="modal"
                                                data-target="#validID">
                                                <i class="far fa-image fa-lg"></i>
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
    $('#complainMenu').removeClass('active');
    $('#accountMenu').addClass('active');

    $('#dropdowncomplainMenu').removeClass('menu-is-opening menu-open');
    $('#dropdownaccountMenu').addClass('menu-is-opening menu-open');
    $('#dropdownapplicationMenu').removeClass('menu-is-opening menu-open');


    $('#complaindown1').removeClass('active');
    $('#complaindown2').removeClass('active');
    $('#applicationdown1').removeClass('active');
    $('#applicationdown2').removeClass('active');
    $('#applicationdown3').removeClass('active');
    $('#accountdown2').removeClass('active');
    $('#accountdown1').addClass('active');

});
</script>