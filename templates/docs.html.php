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

                <form action="https://www.paypal.com/donate" method="post" target="_top" style="margin-top: 48px; margin-bottom: 48px">
                    <input type="hidden" name="hosted_button_id" value="KECGFRKZM9WTE" />
                    <input type="image" src="https://www.paypalobjects.com/de_DE/DE/i/btn/btn_donate_LG.gif" border="0" name="submit" title="PayPal - The safer, easier way to pay online!" alt="Spenden mit dem PayPal-Button" />
                    <img alt="" border="0" src="https://www.paypal.com/de_DE/i/scr/pixel.gif" width="1" height="1" />
                </form>


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
        <!--<div class="col-12">
            <div class="p-section--shallow">
                <h3>BVG</h3>
                <h5>Abfahrten Mosischstr.</h5>
                <?php /*foreach ($timetable['departures'] ?? [] as $trip): */?>
                    <div class="row--25-75">
                        <div><?php /*=$trip['line']['productName']*/?> <?php /*=$trip['line']['id']*/?> nach <b><?php /*=$trip['direction']*/?></b></div>
                        <div>
                            geplante Abfahrt: <?php /*= date("H:i",strtotime('+2 hours',strtotime($trip['plannedWhen']))) */?> Uhr<br>
                            Aktuelle Abfahrtszeit: <?php /*= date("H:i",strtotime('+2 hours',strtotime($trip['when']))) */?> Uhr<br>
                            <?php /*if($trip['delay'] > 0) : */?>
                            (<?php /*= $trip['delay']/60 */?> Minuten später)
                            <?php /*else: */?>
                                (<?php /*= $trip['delay']/60 */?> Minuten früher)
                            <?php /*endif; */?>
                            <br>

                        </div>
                    </div>
                <?php /*endforeach; */?>
            </div>
        </div>-->
        <div class="col scrollspy" data-spy="scroll" data-target="#list" data-offset="0">
            <?=$html?>
        </div>
    </div>
</section>

</main>