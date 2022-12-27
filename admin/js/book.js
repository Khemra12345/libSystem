

//Available
$("#btnAvailable").click(function () {
  $.ajax({
    url: "book_json.php?data=get_available",
    type: "Get",
    dataType: "json",
    success: function (alldata) {
      var columns = [
        { title: "ID" },
        { title: "BOOK TITLE" },
        { title: "CATEGORY" },
        { title: "AUTHOR" },
        { title: "STATUS" },
        { title: "CREATE DATE" },
        { title: "ACTION" },
      ];
      var data = [];
      var option = "";
      for (var i in alldata) {
        option =
          "<i style='cursor: pointer;' class='fa fa-pencil-square-o' data-toggle='modal' data-target='#Mymodal' onclick='editData(" +
          alldata[i][0] +
          ")'></i> | <i style='cursor: pointer;' class='fa fa-trash' onclick='deleteData(" +
          alldata[i][0] +
          ")'></i> | <i style='cursor: pointer;' id='btnStatus' class='fa fa-refresh' onclick='getStatus(" +
          alldata[i][0] +
          ")'></i>";
        data.push([
          alldata[i][0],
          alldata[i][1],
          alldata[i][2],
          alldata[i][3],
          alldata[i][4],
          alldata[i][5],
          option,
        ]);
      }
      console.log(data);
      $("#user_data").DataTable({
        destroy: true,
        data: data,
        columns: columns,
      });
    },
    error: function (e) {
      console.log(e.responseText);
    },
  });
});

//Filter UnAvailable
$("#btnUnAvailable").click(function () {
  $.ajax({
    url: "book_json.php?data=get_unavailable",
    type: "Get",
    dataType: "json",
    success: function (alldata) {
      var columns = [
        { title: "ID" },
        { title: "BOOK TITLE" },
        { title: "CATEGORY" },
        { title: "AUTHOR" },
        { title: "STATUS" },
        { title: "CREATE DATE" },
        { title: "ACTION" },
      ];
      var data = [];
      var option = "";
      for (var i in alldata) {
        option =
          "<i style='cursor: pointer;' class='fa fa-pencil-square-o' data-toggle='modal' data-target='#Mymodal' onclick='editData(" +
          alldata[i][0] +
          ")'></i> | <i style='cursor: pointer;' class='fa fa-trash' onclick='deleteData(" +
          alldata[i][0] +
          ")'></i> | <i style='cursor: pointer;' id='btnStatus' class='fa fa-refresh' onclick='refuseStatus(" +
          alldata[i][0] +
          ")'></i> ";
        data.push([
          alldata[i][0],
          alldata[i][1],
          alldata[i][2],
          alldata[i][3],
          alldata[i][4],
          alldata[i][5],
          option,
        ]);
      }
      console.log(data);
      $("#user_data").DataTable({
        destroy: true,
        data: data,
        columns: columns,
      });
    },
    error: function (e) {
      console.log(e.responseText);
    },
  });
});

