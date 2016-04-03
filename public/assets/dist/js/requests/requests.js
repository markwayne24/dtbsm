$(function () {
    $("#example1").DataTable();
});

$(function () {
    //Initialize Select2 Elements
    $(".select2").select2();
});

$('document').ready(function(){
    var url = 'requests';

    //for viewing item requests
    $('.btn-view').click(function(){
        var id = $(this).val();

        $.ajax({
            type: 'GET',
            url: '/admin/dashboard/requests/' + id +'/'+ 'view',
            success: function (data) {
                console.log(data);
                window.location.href= '/admin/dashboard/requests/'+ id + '/' +'view';

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
            url: '/admin/dashboard/requests/' + id +'/'+ 'view',
            success: function (data) {
                console.log(data);
                location.reload();

            },
            error: function(data){
                console.log('Error:',data);
            }

        });
    });
});
