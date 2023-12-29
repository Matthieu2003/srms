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

function fetchData($regulationNumber, $conn) 
{
    $sql = "SELECT * FROM srsmPersonnel WHERE regulationNumber = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $regulationNumber);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}

// Initialize variables
        $fName = $forenameTwo = $surname = $rankname = $emailAddress = $gender = $regulationNumber =  $updatedfName = $updatedforenameTwo = $updatedsurname = $updatedrankname = $updatedemailAddress = $updatedgender = $entryDate = $regulationNumber =  "";

// Handle form submission for updates
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    $recordStatus = isset($_POST["recordStatus"]) ? $_POST["recordStatus"] : "";

    // Check if the form is submitted for searching or updating
    if ($recordStatus == "New") 
    {
        // Retrieve data from the form
        $regulationNumber = isset($_POST["regulationNumber"]) ? $_POST["regulationNumber"] : "";

        // Search for the regulation number in the database
        $searchedData = fetchData($regulationNumber, $conn);

        // Display the retrieved data in the form fields
        print_r($searchedData);
        if ($searchedData) 
        {
            $fName = $searchedData['fName'];
            $forenameTwo = $searchedData['forenameTwo'];
            $surname = $searchedData['surname'];
            $rankname = $searchedData['rankname'];
            $emailAddress = $searchedData['emailAddress'];
            $gender = $searchedData['gender'];
        } 
        else 
        {
            echo "Record not found for the given regulation number.";
        }

    }
    elseif ($recordStatus == "Archive") 
    {
        echo "Archive functionality is not implemented in this example.";
    }
    else 
    {
        $updatedfName = isset($_POST["fName"]) ? $_POST["fName"] : null;
        $updatedforenameTwo = isset($_POST["forenameTwo"]) ? $_POST["forenameTwo"] : null;
        $updatedsurname = isset($_POST["surname"]) ? $_POST["surname"] : null;
        $updatedrankname = isset($_POST["rankname"]) ? $_POST["rankname"] : null;
        $updatedemailAddress = isset($_POST["emailAddress"]) ? $_POST["emailAddress"] : null;
        $updatedgender = isset($_POST["gender"]) ? $_POST["gender"] : null;


       // Update the database
       $entryDate = date("Y-m-d H:i:s");
       $sql = "UPDATE `connect`.`srsmpersonnel`
       SET fName=?, forenameTwo=?, surname=?, rankname=?, emailAddress=?, gender=?, entryDate=?
       WHERE regulationNumber=?";
       $stmt = $conn->prepare($sql);
       $stmt->bind_param("ssssssss", $updatedfName, $updatedforenameTwo, $updatedsurname, $updatedrankname, $updatedemailAddress, $updatedgender, $entryDate, $regulationNumber);
       $stmt->execute();

       if ($conn->query($sql) === TRUE) 
       {
           echo "Record updated successfully.";
       } 
       else 
       {
           echo "Error updating record: " . $conn->error;
       }
    }

} 
// elseif ($recordStatus == "Search") 
// {
  
// }


?>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="recordStatus">Select Record Status:</label>
            <select name="recordStatus" id="recordStatus" required>
                <option value="New">New</option>
                <option value="Amend">Amend</option>
                <option value="Archive">Archive</option>
            </select>
            <br><br>

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

    echo "<label for='fName'>First Name:</label>";
    echo "<input type='text' name='fName' value='$fName' required>";

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
}
?>

</body>
</html>
