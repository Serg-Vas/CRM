<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include 'api.php';
    $response = addLead($_POST);
    print_r($response);
    echo("IP:" . $_SERVER['REMOTE_ADDR']);
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
    <title>Додавання ліда</title>
</head>
<body>
    <h1>Форма створення ліда</h1>
    <?php if (isset($message)) echo "<p>$message</p>"; ?>
    <form method="post">
        <label>First Name: <input type="text" value="q" name="firstName" required></label><br>
        <label>Last Name: <input type="text" value="q" name="lastName" required></label><br>
        <label>Phone: <input type="text" value="+380501809053" name="phone" required></label><br>
        <label>Email: <input type="email" value="qwe@gmail.com" name="email" required></label><br>
        <button type="submit">Відправити</button>
    </form>
    <a href="statuses.php">Перейти до списку лідів</a>
</body>
</html>
