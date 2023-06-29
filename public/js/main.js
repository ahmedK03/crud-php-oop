$(document).ready(function () {
  $("#usersDataTable").dataTable();

  function showAllUsers() {
    $.ajax({
      url: "crud-php-oop/controllers/controllers.php",
      // type is post bec he's sending a data string named view
      typr: "POST",
      data: { action: "view" },
      success: function (res) {
        console.log(res);
      },
    });
  }

  showAllUsers();
});
