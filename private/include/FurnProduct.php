<?php
/**
 * Created by PhpStorm.
 * User: MahmoudWalied
 * Date: 8/31/2021
 * Time: 8:27 PM
 */

include_once 'Product.php';

class FurnProduct extends Product
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
        $this->specs = "Dimension : {$values['height']}x{$values['width']}x{$values['length']}";
        return $this->specs;
    }

    public function getSpecsString()
    {
        return $this->specsValue;
    }
}