<?php
/**
 * Created by PhpStorm.
 * User: MahmoudWalied
 * Date: 9/27/2021
 * Time: 4:43 PM
 */

include_once 'DbConnect.php';
include_once 'Product.php';
include_once 'BookProduct.php';
include_once 'DvdProduct.php';
include_once 'FurnProduct.php';

class DataFunctions
{
    private $pdo = NULL;
    private $products = array();
    protected $prodType = [
        'book' => 'BookProduct',
        'dvd' => 'DvdProduct',
        'furniture' => 'FurnProduct'
    ];


    public function __construct()
    {
        $pdo = new DbConnect();
        $this->pdo = $pdo->getConnection();
    }

    public function add_product($values)
    {
        $specsArr = [
            'size' => $values['size'],
            'weight' => $values['weight'],
            'height' => $values['height'],
            'length' => $values['length'],
            'width' => $values['width'],
        ];

        if (!array_key_exists($values['type'], $this->prodType)) {
            throw new \RuntimeException('Incorrect productType productType');
        }
        $className = $this->prodType[$values['type']];

        $classObj = new $className($values['sku'], $values['name'], $values['price'], $values['type'], '');

        $specsValue = $classObj->getSpecs($specsArr);

        $insertedValues = [
            'sku' => $values['sku'],
            'name' => $values['name'],
            'price' => $values['price'],
            'productType' => $values['type'],
            'specs' => $specsValue,
        ];

        $sql = "INSERT INTO products (product_sku, product_name, product_price, product_type, product_specs)
                VALUES (:sku,:name,:price,:productType,:specs)";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($insertedValues);
    }

    public function list_product()
    {
        if ($this->pdo) {
            $data = $this->pdo->query("SELECT * FROM products")->fetchAll();
            foreach ($data as $row) {
                $productType = $row['product_type'];
                if (!array_key_exists($productType, $this->prodType)) {
                    throw new \RuntimeException('Incorrect productType productType');
                }
                $className = $this->prodType[$productType];
                $this->products[] = new $className ($row['product_sku'], $row['product_name'], $row['product_price'],
                    $productType, $row['product_specs']);
            }
        }
    }

    public function getProducts()
    {
        return $this->products;
    }

    public function checkSKUValid($sku)
    {
        try {
            $data = $this->pdo->query("SELECT * FROM products WHERE product_sku = $sku")->fetch();
            return false;
        } catch (PDOException $e) {
            return true;
        }
    }

    public function delete_products($skuList)
    {
        foreach ($skuList as $sku) {
            $sql = "DELETE FROM products WHERE product_sku = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(1, $sku);
            $stmt->execute();
        }

        $this->list_product();
    }

}