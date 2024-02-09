<?php
/**
 * @var ParsedownExtra $mdParser
 * @var null|string $md
 */
?>




<main>

<section class="p-section">
    <div class="row">
        <div class="col">
            <?php if($md) echo $mdParser->text($md) ?>
        </div>
    </div>
</section>

</main>