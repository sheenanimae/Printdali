<!-- Main content -->

<section class="content pt-5">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Service List</h3>

                        <button class="btn btn-danger btn-md ml-5" data-title="addservice" data-toggle="modal"
                            data-target="#addservice">
                            <i class="fas fa-plus fa-lg mr-2"></i> Add
                        </button>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Service Name</th>
                                    <th>Description</th>
                                    <th>Remove</th>
                                    <th>Edit</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($allservice as $service){ ?>
                                <tr>
                                    <td><?=$service->service_id ?></td>
                                    <td><?=$service->service_name ?></td>
                                    <td><?=$service->service_des ?></td>
                                    <td class="text-center">
                                        <p data-placement="top" data-toggle="tooltip" title="Edit">
                                            <button class="btn btn-primary btn-md"
                                                onclick="removeService('<?=$service->service_id ?>')">
                                                <i class="far fa-trash-alt fa-lg"></i>
                                            </button>
                                        </p>
                                    </td>
                                    <td class="text-center">
                                        <p data-placement="top" data-toggle="tooltip" title="Update">
                                            <button class="btn btn-success btn-md" data-title="updateservice"
                                                data-toggle="modal" data-target="#updateservice"
                                                onclick="getInfoService('<?=$service->service_id ?>')">
                                                <i class="fas fa-edit fa-lg"></i>
                                            </button>
                                        </p>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                            <!-- <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>Service Name</th>
                                    <th>Description</th>
                                    <th>Remove</th>
                                    <th>Edit</th>
                                </tr>
                            </tfoot> -->
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
<!-- Add Service -->
<div class="modal fade" id="addservice" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content ">
            <div class="modal-header" style="display:block !important;">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span
                        class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>

                <h4 class="modal-title text-center">Add Service</h4>

            </div>
            <form method="POST" role="form" id="AddService">
                <div class="modal-body text-center">
                    <div class="row">
                        <div class="form-group col-12">
                            <label for="serviceName">Service Name:</label>
                            <Input type="text" name="serviceName" class="form-control" id="serviceName" required>
                        </div>
                        <div class="form-group col-12">
                            <label for="servicedes">Service Description:</label>
                            <textarea type="text" name="servicedes" class="form-control" id="servicedes" required>
                                </textarea>
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
<!-- Update Service -->
<div class="modal fade" id="updateservice" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content ">
            <div class="modal-header" style="display:block !important;">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span
                        class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>

                <h4 class="modal-title text-center">Update Service</h4>

            </div>
            <form method="POST" role="form" id="UpdateService">
                <div class="modal-body text-center">
                    <div class="row updateservice">
                        <div class="form-group col-12" id="divupdateserviceName">
                            <label for="serviceName">Service Name:</label>
                        </div>
                        <div class="form-group col-12" id="divupdateservicedes">
                            <label for="servicedes">Service Description:</label>
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
<script>
function getInfoService(serviceID) {
    $.ajax({
        type: "POST",
        url: window.location.origin + "/Printdali/Login/GetServiceInfo",
        data: {
            service_id: serviceID,
        },
        success: function(result) {

            $('input').remove('#updateservice_id');
            $('input').remove('#updateserviceName');
            $('textarea').remove('#updateservicedes');
            var data = JSON.parse(result);
            console.log(data['service_id'])
            $(".updateservice").append(
                " <Input type='hidden' name='updateservice_id' class='form-control' id='updateservice_id' value='" +
                data['service_id'] + "' >"
            );
            $("#divupdateserviceName").append(
                " <Input type='text' name='updateserviceName' class='form-control' id='updateserviceName' value='" +
                data['service_name'] + "' placeholder='" + data['service_name'] + "' required>"
            );
            $("#divupdateservicedes").append(
                "<textarea type='text' name='updateservicedes' class='form-control' id='updateservicedes' value='" +
                data['service_des'] + "' placeholder='" + data['service_des'] + "' required></textarea>"
            );

        }
    })
}

function removeService(serviceID) {
    Swal.fire({
        title: 'Do you want to delete this service?',
        showCancelButton: true,
        confirmButtonText: 'Delete',
    }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
            $.ajax({
                type: "POST",
                url: window.location.origin + "/Printdali/Login/RemovevendorService",
                data: {
                    service_id: serviceID,
                },
                success: function(result) {
                    if (result == '200') {
                        swal.fire({
                            title: "Deleted!",
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

// approve 
$("#UpdateService").submit(function(e) {
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: window.location.origin + "/Printdali/Login/insertupdateService",
        data: {
            service_id: $("#updateservice_id").val(),
            service_des: $("#updateservicedes").val(),
            service_name: $("#updateserviceName").val(),
        },
        success: function(result) {
            if (result == '200') {
                $("#updateservice").modal('hide');

                swal.fire({
                    title: "Updated!",
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
</script>
<script>
$(document).ready(function() {
    $('#costumertab').removeClass('active');
    $('#servicelist').addClass('active');
    $('#vendorhistory').removeClass('active');
    $('#vendorCS').removeClass('active');

    $('#Costumerdropdwon').removeClass('menu-is-opening menu-open');

});
</script>