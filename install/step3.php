<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
ini_set('display_errors', 1);
error_reporting(E_ALL);

$configPath = dirname(__DIR__) . "/system/config.inc.php";
$error = "";
$success_messages = [];
$requirements_met = true; // Wird false, wenn ein Check fehlschlägt

// PHP-Version prüfen
$required_php_version = '8.1.0';
if (version_compare(PHP_VERSION, $required_php_version, '<')) {
    $error .= "❌ PHP-Version zu niedrig! (Aktuell: " . PHP_VERSION . ")<br>";
    $requirements_met = false;
} else {
    $success_messages[] = "✅ PHP-Version ist korrekt! (Aktuell: " . PHP_VERSION . ")";
}

// config.inc.php ggf. temporär laden für MySQL-Test
$_database = null;
if (file_exists($configPath)) {
    include($configPath);
}

// Wenn $_database bereits initialisiert wurde, testen wir
if ($_database instanceof mysqli && !$_database->connect_error) {
    $mysql_version = $_database->server_info;

    if (strpos($mysql_version, 'MariaDB') !== false) {
        $success_messages[] = "✅ MariaDB-Version erkannt! ($mysql_version)";
    } elseif (version_compare($mysql_version, '8.0', '<')) {
        $error .= "❌ MySQL-Version zu niedrig! (Aktuell: $mysql_version)<br>";
        $requirements_met = false;
    } else {
        $success_messages[] = "✅ MySQL-Version ist korrekt! ($mysql_version)";
    }
} else {
    $error .= "⚠️ Keine gültige MySQL-Verbindung verfügbar (config.inc.php wurde eventuell noch nicht erstellt).<br>";
    $requirements_met = false;
}

// Schreibrechte prüfen
$css_file = __DIR__ . '/../includes/themes/default/css/stylesheet.css';
if (!is_writable($css_file)) {
    $error .= "❌ Die Datei <code>stylesheet.css</code> ist nicht schreibbar.<br>";
    $requirements_met = false;
} else {
    $success_messages[] = "✅ Die Datei <code>stylesheet.css</code> ist schreibbar.";
}

// Wenn Formular abgeschickt wurde
if ($_SERVER["REQUEST_METHOD"] === "POST" && $requirements_met) {
    $db_host = $_POST["db_host"] ?? "localhost";
    $db_user = $_POST["db_user"] ?? "";
    $db_pass = $_POST["db_pass"] ?? "";
    $db_name = $_POST["db_name"] ?? "";

    $mysqli = @new mysqli($db_host, $db_user, $db_pass, $db_name);

    if ($mysqli->connect_error) {
        $error = "❌ Fehler bei der Verbindung zur Datenbank: " . $mysqli->connect_error;
    } else {
        // Konfigurationsdatei schreiben
        $configContent = <<<PHP
<?php
define("DB_HOST", "{$db_host}");
define("DB_USER", "{$db_user}");
define("DB_PASS", "{$db_pass}");
define("DB_NAME", "{$db_name}");

\$_database = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if (\$_database->connect_error) {
    die("Datenbankverbindung fehlgeschlagen: " . \$_database->connect_error);
}

\$_database->set_charset("utf8mb4");
PHP;

        if (file_put_contents($configPath, $configContent)) {
            header("Location: step4.php");
            exit;
        } else {
            $error = "❌ Fehler beim Schreiben der Konfigurationsdatei.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Webspell-RM Installation</title>
    <link href="/install/css/bootstrap.min.css" rel="stylesheet">
    <link href="/install/css/installer.css" rel="stylesheet">
</head>
<body>

    <div class="container my-5">
    <div class="text-center">
        <img src="/install/images/logo.png" alt="Webspell-RM Logo" class="install-logo mb-4">
        <h2>Schritt 3: Systemüberprüfung & Datenbankverbindung</h2>
    </div>

    <div class="card shadow-sm border-0 mt-4">
        <div class="card-body">

            <h3>Systemüberprüfung - Schritt 3</h3>

            <!-- Erfolgsmeldungen -->
            <?php foreach ($success_messages as $msg): ?>
                <div class="alert alert-success" role="alert"><?= htmlspecialchars($msg) ?></div>
            <?php endforeach; ?>

            <!-- Fehlermeldungen -->
            <?php if ($error): ?>
                <div class="alert alert-danger" role="alert"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>

            <?php if ($requirements_met): ?>
                <hr>
                <h3>Datenbankverbindung einrichten - Schritt 3</h3>
                <form method="post">
                    <div class="mb-3">
                        <label class="form-label">Host:</label>
                        <input class="form-control" type="text" name="db_host" value="localhost" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Benutzername:</label>
                        <input class="form-control" type="text" name="db_user" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Passwort:</label>
                        <input class="form-control" type="password" name="db_pass">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Datenbankname:</label>
                        <input class="form-control" type="text" name="db_name" required>
                    </div>
                    <div class="mb-3">
                        <input class="btn btn-primary btn-lg w-100" type="submit" value="Weiter zu Schritt 4">
                    </div>
                </form>
            <?php else: ?>
                <p class="text-danger" style="margin-top:20px;">❌ Bitte behebe die oben genannten Probleme, um fortzufahren.</p>
            <?php endif; ?>
        </div>
    

    <div class="card-footer text-center text-muted small">
                            &copy; <?= date("Y") ?> Webspell-RM Installer
                        </div>
</div>

<script src="/install/js/bootstrap.bundle.min.js"></script>
</body>
</html>
