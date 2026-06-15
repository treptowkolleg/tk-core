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
        <meta name="description" content="Wissen rund um Informatik, Mathematik und Physik">


        <title><?= $title ?? "Civicsoft" ?></title>
<!--        <link rel="stylesheet" href="https://unpkg.com/mvp.css">-->
<!--        <link rel="stylesheet" href="https://unpkg.com/chota@latest">-->
        <link rel="stylesheet" href="/dist/style.css" />

        <script src="/assets/cab.js" type="text/javascript"></script>
        <script src="/assets/canvas.js" type="text/javascript"></script>

        <link rel="stylesheet" href="https://unpkg.com/@highlightjs/cdn-assets@11.9.0/styles/foundation.min.css">

        <style>
            details{
                background-color: white;
                border: 1px solid dimgrey;
                padding: 5px 5px 5px 5px!important;
            }
            details > summary{
                cursor: pointer;
                margin-bottom: 0!important;
                padding-top: 2px!important;
                padding-bottom: 2px!important;
            }
            .helper {
                display: block;
                height: 100%;
                vertical-align: middle;
            }
            pre {
                background: none!important;
                padding: 0!important;
            }
        </style>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.10.0/highlight.min.js" integrity="sha512-6yoqbrcLAHDWAdQmiRlHG4+m0g/CT/V9AGyxabG8j7Jk8j3r3K6due7oqpiRMZqcYe9WM2gPcaNNxnl2ux+3tA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.10.0/languages/latex.min.js" integrity="sha512-pFyz4NqzwEQdlyFXfDFIFeKX2k9zqkFu37xCxrjdrDCrprIy/bRItO0jXjii7nyxqwaCK2KfZ/9idRE/x4TkRQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script>hljs.highlightAll();</script>
    </head>
    <body class="is-paper">
    <div class="l-docs">
        <div class="l-docs__header">

            <header id="navigation" class="p-navigation is-light">
                <div class="l-docs__subgrid">
                    <div class="l-docs__sidebar">
                        <div class="p-navigation__banner">
                            <div class="p-navigation__tagged-logo">
                                <a class="p-navigation__link" href="/">
                                    <div class="p-navigation__logo-tag">
                                    </div>
                                    <span class="p-navigation__logo-title">Civic<b>soft</b></span>
                                </a>
                            </div>
                            <a href="#navigation" class="p-navigation__toggle--open" title="menu"><i class="p-icon--menu"></i></a>
                            <a href="#navigation-closed" class="p-navigation__toggle--close" title="close menu"><i class="p-icon--close"></i></a>
                        </div>
                    </div>
                    <div class="l-docs__main">
                        <div class="p-navigation__row u-fixed-width">
                            <nav class="p-navigation__nav" aria-label="Example main">
                                <ul class="p-navigation__items">
                                    <li class="p-navigation__item <?= str_starts_with($_GET['page'], 'docs-toc.md') ? 'is-selected' : ''?>">
                                        <a class="p-navigation__link" href="/?page=docs-toc.md">Home</a>
                                    </li>
                                    <li class="p-navigation__item <?= !str_starts_with($_GET['page'], 'docs-toc.md') && str_starts_with($_GET['page'], 'docs-') ? 'is-selected' : ''?>">
                                        <a class="p-navigation__link" href="/?page=docs-README.md">Docs</a>
                                    </li>
                                    <li class="p-navigation__item--dropdown-toggle  <?= str_starts_with($_GET['page'], 't-') ? 'is-selected' : ''?>" id="link-2">
                                        <a href="#" aria-controls="link-2-menu" class="p-navigation__link">Tools</a>
                                        <ul class="p-navigation__dropdown" id="link-2-menu" aria-hidden="true">
                                            <li>
                                                <a href="/?page=t-abirechner" class="p-navigation__dropdown-item">Abi-Rechner</a>
                                            </li>
                                            <li>
                                                <a href="/?page=t-vp" class="p-navigation__dropdown-item">Simulationen</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="p-navigation__item <?= str_starts_with($_GET['page'], 'projects') ? 'is-selected' : ''?>">
                                        <a class="p-navigation__link" href="/?page=projects">Projekte</a>
                                    </li>
                                    <li class="p-navigation__item <?= str_starts_with($_GET['page'], 'partner') ? 'is-selected' : ''?>">
                                        <a class="p-navigation__link" href="/?page=partner">Partner</a>
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
                        <form class="p-search-box u-no-margin--bottom" method="post" action="/?page=t-search">
                            <input type="search" class="p-search-box__input" name="q" id="search-input" value="<?=$_POST["q"] ?? '' ?>" placeholder="Dokumentation durchsuchen" required="" autocomplete="on">
                            <button type="reset" class="p-search-box__reset" name="close" id="search-docs-reset"><i class="p-icon--close">Schließen</i></button>
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
                            Alle Themen
                        </a>
                    </div>
                </div>

                <div class="p-side-navigation__overlay js-drawer-toggle" aria-controls="drawer"></div>

                <div class="p-side-navigation__drawer">
                    <div class="p-strip is-shallow">
                    <div class="p-side-navigation__drawer-header">
                        <a href="#" class="p-side-navigation__toggle--in-drawer js-drawer-toggle" aria-controls="drawer">
                            schließen
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
    <footer class="l-footer--sticky p-strip--highlighted">
        <nav class="row" aria-label="Footer">
            <ul class="p-inline-list">
                <li class="p-inline-list__item">
                    <a href="https://www.dpg-physik.de/" target="_blank">
                        <img src="/assets/img/dpg.svg" alt="IONOS Logo" height="42" style="vertical-align: middle; max-height: 42px!important;">
                    </a>
                </li>
                <li class="p-inline-list__item">
                    <a href="https://www.gi.de" target="_blank">
                        <img src="/assets/img/gi.svg" alt="IONOS Logo" height="42" style="vertical-align: middle; max-height: 42px!important;">
                    </a>
                </li>
            </ul>
                    <div class="row">
                        <div class="col-12">&nbsp;</div>
                    </div>
            <div class="has-cookie">
                <p>© <?=date("Y")?> Civic<b>soft</b>. Software für öffentliche Einrichtungen, Vereine und Privatpersonen.</p>
                <ul class="p-inline-list--middot">
                    <li class="p-inline-list__item">
                        <a href="#"><small>Impressum</small></a>
                    </li>
                    <li class="p-inline-list__item">
                        <a href="#"><small>Datenschutz</small></a>
                    </li>
                </ul>
            </div>
        </nav>
    </footer>
    <script src="/dist/app.js"></script>
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
    <script src="https://unpkg.com/@sidsbrmnn/scrollspy@1.x/dist/scrollspy.min.js"></script>
    <script>
        window.onload = function () {
            scrollSpy('#list', {
                sectionSelector: 'h2',
                activeClass: 'is-active',
                targetSelector: '.p-table-of-contents__link',
                offset: 50
            });
            let searchDocsReset = document.getElementById('search-docs-reset');
            let searchBox = document.getElementById('search-input');

            if (searchDocsReset) {
                searchDocsReset.addEventListener('click', function (e) {
                    searchBox.value = '';
                    searchBox.focus();
                    e.preventDefault();
                });
            }

            function toggleDropdown(toggle, open) {
                var parentElement = toggle.parentNode;
                var dropdown = document.getElementById(toggle.getAttribute('aria-controls'));
                dropdown.setAttribute('aria-hidden', !open);

                if (open) {
                    parentElement.classList.add('is-active');
                } else {
                    parentElement.classList.remove('is-active');
                }
            }

            function closeAllDropdowns(toggles) {
                toggles.forEach(function(toggle) {
                    toggleDropdown(toggle, false);
                });
            }

            function handleClickOutside(toggles, containerClass) {
                document.addEventListener('click', function(event) {
                    var target = event.target;

                    if (target.closest) {
                        if (!target.closest(containerClass)) {
                            closeAllDropdowns(toggles);
                        }
                    }
                });
            }

            function initNavDropdowns(containerClass) {
                var toggles = [].slice.call(document.querySelectorAll(containerClass + ' [aria-controls]'));

                handleClickOutside(toggles, containerClass);

                toggles.forEach(function(toggle) {
                    toggle.addEventListener('click', function(e) {
                        e.preventDefault();

                        const shouldOpen = !toggle.parentNode.classList.contains('is-active');
                        closeAllDropdowns(toggles);
                        toggleDropdown(toggle, shouldOpen);
                    });
                });
            }

            initNavDropdowns('.p-navigation__item--dropdown-toggle')
        }
    </script>
    </body>
</html>
