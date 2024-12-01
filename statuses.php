<?php
include 'api.php';

$date_from = isset($_GET['date_from']) ? $_GET['date_from'] : date('Y-m-d 00:00:00', strtotime('-30 days'));
$date_to = isset($_GET['date_to']) ? $_GET['date_to'] : date('Y-m-d 23:59:59');
$response = getStatuses($date_from, $date_to);
echo '<pre>';
print_r($response);
echo '</pre>';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Статусы лидов</title>
</head>
<body>
    <h1>Статусы лидов</h1>
    <form method="get">
        <label>Фильтр по дате: <input type="date" name="date" value="<?php echo htmlspecialchars($date); ?>"></label>
        <button type="submit">Фильтровать</button>
    </form>
    <?php if ($response['success'] && isset($response['data']['data']) && is_array($response['data']['data'])): ?>
    <table>
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
    <p style="color: red;">Нет данных для отображения или ошибка API: <?= htmlspecialchars($response['message'] ?? 'Неизвестная ошибка'); ?></p>
<?php endif; ?>

    <a href="index.php">Вернуться к форме</a>
</body>
</html>
