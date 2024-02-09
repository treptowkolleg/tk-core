<?php

namespace TreptowKolleg\Api\Menu;

abstract class Menu
{

    private string $title;
    private array $menuItems = [];

    /**
     * @param string $title
     * @param array $menuItems
     */
    public function __construct(string $title, array $menuItems = [])
    {
        $this->title = $title;

        foreach ($menuItems as $element) {
            $this->addMenuItem($element);
        }
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    public function addMenuItem(MenuItem $item): Menu
    {
        $this->menuItems[$item->getKey()] = $item;
        return $this;
    }

    /**
     * @return array
     */
    public function getMenuItems(): array
    {
        return $this->menuItems;
    }

    public function getMenuItem(string $key): string
    {
        return $this->menuItems[array_search($key,$this->menuItems)];
    }

}