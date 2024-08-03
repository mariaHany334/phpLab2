<!DOCTYPE html>
<html>
<head>
    <title>Form Submission</title>
</head>
<body>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = htmlspecialchars($_POST['firstName']);
    $lastName = htmlspecialchars($_POST['lastName']);
    $address = htmlspecialchars($_POST['address']);
    $country = htmlspecialchars($_POST['country']);
    $gender = htmlspecialchars($_POST['gender']);
    $skills = isset($_POST['skills']) ? implode(", ", array_map('htmlspecialchars', $_POST['skills'])) : "None";
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);
    $department = htmlspecialchars($_POST['department']);
    $verificationCode = htmlspecialchars($_POST['verificationCode']);

    $predefinedCode = "Sh68Sa";

  
    if (empty($username) || empty($firstName) || empty($lastName)) {
        echo "<h1>Validation Failed</h1>";
        echo "<p>Username, First Name, and Last Name are required fields.</p>";
        exit;
    }

  
    $passwordPattern = "/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/"; 
    if (!empty($password) && !preg_match($passwordPattern, $password)) {
        echo "<h1>Validation Failed</h1>";
        echo "<p>Password must be at least 8 characters long and contain at least one letter and one number.</p>";
        exit;
    }

  
    if ($verificationCode === $predefinedCode) {
      
        $data = "First Name: $firstName\n";
        $data .= "Last Name: $lastName\n";
        $data .= "Address: $address\n";
        $data .= "Country: $country\n";
        $data .= "Gender: $gender\n";
        $data .= "Skills: $skills\n";
        $data .= "Username: $username\n";
        $data .= "Department: $department\n";
        $data .= "-------------------------------------\n";

       
        $file = fopen('submitted_data.txt', 'a');
        if ($file) {
            fwrite($file, $data);
            fclose($file);
        } else {
            echo "<h1>Error</h1>";
            echo "<p>Could not open the file for writing.</p>";
            exit;
        }

    
        echo "<h1>Form Submitted Successfully</h1>";
        echo "<p><strong>First Name:</strong> " . htmlspecialchars($firstName) . "</p>";
        echo "<p><strong>Last Name:</strong> " . htmlspecialchars($lastName) . "</p>";
        echo "<p><strong>Address:</strong> " . nl2br(htmlspecialchars($address)) . "</p>";
        echo "<p><strong>Country:</strong> " . htmlspecialchars($country) . "</p>";
        echo "<p><strong>Gender:</strong> " . htmlspecialchars($gender) . "</p>";
        echo "<p><strong>Skills:</strong> " . htmlspecialchars($skills) . "</p>";
        echo "<p><strong>Username:</strong> " . htmlspecialchars($username) . "</p>";
        echo "<p><strong>Department:</strong> " . htmlspecialchars($department) . "</p>";

    } else {
        echo "<h1>Verification Failed</h1>";
        echo "<p>The verification code you entered is incorrect.</p>";
    }
}
?>

<p><a href="show_data.php">View Submitted Data</a></p>

</body>
</html>
