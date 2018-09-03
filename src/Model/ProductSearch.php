<?php
/**
 * Created by PhpStorm.
 * User: arefr
 * Date: 9/2/2018
 * Time: 4:21 PM
 */

namespace App\Model;



class ProductSearch
{

    protected $title;

    protected  $description;

    protected $color;

    protected  $minPrice;

    protected  $maxPrice;

    protected $maxPerPage = 5;

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }
    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(string $color): self
    {
        $this->color = $color;

        return $this;
    }

    public function getMinPrice()
    {
        return $this->minPrice;
    }

    public function setMinPrice($price): self
    {
        $this->minPrice = $price;

        return $this;
    }

    public function getMaxPrice()
    {
        return $this->maxPrice;
    }

    public function setMaxPrice($price): self
    {
        $this->maxPrice = $price;

        return $this;
    }


    public function getMaxPerPage()
    {
        return $this->maxPerPage;
    }

    public function setMaxPerPage($price): self
    {
        $this->maxPerPage = $price;

        return $this;
    }


}