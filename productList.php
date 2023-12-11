<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Product List</title>
	<link crossorigin="anonymous" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css"
				integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" rel="stylesheet">
</head>
<body>

<?php
include './private/include/DataFunctions.php';

$dataConnection = new DataFunctions();

$dataConnection->list_product();

?>

<div class="container" style="padding: 20px;">
	<div class="row">
		<div class="col-md-8">
			<h2>Product List</h2>
		</div>
		<div class="col-md-4">
			<div class="button-box">
				<button type="submit" class="btn btn-success" style="margin-right: 20px;" id="add-product-btn"
								onclick="location.href('./add-product.php')"> ADD
				</button>
				<button type="deleteAll" class="btn btn-danger" id="#delete-product-btn" form="delete-form">
					MASS DELETE
				</button>
			</div>
		</div>
		<hr>
	</div>
	<form id="delete-form" method="post" action="productList.php">

		<div class="row">
			<?php foreach ($dataConnection->getProducts() as $product) { ?>
				<div class="col-md-2 product-grid border" style="margin: 10px; padding: 15px;">
					<input type="checkbox" name="delete-checkbox[]" class="delete-checkbox"
								 value=<?php echo $product->getSku() ?>/>
					<div class="product-box" style="text-align: center">
						<?php
						echo "<div> {$product->getSku()} </div>";
						echo "<div> {$product->getName()} </div>";
						echo "<div> {$product->getPrice()} $ </div>";
						echo "<div> {$product->getSpecsString()} </div>";
						?>
					</div>
				</div>
			<?php }; ?>
		</div>
</div>
</form>


<?php
if (isset($_POST['delete-checkbox'])) {
	$skuList = array();

	$i = 0;
	foreach ($_POST['delete-checkbox'] as $product_sku) {
		$skuList[$i] = substr($product_sku, 0, -1);
		$i++;
	}

	$dataConnection->delete_products($skuList);
	$_POST = array();
	$_POST['delete-checkbox'] = NULL;
	?>

	<script type="text/javascript"> location.href = "productList.php"; </script>

	<?php
}
?>

<?php include './public/assets/footer.html'; ?>
<script type="text/javascript">
	document.getElementById("add-product-btn").onclick = function () {
		location.href = "add-product.php";
	};
</script>
</body>
</html>
