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
            url: "./student/fetchAll.php",
            type: "POST"
        },
        "columnDefs": [{
            "targets": [0, 3, 4],
            "orderable": false,
        }, ],
    });
    $(document).on('submit', '#book_form', function(event) {
        event.preventDefault();
        var studentId = $('#studentId').val();
        var studentName = $('#studentName').val();
        var password = $('#password').val();
        var classId = $('#classId').val();
        var phone = $('#phone').val();
        var email = $('#email').val();
        var extension = $('#user_image').val().split('.').pop().toLowerCase();
        if (extension != '') {
            if (jQuery.inArray(extension, ['gif', 'png', 'jpg', 'jpeg']) == -1) {
                alert("Invalid Image File");
                $('#user_image').val('');
                return false;
            }
        }
        if (studentId != '' && studentName != '' && password != '' && phone != '' && email != '' && classId != '') {
            $.ajax({
                url: "./student/insert.php",
                method: 'POST',
                data: new FormData(this),
                contentType: false,
                processData: false,
                success: function() {
                    toastr.success("Action completed").css("margin-top", "2rem");
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
            url: "./student/update.php",
            method: "POST",
            data: {
                user_id: user_id
            },
            dataType: "json",
            success: function(data) {
                $('#userModal').modal('show');
                $('#studentId').val(data.studentId);
                $('#studentName').val(data.studentName);
                $('#password').val(data.password);
                $('#classId').val(data.classId);
                $('#phone').val(data.phone);
                $('#email').val(data.email);
                $('.modal-title').text("Edit Student");
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
                url: "./student/delete.php",
                method: "POST",
                data: {
                    user_id: user_id
                },
                success: function() {
                    toastr.success("Action completed").css("margin-top", "2rem");
                    dataTable.ajax.reload();
                }
            });
        } else {
            toastr.error("Action incompleted").css("margin-top", "2rem");
        }
    });
});
