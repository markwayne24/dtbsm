$(function () {
    $("#example1").DataTable();
});

$(function () {
    //Initialize Select2 Elements
    $(".select2").select2();
});
//to make the menu active
$(document).ready(function(){
    $('#activeRequests').addClass('active');
});

$('document').ready(function(){
    for(var loop=1; loop <=10;loop++){
        if(window.location.href.toString().split(window.location.host)[1] == '/admin/dashboard/requests/'+ loop){
            $('#district'+loop).addClass('active');
        }
    }
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

    $('.btn-approved').click(function(){
        var id = $(this).val();
        var reason = $('#reason').val();
        var data = {
            status: 'Approved',
            reason: ''
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

    $('.btn-declined').click(function(){
        var id = $('.btn-declined').val();
        $('.btn-save').val(id) ;
        $('#myModal').modal('show');
    });

    $('.btn-save').click(function(){
        var reason = $('#reason').val();
        var id = $('.btn-save').val();
        var data = {
            status: 'Declined',
            reason: reason
        };

        $.ajax({
            type: 'PUT',
            data:  data,
            url: '/admin/dashboard/requests/' + id +'/'+ 'view',
            success: function (data) {
                console.log(data);
                $('#myModal').modal('hide');
                location.reload();

            },
            error: function(data){
                console.log('Error:',data);
            }
        });
    });
});
