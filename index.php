<?php

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

use TreptowKolleg\Api\Bridge;
use TreptowKolleg\Api\Menu\MenuItem;
use TreptowKolleg\Api\Menu\SidebarMenu;
use TreptowKolleg\Api\Menu\TopMenu;
use TreptowKolleg\Api\Session;

require __DIR__ . '/vendor/autoload.php';

function getProtocol(): string
{
    return (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
}

function searchFiles($dir, $text): array
{
    $files = Array();
    $file_tmp = glob($dir . '*', GLOB_MARK | GLOB_NOSORT);
    foreach ($file_tmp as $item) {
        if (substr($item,-1) != DIRECTORY_SEPARATOR) {
            $temp = explode('.', $item);
            $type = $temp[count($temp) - 1];

            if (in_array($type, array("md","txt"))) {
                $inhalt = file_get_contents($item);
                if (stristr($inhalt, $text)) {
                    $files[] = $item;
                }
            }
        }
        else {
            $files = array_merge($files, searchFiles($item, $text));
        }
    }
    return $files;
}

$permitted_chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

function secure_generate_string($input, $strength = 5, $secure = true): string
{
    $input_length = strlen($input);
    $random_string = '';
    for($i = 0; $i < $strength; $i++) {
        if($secure) {
            $random_character = $input[random_int(0, $input_length - 1)];
        } else {
            $random_character = $input[mt_rand(0, $input_length - 1)];
        }
        $random_string .= $random_character;
    }

    return $random_string;
}
$string_length = 6;
$captcha_string = secure_generate_string($permitted_chars, $string_length);

$server = getProtocol().$_SERVER['HTTP_HOST'].'/';

$session = new Session();
$db = $_POST['db'] ?? 'tk01';
$api = new Bridge('a38',$db);
$mdParser = new ParsedownExtra();

$timetable = []; //$api->getTimeTable("900191508",true);

if (!isset($_GET['page'])) {
    header("Location: $server?page=docs-README.md", true, 302);
    exit;
}

if(isset($_GET['logout'])) {
    $session->destroy("$server");
}

$result = null;

$message = null;

// POST verarbeiten
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Login
    if(isset($_POST['login'])) {
        $response = $api->requestLogin($_POST['user'], $_POST['pass']);
        if(isset($response['login']) and $response['login'] == true) {
            $session->set('login', true);
            $session->set('user',$response['origin']['user']);
        }
        $message = $response['message'];
    }

    if(isset($_POST['q'])) {
        $query = $_POST['q'];
        $searchDir = "./docs/";
        $result = searchFiles($searchDir,$query);
    }

    if(isset($_POST['sql'])) {
        $response = $api->requestSQL($_POST['query']);
            if(array_key_exists('message',$response)) {
                $message = $response['message'];
            }
            if(is_array($response['response']) and is_array($response['response'][0])) {
                $columns = array_keys($response['response'][0]);
            } else {
                $columns = [];
            }


    }

    // Kurspunkte
    $points = 0;
    if(isset($_POST['calc_course'])) {
        unset($_POST['calc_course']);
        for($i = 1; $i <= 7; $i++) {
            for($p = 1; $p <= 4; $p++) {
                if($_POST["$i-$p"] < 0 || $_POST["$i-$p"] > 15) {
                    $_SESSION['message'] = printf("Du hast im %s. Kurs im Semester Q%s mehr als 15 Punkte eingetragen!",$i,$p);
                    header("Location: $server?page=t-abirechner", true, 302);
                    exit;
                }
                if ($i <= 3) {
                    $points += 2 * $_POST["$i-$p"];
                } else {
                    $points += $_POST["$i-$p"];
                }
            }
        }
        $_SESSION['course'] = $points;
    }

    // Prüfungspunkte
    $examPoints = 0;
    if(isset($_POST['calc_exam'])) {
        unset($_POST['calc_exam']);
        foreach($_POST as $value) {
            $examPoints += 4 * $value;
        }
        $_SESSION['exam'] = $examPoints;
    }

    // Reset
    if(isset($_POST['calc_reset'])) {
        unset($_SESSION['course']);
        unset($_SESSION['exam']);
    }

}
$searchMenu = new TopMenu('search');
$searchMenu->addMenuItem(new MenuItem('Suchen','search.html','t-search'));


