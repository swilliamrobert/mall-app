$(document).ready(function(){

    var url = "/mall-app/public/shops";

    //display modal form for shop editing
    $('.open-modal').click(function(){
        var shop_id = $(this).val();

        $.get(url + '/' + shop_id, function (data) {
            //success data
            console.log(data);
            $('#shop_id').val(data.id);
            $('#name').val(data.name);
            $('#floor').val(data.floor);
            $('#lot_no').val(data.lot_no);
            $('#btn-save').val("update");

            $('#myModal').modal('show');
        }) 
    });

    //display modal form for creating new shop
    $('#btn-add').click(function(){
        $('#btn-save').val("add");
        $('#frmShops').trigger("reset");
        $('#myModal').modal('show');
    });

    //display modal form for upload new shop
    $('#btn-upload').click(function(){
        $('#btn-save').val("Upload");
        $('#frmShops').trigger("reset");
        $('#myModalUpload').modal('show');
    });

    //form submit for upload
    $('#btn-uploadfrm').click(function(){
         $( "#UploadShops" ).submit();
    });


    //delete shop and remove it from list
    $('.delete-shop').click(function(){
        var shop_id = $(this).val();

        $.ajax({

            type: "DELETE",
            url: url + '/' + shop_id,
            success: function (data) {
                console.log(data);

                $("#shop" + shop_id).remove();
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });

    //create new shop / update existing shop
    $("#btn-save").click(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        })

        e.preventDefault(); 

        var formData = {
            name: $('#name').val(),
            floor: $('#floor').val(),
            lot_no: $('#lot_no').val(),
        }

        var state = $('#btn-save').val();

        var type = "POST"; //for creating new resource
        var shop_id = $('#shop_id').val();;
        var my_url = url;

        if (state == "update"){
            type = "PUT"; //for updating existing resource
            my_url += '/' + shop_id;
        }

        console.log(formData);

        $.ajax({

            type: type,
            url: my_url,
            data: formData,
            dataType: 'json',
            success: function (data) {
                console.log(data);

                var shop = '<tr id="shop' + data.id + '"><td>' + data.id + '</td><td>' + data.name + '</td><td>' + data.floor + '</td><td>' + data.lot_no + '</td><td>' + data.created_at + '</td>';
                shop += '<td><button class="btn btn-warning btn-xs btn-detail open-modal" value="' + data.id + '">Edit</button>&nbsp&nbsp';
                shop += '<button class="btn btn-danger btn-xs btn-delete delete-shop" value="' + data.id + '">Delete</button></td></tr>';

                if (state == "add"){ //if user added a new record
                    $('#shops-list').append(shop);
                }else{ //if user updated an existing record

                    $("#shop" + shop_id).replaceWith( shop );
                }

                $('#frmShops').trigger("reset");

                $('#myModal').modal('hide')
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });
});