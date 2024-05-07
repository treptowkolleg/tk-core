<?php
/**
 * @var ParsedownExtra $mdParser
 * @var null|string $md
 */

use voku\helper\HtmlDomParser;


$content = $md ? $mdParser->text($md) : '';
$html = HtmlDomParser::str_get_html($content);
$links = [];
$first = true;
$heading = '';

foreach ($html->find('h1') as $e) {
    $heading = $e->text;
    $e->outerhtml = '';
    break;
}

?>

<div class="l-docs__title" id="main-content">
    <div class="p-section--shallow">
        <div class="row">
            <div class="col-12">
                <h1><?=$heading?></h1>
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
                        <?php foreach ($html->find('h2') as $e): ?>
                            <?php $id = strtolower(str_replace(' ','-',lcfirst($e->text))) ?>
                            <?php $id = strtolower(str_replace('Ü','ü',$id)) ?>
                            <?php $id = strtolower(str_replace('Ö','ö',$id)) ?>
                            <?php $id = strtolower(str_replace('Ä','ä',$id)) ?>
                                <li class="p-table-of-contents__item"><a class="p-table-of-contents__link <?= $first ? 'is-active' : ''?>" href="#<?=$id?>"><?=$e->text?></a></li>
                        <?php $first = false; ?>
                        <?php endforeach;?>

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
            <?=$html?>
        </div>
    </div>
</section>

</main>