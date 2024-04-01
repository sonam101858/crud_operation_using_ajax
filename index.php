
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
    *{
        padding:0px;
        margin:0px;
        box-sizing: border-box;
    }

Table {
 border-collapse: collapse;
 width: 100%;
}

th, td {
 border-bottom: 1px solid black;
 text-align: left;
}
th,td{
    text-align:center;
}
img{
    width: 150px;
    height:auto;
    padding: 5px;
}
.delete{
    color:red;
    font-size:30px;
    cursor:pointer;
}
.edit{
    color:green;
    font-size:30px;
    cursor:pointer;
    margin-left:20px;
}

</style>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-lg-2"></div>
        <div class="col-lg-8">
            <div class="form-outline mt-2">
                <input type="search" class="form-control" id="search" placeholder="Search here">
            </div>
        </div>
    </div>
</div>

<br><br>
    <div class="container">
        <div class="row">
                <div class="col-md-12">
                    <table class="mt-2 Table">
                               <td id="table-data">
                                    <!-- though ajax data is showing -->
                             </td>
                      </table>
               </div>
           </div>
     </div>

     <br><br>

<
<!-- Your pagination script (in the same file) -->
<script type="text/javascript">
    $(document).ready(function(){
        // Function to fetch data via AJAX for a specific page
        function fetchPageData(page) {
            $.ajax({
                url: 'index_ajax.php',
                type: 'GET',
                data: { page: page }, // Send the page number as a parameter
                success: function(datas) {
                    $("#table-data").html(datas);
                }
            });
        }

        // Initial load of data and pagination links
        fetchPageData(1);

        // Click event for pagination links (event delegation)
        $(document).on('click', '.page-link', function(e) {
            e.preventDefault();
            var page = $(this).attr('href').split('page=')[1]; // Extract the page number from the URL
            fetchPageData(page); // Fetch data for the clicked page
        });

        // Additional AJAX functionality (delete, live search) goes here
        $(document).on("click", ".delete-btn", function () {
            if (confirm("Do you really want to delete this record ?")) {
                var userId = $(this).data("id");
                var element = this;

                $.ajax({
                    url: "delete_ajax.php",
                    type: "POST",
                    data: { id: userId },
                    success: function (data) {
                        var response = JSON.parse(data);
                        if (response.status === 1) {
                            $(element).closest("tr").fadeOut();
                            console.log("Record and image file deleted successfully.");
                        } else {
                            console.log("Failed to delete record and image file:", response.status);
                            // Handle failure scenarios (e.g., display an error message to the user)
                        }
                    },
                    error: function (xhr, status, error) {
                        console.log("AJAX request failed:", status, error);
                        // Handle AJAX request failure (e.g., display an error message to the user)
                    }
                });
            }
        });

        // Live search functionality
        $("#search").on("keyup",function(){
            var search_term = $(this).val();
            $.ajax({
                url:"ajax-live-search.php",
                type:"POST",
                data:{search:search_term},
                success:function(data){
                    $("#table-data").html(data);
                    console.log(data);
                }
            });
        });
    });
</script>


</body>
</html>