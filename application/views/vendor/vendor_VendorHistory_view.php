<!-- Main content -->

<section class="content pt-5">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">History</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center">ID</th>
                                    <th class="text-center">V-ID</th>
                                    <th class="text-center">User ID</th>
                                    <th class="text-center">Name</th>
                                    <th class="text-center">Service</th>
                                    <th class="text-center">Payment Type</th>
                                    <th class="text-center">Costumer Status</th>
                                    <th class="text-center">Price</th>
                                    <th class="text-center">Prof of Payment</th>
                                    <th class="text-center">File</th>
                                    <th class="text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($allVendorHistory as $ListingHistory){ ?>
                                <tr>
                                    <td class="text-center"><?=$ListingHistory->costumer_id ?></td>
                                    <td class="text-center"><?=$ListingHistory->VendorID ?></td>
                                    <td class="text-center"><?=$ListingHistory->user_id ?></td>
                                    <td class="text-center"><?=$ListingHistory->user_fname ?>
                                        <?=$ListingHistory->user_lname ?></td>
                                    <td class="text-center"><?=$ListingHistory->service_name ?></td>
                                    <td class="text-center"><?=$ListingHistory->payment_method ?></td>
                                    <td class="text-center"><?=$ListingHistory->costumer_status ?></td>
                                    <td class="text-center" class="text-center">
                                        <p class="pl-1" data-placement="top" data-toggle="tooltip" title="Price">
                                            <?=$ListingHistory->total_price ?>
                                        </p>
                                    </td>
                                    <td class="text-center">
                                        <p class="pl-1" data-placement="top" data-toggle="tooltip" title="Payment Prof">
                                            <button class="btn btn-primary btn-md" data-title="ProfPayment"
                                                onclick="ProfPay('<?=$ListingHistory->user_id ?>', '<?=$ListingHistory->VendorID ?>', '<?=$ListingHistory->paymentSS ?>')"
                                                data-toggle="modal" data-target="#ProfPayment">
                                                <i class="far fa-image fa-lg"></i>
                                            </button>
                                        </p>
                                    </td>
                                    <td class="text-center">
                                        <p class="pl-1" data-placement="top" data-toggle="tooltip" title="File">
                                            <a type="button"
                                                href="<?=base_url('/assets/costumer_Files/'.$ListingHistory->VendorID.'/'.$ListingHistory->user_id.'/'.$ListingHistory->File_name)?>"
                                                class="btn btn-warning btn-md">
                                                <i class="fas fa-download fa-lg"></i>
                                            </a>
                                        </p>
                                    </td>
                                    <td class="text-center">

                                        <p <?=($ListingHistory->status=='reject')? "class='pl-1 text-danger'": "class='pl-1 text-success'"; ?>
                                            data-placement="top" data-toggle="tooltip" title="status">
                                            <?php if(strtoupper($ListingHistory->status)=="11"|| strtoupper($ListingHistory->status) == "success"){
                                                echo "Done";
                                            }else{
                                                echo strtoupper($ListingHistory->status);
                                            } ?>
                                        </p>
                                    </td>

                                </tr>
                                <?php } ?>

                            </tbody>
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
    $('#costumertab').removeClass('active');
    $('#servicelist').removeClass('active');
    $('#vendorhistory').addClass('active');
    $('#vendorCS').removeClass('active');

    $('#Costumerdropdwon').removeClass('menu-is-opening menu-open');

});
</script>