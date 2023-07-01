$(document).ready(function () {});

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
          // console.log(res);
          // show the success alert
          $("#success-alert").removeClass("d-none");
          // clear the inputs
          $("input").val("");
          // redirect to the index page after 2.5 secs
          setTimeout(function () {
            window.location.href = "../index.php";
          }, 2500);
        },
        error: function (err) {
          console.error(err);
        },
      });
    },
  });
}
addUsers();

function editUser() {
  // fetching single user info
  $("body").on("click", ".btn-edit", function (e) {
    let id = $(this).attr("data-id");
    e.preventDefault();
    $.ajax({
      url: "http://localhost/crud-php-oop/controllers/controllers.php",
      type: "GET",
      // adding data type parse your response as JSON before it comes to the "success" function.
      dataType: "json",
      data: { editId: id },
      success: function (res) {
        // adding form values
        $("#edit-id").val(res.id);
        $("#e-fName").val(res.first_name);
        $("#e-lName").val(res.last_name);
        $("#e-email").val(res.email);
        $("#e-phone").val(res.phone_number);
      },
      error: function (err) {
        console.error(err);
      },
    });
  });
  // update form
  $("#edit-user").validate({
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
        dataType: "html",
        data: $("#edit-user").serialize() + "&action=update",
        success: function (res) {
          $(".modal-alert")
            .html(
              `<div id="success-alert" class="alert alert-dismissible alert-success px-3">
              <strong>User Updated Successfully</strong>
              </div>`
            )
            .slideToggle(1500);
          setTimeout(function () {
            $("#editModal").modal("hide");
            showAllUsers();
          }, 1500);
        },
        error: function (err) {
          console.error(err);
        },
      });
    },
  });
}
editUser();
