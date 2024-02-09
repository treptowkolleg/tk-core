<?php

namespace TreptowKolleg\Api\Menu;

class MenuItem
{

    private string $title;
    private string $key;
    private string $filePath;
    private array $children;
    private bool $isCurrent = false;

    /**
     * @param string $title
     * @param string $filePath
     * @param string $page
     * @param array $children
     */
    public function __construct(string $title, string $filePath, string $page = '', array $children = [])
    {
        $this->title = $title;
        $this->filePath = "./templates/$filePath.php";
        $this->key = $page;
        foreach ($children as $child) {
            $this->addChild($child);
        }
    }


    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getKey(): string
    {
        return $this->key;
    }

    /**
     * @param string $key
     */
    public function setKey(string $key): void
    {
        $this->key = $key;
    }

    public function getUrl(): string
    {
        return "?page={$this->key}";
    }

    /**
     * @return string
     */
    public function getTemplate(): string
    {
        return $this->filePath;
    }

    /**
     * @return array
     */
    public function getChildren(): array
    {
        return $this->children;
    }

    /**
     * @param array $children
     */
    public function setChildren(array $children): void
    {
        $this->children = $children;
    }

    public function addChild(MenuItem $child): MenuItem
    {
        $this->children[$child->getKey()] = $child;
        return $this;
    }

    public function setCurrent(bool $state): void
    {
        $this->isCurrent = $state;
    }

    public function isCurrent(): string
    {
        return $this->isCurrent ? 'aria-current="page"' : '';
    }

}
