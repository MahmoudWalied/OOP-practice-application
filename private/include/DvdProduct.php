<?php
/**
 * Created by PhpStorm.
 * User: MahmoudWalied
 * Date: 8/31/2021
 * Time: 8:26 PM
 */

include_once 'Product.php';

class DvdProduct extends Product
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
        $this->specs = "Size : {$values['size']} MB";
        return $this->specs;
    }

    public function getSpecsString()
    {
        return $this->specsValue;
    }
}