$(document).ready(function () {
  function showAllUsers() {
    $.ajax({
      url: " http://localhost/crud-php-oop/controllers/controllers.php",
      // type is post bec he's sending a data string named view
      // get command is faster, but the url is as follows
      // controllers.php?action=view
      type: "GET",
      dataType: "html",
      data: {
        action: "view",
      },
      success: function (res) {
        console.log(res);
        $("#tableBody").html(res);
        $("#usersDataTable").dataTable();
      },
    });
  }

  showAllUsers();

  // adding users data to the data base
  // create manual checks using jquery
});
