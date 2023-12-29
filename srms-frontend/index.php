<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Form Submission</title>
</head>
<body>


<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $recordStatus = $_POST["recordStatus"];
    $regulationNO = $_POST["regulationNO"];
    $title = $_POST["title"];
    $name = $_POST["name"];
    $surname = $_POST["surname"];
    $forename2 = $_POST["forename2"];
    $gender = $_POST["gender"];
    $stationName = $_POST["stationName"];
    $EmailAddress = $_POST["EmailAddress"];
    $rank = $_POST["rank"];
    $currentUnitRole = $_POST["currentUnitRole"];

    // You can perform further processing or validation here



    // For demonstration purposes, let's display the submitted data
    echo "<h2>Submitted Data:</h2>";
    echo "<p>Record Status: $recordStatus</p>";
    echo "<p>Regulation Number: $regulationNO</p>";
    echo "<p>Force Description: $forceDescription</p>";
    echo "<p>Personnel Id: $personnelID</p>";
    echo "<p>Unique National Identifier: $uniqueNationalIdentifier</p>";
    echo "<p>Collar Number: $collarNumber</p>";
    echo "<p>PNC User ID: $pncUserID</p>";
    echo "<p>Title: $title</p>";
    echo "<p>Title Description: $titleDescription</p>";
    echo "<p>Name: $name</p>";
    echo "<p>Surname: $surname</p>";
    echo "<p>Forename 1: $forename1</p>";
    echo "<p>Forename 2: $forename2</p>";
    echo "<p>Gender: $gender</p>";
    echo "<p>Gender Description: $genderDescription</p>";
    echo "<p>Supervisor Full Name: $supervisorfullName</p>";
    echo "<p>Supervisor ID: $supervisorID</p>";
    echo "<p>Supervisor UNI: $supervisorUNI</p>";
    echo "<p>Station Name: $stationName</p>";
    echo "<p>Station Code: $stationCode</p>";
    echo "<p>EmailAddress: $EmailAddress</p>";
    echo "<p>Rank: $rank</p>";
    echo "<p>Rank Description: $rankDescription</p>";
    echo "<p>Default Unit: $defaultUnit</p>";
    echo "<p>Default Submit Unit: $defaultSubmitUnit</p>";
    echo "<p>Current Unit: $currentUnit</p>";
    echo "<p>Current Unit Role: $currentUnitRole</p>";
    echo "<p>Role Code: $roleCode</p>";
    echo "<p>Role: $role</p>";
    
    
} else {
    // Display the form
?>
    <h2>Enter Details:</h2>
    <form class="container" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <!-- Add input fields for each specified field -->

        <label for="recordStatus">Select Record Status:</label>
            <select name="recordStatus" id="recordStatus" required>
                <option value="New">New</option>
                <option value="Amend">Amend</option>
                <option value="Archive">Archive</option></select><br><br>

        <label for="forceId">Enter Force ID:</label>
            <input type="text" id="forceId" name="forceId" required><br><br>


        <!--Text input for the 'Force Description' field -->
        <label for="forceDescription">Enter Force Description:</label>
            <input type="text" id="forceDescription" name="forceDescription" required><br><br>


        <label for="personnelId">Enter Personnel ID:</label>
            <input type="text" id="personnelId" name="personnelId" required><br><br>

        <label for="uniqueNationalIdentifier">Enter Unique National Identifier:</label>
            <input type="text" id="uniqueNationalIdentifier" name="uniqueNationalIdentifier" required><br><br>

        <label for="collarNumber">Enter Collar Number:</label>
            <input type="text" id="collarNumber" name="collarNumber" required><br><br>

        <label for="pncUserID">Enter PNC User ID:</label>
            <input type="text" id="pncUserID" name="pncUserID" required><br><br>

            <label for="title">Select Title:</label>
                <select name="title" id="title" required>
                <option value="Mr">Mr</option>
                <option value="Ms">Ms</option>
                </select><br><br>

        </select><br><br>
        <label for="titleDescription">Select Title Description:</label>
            <select name="titleDescription" id="titleDescription" required>
            <option value="Mr">Mr</option>
            <option value="Mister">Mister</option>
            <option value="Mrs">Mrs</option>
            <option value="Miss">Miss</option>
            <option value="Ms">Ms</option></select><br><br>


        <label for="name">Enter First Name:</label>
        <input type="text" name="name" required><br>

        <label for="surname">Enter Last Name:</label>
        <input type="text" name="surname"><br>

        <label for="forename1">Enter Forename 1:</label>
        <input type="text" name="forename1" required><br>

        <label for="forename2">Enter Forename 2:</label>
        <input type="text" name="forename2" required><br>

        <label for="gender">Select Gender:</label>
            <select name="gender" id="gender" required>
            <option value="male">Male</option>
            <option value="female">Female</option>
            </select><br><br>

        <label for="genderDescription">Enter Gender Description:</label>
        <input type="text" name="genderDescription" required><br>

        <label for="supervisorfullName">Enter Supervisor Full Name:</label>
        <input type="text" name="supervisorfullName" required><br>

        <label for="supervisorId">Enter Supervisor ID:</label>
            <input type="text" id="supervisorId" name="supervisorId" required><br><br>

        <label for="supervisorUNI">Enter Supervisor Unique Number Identifier:</label>
            <input type="text" id="supervisorUNI" name="supervisorUNI" required><br><br>

        <label for="stationName">Enter Station Name:</label>
            <input type="text" id="stationName" name="stationName" required><br><br>

        <label for="stationCode">Enter Station Code:</label>
            <input type="text" id="stationCode" name="stationCode" required><br><br>  

        <label for="emailAddress">Email:</label>
            <input type="email" id="emailAddress" name="emailAddress" required><br><br>

        <label for="rank">Enter Rank:</label>
            <input type="text" id="rank" name="rank" required><br><br>  

        <label for="rankDescription">Enter Rank Description:</label>
            <input type="text" id="rankDescription" name="rankDescription" required><br><br> 
            
        <label for="defaultUnit">Enter Default Unit:</label>
            <input type="text" id="defaultUnit" name="defaultUnit" required><br><br>  

        <label for="defaultSubmitUnit">Enter Default Submit Unit:</label>
            <input type="text" id="defaultSubmitUnit" name="defaultSubmitUnit" required><br><br> 
            
        <label for="currentUnit">Enter Current Unit:</label>
            <input type="text" id="currentUnit" name="currentUnit" required><br><br> 
            
            <label for="currentUnitRole">Enter Current Unit Role:</label>
            <input type="text" id="currentUnitRole" name="currentUnitRole" required><br><br>  

            <label for="role">Enter Role:</label>
            <input type="text" id="role" name="role" required><br><br>  

            <label for="roleCode">Enter Role Code:</label>
            <input type="text" id="roleCode" name="roleCode" required><br><br> 

        

        <input type="submit" value="Submit">
    </form>
<?php
}
?>
</body>
</html>