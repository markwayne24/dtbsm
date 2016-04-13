$(function () {
    $("#example1").DataTable();
});

$(function () {
    //Initialize Select2 Elements
    $(".select2").select2();
});

function hide_modal(){
    $('#alertModal').modal('hide');
}
// to check the maximum and minum of the numbers
$(".maxmin").each(function () {
    var thisJ = $(this);
    var max = thisJ.attr("max") * 1;
    var min = thisJ.attr("min") * 1;
    var intOnly = String(thisJ.attr("intOnly")).toLowerCase() == "true";

    var test = function (str) {
        return str == "" || /* (!intOnly && str == ".") || */
            ($.isNumeric(str) && str * 1 <= max && str * 1 >= min &&
            (!intOnly || str.indexOf(".") == -1) && str.match(/^0\d/) == null);
        // commented out code would allow entries like ".7"
    };

    thisJ.keydown(function () {
        var str = thisJ.val();
        if (test(str)) thisJ.data("dwnval", str);
    });

    thisJ.keyup(function () {
        var str = thisJ.val();
        if (!test(str)) thisJ.val(thisJ.data("dwnval"));
    })
});

$('document').ready(function(){
    var url = 'requests';

    //for viewing item requests
    $('.btn-view').click(function(){
        var id = $(this).val();

        $.ajax({
            type: 'GET',
            url: '/users/requests/' + id +'/'+ 'view',
            success: function (data) {
                console.log(data);
                window.location.href= '/users/requests/'+ id + '/' +'view';

            },
            error: function(data){
                console.log('Error:',data);
            }

        });
    });

    //Item Requests
    $('.btn-status').click(function(){
        var status = $(this).attr('name');
        var id = $(this).val();
        var data = {
            status:status
        };
        $.ajax({
            type: 'PUT',
            data:  data,
            url: '/users/requests/' + id +'/'+ 'view',
            success: function (data) {
                console.log(data);
                location.reload();

            },
            error: function(data){
                console.log('Error:',data);
            }

        });
    });

    $('.btn-addRequest').click(function(){
        $.ajax({
            type: 'GET',
            url:  '/users/requests/add',
            success:function (data){
                console.log(data);
                window.location.href= '/users/requests/add';
            },
            error: function(data){
                console.log(data);
            }
        });
    });

    //to select the selected row
    $('#example1 tbody').on( 'click', 'tr', function () {
        var firstTable = $('#example1').DataTable();
        if ( $(this).hasClass('selected') ) {
            $(this).removeClass('selected');
        }
        else {
            firstTable.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
    } );

    $('.btn-add').click(function(){
        var quantity = $('#quantity').val();
        var id = $(this).val();
        var table = $('#example2').DataTable();
        var firstTable = $('#example1').DataTable();

        var button = [
                '<button class="btn btn-danger btn-flat btn-remove" data-toggle="modal" data-target=".bs-example-modal-sm" value="' +id +'"><i class="fa fa-trash-o"></i></button>'
        ];

    //to get all data from the selected row on first table
        var data = [
            $(this).closest('tr').find('td:first').text(),
            $(this).closest('tr').find('td:nth-child(2)').text(),
            $(this).closest('tr').find('td:nth-child(3)').text(),
            $(this).closest('tr').find('td:nth-child(4)').text(),
            $(this).closest('tr').find('td:nth-child(5)').text(),
            $(this).closest('tr').find('#quantity').val(),
            button
        ];
        var first = $(this).closest('tr').find('td:first').text();
        var check = true;

        //to check if the items are already on the lists
        $('#example2 tr').each(function(row, tr){
            if(check == true){
                switch(first){
                    case $(tr).find('td:eq(0)').text():
                        check = false;
                        break;
                    default:
                        check = true;
                }
            }

        });

        var alertDuplicate = [
            '<div class="modal-body" id="duplicate">'+
            '<center><H2>This item already exists</H2></center>'+
            '<center> <button type="button" class="btn btn-default" data-dismiss="modal">Ok</button></center></div>'
        ];

        var alertAdded = [
            '<div class="modal-body" id="added">'+
            '<center><H2>Successfully Added on your list</H2></center>'+
            '<center> <button type="button" class="btn btn-default" data-dismiss="modal">Ok</button></center></div>'
        ];

        var alertNull = [
            '<div class="modal-body" id="null">'+
            '<center><H2>Please enter quantity value to add</H2></center>'+
            '<center> <button type="button" class="btn btn-default" data-dismiss="modal">Ok</button></center></div>'
        ];

        var text = $(this).closest('tr').find('#quantity').val();
        //check if the textbox has quantity value
        if(text == ""){
            $('.modal-body').replaceWith(alertNull);
            $('#alertModal').modal('show');
            window.setTimeout(hide_modal, 1000);
        }else{
            if(check){
                //to display data on the second table below first table
                table.row.add(data).draw( false );
                $('.modal-body').replaceWith(alertAdded);
                $('#alertModal').modal('show');
                window.setTimeout(hide_modal, 1000);
            }else{
                //show modal on page laod
                $('.modal-body').replaceWith(alertDuplicate);
                $('#alertModal').modal('show');
                //setTimeout for the modal to hide
                window.setTimeout(hide_modal, 1000);
            }
        }
    });

    $('.btn-send').click(function(){
        // Storing all data on the table to an multidimentional array
        var TableData = [];
        $('#example2 tr').each(function(row, tr){
            if(row != 0){
                TableData[row] = {
                    id : $(tr).find('td:eq(0)').text(),
                    type :$(tr).find('td:eq(1)').text(),
                    name : $(tr).find('td:eq(2)').text(),
                    sku : $(tr).find('td:eq(3)').text(),
                    price : $(tr).find('td:eq(4)').text(),
                    quantity : $(tr).find('td:eq(5)').text(),
                }
            }
        });
        console.log(TableData);
                $.ajax({
                    type:'POST',
                    url:'/users/requests/add',
                    data: TableData,
                    success: function (data) {
                        console.log(data);
                    },
                    error: function (data){
                        console.log(data);
                    }
                });

    });

    $('.deleteModal').click(function() {
        var id = $(this).val();
        $('#deleteItem').val(id);
    });

    $('.delete-item').click(function(){
        var table = $('#example2').DataTable();
        var id = $(this).val();


        $('#example2 tbody').on( 'click', 'tr', function () {
            if ( $(this).hasClass('selected') ) {
                $(this).removeClass('selected');
            }
            else {
                table.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');
            }
        } );
        $('#confirmBox').modal('hide');
        table.row('.selected').remove().draw( false );

    });

    $(document).ready(function() {
        var table = $('#example2').DataTable();

        $('#example2 tbody').on( 'click', 'tr', function () {
            if ( $(this).hasClass('selected') ) {
                $(this).removeClass('selected');
            }
            else {
                table.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');
            }
        } );

        $('#button').click( function () {
            table.row('.selected').remove().draw( false );
        } );
    } );
});
