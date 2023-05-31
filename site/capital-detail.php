<?php
session_start();
require 'database.php';

$capitalId = $_GET['id'];

$sql = "SELECT * FROM Capitals INNER JOIN Countries ON Countries.CountryID = Capitals.CountryID WHERE Capitals.CapitalID = $capitalId";

$result = mysqli_query($conn, $sql);

if (!is_object($result)) {
    header("location: capital-detail.php");
    exit;
}

if (mysqli_num_rows($result) <= 0) {
    echo "This capital doens't exist!!";
    exit;
}

$capital = mysqli_fetch_assoc($result);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/styles.css?<?php echo time(); ?>">
</head>

<body>

    <div>
        <table>
            <thead>
                <th>CapitalID</th>
                <th>Capital</th>
                <th>CountryID</th>
                <th>Country</th>
            </thead>
            <tbody>
                <td><?php echo $capital["CapitalID"] ?></td>
                <td><?php echo $capital["Capital"] ?></td>
                <td><?php echo $capital["CountryID"] ?></td>
                <td><?php echo $capital["Country"] ?></td>
            </tbody>
        </table>
    </div>
</body>

</html>