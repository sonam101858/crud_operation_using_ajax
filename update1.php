<?php
// Establish database connection
include "db.php";

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM user WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if($row) {
        $userid = $row['id'];
        $userName = $row['name'];
        $email = $row['email'];
        $img = $row['img'];
    } else {
        // No user found with the provided id
        echo "No user found with the provided ID.";
    }
} else {
    // "id" parameter is missing in the URL
    echo "No user ID provided.";
}

// Close the database connection (Not necessary for PDO)
// mysqli_close($conn);
?>


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
   img{
    width:100px;
    height: 100px;
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
              <h2 class="text-uppercase text-center mb-1">Update</h2>
              <form id="Form"  enctype="multipart/form-data">
                <div class="form-outline mb-0">
                <!-- hide the user id -->
                <input type="hidden" id="id" name="id" value="<?php echo $userid; ?>">
                 <!-- hide the user id -->
                <label class="form-label" for="uname">Your Name</label>
                  <input type="text" id="uname"  name="name" value="<?php echo  $userName; ?>" autocomplete="username" class="form-control form-control-lg" />
                </div>
                <p id="name_error"></p>
                 

                <div class="form-outline mb-0 ">
                <label class="form-label" for="uemail">Your Email</label>
                  <input type="email" id="uemail" name="email"  value="<?php echo  $email; ?>" autocomplete="useremail" class="form-control form-control-lg" />
                </div>
                <p id="email_error"></p>
            

                <div class="mb-0">
                <!-- Display the current image -->
                <img src="<?php echo $img; ?>" alt="Current Image"><br>
                 <input type="hidden" name="old_image" value="<?php echo $img; ?>">
                <!-- Input field to upload a new image -->
                <label for="File" class="form-label">Upload New Image</label>
                <input class="form-control" name="image" type="file" id="File">   
            </div>

               <p id="image_error"></p>

                <div class="d-flex justify-content-center mt-2">
                  <button type="submit" name="submit"  id="Update-button"
                    class="btn btn-success btn-block btn-lg gradient-custom-4 text-body">Update</button>
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
    $("#File").on("focus", function () {
        $("#image_error").slideUp();
    });

    $("#Update-button").on("click", function (e) {
        e.preventDefault(); 
       
        // If no errors, proceed with the AJAX request
        var formData = new FormData($("#Form")[0]);
        formData.append("file", $("#File")[0].files[0]);

        function myURL() {
         document.location.href = 'index.php';
      }
      
        $.ajax({
            url: "update_ajax.php",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function (data) {
                var response = JSON.parse(data);
        
                if (response.status === 1) {

                    $("#success-message").html("Record Updated successfully.").slideDown();
                    $("#error-message").slideUp();
                    setTimeout(myURL, 2000);
                } else {
                    // Check for specific error messages
                    if (response.message === "Invalid email format.") {
                        $("#email_error").html(response.message).slideDown();
                    } else if (response.message === "Invalid image format or not a valid image.") {
                        $("#image_error").html(response.message).slideDown();
                    } else if (response.message === "Invalid name format.") {
                        $("#name_error").html(response.message).slideDown();
                    }
                    
                    $("#success-message").slideUp();
                }
            },
            error: function(error){
          
              console.log("update api error "+error)
            }
        });
    });
});




</script>
</body>
</html>