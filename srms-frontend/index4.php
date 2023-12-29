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

// Handle form submission for updates
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $regulationNumber = isset($_POST["regulationNumber"]) ? $_POST["regulationNumber"] : "";
    $recordStatus = isset($_POST["recordStatus"]) ? $_POST["recordStatus"] : "";

    // Check if the form is submitted for searching or updating
    if ($recordStatus == "New" || $recordStatus == "Amend") {
        // Retrieve data from the form
        $updatedname = $_POST["name"];
        $updatedforenameTwo = $_POST["forenameTwo"];
        $updatedsurname = $_POST["surname"];
        $updatedrankname = $_POST["rankname"];
        $updatedemailAddress = $_POST["emailAddress"];
        $updatedgender = $_POST["gender"];

       // Update the database
       $entryDate = date("Y-m-d H:i:s");
       $sql = "UPDATE srsmPersonnel 
               SET name=?, forenameTwo=?, surname=?, rankname=?, emailAddress=?, gender=?, entryDate=?
               WHERE regulationNumber=?";
       $stmt = $conn->prepare($sql);

       if ($stmt) {
        $stmt->bind_param("ssssssss", $updatedname, $updatedforenameTwo, $updatedsurname, $updatedrankname, $updatedemailAddress, $updatedgender, $entryDate, $regulationNumber);

        if ($stmt->execute()) {
            echo "Record updated successfully.";
        } else {
            echo "Error updating record: " . $stmt->error;
        }
    } else {
        echo "Error preparing statement: " . $conn->error;
    }
} elseif ($recordStatus == "Archive") {
    echo "Archive functionality is not implemented in this example.";
} elseif ($recordStatus == "Search") {
    // Search for the regulation number in the database
    $searchedData = fetchData($regulationNumber, $conn);

    // Display the retrieved data in the form fields
    if ($searchedData) {
        $name = $searchedData['name'];
        $forenameTwo = $searchedData['forenameTwo'];
        $surname = $searchedData['surname'];
        $rankname = $searchedData['rankname'];
        $emailAddress = $searchedData['emailAddress'];
        $gender = $searchedData['gender'];
    } else {
        echo "Record not found for the given regulation number.";
    }
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
</form>

</body>
</html>
