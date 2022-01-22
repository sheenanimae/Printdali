</div>
<!-- BPermit -->
<div class="modal fade" id="storeimage" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content ">
            <div class="modal-header" style="display:block !important;">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span
                        class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>

                <h4 class="modal-title text-center">Shop Image</h4>

            </div>
            <div class="modal-body text-center" id="Disstoreimage">

            </div>
            <div class="modal-footer ">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i
                        class="fas fa-times-circle"></i> Close</button>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</div>
<!-- BPermit -->
<div class="modal fade" id="bpermit" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content ">
            <div class="modal-header" style="display:block !important;">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span
                        class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>

                <h4 class="modal-title text-center">Business Permit</h4>

            </div>
            <div class="modal-body text-center" id="DisBpermit">

            </div>
            <div class="modal-footer ">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i
                        class="fas fa-times-circle"></i> Close</button>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</div>
<!-- valid ID -->
<div class="modal fade" id="validID" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content ">
            <div class="modal-header" style="display:block !important;">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span
                        class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>

                <h4 class="modal-title text-center">Valid ID</h4>

            </div>
            <div class="modal-body text-center" id="DisValidID">

            </div>
            <div class="modal-footer ">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i
                        class="fas fa-times-circle"></i> Close</button>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</div>

<!-- Approved Vendor -->
<div class="modal fade" id="approvedVendor" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">

    <div class="modal-dialog">
        <div class="modal-content ">
            <div class="modal-header" style="display:block !important;">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span
                        class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>

                <h4 class="modal-title text-center">Approved Shop</h4>

            </div>
            <form method="POST" role="form" id="approveBy">
                <div class="modal-body text-center">

                    <div class="row">
                        <div class="form-group col-12">
                            <label for="locationLong">Longhitude</label>
                            <input type="text" name="locationLong" class="form-control" id="locationLong"
                                placeholder="Long" required>
                        </div>
                        <div class="form-group col-12">
                            <label for="locationLat">Lathitude</label>
                            <input type="text" name="locationLat" class="form-control" id="locationLat"
                                placeholder="Lat" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer ">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-check-circle"></i>
                        Submit</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i
                            class="fas fa-times-circle"></i> 
                        Close</button>
                </div>
            </form>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

</div>
<!-- Dispproved Vendor -->
<div class="modal fade" id="disapprovedVendor" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content ">
            <div class="modal-header" style="display:block !important;">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span
                        class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>

                <h4 class="modal-title text-center">Dispproved Shop</h4>

            </div>
            <form method="POST" role="form" id="disapproveBy">
                <div class="modal-body text-center">
                    <div class="row">
                        <div class="form-group col-12">
                            <label for="vendorNote">Note:</label>
                            <textarea type="text" name="vendorNote" class="form-control" id="vendorNote"
                                placeholder="text..." required></textarea>
                        </div>

                    </div>
                </div>
                <div class="modal-footer ">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-check-circle"></i>
                        Submit</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i
                            class="fas fa-times-circle"></i> 
                        Close</button>
                </div>
            </form>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</div>
<!-- vendorNotes -->
<div class="modal fade" id="vnote" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content ">
            <div class="modal-header" style="display:block !important;">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span
                        class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>

                <h4 class="modal-title text-center">Note</h4>

            </div>
            <div class="modal-body text-center" id="DisNotes">

            </div>
            <div class="modal-footer ">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i
                        class="fas fa-times-circle"></i> Close</button>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</div>
<!-- Prof of Payment Online -->
<div class="modal fade" id="ProfPayment" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content ">
            <div class="modal-header" style="display:block !important;">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span
                        class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>

                <h4 class="modal-title text-center">Online Payment Screen Shot</h4>

            </div>
            <div class="modal-body text-center" id="PaySS">

            </div>
            <div class="modal-footer ">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i
                        class="fas fa-times-circle"></i> Close</button>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</div>
</body>

<script>
var TABLEs = $('#example2').DataTable();
$(document).ready(function() {
    TABLEs;

});

function storeIMG(id) {
    $.ajax({
        type: "POST",
        url: window.location.origin + "/Printdali/Login/getVendorDetail",
        data: {
            id: id
        },
        success: function(result) {
            $('img').remove('#Store-img');
            var data = JSON.parse(result);
            console.log(data)
            $("#Disstoreimage").append(
                "<img id='Store-img' src='<?= base_url(); ?>assets/VendorApplicationData/" + data[
                    'user_email'] + "/" + data['storenameImg'] +
                "' style='max-width: 900px; height: auto; '/>"
            );


        }
    })
}

