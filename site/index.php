<?php
require 'database.php';

//de sql query
$sql = "SELECT Country, Capital FROM CountryCapital";

//hier wordt de query uitgevoerd met de database
$result = mysqli_query($conn, $sql);
$all_countries = mysqli_fetch_all($result, MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <form action="index.php" method="POST">
        <input id="search" name="search" type="text" placeholder="Type here">
        <input id="submit" type="submit" name="submit" value="Search">
    </form>


    <?php
    if (isset($_POST['submit'])) {
        $search = $_POST['search'];
        $sqlsearch = "SELECT * FROM Capitals INNER JOIN Countries ON Countries.CountryID = Capitals.CountryID WHERE Countries.Country LIKE '%$search%' OR  Capitals.Capital LIKE '%$search%';";

        $resultsearch = mysqli_query($conn, $sqlsearch);

        // mysqli_error($resultsearch);

        $searchCoutrysCapitals = mysqli_fetch_all($resultsearch, MYSQLI_ASSOC);
    ?>
        <table>
            <thead>
                <th>Country</th>
                <th>Capital</th>
            </thead>
            <?php foreach ($searchCoutrysCapitals as $searchCoutryCapital) : ?>
                <tbody>
                    <td><?php echo $searchCoutryCapital["Country"] ?></td>
                    <td><?php echo $searchCoutryCapital["Capital"] ?></td>
                    <td><a href="capital-detail.php?id=<?php echo $searchCoutryCapital['CapitalID'] ?>">Info</a></td>
                </tbody>
            <?php endforeach; ?>

        </table>
    <?php
    }

    if (empty($_POST['submit'])) {
    ?>
        <table>
            <thead>
                <th>Country</th>
                <th>Capital</th>
            </thead>
            <?php

            //de sql query
            $sql2 = "SELECT * FROM Capitals INNER JOIN Countries ON Countries.CountryID = Capitals.CountryID";

            //hier wordt de query uitgevoerd met de database
            $result2 = mysqli_query($conn, $sql2);
            $all_countriesCity = mysqli_fetch_all($result2, MYSQLI_ASSOC);

            foreach ($all_countriesCity as $countrycity) : ?>
                <tbody>
                    <td><?php echo $countrycity["Country"] ?></td>
                    <td><?php echo $countrycity["Capital"] ?></td>
                    <td><a href="capital-detail.php?id=<?php echo $countrycity['CapitalID'] ?>">Info</a></td>
                </tbody>
            <?php endforeach; ?>

        </table>
    <?php
    } ?>
</body>

</html>