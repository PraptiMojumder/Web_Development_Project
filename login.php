
<?php
var_dump($_POST);
session_start();

// Include database connection
include 'database.php';
$conn = new mysqli($servername, $username, $password, $dbname);

// Check for connection errors
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['email1']) && isset($_POST['password1'])) {
        $email = $_POST['email1'];
        $password = $_POST['password1'];
        echo "Connected2<br>"; // Debugging output
    } else {
        die("Email or Password not set");
    }

    // SQL query to validate login
    $sql = "SELECT * FROM sign_up WHERE email='$email' AND password='$password'";
    $result = mysqli_query($conn, $sql);

    // Debugging SQL Execution
    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }

    echo "Connected3<br>"; // Debugging output

    // Check the number of rows
    $num = mysqli_num_rows($result);
    echo "Number of rows: $num<br>"; // Debugging output

    if ($num == 1) {
        // Store data in the session
        $userId = $conn->insert_id;
        $first_name = trim($_POST['first_name']);
        $last_name = trim($_POST['last_name']);
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);
        $workAs = trim($_POST['work_as']);
        // Redirect to another page
        header("Location: trackit_prototype.html");
        exit();
    } else {
        // Error in validation
        echo "Invalid email or password.";
    }
} else {
    die("Form data is missing.");
}

// Close connection
$conn->close();
?>




























