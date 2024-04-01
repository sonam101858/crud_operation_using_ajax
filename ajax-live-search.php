<?php
 include "db.php";

 $search_value = $_POST["search"];
 
 try {
     // Prepare the SQL query with placeholders for the search conditions
     $sql = "SELECT * FROM user WHERE name LIKE :search_value OR email LIKE :search_value";
     $stmt = $conn->prepare($sql);
 
     // Bind the search value to the placeholder
     $search_param = "%$search_value%"; // Add wildcard % before and after the search value
     $stmt->bindParam(':search_value', $search_param);
 
     // Execute the query
     $stmt->execute();
 
     // Check if any records were found
     if ($stmt->rowCount() > 0) {
         // Output table header
         echo '<table>
                 <tr>
                     <th>Id</th>
                     <th>Name</th>
                     <th>Email</th>
                     <th>Image</th>
                     <th>Action</th>
                 </tr>';
 
         $i = 1; // Initialize the counter
         // Output table rows
         while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
             echo "<tr>
                     <td>$i</td>
                     <td>{$row["name"]}</td>
                     <td>{$row["email"]}</td>
                     <td><img src='" . $row['img'] . "' alt='Image'></td>
                     <td>
                         <i class='bi bi-trash3-fill delete delete-btn' data-id='{$row["id"]}'></i>
                         <a href='update1.php?id={$row["id"]}' class='edit-btn'>
                             <i class='bi bi-pencil-square edit'></i>
                         </a>
                     </td>
                 </tr>";
             $i++; // Increment the counter
         }
 
         // Close the table
         echo "</table>";
     } else {
         // No records found
         echo "<h2> Record not found.</h2>";
     }
 } catch (PDOException $e) {
     // Handle any PDO exceptions
     echo "Error: " . $e->getMessage();
 }
 
?>