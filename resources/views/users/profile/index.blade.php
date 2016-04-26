@extends('layouts.user')

@section('style')
<style>
    #contentBg {
        left: 20%;
        top: 10%;
        width: 80%;
        height: 100%;
        opacity: 0.6;
        position:absolute;
        background-repeat: no-repeat;
    }
</style>

@stop

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

            // Prepare reset.
            function resetModalFormErrors() {
                $('.form-group').removeClass('has-error');
                $('.form-group').find('.help-block').remove();
            }

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
                        $('#school').val(data.user_profile.school);
                        $('#gender').val(data.user_profile.gender);
                        $('#contact_number').val(data.user_profile.contact_number);
                        $('#email').val(data.email);
                        $('.btn-save').html('Update');
                        $('.btn-save').val('edit');
                        $('#myModal').modal('show');
                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
                });

            });

            $('form.bootstrap-modal-form').on('submit', function(submission) {
                submission.preventDefault();

                // Set vars.
                var form   = $(this),
                        url    = form.attr('action'),
                        submit = form.find('[type=submit]');

                // Check for file inputs.
                if (form.find('[type=file]').length) {

                    // If found, prepare submission via FormData object.
                    var input       = form.serializeArray(),
                            data        = new FormData(),
                            contentType = false;

                    // Append input to FormData object.
                    $.each(input, function(index, input) {
                        data.append(input.name, input.value);
                    });

                    // Append files to FormData object.
                    $.each(form.find('[type=file]'), function(index, input) {
                        if (input.files.length == 1) {
                            data.append(input.name, input.files[0]);
                        } else if (input.files.length > 1) {
                            data.append(input.name, input.files);
                        }
                    });
                }

                // If no file input found, do not use FormData object (better browser compatibility).
                else {
                    var data        = form.serialize(),
                            contentType = 'application/x-www-form-urlencoded; charset=UTF-8';
                }

                // Please wait.
                if (submit.is('button')) {
                    var submitOriginal = submit.html();
                    submit.html('Please wait...');
                } else if (submit.is('input')) {
                    var submitOriginal = submit.val();
                    submit.val('Please wait...');
                }


                //Uppercase First word
                var firstname = $('#firstname').val().substring(0, 1).toUpperCase() + $('#firstname').val().substring(1);
                var middlename = $('#middlename').val().substring(0, 1).toUpperCase() + $('#middlename').val().substring(1);
                var lastname = $('#lastname').val().substring(0, 1).toUpperCase() + $('#lastname').val().substring(1);




                var formData = {
                    firstname: firstname,
                    middlename: middlename,
                    lastname:lastname,
                    gender:$('#gender').val(),
                    address:$('#address').val(),
                    school:$('#school').val(),
                    contact_number: $('#contact_number').val(),
                    email: $('#email').val(),
                    password:$('#password').val(),
                    image_path: input
                };

                var type = "PUT";
                var user_id = $('#user_id').val();
                var my_url = 'users' + '/' +user_id;

                console.log(formData)
                $.ajax({
                    type: type,
                    url: my_url,
                    data: formData,
                    success: function (data) {
                        console.log(data);

                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
                }).always(function(response, status) {

                    // Reset errors.
                    resetModalFormErrors();

                    // Check for errors.
                    if (response.status == 422) {
                        var errors = $.parseJSON(response.responseText);

                        // Iterate through errors object.
                        $.each(errors, function(field, message) {
                            console.error(field+': '+message);
                            var formGroup = $('[name='+field+']', form).closest('.form-group');
                            formGroup.addClass('has-error').append('<p class="help-block">'+message+'</p>');
                        });

                        // Reset submit.
                        if (submit.is('button')) {
                            submit.html(submitOriginal);
                        } else if (submit.is('input')) {
                            submit.val(submitOriginal);
                        }

                        // If successful, reload.
                    } else {
                        // location.reload();
                    }
                });
            });
        });
    </script>
@stop