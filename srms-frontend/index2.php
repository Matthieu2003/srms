<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles2.css">
    <title>Your Title Here</title>
</head>
<body>

<?php
include("config.php");

function fetchData($regulationNumber, $conn) {
    $sql = "SELECT * FROM srsmPersonnel WHERE regulationNumber = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $regulationNumber);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}

// Initialize variables
$name = $forenameTwo = $surname = $rankname = $emailAddress = $gender = $regulationNumber = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data based on Regulation Number
    $regulationNumber = $_POST["regulationNumber"];
    $recordStatus = $_POST["recordStatus"];

    if ($recordStatus == "New" || $recordStatus == "Amend") {
        // Retrieve data based on Regulation Number
        $sql = "SELECT * FROM srsmPersonnel WHERE regulationNumber = '$regulationNumber'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $name = $row["name"];
            $forenameTwo = $row["forenameTwo"];
            $surname= $row["surname"];
            $rankname = $row["rankname"];
            $emailAddress = $row["emailAddress"];
            $gender = $row["gender"];
        } else {
            echo "No records found for the given Regulation Number.";
        }
    } elseif ($recordStatus == "Archive") {
        // Add logic for handling Archive status if needed
        echo "Archive functionality is not implemented in this example.";
    }
}

// Handle form submission for updates
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submitUpdate"])) {
    // Retrieve updated data from form
    $updatedName = $_POST["name"];
    $updatedForenameTwo = $_POST["forenameTwo"];
    $updatedSurname = $_POST["surname"];
    $updatedRankname = $_POST["rankname"];
    $updatedEmailAddress = $_POST["emailAddress"];
    $updatedGender = $_POST["gender"];
    $timestamp = date("Y-m-d H:i:s");
    // Update the database with the new data
    $sql = "UPDATE srsmPersonnel 
            SET name='$updatedName', forenameTwo='$updatedForenameTwo', surname='$updatedSurname',
                rankname='$updatedRankname', emailAddress='$updatedEmailAddress', gender='$updatedGender', timestamp='$timestamp'
            WHERE regulationNumber='$regulationNumber'";

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully.";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
?>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label for="recordStatus">Select Record Status:</label>
    <select name="recordStatus" id="recordStatus" required>
        <option value="New">New</option>
        <option value="Amend">Amend</option>
        <option value="Archive">Archive</option>
    </select><br><br>

    <label for="regulationNumber">Regulation Number:</label>
    <input type="text" name="regulationNumber" value="<?php echo htmlspecialchars($regulationNumber); ?>" required>
    <input type="submit" value="Search">
</form>

<?php
// Display retrieved data in editable fields
if (isset($regulationNumber)) {
    echo "<h2>SRMS Information</h2>";
    echo "<form method='post' action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "'>";
    echo "<input type='hidden' name='regulationNumber' value='$regulationNumber'>";

    echo "<label for='name'>First Name:</label>";
    echo "<input type='text' name='name' value='$name' required>";

    echo "<label for='forenameTwo'>Middle Name:</label>";
    echo "<input type='text' name='forenameTwo' value='$forenameTwo'>";

    echo "<label for='surname'>Last Name:</label>";
    echo "<input type='text' name='surname' value='$surname' required>";

    echo "<label for='rankname'>Rank:</label>";
    echo "<input type='text' name='rankname' value='$rankname'>";

    echo "<label for='emailAddress'>Email Address:</label>";
    echo "<input type='email' name='emailAddress' value='$emailAddress'>";

    echo "<label for='gender'>Gender:</label>";
    echo "<select name='gender'>";
    echo "<option value='Male' " . ($gender == 'Male' ? 'selected' : '') . ">Male</option>";
    echo "<option value='Female' " . ($gender == 'Female' ? 'selected' : '') . ">Female</option>";
    echo "</select>";

    echo "<input type='submit' name='submitUpdate' value='SUBMIT'>";
    echo "</form>";
}
?>

</body>
</html>
