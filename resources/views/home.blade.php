<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/main.css') }}">
    <title>Document</title>
</head>

<body>
    <div class="row p-5">
        <div class="col-12">
            <h3>Halo, Asroel!</h3>
            <p class="text-danger">asroel.dev@gmail.com</p>
        </div>
        <div class="col-6 d-flex justify-content-start align-items-center mt-3">
            <p class="mb-0 text-danger">Labels</p>
        </div>
        <div class="col-6 mt-3 text-end">
            <button onclick="modalCategory()" class="btn btn-yfk">+ New label</button>
        </div>
        <div class="col-12 mt-3 p-3 bg-yfk br-20">
            <p class="fw-700">Costumer Type</p>
            <div id="costumer">
                <!-- APPEND BY JS -->
            </div>
        </div>
        <div class="col-12 mt-3 p-3 bg-yfk br-20">
            <p class="fw-700">Goals</p>
            <div id="goals">
                <!-- APPEND BY JS -->
            </div>
        </div>
    </div>
</body>

<div class="modal fade" id="modal-category" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title"></h5>
            </div>
            <div class="modal-body">
                <div class="row p-3">
                    <div class="col-12">
                        <input id="label" type="text" class="form-control" placeholder="Enter Label Name">
                    </div>
                    <div class="col-12 mt-3">
                        <select id="kategori" class="form-select" aria-label="Default select example">
                            <option value="0" selected>Select Category</option>
                            <option value="1">Costumer Type</option>
                            <option value="2">Goals</option>
                        </select>
                    </div>
                </div>
            </div>
            <div id="modal-footer" class="modal-footer d-flex justify-content-center">
                <!-- APPEND BY JS -->
            </div>
        </div>
    </div>
</div>

</html>

<script>
    function modalCategory() {
        $("#modal-category").modal('show');

        var html = `<button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-yfk text-dark" onclick="saveCategory()">Create</button>`;

        $("#modal-title").text("Create new Label");
        $("#label").val('');
        $("#kategori").val(0).attr('selected');
        $("#modal-footer").html(html);
    }

    function editData(id) {
        var tokenVal = $('meta[name="csrf-token"]').attr('content');
        var fd = new FormData();

        $.ajax({
            type: 'GET',
            url: '/get_data_modal/' + id,
            data: fd,
            enctype: 'multipart/form-data',
            cache: false,
            contentType: false,
            async: false,
            processData: false,
            success: function(response) {
                console.log(response);
                $("#modal-category").modal('show');

                var html = `<button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-yfk text-dark" onclick="updateData(` + id + `)">Save</button>`;

                $("#modal-title").text("Edit Label");
                $("#label").val(response[0].label);
                $("#kategori").val(2).attr('selected');
                $("#modal-footer").html(html);
            },
            error: function(error) {
                console.log(error);
            }
        });
    }

    function saveCategory() {
        var object = {}

        $("input, select").each(function(index, value) {
            object[value.id] = $(value).val();
        });

        console.log(object.label);
        console.log(object.kategori);

        var tokenVal = $('meta[name="csrf-token"]').attr('content');
        var fd = new FormData();

        fd.append("label", object.label);
        fd.append("kategori", object.kategori);
        fd.append("_token", tokenVal);

        $.ajax({
            type: 'POST',
            url: '/data',
            data: fd,
            enctype: 'multipart/form-data',
            cache: false,
            contentType: false,
            async: false,
            processData: false,
            success: function(response) {
                alert("DATA BERHASIL DIMASUKKAN!");
                window.location.reload();
            },
            error: function(error) {
                console.log(error);
            }
        });
    }

    function getData() {
        var tokenVal = $('meta[name="csrf-token"]').attr('content');
        var fd = new FormData();

        $.ajax({
            type: 'GET',
            url: '/get_data',
            data: fd,
            enctype: 'multipart/form-data',
            cache: false,
            contentType: false,
            async: false,
            processData: false,
            success: function(response) {
                console.log(response);

                for (var i = 0; i <= response.length; i++) {
                    if (response.length > 0) {
                        var html = `<div onclick="editData(` + response[i].id + `)" class="row gx-0 mt-1">
                            <div class="col-9 d-flex justify-content-center">
                                <input type="text" class="form-control text-danger" value="` + response[i].label + `" readonly>
                            </div>
                            <div class="col-3 d-flex justify-content-end">
                                <button onclick="deleteData(` + response[i].id + `)" class="btn btn-white text-danger bg-white">Delete</button>
                            </div>
                        </div>`;

                        if (response[i].kategori == 1) {
                            $("#costumer").append(html);
                        } else {
                            $("#goals").append(html);
                        }
                    } else {
                        var html = `<div class="row gx-0 mt-1">
                            <div class="col-12 d-flex justify-content-center">
                                <h6>NO DATA AVAILABLE</h6>
                            </div>
                        </div>`;

                        $("#costumer").html(html);
                    }
                }
            },
            error: function(error) {
                console.log(error);
            }
        });
    }

    getData();

    function updateData(id) {
        var object = {}

        $("input, select").each(function(index, value) {
            object[value.id] = $(value).val();
        });

        var tokenVal = $('meta[name="csrf-token"]').attr('content');
        var fd = new FormData();

        fd.append("label", object.label);
        fd.append("kategori", object.kategori);
        fd.append("_token", tokenVal);

        $.ajax({
            type: 'POST',
            url: '/edit_data/' + id,
            data: fd,
            enctype: 'multipart/form-data',
            cache: false,
            contentType: false,
            async: false,
            processData: false,
            success: function(response) {
                alert("EDIT DATA BERHASIL!");
                window.location.reload();
            },
            error: function(error) {
                console.log(error);
            }
        });
    }

    function deleteData(id) {
        var tokenVal = $('meta[name="csrf-token"]').attr('content');
        var fd = new FormData();

        fd.append("_token", tokenVal);
        fd.append("id", id);

        $.ajax({
            type: 'POST',
            url: '/delete_data/' + id,
            data: fd,
            enctype: 'multipart/form-data',
            cache: false,
            contentType: false,
            async: false,
            processData: false,
            success: function(response) {
                alert("DELETE DATA BERHASIL!");
                window.location.reload();
            },
            error: function(error) {
                console.log(error);
            }
        });
    }
</script>