<?php

// ===== Basic HTTP Authentication =====
$USERNAME = 'Hu@SAkNps';
$PASSWORD = 'Pg*2sxSl4SApQww%eG2';

if (
    !isset($_SERVER['PHP_AUTH_USER'])
    || $_SERVER['PHP_AUTH_USER'] !== $USERNAME
    || $_SERVER['PHP_AUTH_PW']   !== $PASSWORD
) {
    header('WWW-Authenticate: Basic realm="Logs Viewer"');
    header('HTTP/1.0 401 Unauthorized');
    echo 'Доступ запрещён.';
    exit;
}

const LOG_DIR = __DIR__;


// =====  Return Log files for grafana =====

if (isset($_GET['type']) && $_GET['type'] === 'scraper') {
    $since = isset($_GET['since']) ? intval($_GET['since']) : 0;
    $files = glob(LOG_DIR . '/*.log');
    sort($files);

    header('Content-Type: text/plain; charset=utf-8');
    foreach ($files as $file) {
        $lines = file($file);
        foreach ($lines as $line) {
            // Check line for date - [2025-05-29 15:27:10]
            if (preg_match('/\[(\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2})\]/', $line, $m)) {
                $ts = strtotime($m[1]);
                if ($ts >= $since) echo $line;
            } else {
                // everything
                echo $line;
            }
        }
    }
    exit;
}


// ===== Обработка скачивания файла =====
if (!empty($_GET['download'])) {
    $fileName = basename($_GET['download']);
    $filePath = LOG_DIR . DIRECTORY_SEPARATOR . $fileName;
    if (is_file($filePath) && preg_match('/\.log$/', $fileName)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . $fileName . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filePath));
        readfile($filePath);
        exit;
    } else {
        echo 'Файл не найден.';
        exit;
    }
}

// ===== Получение выбранного файла для просмотра =====
$selected = isset($_GET['file']) ? basename($_GET['file']) : '';
$content = '';
if ($selected) {
    $fullPath = LOG_DIR . DIRECTORY_SEPARATOR . $selected;
    if (is_file($fullPath) && preg_match('/\.log$/', $selected)) {
        $content = file_get_contents($fullPath);
    } else {
        $content = "Файл не найден или недоступен.";
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Просмотр логов</title>
    <style>
        body { font-family: monospace; background: #f4f4f4; color: #333; padding: 20px; }
        a { text-decoration: none; color: #06c; margin-right: 10px; }
        ul { list-style: none; padding: 0; }
        li { margin-bottom: 5px; }
        pre { background: #fff; padding: 10px; border: 1px solid #ccc; overflow: auto; max-height: 80vh; }
        .actions { margin-bottom: 10px; }
        .download-btn { display: inline-block; padding: 5px 10px; background: #06c; color: #fff; text-decoration: none; border-radius: 3px; }
    </style>
</head>
<body>
    <h2>Список логов в папке <?= htmlspecialchars(LOG_DIR) ?></h2>
    <ul>
        <?php foreach (glob(LOG_DIR . '/*.log') as $log): ?>
            <?php $name = basename($log); ?>
            <li><a href="?file=<?= urlencode($name) ?>"><?= htmlspecialchars($name) ?></a></li>
        <?php endforeach; ?>
    </ul>

    <?php if ($selected): ?>
        <div class="actions">
            <strong>Просмотр файла:</strong> <?= htmlspecialchars($selected) ?>
            <a class="download-btn" href="?download=<?= urlencode($selected) ?>&file=<?= urlencode($selected) ?>">Скачать</a>
        </div>
        <pre><?= htmlspecialchars($content) ?></pre>
    <?php endif; ?>
</body>
</html>
