<?php
$racine = $_SERVER['DOCUMENT_ROOT'];

require "$racine/vendor/autoload.php";

$dbHost = 'localhost';
$dbUser = 'root';
$dbPassword = '';
$dbBase = 'vds';

$date = date('Y-m-d');
$fichier = "$racine/data/sauvegarde/$date.sql";

use Ifsnop\Mysqldump as IMysqldump;

$parametres = [
    'add-drop-database' => true,
    'add-drop-trigger' => false,
    'databases' => true,
    'routines' => true,
    'skip-definer' => true
];

try {
    $dump = new IMysqldump\Mysqldump("mysql:host=$dbHost;dbname=$dbBase", "$dbUser", "$dbPassword", $parametres);
    $dump->start("$fichier");
    echo 1;
} catch (Exception $e) {
    echo 'mysqldump-php error: ' . $e->getMessage();
    exit;
}
$ftpcon = ftp_connect("ftp-leovarlet.alwaysdata.net", 21, 90);
ftp_login($ftpcon, "leovarlet", "SlamSr.2023");
ftp_pasv($ftpcon, true);

if (ftp_put($ftpcon, "/sauvegarde/$date.sql", $fichier, FTP_ASCII))
    echo 1;
else
    echo "la sauvegarde a réussi mais son exportation a échoué";

ftp_close($ftpcon);
