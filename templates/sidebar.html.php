<?php

/**
 * @var SidebarMenu $sidebar;
 * @var MenuItem $item;
 * @var array $sidebars;
 */

use TreptowKolleg\Api\Menu\MenuItem;
use TreptowKolleg\Api\Menu\SidebarMenu;

?>

<ul class="p-side-navigation__list">
    <?php foreach ($sidebars as $sidebar): ?>
        <?php if ($sidebar instanceof SidebarMenu): ?>
            <li class="p-side-navigation__item">
                <button class="p-side-navigation__accordion-button" aria-expanded="false"><?=$sidebar->getTitle()?></button>
                <ul class="p-side-navigation__list" aria-expanded="false">
                    <?php foreach ($sidebar->getMenuItems() as $item): ?>
                    <li class="p-side-navigation__item">
                        <a class="p-side-navigation__link" href="<?=$item->getUrl()?>"  <?=$item->isCurrent()?>><?=$item->getTitle()?></a>
                    </li>
                    <?php endforeach;?>
                </ul>
            </li>
        <?php endif;?>
    <?php endforeach;?>
</ul>