@extends('layouts.admin')

@section('content')
 @include('admin.users.lists')
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
        $('document').ready(function() {

            // Prepare reset.
            function resetModalFormErrors() {
                $('.form-group').removeClass('has-error');
                $('.form-group').find('.help-block').remove();
            }

            // Intercept submit.
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

                // Request.
                $.ajax({
                    type: "POST",
                    url: url,
                    data: data,
                    dataType: 'json',
                    cache: false,
                    contentType: contentType,
                    processData: false

                    // Response.
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
                        location.reload();
                    }
                });
            });

            // Reset errors when opening modal.
            $('.bootstrap-modal-form-open').click(function() {
                resetModalFormErrors();
            });

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
                        $('#group_id').val(data.user_group.id);
                        $('#firstname').val(data.user_profile.firstname);
                        $('#middlename').val(data.user_profile.middlename);
                        $('#lastname').val(data.user_profile.lastname);
                        $('#address').val(data.user_profile.address);
                        $('#gender').val(data.user_profile.gender);
                        $('#contact_number').val(data.user_profile.contact_number);
                        $('#email').val(data.email);
                        $('.btn-save').html('Update');
                        $('.btn-save').val('edit');
                        $('#myModalLabel').html('Update Users');
                        $('#user_id').val(data.id);
                        $('#myModal').modal('show');
                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
                });

            });

            $('.open-modal-info').click(function(){
               var id = $(this).val();
                $.ajax({
                    type: 'GET',
                    url: url + '/' +id + '/edit',
                    success: function (data){
                        console.log(data);
                        $('#infoUserType').html(data.user_group.name);
                        $('#infoFirstName').html(data.user_profile.firstname);
                        $('#infoMiddleName').html(data.user_profile.middlename);
                        $('#infoLastName').html(data.user_profile.lastname);
                        $('#infoAddress').html(data.user_profile.address);
                        $('#infoGender').html(data.user_profile.gender);
                        $('#infoContactNumber').html(data.user_profile.contact_number);
                        $('#infoEmail').html(data.email);
                        $('#myModalLabel').html('User Info');
                        $('#myModalLabels').modal('show');
                    },
                    error: function(data){
                        console.log('Error:',data);
                    }
                });

            });

            $('.btn-save').click(function (e) {
                var formData = {
                    group_id:$('#group_id').val(),
                    firstname: $('#firstname').val(),
                    middlename: $('#middlename').val(),
                    lastname:$('#lastname').val(),
                    gender:$('#gender').val(),
                    address:$('#address').val(),
                    contact_number: $('#contact_number').val(),
                    email:$('#email').val(),
                    password:$('#password').val(),
                };

                //used to determine the http verb to use [add=POST], [update=PUT]
                var state = $('.btn-save').val();
                var type = "POST"; //for creating new resource
                var item_id = $('#user_id').val();
                var my_url = url;

                if (state == "edit"){
                    type = 'PUT';
                    my_url += '/' + item_id;
                }

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

            // Clear form fields in a designated area of a page
            $('body').on('hidden.bs.modal', '.modal', function () {
                $('.btn-save').html('Create').val('add');
                $('#myModalLabel').html('Create Users');
                $('#password').val('');
                $('#password_confirmation').val('');
                $(this).find('input[type="text"],input[type="email"],textarea,select').each(function() {
                    if (this.defaultValue != '' || this.value != this.defaultValue) {
                        this.value = this.defaultValue;
                    } else { this.value = ''; }
                });
            });

            //delete task and remove it from list
            $('.delete-item').click(function(){
                var id = $(this).val();

                var parent = $('#user-'+id);
                $.ajax({
                    type: "DELETE",
                    url: url + '/' + id ,
                    data: {"_token": "{{ csrf_token() }}" },

                    beforeSend: function() {
                        parent.animate({'backgroundColor':'#fb6c6c'},300);
                    },
                    success: function() {
                        $('#confirmBox').modal('hide')
                        parent.fadeOut(300,function() {
                            parent.remove();
                        });
                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
                });
            });

            $('.deleteModal').click(function() {
                var id = $(this).val();
                $('#deleteUser').val(id);
            });

        });
    </script>
@stop


