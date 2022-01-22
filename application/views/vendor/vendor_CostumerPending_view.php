<!-- Main content -->

<section class="content pt-5">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Pending</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center">ID</th>
                                    <th class="text-center">User ID</th>
                                    <th class="text-center">Name</th>
                                    <th class="text-center">Service</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Payment Type</th>
                                    <th class="text-center"># Copy</th>
                                    <th class="text-center">Type</th>\
                                    <th class="text-center">Costumer Note</th>
                                    <th class="text-center">Costumer Status</th>
                                    <th class="text-center">Price</th>
                                    <th class="text-center">Prof of Payment</th>
                                    <th class="text-center">File</th>
                                    <th class="text-center">Pickup Time</th>
                                    <th class="text-center">Done</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($allpendingCostumer as $PendingCostumer){ ?>
                                <tr>
                                    <td class="text-center"><?=$PendingCostumer->costumer_id ?></td>
                                    <td class="text-center"><?=$PendingCostumer->user_id ?></td>
                                    <td class="text-center"><?=$PendingCostumer->user_fname ?>
                                        <?=$PendingCostumer->user_lname ?></td>
                                    <td class="text-center"><?=$PendingCostumer->service_name ?></td>
                                    <td class="text-center"><?=$PendingCostumer->status ?></td>
                                    <td class="text-center"><?=$PendingCostumer->payment_method ?></td>
                                    <td class="text-center"><?=$PendingCostumer->numbercopy ?></td>
                                    <td class="text-center"><?=$PendingCostumer->colortype ?></td>
                                    <td class="text-center"><?=$PendingCostumer->transactionNote ?></td>
                                    <td class="text-center"><?=$PendingCostumer->costumer_status ?></td>
                                    <td class="text-center" class="text-center">
                                        <p class="pl-1" data-placement="top" data-toggle="tooltip" title="Price">
                                            <?=$PendingCostumer->total_price ?>
                                        </p>
                                    </td>
                                    <td class="text-center">
                                        <p class="pl-1" data-placement="top" data-toggle="tooltip" title="Payment Prof">
                                            <button class="btn btn-primary btn-md" data-title="ProfPayment"
                                                onclick="ProfPay('<?=$PendingCostumer->user_id ?>', '<?=$PendingCostumer->VendorID ?>', '<?=$PendingCostumer->paymentSS ?>')"
                                                data-toggle="modal" data-target="#ProfPayment">
                                                <i class="far fa-image fa-lg"></i>
                                            </button>
                                        </p>
                                    </td>
                                    <td class="text-center">
                                        <p class="pl-1" data-placement="top" data-toggle="tooltip" title="File">
                                            <a type="button" target="_blank"
                                                href="<?=base_url($PendingCostumer->File_name."/".$PendingCostumer->costumer_id."/files/")?>"
                                                class="btn btn-warning btn-md">
                                                <i class="fas fa-download fa-lg"></i>
                                            </a>
                                        </p>
                                    </td>
                                    <td class="text-center"><?=$PendingCostumer->pickupDateandTime ?></td>
                                    <td class="text-center">
                                        <p data-placement="top" data-toggle="tooltip" title="ready to pick up">
                                            <button class="btn btn-success btn-md"
                                                onclick="updatecostumerstatus('<?=$PendingCostumer->costumer_id ?>','ready')">
                                                <i class="fas fa-truck-pickup fa-lg"></i>
                                            </button>

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
    $('#costumertab').addClass('active');
    $('#servicelist').removeClass('active');
    $('#vendorhistory').removeClass('active');
    $('#vendorCS').removeClass('active');

    $('#Costumerdropdwon').addClass('menu-is-opening menu-open');

    $('#ListP').removeClass('active');
    $('#PendngP').addClass('active');
    $('#ReadytoP').removeClass('active');
});
</script>