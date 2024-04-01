<?php
// Include the database connection file (assuming it uses PDO)
include "db.php";

try {
    // Pagination variables
    $limit = 3; // Number of records per page

    // Count total records
    $totalRecords = $conn->query("SELECT count(*) as count FROM user")->fetch(PDO::FETCH_ASSOC)['count'];

    // Calculate total pages
    $totalPages = ceil($totalRecords / $limit);

    // Current page number
    $page = isset($_GET['page']) ? $_GET['page'] : 1;

    // Offset for SQL query
    $start = ($page - 1) * $limit;

    // Prepare and execute the query using PDO with pagination
    $sql = "SELECT * FROM user LIMIT :start, :limit";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':start', $start, PDO::PARAM_INT);
    $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
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

        $i = 1 + $start; // Initialize the counter with start offset
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

        // Pagination links
        echo '<nav aria-label="Page navigation example">
                  <ul class="pagination justify-content-center">';

        // Previous button
        if ($page > 1) {
            echo '<li class="page-item">
                      <a class="page-link" href="?page=' . ($page - 1) . '">Previous</a>
                  </li>';
        } else {
            echo '<li class="page-item disabled">
                      <a class="page-link">Previous</a>
                  </li>';
        }

        // Pagination numbers
        for ($i = 1; $i <= $totalPages; $i++) {
            echo '<li class="page-item';
            if ($i == $page) {
                echo ' active';
            }
            echo '">
                      <a class="page-link" href="?page=' . $i . '">' . $i . '</a>
                  </li>';
        }

        // Next button
        if ($page < $totalPages) {
            echo '<li class="page-item">
                      <a class="page-link" href="?page=' . ($page + 1) . '">Next</a>
                  </li>';
        } else {
            echo '<li class="page-item disabled">
                      <a class="page-link">Next</a>
                  </li>';
        }

        echo '</ul>
              </nav>';
    } else {
        // No records found
        echo "<h2> Record not found.</h2>";
    }
} catch (PDOException $e) {
    // Handle any PDO exceptions
    echo "Error: " . $e->getMessage();
}
?>
