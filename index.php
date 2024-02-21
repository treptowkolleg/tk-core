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

$session = new Session();
$api = new Bridge('a38');
$mdParser = new ParsedownExtra();

if (!isset($_GET['page'])) {
    header("Location: https://it.treptowkolleg.de/?page=docs-README.md", true, 302);
    exit;
}

if(isset($_GET['logout'])) {
    $session->destroy("https://it.treptowkolleg.de/");
}

// Login verarbeiten
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

    // Kurspunkte
    $points = 0;
    if(isset($_POST['calc_course'])) {
        unset($_POST['calc_course']);
        for($i = 1; $i <= 7; $i++) {
            for($p = 1; $p <= 4; $p++) {
                if($_POST["$i-$p"] < 0 || $_POST["$i-$p"] > 15) {
                    $_SESSION['message'] = printf("Du hast im %s. Kurs im Semester Q%s mehr als 15 Punkte eingetragen!",$i,$p);
                    header("Location: https://it.treptowkolleg.de/?page=t-abirechner", true, 302);
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
$mainMenu = new TopMenu('main');
$mainMenu
    ->addMenuItem(new MenuItem('Abi-Rechner','abicalc.html','t-abirechner'))
    ->addMenuItem(new MenuItem('API','docs.html','docs-README.md'))
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
        'relations' => 'Beziehungen',
        'object_relations' => 'Objektbeziehungen',
        'class_relations' => 'Klassenbeziehungen',
        'typo' => 'Typographie',
        'control' => 'Kontrollstrukturen',
        'README' => 'Einleitung',
        'dea' => 'DEA',
    ];
    $fileName = substr($file,0,-3);

    return $fileNames[$fileName];
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
asort($entries);
foreach ($entries as $dir => $value) {
    if ($dir != "img") {
        if(is_array($value)) {

            $dirArray = explode('-',$dir);
            foreach ($dirArray as &$word) {
                $word = ucfirst($word);
            }
            $dir = implode(' ', $dirArray);

            if(strlen($dir) <= 5) {
                $dirTitle = strtoupper($dir);
            } else {
                $dirTitle = ucfirst($dir);
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

$sidebars = array_merge($sidebars,[$sidebar,$mainMenu]);


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
