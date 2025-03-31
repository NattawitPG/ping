<?php
include 'db_connection.php';

$sql = "SELECT * FROM amusement_ride"; 
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>เครื่องเล่น | Dream World</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>

<h1>เครื่องเล่นสุดมันส์</h1>

<?php while($row = $result->fetch_assoc()): ?>
    <div class="ride">
        <h2><?php echo $row['ride_name']; ?></h2>
        <p><?php echo $row['description']; ?></p>
    </div>
<?php endwhile; ?>

</body>
</html>
