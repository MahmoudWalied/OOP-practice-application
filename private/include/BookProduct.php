<?php
/**
 * Created by PhpStorm.
 * User: MahmoudWalied
 * Date: 8/31/2021
 * Time: 8:26 PM
 */

include_once 'Product.php';

class BookProduct extends Product
{
    private $specs;
    private $specsValue;

    public function __construct($sku, $name, $price, $type, $specsValue)
    {
        parent::__construct($sku, $name, $price, $type);
        $this->specsValue = $specsValue;
    }

    public function getSpecs($values)
    {
        $this->specs = "Weight : {$values['weight']} KG";
        return $this->specs;
    }

    public function getSpecsString()
    {
        return $this->specsValue;
    }
}