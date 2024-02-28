<?php
/**
 * @var Session $session;
 */

use TreptowKolleg\Api\Session;

?>
<!DOCTYPE HTML>
<html lang="de" color-mode="user">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
        <link rel="manifest" href="/site.webmanifest">
        <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
        <meta name="msapplication-TileColor" content="#2b5797">
        <meta name="theme-color" content="#ffffff">
        <meta name="description" content="My description">


        <title><?= $title ?? "AG Informatik" ?></title>
<!--        <link rel="stylesheet" href="https://unpkg.com/mvp.css">-->
<!--        <link rel="stylesheet" href="https://unpkg.com/chota@latest">-->
        <link rel="stylesheet" href="/dist/style.css" />

        <script src="/assets/cab.js" type="text/javascript"></script>
        <script src="/assets/canvas.js" type="text/javascript"></script>

        <link rel="stylesheet" href="https://unpkg.com/@highlightjs/cdn-assets@11.9.0/styles/a11y-light.min.css">

        <style>
            details{
                background-color: white;
                border: 1px solid dimgrey;
            }
        </style>
        <script src="https://unpkg.com/@highlightjs/cdn-assets@11.9.0/highlight.min.js"></script>

        <script>hljs.highlightAll();</script>
    </head>
    <body class="is-paper">
    <div class="l-docs">
        <div class="l-docs__header">

            <header id="navigation" class="p-navigation is-dark">
                <div class="l-docs__subgrid">
                    <div class="l-docs__sidebar">
                        <div class="p-navigation__banner">
                            <div class="p-navigation__tagged-logo">
                                <a class="p-navigation__link" href="/">
                                    <div class="p-navigation__logo-tag">
                                        <img class="p-navigation__logo-icon" src="/assets/img/tk.png"  alt="Logo">
                                    </div>
                                    <span class="p-navigation__logo-title">AG Informatik</span>
                                </a>
                            </div>
                            <a href="#navigation" class="p-navigation__toggle--open" title="menu">Menü</a>
                            <a href="#navigation-closed" class="p-navigation__toggle--close" title="close menu">Menü schließen</a>
                        </div>
                    </div>
                    <div class="l-docs__main">
                        <div class="p-navigation__row u-fixed-width">
                            <nav class="p-navigation__nav" aria-label="Example main">
                                <ul class="p-navigation__items">
                                    <li class="p-navigation__item <?= str_starts_with($_GET['page'], 'docs-') ? 'is-selected' : ''?>">
                                        <a class="p-navigation__link" href="/">Unterricht</a>
                                    </li>
                                    <li class="p-navigation__item <?= $_GET['page'] == 't-abirechner' ? 'is-selected' : ''?>">
                                        <a class="p-navigation__link" href="/?page=t-abirechner">Abi-Rechner</a>
                                    </li>
                                    <li class="p-navigation__item <?= $_GET['page'] == 't-vp' ? 'is-selected' : ''?>">
                                        <a class="p-navigation__link" href="/?page=t-vp">Philosophie</a>
                                    </li>
                                    <?php if ($session->get('login')): ?>
                                        <li class="p-navigation__item">
                                            <a class="p-navigation__link" href="/?page=docs-README.md&logout=true"><?=ucfirst($session->get('user'))?> abmelden</a>
                                        </li>
                                    <?php endif;?>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </header>
            <section id="search-docs" class="p-strip is-bordered is-shallow l-docs__subgrid">
                <div class="l-docs__sidebar u-hide--medium u-hide--small">
                    <div class="u-fixed-width">
                        <h5 class="u-sv-2">Dokumentation</h5>
                    </div>
                </div>
                <div class="l-docs__main">
                    <div class="row">
                        <form class="p-search-box u-no-margin--bottom">
                            <input type="search" class="p-search-box__input" name="q" placeholder="Dokumentation durchsuchen" required="" autocomplete="on">
                            <button type="reset" class="p-search-box__reset" name="close"><i class="p-icon--close">Schließen</i></button>
                            <button type="submit" class="p-search-box__button" name="submitSearch"><i class="p-icon--search">Suchen</i></button>
                        </form>
                    </div>
                </div>
            </section>
        </div>

        <aside class="l-docs__sidebar">
            <nav class="p-side-navigation--accordion is-sticky" id="drawer" aria-label="Table of contents">
                <div class="u-hide--large p-strip is-shallow">
                    <div class="u-fixed-width">
                        <a href="#drawer" class="p-side-navigation__toggle js-drawer-toggle" aria-controls="drawer">
                            Navigation öffnen
                        </a>
                    </div>
                </div>

                <div class="p-side-navigation__overlay js-drawer-toggle" aria-controls="drawer"></div>

                <div class="p-side-navigation__drawer">
                    <div class="p-strip is-shallow">
                    <div class="p-side-navigation__drawer-header">
                        <a href="#" class="p-side-navigation__toggle--in-drawer js-drawer-toggle" aria-controls="drawer">
                            Navigation schließen
                        </a>
                    </div>
                    <?php include "./templates/sidebar.html.php";?>
                    </div>
                </div>
            </nav>
        </aside>
        <?php
        // Unterseite einbinden
        include $currentPage ?? './templates/index.html.php';
        ?>
    </div>
    <footer class="l-footer--sticky p-strip--dark">
        <div class="l-docs__subgrid">
            <div class="l-docs__sidebar u-fixed-width">
                <p class="u-no-margin--bottom">© 2003-<?=date("Y")?><br>Benjamin Wagner.</p>
            </div>
            <div class="l-docs__main">
                <div class="row">
                    <nav class="col-3" aria-label="Footer">
                        <ul class="p-list u-no-margin--bottom">
                            <li class="p-list__item">
                                <a class="is-dark" href="https://it.treptowkolleg.de/admin" target="_blank">PhpMyAdmin</a>
                            </li>
                            <li class="p-list__item">
                                <a class="is-dark" href="https://www.treptow-kolleg.de" target="_blank">Treptow-Kolleg Berlin</a>
                            </li>
                        </ul>
                    </nav>
                    <div class="col-9">
                        <p class="u-no-margin--bottom">Ein Projekt der <b>AG Informatik</b> am Treptow-Kolleg Berlin.</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <script src="/dist/app.js"></script>
    <script>
        MathJax = {
            tex: {
                packages: ['base'],        // extensions to use
                inlineMath: [              // start/end delimiter pairs for in-line math
                    ['$', '$']
                ],
                processEscapes: true,      // use \$ to produce a literal dollar sign
                processEnvironments: true, // process \begin{xxx}...\end{xxx} outside math mode
                processRefs: true,         // process \ref{...} outside of math mode
                digits: /^(?:[0-9]+(?:\{,\}[0-9]{3})*(?:\.[0-9]*)?|\.[0-9]+)/,
                // pattern for recognizing numbers
                tags: 'all',              // or 'ams' or 'all'
                tagSide: 'left',          // side for \tag macros
                tagIndent: '0.8em',        // amount to indent tags
                useLabelIds: true,         // use label name rather than tag for ids
                maxMacros: 10000,          // maximum number of macro substitutions per expression
                maxBuffer: 5 * 1024,       // maximum size for the internal TeX string (5K)
            }
        }
    </script>
    <script>
        MathJax = {
            tex: {
                inlineMath: [['$', '$'], ['\\(', '\\)']],
                displayMath: [             // start/end delimiter pairs for display math
                    ['$$', '$$'],
                    ['\\[', '\\]']
                ],
                processEscapes: true,      // use \$ to produce a literal dollar sign
                processEnvironments: true, // process \begin{xxx}...\end{xxx} outside math mode
                processRefs: true,         // process \ref{...} outside of math mode
                digits: /^(?:[0-9]+(?:\{,\}[0-9]{3})*(?:\.[0-9]*)?|\.[0-9]+)/,
                // pattern for recognizing numbers
                tags: 'none',              // or 'ams' or 'all'
                tagSide: 'right',          // side for \tag macros
                tagIndent: '0.8em',        // amount to indent tags
                useLabelIds: true,         // use label name rather than tag for ids
                maxMacros: 10000,          // maximum number of macro substitutions per expression
                maxBuffer: 5 * 1024,       // maximum size for the internal TeX string (5K)
            },
            svg: {
                scale: 1,                      // global scaling factor for all expressions
                minScale: .5,                  // smallest scaling factor to use
                mtextInheritFont: false,       // true to make mtext elements use surrounding font
                merrorInheritFont: true,       // true to make merror text use surrounding font
                mathmlSpacing: false,          // true for MathML spacing rules, false for TeX rules
                skipAttributes: {},            // RFDa and other attributes NOT to copy to the output
                exFactor: .5,                  // default size of ex in em units
                displayAlign: 'center',        // default for indentalign when set to 'auto'
                displayIndent: '0',            // default for indentshift when set to 'auto'
                fontCache: 'local',            // or 'global' or 'none'
                localID: null,                 // ID to use for local font cache (for single equation processing)
                internalSpeechTitles: true,    // insert <title> tags with speech content
                titleID: 0                     // initial id number to use for aria-labeledby titles
            },
        };
    </script>
    <script type="text/javascript" id="MathJax-script" async
            src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-svg.js">
    </script>

    </body>
</html>
