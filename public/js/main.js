$(document).ready(function () {
  function showAllUsers() {
    $.ajax({
      url: "http://localhost/crud-php-oop/controllers/controllers.php",
      // type is post bec he's sending a data string named view
      // get command is faster, but the url is as follows
      // controllers.php?action=view
      type: "GET",
      dataType: "html",
      data: {
        action: "view",
      },
      success: function (res) {
        $("#tableBody").html(res);
        $("#usersDataTable").dataTable();
      },
    });
  }

  showAllUsers();

  // adding users data to the data base
  // create manual checks using jquery-validate liberary
  function addUsers() {
    // validate the form first
    $("#add-user").validate({
      rules: {
        fName: {
          required: true,
          minlength: 3,
        },
        lName: {
          required: true,
          minlength: 3,
        },
        email: {
          required: true,
          email: true,
        },
        phone: {
          required: true,
          number: true,
        },
      },
      messages: {
        fName: {
          required: "first name is required",
          minlength: "Name should be at least 3 characters",
        },
        lName: {
          required: "last name is required",
          minlength: "Name should be at least 3 characters",
        },
        email: {
          required: "email is required",
          email: "email should be like: demo@gmail.com",
        },
        phone: {
          required: "phone number is required",
        },
      },
      // submit data after validation
      submitHandler: function () {
        $.ajax({
          url: "http://localhost/crud-php-oop/controllers/controllers.php",
          type: "POST",
          data: $("#add-user").serialize() + "&action=insert",
          success: function (res) {
            console.log(res);
          },
          error: function (err) {
            console.log(err);
          },
        });
      },
    });
  }

  addUsers();
});