function bpermitF(id) {
    $.ajax({
        type: "POST",
        url: window.location.origin + "/Printdali/Login/getVendorDetail",
        data: {
            id: id
        },
        success: function(result) {
            $('img').remove('#permitImg');
            var data = JSON.parse(result);
            console.log(data)
            $("#DisBpermit").append(
                "<img id='permitImg' src='<?= base_url(); ?>assets/VendorApplicationData/" + data[
                    'user_email'] + "/" + data['permitName'] +
                "' style='max-width: 900px; height: auto; '/>"
            );


        }
    })
}

function validIDF(id) {
    $.ajax({
        type: "POST",
        url: window.location.origin + "/Printdali/Login/getVendorDetail",
        data: {
            id: id
        },
        success: function(result) {
            $('img').remove('#IDImg');
            var data = JSON.parse(result);
            console.log(data)
            $("#DisValidID").append(
                "<img id='IDImg' src='<?= base_url(); ?>assets/VendorApplicationData/" + data[
                    'user_email'] + "/" + data['ValidIdName'] +
                "' style='max-width: 900px; height: auto; '/>"
            );


        }
    })
}

function vendorNote(id) {
    $.ajax({
        type: "POST",
        url: window.location.origin + "/Printdali/Login/getVendorNotes",
        data: {
            id: id
        },
        success: function(result) {
            $('p').remove('#notesV');
            var data = JSON.parse(result);
            console.log(data)
            $("#DisNotes").append(
                "<p id='notesV'> " + data['note_message'] + "</p>"
            );


        }
    })
}
var vendorid;

function approvebyId(id) {
    $("#approveBy").trigger("reset");
    vendorid = id;
}

function disapprovebyId(id) {
    $("#disapproveBy").trigger("reset");
    vendorid = id;
}
// approve 
$("#approveBy").submit(function(e) {
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: window.location.origin + "/Printdali/Login/locationData",
        data: {
            id: vendorid,
            LongH: $("#locationLong").val(),
            LatH: $("#locationLat").val(),
        },
        success: function(result) {
            if (result == '200') {
                $("#approvedVendor").modal('hide');

                swal.fire({
                    title: "Approved!",
                    text: "Successfully",
                    icon: "success",
                    button: "Ok!",
                }).then((result) => {
                    location.reload();
                })

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
});
// disapprove 
$("#disapproveBy").submit(function(e) {
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: window.location.origin + "/Printdali/Login/disapprovedWithNote",
        data: {
            id: vendorid,
            messageN: $("#vendorNote").val()
        },
        success: function(result) {
            if (result == '200') {
                $("#disapprovedVendor").modal('hide');

                swal.fire({
                    title: "Disapproved!",
                    text: "Successfully",
                    icon: "success",
                    button: "Ok!",
                }).then((result) => {
                    location.reload();
                })

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
});
// add sevice 
$("#AddService").submit(function(e) {
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: window.location.origin + "/Printdali/Login/addVendorService",
        data: {
            service_name: $("#serviceName").val(),
            service_des: $("#servicedes").val(),
        },
        success: function(result) {
            if (result == '200') {
                $("#AddService").modal('hide');

                swal.fire({
                    title: "Added!",
                    text: "Successfully",
                    icon: "success",
                    button: "Ok!",
                }).then((result) => {
                    location.reload();
                })

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
});
//Update Costumer Status
function updatecostumerstatus(costumerId, status) {
    var messageText, successText;
    if (status == 'pending') {
        messageText = 'Are you sure you want to Accept and move to pending.?';
        successText = 'Moved to Pending!';
    } else if (status == 'reject') {
        messageText = 'Are you sure you want to Reject and move to History.?';
        successText = 'Rejected!';
    } else if (status == 'ready') {
        messageText = 'Are you sure its Ready and move Ready to Pickup.?';
        successText = 'Moved Ready to Pickup!';
    } else if (status == 'success') {
        messageText = 'Already Pickup.?';
        successText = 'Pickup!';
    }
    Swal.fire({
        title: messageText,
        showCancelButton: true,
        confirmButtonText: 'Yes!',
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "POST",
                url: window.location.origin + "/Printdali/Login/UpdateCostumerStatus",
                data: {
                    costumer_id: costumerId,
                    status: status
                },
                success: function(result) {
                    if (result == '200') {
                        swal.fire({
                            title: successText,
                            text: "Successfully",
                            icon: "success",
                            button: "Ok!",
                        }).then((result) => {
                            location.reload();
                        })

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
    })
}
//Prof of Payment
function ProfPay(user_id, VendorID, paymentSS) {

    $('img').remove('#ProfPay');
    $("#PaySS").append(
        "<img id='ProfPay' src='<?= base_url(); ?>" + paymentSS.substring(2) +
        " 'style='max-width: 900px; height: auto; '/>"
    );


}
</script>

</html>