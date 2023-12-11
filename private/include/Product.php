<?php
/**
 * Created by PhpStorm.
 * User: MahmoudWalied
 * Date: 8/31/2021
 * Time: 8:21 PM
 */

abstract class Product
{
    private $sku;
    private $name;
    private $price;
    private $type;


    /**
     * Product constructor.
     * @param $sku
     * @param $name
     * @param $price
     * @param $type
     */
    public function __construct($sku, $name, $price, $type)
    {
        $this->sku = $sku;
        $this->name = $name;
        $this->price = $price;
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getSku()
    {
        return $this->sku;
    }

    /**
     * @param mixed $sku
     */
    public function setSku($sku): void
    {
        $this->sku = $sku;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price): void
    {
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type): void
    {
        $this->type = $type;
    }

    /**
     * @param array $specArr
     * @return mixed
     */
    abstract public function getSpecs(array $specArr);

    /**
     * @return mixed
     */
    abstract public function getSpecsString();


}