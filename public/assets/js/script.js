$(document).ready(function(){
    $('#btn-kembali').prop('hidden', true);
    $('#form-btn-save').prop('hidden', true);

    //SHOW TABLE
    $('.btn-table-show').click(function() {

        var me = $(this),
        title = me.attr('title');

        $('.form-title').text(title);
        $('.table-data').prop('hidden', false);
        $('.btn-export').prop('hidden', false);
        $('.form-data-show').prop('hidden', true);

    })

    //SHOW FORM CREATE
    $('.btn-form-show').click(function(){
        event.preventDefault();

        var me = $(this),
        url = me.attr('href'),
        title = me.attr('title');

        $('.form-title').text(title);
        $('.btn-export').prop('hidden', true);
        $('.table-data').prop('hidden', true);
        $('.form-data-show').prop('hidden', false);
        $('#btn-kembali').prop('hidden', false);
        $('#form-btn-save').prop('hidden', false);
        $('#form-btn-save').removeClass('hide')
        .text(me.hasClass('edit') ? 'Update' : 'Create');

        $.ajax({
            url: url,
            dataType: 'html',
            success: function(response){
                $('#form-show').html(response);
            }
        })   

    })

})

//SHOW FORM EDIT
$('body').on('click', '.btn-form-edit', function(event){
    event.preventDefault();

    var me = $(this),
    url = me.attr('href'),
    title = me.attr('title');

    $('.form-title').text(title);
    $('.btn-export').prop('hidden', true);
    $('.table-data').prop('hidden', true);
    $('.form-data-show').prop('hidden', false);

    $('#btn-kembali').prop('hidden', false);
    $('#form-btn-save').prop('hidden', false);
    $('#form-btn-save').removeClass('hide')
    .text(me.hasClass('edit') ? 'Update' : 'Create');

    $.ajax({
        url: url,
        dataType: 'html',
        success: function(response){
            $('#form-show').html(response);
        }
    })   
})

//SHOW DETAIL
$('body').on('click', '.btn-show', function (event) {
    event.preventDefault();

    var me = $(this),
    url = me.attr('href'),
    title = me.attr('title');

    $('.form-title').text(title);
    $('.btn-export').prop('hidden', true);
    $('.table-data').prop('hidden', true);
    $('.form-data-show').prop('hidden', false);
    $('#btn-kembali').prop('hidden', false);
    $('#form-btn-save').prop('hidden', true);

    $.ajax({
        url: url,
        dataType: 'html',
        success: function(response){
            $('#form-show').html(response);
        }
    })   
});

//ACTION CREATE-EDIT
$('#form-btn-save').click(function (event) {
    event.preventDefault();

    const fileupload = $('#fileupload').prop('files')[0];
 
    let formData = new FormData();
    formData.append('fileupload', fileupload);
    formData.append('name', $('#name').val());
    formData.append('alamat', $('#alamat').val());

    var formURL = $("#formData").attr("action");
    method = $('input[name=_method]').val() == undefined ? 'POST' : 'PUT';

    formData.find('.help-error').remove();
    formData.find('.spanerror').removeClass('has-error');
    
    $.ajax({
        url : formURL,
        method: method,
        enctype: 'multipart/form-data',
        data : formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function (response) {
            if(response.status == 'ERROR'){
                swal({
                    type: 'error',
                    title: 'Oops...',
                    text: 'Data Error!'
                });
            } else {
                formData.trigger('reset');
                $('#datatable').DataTable().ajax.reload();

                $('.form-title').text('Table Data');
                $('.table-data').prop('hidden', false);
                $('.btn-export').prop('hidden', false);
                $('.form-data-show').prop('hidden', true);

                swal({
                    type : 'success',
                    title : 'Success!',
                    text : 'Data has been saved!'
                });
            }
        },
        error : function (xhr) {
            var res = xhr.responseJSON;
            if ($.isEmptyObject(res) == false) {
                $.each(res.errors, function (key, value) {
                    $('#' + key)
                    .closest('.spanerror')
                    .addClass('has-error')
                    .append('<span class="help-error text-danger text-sm"><strong>' + value + '</strong></span>');
                });
            }
        }
    })
});

//DELETE DATA
$('body').on('click', '.btn-delete', function (event) {
    event.preventDefault();

    var me = $(this),
    url = me.attr('href'),
    title = me.attr('title'),
    csrf_token = $('meta[name="csrf-token"]').attr('content');

    swal({
        title: 'Yakin ingin menghapus Data ' + title + ' ?',
        text: 'kamu tidak bisa mengembalikan data ini',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Hapus!'
    }).then((result) => {
        if (result.value) {
            $.ajax({
                url: url,
                type: "POST",
                data: {
                    '_method': 'DELETE',
                    '_token': csrf_token,
                },
                success: function (response) {
                    $('#datatable').DataTable().ajax.reload();
                    swal({
                        type: 'success',
                        title: 'Success!',
                        text: 'Data Berhasil Dihapus'
                    });
                },
                error: function (xhr) {
                    swal({
                        type: 'error',
                        title: 'Oops...',
                        text: 'Something went wrong!'
                    });
                }
            });
        }
    });
});
