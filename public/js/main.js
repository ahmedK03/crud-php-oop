$(document).ready(function () {
  function showAllUsers() {
    $.ajax({
      url: " http://localhost/crud-php-oop/controllers/controllers.php",
      // type is post bec he's sending a data string named view
      type: "POST",
      dataType: "html",
      data: {
        action: "view",
      },
      success: function (res) {
        // console.log(res);
        $("#tableBody").html(res);
        $("#usersDataTable").dataTable();
      },
    });
  }

  showAllUsers();

  // adding users data to the data base
  // create manual checks using jquery
});
