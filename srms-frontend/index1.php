<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles1.css">
    <title></title>
    
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
    echo "<form method='post' action='update_index1.php'>";  // Add an action for updating the data
    echo "<input type='hidden' name='regulationNumber' value='$regulationNumber'>";  // Include the Regulation Number for reference

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

    echo "<input type='submit' value='SUBMIT'>";
    echo "</form>";
}
?>

</body>
</html>
