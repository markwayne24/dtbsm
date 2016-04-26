@extends('layouts.admin')

@section('content')
    @include('admin.items.itemTypes.lists')
@stop

@section('scripts')
    <script>
        $(function () {
            $("#example1").DataTable();
        });

        $(function () {
            //Initialize Select2 Elements
            $(".select2").select2();
        });
    </script>
    <script>
        //to make the menu active
        $(document).ready(function(){
               $('#activeSupplies').addClass('active');
        });
    </script>

    <script>
        $(document).ready(function(){
            var url = "item-types";

            $('.open-modal').click(function(){
                var id = $(this).val();
                $.ajax({
                    type: 'GET',
                    url: url + '/' + id,
                    success: function (data) {
                        console.log(data);

                        $('#name').val(data.name);
                        $('#item_id').val(data.id);
                        $('#btn-save').val("Update");

                        $('#myModal').modal('show');

                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
                });

            });

            //delete task and remove it from list
            $('.delete-item').click(function(){
                var id = $(this).val();

                $.ajax({

                    type: "DELETE",
                    url: url + '/' + id,
                    success: function (data) {
                        console.log(data);

                        $("#id" + id).remove();
                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
                });
            });

        });
    </script>
    <script>
        $(document).ready(function(){
            var url = "item-types";
            var options;

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
                        $('#name').val(data.name);
                        $('.btn-save').html('Update');
                        $('#myModalLabel').html('Update Types of Item');
                        $('.btn-save').val('edit');
                        $('#type_id').val(data.id);
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
              var name = $('#name').val().toUpperCase();

                //used to determine the http verb to use [add=POST], [update=PUT]
                var state = $('.btn-save').val();
                var type = "POST"; //for creating new resource
                var type_id = $('#type_id').val();
                var my_url = "item-types";

                if (state == "edit"){
                    type = 'PUT';
                    my_url += '/' + type_id;
                }
                var formData = {
                    categories:$('#categories').val(),
                    name: name
                };

                console.log(formData);
                $.ajax({
                    type: type,
                    url: my_url,
                    data: formData,
                    success: function (data) {
                        console.log(data);
                        $('#myModal').modal('hide');
                        location.reload();
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
            // Clear form fields in a designated area of a page
            $('body').on('hidden.bs.modal', '.modal', function () {
                $('.btn-save').html('Create').val('add');
                $('#myModalLabel').html('Create Types of Item');
                $(this).find('input[type="text"],input[type="email"],textarea,select').each(function() {
                    if (this.defaultValue != '' || this.value != this.defaultValue) {
                        this.value = this.defaultValue;
                    } else { this.value = ''; }
                });
                resetModalFormErrors();
            });

            //delete task and remove it from list
            $('.delete-item').click(function(){
                var id = $(this).val();

                var parent = $('#type-'+id);
                $.ajax({
                    type: "DELETE",
                    url: url + '/' + id ,
                    data: {"_token": "{{ csrf_token() }}" },

                    beforeSend: function() {
                        $('#confirmBox').modal('hide');
                        parent.animate({'backgroundColor':'#fb6c6c'},300);
                    },

                    success: function() {
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
                $('#deleteItem').val(id);
            });
        });
    </script>
@stop
