<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include 'api.php';
    $response = addLead($_POST);
    print_r($response);
    if ($response['success']) {
        echo "<p style='color:green'>{$response['message']}</p>";
    } else {
        echo "<p style='color:red'>{$response['message']}</p>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Добавление лида</title>
</head>
<body>
    <h1>Форма отправки лида</h1>
    <?php if (isset($message)) echo "<p>$message</p>"; ?>
    <form method="post">
        <label>First Name: <input type="text" name="firstName" required></label><br>
        <label>Last Name: <input type="text" name="lastName" required></label><br>
        <label>Phone: <input type="text" name="phone" required></label><br>
        <label>Email: <input type="email" name="email" required></label><br>
        <button type="submit">Отправить</button>
    </form>
    <a href="statuses.php">Перейти к статусам лидов</a>
</body>
</html>
