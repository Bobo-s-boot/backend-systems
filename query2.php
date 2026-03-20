<?php
require_once 'connect.php';

if (isset($_GET['department_id'])) {
    $department_id = $_GET['department_id'];
    $sql = "SELECT name, date, shift FROM nurse WHERE department = :department_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['department_id' => $department_id]);
    $nurses = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    die("Не обрано відділення.");
}
?>

<!DOCTYPE html>
<html lang="uk">
<head><meta charset="UTF-8"><title>Запит 2</title></head>
<body>
    <h2>Медсестри відділення №<?= htmlspecialchars($department_id) ?></h2>
    <?php if (!empty($nurses)): ?>
        <table border="1" cellpadding="5" cellspacing="0">
            <tr><th>Ім'я медсестри</th><th>Дата</th><th>Зміна</th></tr>
            <?php foreach ($nurses as $nurse): ?>
                <tr>
                    <td><?= htmlspecialchars($nurse['name']) ?></td>
                    <td><?= htmlspecialchars($nurse['date']) ?></td>
                    <td><?= htmlspecialchars($nurse['shift']) ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php else: ?>
        <p>У цьому відділенні немає медсестер.</p>
    <?php endif; ?>
    <br><a href="index.php">Повернутися на головну</a>
</body>
</html>