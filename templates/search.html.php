<?php


?>

<div class="l-docs__title" id="main-content">
    <div class="p-section--shallow">
        <div class="row">
            <div class="col-12">
                <h1>Suchergebnisse</h1>
            </div>
        </div>
    </div>
</div>

<div class="l-docs__meta">
    <div class="l-docs__sticky-container">
        <aside class="p-table-of-contents">
            <div class="p-table-of-contents__section p-strip is-shallow">
                <h2 class="p-table-of-contents__header">Auf dieser Seite</h2>
                <nav class="p-table-of-contents__nav" aria-label="Table of contents">
                    <ul class="p-table-of-contents__list" id="list">
                        <li class="p-table-of-contents__item"><a class="p-table-of-contents__link" href="#result">Suchergebnisse</a></li>
                    </ul>
                </nav>
            </div>
        </aside>
    </div>
</div>

<main>
    <section class="p-section">
        <div class="row">
            <div class="col scrollspy" data-spy="scroll" data-target="#list" data-offset="0">
                <ul id="result" class="p-list--divided">
                    <?php

                    if(isset($result) and $result != null) {
                        asort($result);
                        foreach ($result as $zaehler => $element) {
                            $element = str_replace("\\", '/', $element);

                            $fileParts = explode("/",$element);

                            $fileName = getName(array_pop($fileParts));

                            $sectionName = array_pop($fileParts);
                            $sectionNameParts = explode("_",$sectionName);
                            $newSectionNameParts = array();
                            foreach ($sectionNameParts as $part) {
                                if(strlen($part) <= 5) {
                                    $newSectionNameParts[] = strtoupper($part);
                                } else {
                                    $newSectionNameParts[] = ucfirst($part);
                                }
                            }
                            $sectionName = implode(' ',$newSectionNameParts);

                            $element = str_replace("/", '-', $element);
                            $element = substr($element,2);
                            ?>
                            <li class="p-list__item">
                                <div class="row--25-75">
                                    <div class="col"><b><?=$sectionName?></b></div>
                                    <div class="col"><a href="/?page=<?=$element?>"><?=$fileName?></a></div>
                                </div>
                            </li>
                    <?php
                        }
                    }
                    ?>
                </ul>
            </div>
        </div>
    </section>
</main>