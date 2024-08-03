<!DOCTYPE html>
<html>
<head>
    <title>Submitted Data</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .action-buttons {
            display: flex;
            gap: 5px;
        }
    </style>
</head>
<body>

<h1>Submitted Data</h1>

<?php
$file = 'submitted_data.txt';

if (file_exists($file) && is_readable($file)) {
    $content = file_get_contents($file);

    if ($content) {
        $entries = explode("-------------------------------------", $content);

        if (count($entries) > 1) {
            echo "<table>";
            echo "<tr><th>First Name</th><th>Last Name</th><th>Address</th><th>Country</th><th>Gender</th><th>Skills</th><th>Username</th><th>Department</th><th>Actions</th></tr>";

            foreach ($entries as $index => $entry) {
                if (trim($entry) != "") {
                    $lines = explode("\n", trim($entry));
                    echo "<tr>";
                    foreach ($lines as $line) {
                        $parts = explode(": ", $line);
                        if (count($parts) == 2) {
                            echo "<td>" . htmlspecialchars($parts[1]) . "</td>";
                        }
                    }
                    echo "<td class='action-buttons'>";
                    echo "<form action='edit.php' method='post' style='display:inline;'><input type='hidden' name='index' value='$index'><input type='submit' value='Edit'></form>";
                    echo "<form action='delete.php' method='post' style='display:inline;'><input type='hidden' name='index' value='$index'><input type='submit' value='Delete'></form>";
                    echo "</td>";
                    echo "</tr>";
                }
            }
            echo "</table>";
        } else {
            echo "<p>No data available.</p>";
        }
    } else {
        echo "<p>No data available.</p>";
    }
} else {
    echo "<p>File not found or not readable.</p>";
}
?>

</body>
</html>
