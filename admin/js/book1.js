$(document).ready(function() {
    $('#add_button').click(function() {
        $('#book_form')[0].reset();
        $('.modal-title').text("Add book");
        $('#action').val("Add");
        $('#operation').val("Add");
        $('#user_uploaded_image').html('');
    });

    var dataTable = $('#user_data').DataTable({
        "processing": true,
        "serverSide": true,
        "order": [],
        "ajax": {
            url: "./book/fetchAll.php",
            type: "POST"
        },
        "columnDefs": [{
            "targets": [0, 3, 4],
            "orderable": false,
        }, ],
    });
    $(document).on('submit', '#book_form', function(event) {
        event.preventDefault();
        var bookTitle = $('#txtBookTitle').val();
        var author = $('#txtAuthor').val();
        var categoryId = $('#txtCategoryId').val();
        var extension = $('#user_image').val().split('.').pop().toLowerCase();
        if (extension != '') {
            if (jQuery.inArray(extension, ['gif', 'png', 'jpg', 'jpeg']) == -1) {
                alert("Invalid Image File");
                $('#user_image').val('');
                return false;
            }
        }
        if (bookTitle != '' && author != '' && categoryId != '') {
            $.ajax({
                url: "./book/insert.php",
                method: 'POST',
                data: new FormData(this),
                contentType: false,
                processData: false,
                success: function(data) {
                    alert(data);
                    $('#book_form')[0].reset();
                    $('#userModal').modal('hide');
                    dataTable.ajax.reload();
                }
            });
        } else {
            return  toastr.warning("Field Require!").css("margin-top", "2rem");
        }
    });

    $(document).on('click', '.update', function() {
        var user_id = $(this).attr("id");
        $.ajax({
            url: "./book/update.php",
            method: "POST",
            data: {
                user_id: user_id
            },
            dataType: "json",
            success: function(data) {
                $('#userModal').modal('show');
                $('#txtBookTitle').val(data.bookTitle);
                $('#txtAuthor').val(data.author);
                $('#txtCategoryId').val(data.categoryId);
                $('.modal-title').text("Edit Book");
                $('#user_id').val(user_id);
                $('#user_uploaded_image').html(data.user_image);
                $('#action').val("Edit");
                $('#operation').val("Edit");
            }
        })
    });

    $(document).on('click', '.delete', function() {
        var user_id = $(this).attr("id");
        if (confirm("Are you sure you want to delete this?")) {
            $.ajax({
                url: "./book/delete.php",
                method: "POST",
                data: {
                    user_id: user_id
                },
                success: function(data) {
                    alert(data);
                    dataTable.ajax.reload();
                }
            });
        } else {
            return false;
        }
    });

    $(document).on('click', '.test', function() {
        var user_id = $(this).attr("id");
        if (confirm("test")) {
            $.ajax({
                url: "./book/test.php",
                method: "POST",
                data: {
                    user_id: user_id
                },
                success: function(data) {
                    alert(data);
                    dataTable.ajax.reload();
                }
            });
        } else {
            return false;
        }
    });
});

$("#btnUnAvailable").click(function (){
    
})
