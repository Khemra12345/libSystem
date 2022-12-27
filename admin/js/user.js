$(document).ready(function() {
  $('#add_button').click(function() {
      $('#user_form')[0].reset();
      $('.modal-title').text("Add User");
      $('#action').val("Add");
      $('#operation').val("Add");
      $('#user_uploaded_image').html('');
  });

  var dataTable = $('#user_data').DataTable({
      "processing": true,
      "serverSide": true,
      "order": [],
      "ajax": {
          url: "./user/fetchAll.php",
          type: "POST"
      },
      "columnDefs": [{
          "targets": [0, 3, 4],
          "orderable": false,
      }, ],
  });
  $(document).on('submit', '#user_form', function(event) {
      event.preventDefault();
      var username = $('#username').val();
      var password = $('#password').val();
      var email = $('#email').val();
      var extension = $('#user_image').val().split('.').pop().toLowerCase();
      if (extension != '') {
          if (jQuery.inArray(extension, ['gif', 'png', 'jpg', 'jpeg']) == -1) {
              alert("Invalid Image File");
              $('#user_image').val('');
              return false;
          }
      }
      if (username != '' && password != '' && email != '') {
          $.ajax({
              url: "./user/insert.php",
              method: 'POST',
              data: new FormData(this),
              contentType: false,
              processData: false,
              success: function(data) {
                  alert(data);
                  $('#user_form')[0].reset();
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
          url: "./user/update.php",
          method: "POST",
          data: {
              user_id: user_id
          },
          dataType: "json",
          success: function(data) {
              $('#userModal').modal('show');
              $('#username').val(data.username);
              $('#password').val(data.password);
              $('#email').val(data.email);
              $('.modal-title').text("Edit User");
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
              url: "./user/delete.php",
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