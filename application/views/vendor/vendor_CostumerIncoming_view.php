<!-- Main content -->

<section class="content pt-5">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">New Costumer</h3>
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
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($alllistingCostumer as $ListingCostumer){ ?>
                                <tr>
                                    <td class="text-center"><?=$ListingCostumer->costumer_id ?></td>
                                    <td class="text-center"><?=$ListingCostumer->user_id ?></td>
                                    <td class="text-center"><?=$ListingCostumer->user_fname ?>
                                        <?=$ListingCostumer->user_lname ?></td>
                                    <td class="text-center"><?=$ListingCostumer->service_name ?></td>
                                    <td class="text-center"><?=$ListingCostumer->status ?></td>
                                    <td class="text-center"><?=$ListingCostumer->payment_method ?></td>

                                    <td class="text-center"><?=$ListingCostumer->numbercopy ?></td>
                                    <td class="text-center"><?=$ListingCostumer->colortype ?></td>
                                    <td class="text-center"><?=$ListingCostumer->transactionNote ?></td>

                                    <td class="text-center"><?=$ListingCostumer->costumer_status ?></td>
                                    <td class="text-center" class="text-center"><?=$ListingCostumer->total_price ?>
                                        <p class="pl-1" data-placement="top" data-toggle="tooltip" title="Price">
                                            <button class="btn btn-info btn-md btn-price"
                                                onclick="UpdatePrice('<?=$ListingCostumer->costumer_id ?>')">
                                                <i class="far fa-money-bill-alt fa-lg"></i>
                                            </button>
                                        </p>
                                    </td>
                                    <td class="text-center">
                                        <p class="pl-1" data-placement="top" data-toggle="tooltip" title="Payment Prof">
                                            <button class="btn btn-primary btn-md" data-title="ProfPayment"
                                                onclick="ProfPay('<?=$ListingCostumer->user_id ?>', '<?=$ListingCostumer->VendorID ?>', '<?=$ListingCostumer->paymentSS ?>')"
                                                data-toggle="modal" data-target="#ProfPayment">
                                                <i class="far fa-image fa-lg"></i>
                                            </button>
                                        </p>
                                    </td>
                                    <td class="text-center">
                                        <p class="pl-1" data-placement="top" data-toggle="tooltip" title="File">
                                            <a type="button" target="_blank"
                                                href="<?=base_url($ListingCostumer->File_name."/".$ListingCostumer->costumer_id."/files/")?>"
                                                class="btn btn-warning btn-md">
                                                <i class="fas fa-download fa-lg"></i>
                                            </a>
                                        </p>
                                    </td>
                                    <td class="text-center"><?=$ListingCostumer->pickupDateandTime ?></td>
                                    <td class="text-center">
                                        <p data-placement="top" data-toggle="tooltip" title="accept/reject">
                                            <button class="btn btn-success btn-md"
                                                <?=$ListingCostumer->costumer_status=='0'?'disabled':''; ?>
                                                onclick="updatecostumerstatus('<?=$ListingCostumer->costumer_id ?>','pending')">
                                                <i class="fas fa-check-square fa-lg"></i>
                                            </button>
                                            <button class="btn btn-danger btn-md"
                                                onclick="updatecostumerstatus('<?=$ListingCostumer->costumer_id ?>','reject')">
                                                <i class="far fa-trash-alt fa-lg"></i>
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

    $('#ListP').addClass('active');
    $('#PendngP').removeClass('active');
    $('#ReadytoP').removeClass('active');


});


function UpdatePrice(costumerId) {
    const {
        value: totalPrice
    } = Swal.fire({
        title: 'Price',
        input: 'number',
        confirmButtonText: 'Submit',
        showCancelButton: true,
        inputLabel: 'Enter Price',
        inputValidator: (totalPrice) => {
            if (!totalPrice) {
                return 'You need to input amount!'
            } else {
                $.ajax({
                    type: "POST",
                    url: window.location.origin + "/Printdali/Login/Updateprice",
                    data: {
                        costumer_id: costumerId,
                        total_price: totalPrice
                    },
                    success: function(result) {
                        if (result == '200') {
                            Swal.disableInput();
                            location.reload();
                        } else {
                            swal.fire({
                                title: "Error!",
                                text: "Failed",
                                icon: "error",
                                button: "Ok!",
                            });
                        }

                    }
                })

            }
        }
    })

};
</script>