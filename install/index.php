<?php
/**
 * ─────────────────────────────────────────────────────────────────────────────
 * Webspell-RM 3.0 - Modern Content & Community Management System
 * ─────────────────────────────────────────────────────────────────────────────
 *
 * @version       3.0
 * @build         Stable Release
 * @release       2025
 * @copyright     © 2018–2025 Webspell-RM | https://www.webspell-rm.de
 * 
 * @description   Webspell-RM is a modern open source CMS designed for gaming
 *                communities, esports teams, and digital projects of any kind.
 * 
 * @author        Based on the original WebSPELL Clanpackage by Michael Gruber
 *                (webspell.at), further developed by the Webspell-RM Team.
 * 
 * @license       GNU General Public License (GPL)
 *                This software is distributed under the terms of the GPL.
 *                It is strictly prohibited to remove this copyright notice.
 *                For license details, see: https://www.gnu.org/licenses/gpl.html
 * 
 * @support       Support, updates, and plugins available at:
 *                → Website: https://www.webspell-rm.de
 *                → Forum:   https://www.webspell-rm.de/forum.html
 *                → Wiki:    https://www.webspell-rm.de/wiki.html
 * 
 * ─────────────────────────────────────────────────────────────────────────────
 */

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/check_lock.php';


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
        <h2>Webspell-RM Installation</h2>
    </div>

    <div class="card shadow-sm border-0 mt-4">
        <div class="card-body">

            <h3>Willkommen zur Webspell-RM Installation</h3>
<p>Vielen Dank, dass du Webspell-RM gewählt hast! In den nächsten Schritten wirst du durch den Installationsprozess geführt, der sicherstellt, dass alles korrekt eingerichtet wird. Hierbei werden folgende Punkte überprüft und konfiguriert:</p>

<ul>
    <li>Die Eingabe deiner Datenbankinformationen, um die Verbindung zum System herzustellen.</li>
    <li>Die Prüfung der erforderlichen Ordnerrechte, damit Webspell-RM korrekt auf deinem Server ausgeführt werden kann.</li>
    <li>Die Konfiguration der grundlegenden Einstellungen für eine fehlerfreie Nutzung der Software.</li>
</ul>

<p>Die Installation ist ein notwendiger Schritt, um Webspell-RM korrekt auf deinem Webserver einzurichten und sicherzustellen, dass alle Komponenten reibungslos zusammenarbeiten.</p>

<p>Falls du während der Installation auf Fragen oder Probleme stößt, bieten wir dir ausführliche Hilfe. Weitere Informationen findest du in der <a href="https://www.webspell-rm.de/dokumentation" target="_blank">Dokumentation</a> oder auf unserer offiziellen Webseite.</p>

<p>Bereit, Webspell-RM zu installieren? Klicke auf den Button unten, um den Installationsprozess zu starten.</p>


            <!-- Wichtige Hinweise -->
            <div class="alert alert-info mt-4" role="alert">
                <h5>Systemanforderungen:</h5>
                <ul>
                    <li>PHP Version 8.1 oder höher</li>
                    <li>MySQL 8 oder MariaDB 10 oder höher</li>
                    <li>Mindestens 512 MB RAM</li>
                    <li>Schreibrechte für <code>/system/</code> und <code>/includes/</code></li>
                    <li>Schreibrechte für <code>config.inc.php</code> & <code>stylesheet.css</code></li>
                </ul>
                <p class="mt-3"><strong>Wichtig:</strong> Bitte stelle sicher, dass alle Anforderungen erfüllt sind, bevor du fortfährst.</p>
            </div>

            <a href="step1.php" class="btn btn-primary btn-lg w-100">Installation starten</a>

        </div>
        <div class="card-footer text-center text-muted small">
            &copy; <?= date("Y") ?> Webspell-RM Installer
        </div>
    </div>
</div>


<script src="/install/js/bootstrap.bundle.min.js"></script>

</body>
</html>

