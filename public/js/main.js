// $(document).ready(function () {});

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
      $("#tableBody").append(res);
      $("#usersDataTable").dataTable();
    },
    error: function (err) {
      console.error(err);
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
      data: { user_id: id },
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

function deleteUser() {
  // hide .done-alert div
  $(".done-alert").fadeOut();
  // click handler for the delete icon
  $("body").on("click", ".btn-delete", function (e) {
    // set the id value
    let id = $(this).attr("data-id");
    $("#delete_id").val(id);
  });
  // delete form handler
  $("#del-user").submit(function (e) {
    e.preventDefault();
    // get the id value
    let id = $("input#delete_id").val();
    $.ajax({
      url: "http://localhost/crud-php-oop/controllers/controllers.php",
      type: "POST",
      dataType: "html",
      data: {
        id: id,
        action: "delete",
      },
      success: function (res) {
        console.log(res);
        $(".delete-alert").slideUp(10);
        $(".done-alert").fadeIn(600).addClass("d-flex");
        setTimeout(function () {
          $("#deleteModal").modal("hide");
        }, 1500);
        showAllUsers();
      },
      error: function (err) {
        console.error(err);
      },
    });
  });
}
deleteUser();

function displaySingleUser() {
  $("body").on("click", ".btn-details", function (e) {
    e.preventDefault();
    let id = $(this).attr("data-id");
    $.ajax({
      url: "http://localhost/crud-php-oop/controllers/controllers.php",
      type: "GET",
      dataType: "json",
      data: {
        user_id: id,
      },
      success: function (res) {
        // clear values first
        $("#userFirstName, h2.user-full-name, p.user-email, p.user-phone").html('');
        // set the values
        $("#userFirstName").append(res.first_name);
        $("h2.user-full-name").append("<span class='fs-6 fw-bold'>Full Name</span> " + res.first_name + " " + res.last_name);
        $("p.user-email").append("<b>Email</b>: " + res.email);
        $("p.user-phone").append("<b>Phone Number</b>: " + res.phone_number);
      },
      error: function (err) {
        console.error(err);
      },
    });
  });
}

displaySingleUser();
