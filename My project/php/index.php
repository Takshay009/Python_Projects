<?php
    
error_reporting(E_ALL);
ini_set('display_errors',1);
    
$servername = "sql205.infinityfree.com";
$username = "if0_41169119";
$password = "W7Sd0eDOv610Idx";
$DATABASE = "if0_41169119_db_okay";

$conn = mysqli_connect($servername, $username, $password, $DATABASE);

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

// mysqli_set_charset($conn, "utf8mb4");

/* Create table */
$create_table = "CREATE TABLE IF NOT EXISTS student (
    sno INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
)";

if (!mysqli_query($conn, $create_table)) {
    die("Table creation failed: " . mysqli_error($conn));
}

$message = "";
$type    = ""; // success or error

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email    = trim($_POST["email"] ?? "");
    $password = trim($_POST["password"] ?? "");

    if (empty($email) || empty($password)) {
        $message = "All fields are required.";
        $type = "error";
    }
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "Invalid email format.";
        $type = "error";
    }
    else {

        $check = $conn->prepare("SELECT sno FROM student WHERE email = ?");
        $check->bind_param("s", $email);
        $check->execute();
        $check->store_result();

        if ($check->num_rows > 0) {
            $message = "Email already registered.";
            $type = "error";
        } 
        else {
            $hashed_pass = password_hash($password, PASSWORD_DEFAULT);

            $stmt = $conn->prepare("INSERT INTO student (email, password) VALUES (?, ?)");
            $stmt->bind_param("ss", $email, $hashed_pass);

            if ($stmt->execute()) {
                $message = "Registration successful.";
                $type = "success";
            } else {
                $message = "Something went wrong.";
                $type = "error";
            }

            $stmt->close();
        }

        $check->close();
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Student Registration</title>
<link rel="stylesheet" href="style.css">
</head>

<style></style>




<body>

<?php if (!empty($message)) : ?>
    <div class="toast show <?php echo $type; ?>">
        <?php echo htmlspecialchars($message); ?>
    </div>
<?php endif; ?>

<form method="POST">
    <h2>Register</h2>

    <label>Email address</label>
    <input type="email" name="email" required>

    <label>Password</label>
    <input type="password" name="password" required>

    <button type="submit">Create Account</button>
</form>

</body>
</html>