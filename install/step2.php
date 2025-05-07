<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/check_lock.php';

set_time_limit(300);
ini_set('memory_limit', '512M');

#$updateUrl = "https://update.webspell-rm.de/releases/2.1.7/cms.zip";
$updateUrl = "https://github.com/Webspell-RM/Webspell-RM-3.0-Next-Generation/archive/refs/heads/main.zip";
$tempZipPath = __DIR__ . "/main.zip";
$extractPath = dirname(__DIR__); // Ziel: Webroot

$messages = [];

function addMessage(&$messages, $message, $type = "info", $icon = "ℹ️") {
    $messages[] = [
        'message' => $message,
        'type' => $type,
        'icon' => $icon
    ];
}

addMessage($messages, "📥 Lade CMS herunter...");

$zipData = @file_get_contents($updateUrl);
if ($zipData === false) {
    addMessage($messages, "Fehler: Download fehlgeschlagen. Prüfe URL oder Netzwerkverbindung.", "danger", "❌");
    renderTemplateAndExit($messages);
}

file_put_contents($tempZipPath, $zipData);

$zip = new ZipArchive;
if ($zip->open($tempZipPath) === TRUE) {

    addMessage($messages, "📦 Entpacke CMS-Dateien...");

    // Sicherheitsprüfung auf Zip-Slip
    for ($i = 0; $i < $zip->numFiles; $i++) {
        $entry = $zip->getNameIndex($i);
        if (strpos($entry, '..') !== false) {
            $zip->close();
            unlink($tempZipPath);
            addMessage($messages, "Sicherheitsfehler im ZIP-Archiv.", "danger", "❌");
            renderTemplateAndExit($messages);
        }
    }

    $zip->extractTo($extractPath);
    $zip->close();
    unlink($tempZipPath);

    addMessage($messages, "CMS erfolgreich installiert. Du wirst weitergeleitet...", "success", "✅");

    // Weiterleitung zu step2.php nach 3 Sekunden
    $redirect = true;

} else {
    addMessage($messages, "Fehler beim Öffnen des ZIP-Archivs.", "danger", "❌");
}

renderTemplateAndExit($messages, $redirect ?? false);


// TEMPLATE
function renderTemplateAndExit($messages, $redirect = false) {
    ?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Webspell-RM Installation</title>
    <link href="/install/css/bootstrap.min.css" rel="stylesheet">
    <link href="/install/css/installer.css" rel="stylesheet">
    <?php if ($redirect): ?>
        <meta http-equiv="refresh" content="3;url=step3.php">
    <?php endif; ?>    
</head>
<body>

<div class="container my-5">
    <div class="text-center">
        <img src="/install/images/logo.png" alt="Webspell-RM Logo" class="install-logo mb-4">
        <h2>Schritt 2: Systemüberprüfung</h2>
    </div>

    <div class="card shadow-sm border-0 mt-4">
        <div class="card-body">
            <h3>Webspell-RM Installer – Schritt 2</h3>

            <?php if (!empty($messages)): ?>
                <?php foreach ($messages as $msg): ?>
                    <div class="alert alert-<?= $msg['type'] ?> d-flex align-items-center" role="alert">
                        <span class="me-2 fs-4"><?= $msg['icon'] ?></span>
                        <div><?= htmlspecialchars($msg['message']) ?></div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <div class="card-footer text-center text-muted small">
            &copy; <?= date("Y") ?> Webspell-RM Installer
        </div>
    </div>
</div>


<script src="/install/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php
    exit;
}
