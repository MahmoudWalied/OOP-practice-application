<?php
/**
 * Created by PhpStorm.
 * User: MahmoudWalied
 * Date: 9/3/2021
 * Time: 4:44 PM
 */

$request = $_SERVER['REQUEST_URI'];

switch ($request) {
	case '/' :
		header('Location: productList.php');
		break;
	case '' :
		header('Location: productList.php');
		break;
	case '/add-product' :
		header('Location: add-product.php');
		break;
	default:
		header('Location: productList.php');
		break;
}

