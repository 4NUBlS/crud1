<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nueapop | Food</title>
    <script src="https://code.jquery.com/jquery-3.6.0.js"
        integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@200&display=swap" rel="stylesheet">
</head>
<style>
    * {
        font-family: 'Kanit', sans-serif;
    }
</style>

<body>
    <div class="container mt-5 pt-1 mb-5" style="width: 900px;">
        <input type="hidden" id="hfRowIndex" value="" />
        <table class="table">
            <tr>
                <td>
                    <div class="input-group">
                        <span class="input-group-text"> Name </span>
                        <input class="form-control" type="text" name="Name" id="txtName" value="" />
                    </div>
                </td>
                <td>
                    <div class="input-group">
                        <span class="input-group-text"> Price </span>
                        <input class="form-control" type="number" name="Price" id="txtPrice" value="" />
                    </div>
                </td>
                <td>
                    <button type='button' id='btnAdd' class='btn btn-primary form-control'> Add </button>
                    <button type='button' id='btnUpdate' style="display: none;" class='btn btn-primary form-control'>
                        Update </button>
                </td>
                <td>
                    <button type='button' id='btnClear' class='btn btn-danger form-control'> Clear </button>
                </td>
            </tr>
        </table>
        <table id="tblCustomers" class="table table-hover table-success">
            <thead>
                <tr class="table-primary">
                    <th>Id</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</body>
<script>
    var toastMixin = Swal.mixin({
        toast: true,
        icon: 'success',
        animation: true,
        position: 'top-right',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    });

    var i = 1;
    $(function () {
        $('#btnAdd').on('click', function () {
            var name, price, id;
            id = i;
            name = $("#txtName").val();
            price = $("#txtPrice").val();

            var edit = "<a class='edit' href='JavaScript:void(0);'><button class='btn btn-success form-control' type='button'> Edit </button></a>";
            var del = "<a class='delete' href='JavaScript:void(0);'><button class='btn btn-danger form-control' type='button'> Delete </button></a>";

            if (name == "" || price == "") {
                toastMixin.fire({
                    title: "Name and Price required!",
                    icon: "error"
                });
            } else {
                var table = "<tr><td>" + id + "</td><td>" + name + "</td><td>" + price + "</td><td>" + edit + "</td><td>" + del + "</td></tr>";
                $("#tblCustomers").append(table);
                toastMixin.fire({
                    title: "Add Menu Success!",
                    icon: "success"
                });
                i += 1;
            }
            name = $("#txtName").val("");
            price = $("#txtPrice").val("");
            Clear();
        });

        $('#btnUpdate').on('click', function () {
            var name, price;
            name = $("#txtName").val();
            price = $("#txtPrice").val();

            $('#tblCustomers tbody tr').eq($('#hfRowIndex').val()).find('td').eq(1).html(name);
            $('#tblCustomers tbody tr').eq($('#hfRowIndex').val()).find('td').eq(2).html(price)

            $('#btnAdd').show();
            $('#btnUpdate').hide();
            toastMixin.fire({
                title: "Update Menu Success!",
                icon: "info"
            });
            Clear();
        });

        $("#tblCustomers").on("click", ".delete", function (e) {
            if (0 == 0) {
                $(this).closest('tr').remove();
                toastMixin.fire({
                    title: "Delete Menu Success!",
                    icon: "warning"
                });
            } else {
                e.preventDefault();
            }
        });

        $('#btnClear').on('click', function () {
            Clear();
        });

        $("#tblCustomers").on("click", ".edit", function (e) {
            var row = $(this).closest('tr');
            $('#hfRowIndex').val($(row).index());
            var td = $(row).find("td");
            $('#txtName').val($(td).eq(1).html());
            $('#txtPrice').val($(td).eq(2).html());
            $('#btnAdd').hide();
            $('#btnUpdate').show();
        });
    });
    function Clear() {
        $("#txtName").val("");
        $("#txtPrice").val("");
        $("#hfRowIndex").val("");
    }
</script>

</html>
