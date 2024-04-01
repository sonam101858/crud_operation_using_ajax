<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"  content="width=device-width, initial-scale=1.0">
    <title>registration</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
     <!-- link of bootstrap -->
     <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
      crossorigin="anonymous"
    />
    <!-- link of bootstrap -->

    <!-- link of js-->
    <script
      src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
      integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
      integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF"
      crossorigin="anonymous"
    ></script>
    <!-- link of js-->

    <!-- link of icons-->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css"
    />
    <!-- link of icons-->

<style>
.gradient-custom-3 {
/* fallback for old browsers */
background: #84fab0;

/* Chrome 10-25, Safari 5.1-6 */
background: -webkit-linear-gradient(to right, rgba(132, 250, 176, 0.5), rgba(143, 211, 244, 0.5));

/* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
background: linear-gradient(to right, rgba(132, 250, 176, 0.5), rgba(143, 211, 244, 0.5))
}
.gradient-custom-4 {
/* fallback for old browsers */
background: #84fab0;

/* Chrome 10-25, Safari 5.1-6 */
background: -webkit-linear-gradient(to right, rgba(132, 250, 176, 1), rgba(143, 211, 244, 1));

/* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
background: linear-gradient(to right, rgba(132, 250, 176, 1), rgba(143, 211, 244, 1))
}
#success-message{
  background:#DEF1D8;
  color: green;
  padding: 10px;
  margin:10px;
  display:none;
  position:absolute;
  right:15px;
  top:15px;

}
#error-message{
  background:#EFDCDD;
  color: red;
  padding: 10px;
  margin:10px;
  display:none;
  position:absolute;
  right:15px;
  top:15px;
}
.error-border {
   border: 1px solid red;
   }
   #name_error,#email_error,#password_error,#image_error{
  color: red;
  padding: 10px;
  margin:10px;
  display:none;
   }
</style>

</head>
<body>
<section class="vh-100 bg-image">
  <div class="mask d-flex align-items-center h-100 gradient-custom-3">
    <div class="container h-100 mt-2">
      <div class="row d-flex justify-content-center align-items-center h-50 mt-5">
        <div class="col-12 col-md-9 col-lg-7 col-xl-6">
          <div class="card" style="border-radius: 15px; mt-3">
            <div class="card-body p-3 mt-5">
              <h2 class="text-uppercase text-center mb-1">Create an account</h2>
              <form id="Form"  enctype="multipart/form-data">
                <div class="form-outline mb-0">
                <label class="form-label" for="uname">Your Name</label>
                  <input type="text" id="uname" name="name" value="" autocomplete="username" placeholder="Enter name" class="form-control form-control-lg" />
                </div>
                <p id="name_error"></p>
                 

                <div class="form-outline mb-0 ">
                  <label class="form-label" for="uemail">Your Email</label>
                  <input type="email" id="uemail" name="email"  value="" autocomplete="useremail" placeholder="Enter email" class="form-control form-control-lg" />
                </div>
                <p id="email_error"></p>
            
               <div class="mb-1">
                  <label for="password" class="form-label">Password</label>
                  <input type="password" class="form-control form-control-lg" id="password" autocomplete="userpassword" name="password"  value="" placeholder="Enter password" autocomplete="new-password">
              </div>
              <p id="password_error"></p>

               <div class="mb-0">
               <label for="File" class="form-label">Upload Image</label>
               <input class="form-control" name="image" type="file" id="File">   
               </div>
               <p id="image_error"></p>

                <div class="d-flex justify-content-center mt-2">
                  <button type="submit" name="submit"  id="save-button"
                    class="btn btn-success btn-block btn-lg gradient-custom-4 text-body">Register</button>
                </div>

                <!-- <p class="text-center text-muted mt-1 mb-0">Have already an account? <a href="login.php"
                    class="fw-bold text-body"><u>Login here</u></a></p>
                  </form> -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<div id="error-message"></div>
<div id="success-message"></div>
<!-- Bootstrap JS and dependencies -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>

  $(document).ready(function () {
 
    $("#uname").on("focus", function () {
        $("#name_error").slideUp();
    });

    $("#uemail").on("focus", function () {
        $("#email_error").slideUp();
    });

    $("#password").on("focus", function () {
        $("#password_error").slideUp();
    });

    $("#File").on("focus", function () {
        $("#image_error").slideUp();
    });

    $("#save-button").on("click", function (e) {
        e.preventDefault();

        var uname = $("#uname").val().trim();
        if (uname === "") {
            $("#uname").addClass("error-border").blur();
        } else {
            $("#uname").removeClass("error-border");
        }

        var uemail = $("#uemail").val().trim();
        if (uemail === "") {
            $("#uemail").addClass("error-border").blur();
        } else {
            $("#uemail").removeClass("error-border");
        }

        var upassword = $("#password").val().trim();
        if (upassword === "") {
            $("#password").addClass("error-border").blur();
        } else {
            $("#password").removeClass("error-border");
        }

        var uFile = $("#File").val().trim();
        if (uFile === "") {
            $("#File").addClass("error-border").blur();
        } else {
            $("#File").removeClass("error-border");
        }

        if ($("#uname, #uemail, #password, #File").hasClass("error-border")) {
            return;
        }
        function myURL() {
         document.location.href = 'index.php';
      }
        // If no errors, proceed with the AJAX request
        var formData = new FormData($("#Form")[0]);
        formData.append("file", $("#File")[0].files[0]);

        $.ajax({
            url: "insert_ajax.php",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function (data) {
                var response = JSON.parse(data);
                if (response.status === 1) {
                    $("#Form").trigger("reset");
                    $("#success-message").html("Record inserted successfully.").slideDown();
                    $("#error-message").slideUp();
                     setTimeout(myURL, 2000);
                } else {
                    // Check for specific error messages
                    if (response.message === "Invalid email format.") {
                        $("#email_error").html(response.message).slideDown();
                    } else if (response.message === "Password should be at least 8 characters long.") {
                        $("#password_error").html(response.message).slideDown();
                    } else if (response.message === "Invalid image format or not a valid image.") {
                        $("#image_error").html(response.message).slideDown();
                    } else if (response.message === "Invalid name format.") {
                        $("#name_error").html(response.message).slideDown();
                    }
                    
                    $("#success-message").slideUp();
                }
            }
        });
    });
});




</script>
</body>
</html>