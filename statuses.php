<?php
include 'api.php';

$date_from = isset($_GET['date_from']) ? $_GET['date_from'] : date('Y-m-d 00:00:00', strtotime('-30 days'));
$date_to = isset($_GET['date_to']) ? $_GET['date_to'] : date('Y-m-d 23:59:59');
$response = getStatuses($date_from, $date_to);
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Статуси лідів</title>
</head>
<body>
    <h1>Статуси лідів</h1>
    <form method="get">
        <label>Дата від:
            <input type="date" name="date_from" value="<?php echo htmlspecialchars(explode(' ', $date_from)[0]); ?>">
        </label>
        <label>Дата до:
            <input type="date" name="date_to" value="<?php echo htmlspecialchars(explode(' ', $date_to)[0]); ?>">
        </label>
        <button type="submit">Фільтрувати</button>
    </form>
    <?php if ($response['success'] && isset($response['data']['data']) && is_array($response['data']['data'])): ?>
    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Email</th>
                <th>Status</th>
                <th>FTD</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($response['data']['data'] as $status): ?>
                <tr>
                    <td><?= htmlspecialchars($status['id'] ?? 'N/A'); ?></td>
                    <td><?= htmlspecialchars($status['email'] ?? 'N/A'); ?></td>
                    <td><?= htmlspecialchars($status['status'] ?? 'N/A'); ?></td>
                    <td><?= htmlspecialchars($status['ftd'] ?? 'N/A'); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <p style="color: red;">Немає даних для відображення або помилка API: <?= htmlspecialchars($response['message'] ?? 'Неизвестная ошибка'); ?></p>
<?php endif; ?>

    <a href="index.php">Повернутися до форми</a>
</body>
</html>
