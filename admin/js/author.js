
function displayData() {
    $.ajax({
        url: 'author_json.php?data=get_author',
        type: 'GET',
        dataType: 'json',
        success: function(alldata) {
            var columns = [{
                title: "ID"
            }, {
                title: "AUTHOR NAME"
            },{
                title: "CREATE DATE"
            }, {
                title: "ACTION"
            }];
            var data = [];
            var option = '';
            for (var i in alldata) {
                option =
                    "<i class='fa fa-pencil-square-o' data-toggle='modal' data-target='#myModal' onclick='editData(" +
                    alldata[i][0] +
                    ")'></i> | <i class='fa fa-trash' onclick='deleteData(" +
                    alldata[i][0] + ")'></i> ";
                data.push([alldata[i][0],alldata[i][1],alldata[i][2], option]);
            }
            console.log(data);
            $('#table_id').DataTable({
                destroy: true,
                data: data,
                columns: columns
            });
        },
        error: function(e) {
            console.log(e.responseText);
        }
    });
}

//Load
$(document).ready(function() {
    displayData();
})


//btnSave
$('#btnSave').click(function() {
    var author = $('#txtName');
    if(author.val() == ""){
        author.focus();
        return  toastr.warning("Field Require!").css("margin-top", "2rem");
    }
    var form_data = $('#form').serialize();
    if ($('#btnSave').text() == "Insert") {
        //Insert
        $.ajax({
            type: 'POST',
            url: 'author_json.php?data=add_author',
            data: form_data,
            dataType: 'json',
            success: function(data) {
                // alert(data);
                toastr.success("Action completed").css("margin-top", "2rem");
                displayData();
                $('#myModal').modal('hide');
            },
            error: function(ex) {
                toastr.error("Action incomplete").css("margin-top", "2rem");
                console.log(ex.responseText);
            }
        });
    } else {
        //Update
        $.ajax({
            type: 'POST',
            url: 'author_json.php?data=update_author&id=' + author_id,
            data: form_data,
            dataType: 'json',
            success: function(data) {
                toastr.success("Action completed").css("margin-top", "2rem");
                // alert(data);
                displayData();
                $('#myModal').modal('hide');
            },
            error: function(ex) {
                toastr.error("Action incomplete").css("margin-top", "2rem");
                console.log(ex.responseText);
            }
        });
    }
});

$('#btnAdd').click(function() {
    $('#txtName').val("");
    $('#btnSave').text("Insert");
});

var author_id;

function editData(id) {
    $('#btnSave').text("Update");
    author_id = id;
    $.ajax({
        url: 'author_json.php?data=get_byid',
        data: '&id=' + id,
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            $('#txtName').val(data[0][1]);
        },
        error: function(ex) {
            console.log(ex.responseText);
        }
    });
}

function deleteData(id) {
    if (confirm('Are you sure')) {
        $.ajax({
            type: 'GET',
            url: 'author_json.php?data=delete_author&id=' + id,
            dataType: 'json',
            success: function(data) {
                // alert(data);
                toastr.success("Action completed").css("margin-top", "2rem");
                displayData();
            },
            error: function(ex) {
                toastr.error("Action incomplete").css("margin-top", "2rem");
                console.log(ex.responseText);
            }
        });
    }
}