$mainMenu = new TopMenu('main');
$mainMenu
    ->addMenuItem(new MenuItem('Abi-Rechner','abicalc.html','t-abirechner'))
    ->addMenuItem(new MenuItem('API','docs.html','docs-README.md'))
    ->addMenuItem(new MenuItem('Vertretungsplan','vp.html','t-vp'))
;
$sidebar = new SidebarMenu('Interaktiv');
$sidebar
    ->addMenuItem(new MenuItem('API','form.html','docs-form'))
    ->addMenuItem(new MenuItem('SQL-Query','sql.html','docs-sql'))
;



$md = null;
$file = './';
if (isset($_GET['page']) and str_starts_with($_GET['page'],'docs') ) {
    $path = str_replace('-','/',$_GET['page']);
    if(file_exists($file = './'. $path)) {
        $md = file_get_contents($file );
    }
}

function getName(string $file): ?string
{
    $fileNames = [
        'basics' => 'Grundlagen',
        'exercise' => 'Übungen',
        'class' => 'Klassen',
        '_index' => 'Einleitung',
        'projection' => 'Projektion',
        'selection' => 'Selektion',
        'hesse' => 'Hesse',
        'orm' => 'ORM',
        'erm' => 'ERM',
        'enum' => 'Enums',
        'associations' => 'Beziehungen',
        'vars' => 'Variablen & Konstanten',
        'magic_methods' => 'Magische Methoden',
        'tables' => 'Tabellen',
        'php_ide' => 'PHP IDE',
        'java_ide' => 'JAVA IDE',
        'relations' => 'Beziehungen',
        'object_relations' => 'Objektbeziehungen',
        'class_relations' => 'Klassenbeziehungen',
        'typo' => 'Typographie',
        'control' => 'Kontrollstrukturen',
        'README' => 'Einleitung',
        'dea' => 'DEA',
        'elektrische_felder' => 'Elektrische Felder',
        'kernphysik' => 'Kernphysik',
        'method' => 'Methoden',
        'swing' => 'EM-Schwingkreis',
        'command' => 'Befehle',
        'index' => 'Startseite',
        'analysis' => 'Analysis',
        'gd' => 'Bildbearbeitung',
    ];
    $fileName = substr($file,0,-3);


    if(array_key_exists($fileName,$fileNames)) {
        return $fileNames[$fileName];
    } else {
        return "$fileName ist nicht benannt.";
    }

}

function dirToArray($dir): array
{
    $result = array();
    $cdir = scandir($dir,SCANDIR_SORT_ASCENDING);

    foreach ($cdir as $key => $value)
    {
        if (!in_array($value,array(".","..")))
        {
            if (is_dir($dir . DIRECTORY_SEPARATOR . $value))
            {
                $result[$value] = dirToArray($dir . DIRECTORY_SEPARATOR . $value);
            }
            else
            {
                $result[] = $value;
            }
        }
    }
    return $result;
}

$entries = dirToArray('./docs');
$sidebars = [];
ksort($entries);
foreach ($entries as $dir => $value) {
    if ($dir != "img") {
        if(is_array($value)) {

            $dirArray = explode('_',$dir);
            foreach ($dirArray as &$word) {
                $word = ucfirst($word);
            }
            $dir2 = implode(' ', $dirArray);

            if(strlen($dir) <= 5) {
                $dirTitle = strtoupper($dir2);
            } else {
                $dirTitle = ucfirst($dir2);
            }
            $newSidebarMenu = new SidebarMenu($dirTitle);
            foreach ($value as $key => $subValue) {
                $newMenuItem = new MenuItem(getName($subValue),'docs.html',"docs-$dir-$subValue");
                $newSidebarMenu->addMenuItem($newMenuItem);
            }
            $sidebars[] = $newSidebarMenu;

        }
    }
}

$sidebars = array_merge($sidebars,[$sidebar,$mainMenu,$searchMenu]);


function checkPages(array $items, &$filePathOutput)
{
    foreach ($items as $key => $item) {
        /* @var MenuItem $item */
        if($item->getKey() == $_GET['page']) {
            $item->setCurrent(true);
            $filePathOutput = $item->getTemplate();
            break;
        }
    }
}

if(isset($_GET['page'])) {
    foreach ($sidebars as $sidebar)
    checkPages($sidebar->getMenuItems(),$currentPage);
}


// HTML-Template einbinden
include "./templates/base.html.php";
