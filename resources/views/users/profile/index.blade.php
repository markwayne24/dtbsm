@extends('layouts.user')

@section('content')
    @include('users.profile.profile')
@stop

@section('scripts')
    <script>
        $(function () {
            $("#example1").DataTable();
        });
    </script>

    <script>
        $(function () {
            //Initialize Select2 Elements
            $(".select2").select2();
        });
    </script>
    <script>
        $(document).ready(function(){
            // Prepare reset.
            var url = "users";

            $('.open-modal-edit').click(function(){
                var id = $(this).val();
                $.ajax({
                    type: 'GET',
                    url: url + '/' + id + '/edit',
                    success: function (data) {
                        console.log(data);
                        $('#firstname').val(data.user_profile.firstname);
                        $('#middlename').val(data.user_profile.middlename);
                        $('#lastname').val(data.user_profile.lastname);
                        $('#address').val(data.user_profile.address);
                        $('#gender').val(data.user_profile.gender);
                        $('#contact_number').val(data.user_profile.contact_number);
                        $('.btn-save').html('Update');
                        $('.btn-save').val('edit');
                        $('#myModal').modal('show');
                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
                });

            });

            $('.btn-save').click(function (e) {
                var formData = {
                    firstname: $('#firstname').val(),
                    middlename: $('#middlename').val(),
                    lastname:$('#lastname').val(),
                    gender:$('#gender').val(),
                    address:$('#address').val(),
                    contact_number: $('#contact_number').val(),
                };

                var type = "PUT";
                var user_id = $('#user_id').val();
                var my_url = url + '/' +user_id;

                console.log(formData);
                $.ajax({
                    type: type,
                    url: my_url,
                    data: formData,
                    success: function (data) {
                        console.log(data);
                        $('#myModal').modal('hide')
                        location.reload();
                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
                });
            });
        });
    </script>
@stop