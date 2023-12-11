<?php
include './private/include/DataFunctions.php';

$dataConnection = new DataFunctions();

// Define variables and initialize with empty values

$sku = $name = $productType = $uniqueSku = "";
$price = $size = $weight = $height = $width = $length = 0;

$error = array(
    'sku' => '',
    'name' => '',
    'price' => '',
    'type' => '',
    'size' => '',
    'weight' => '',
    'width' => '',
    'length' => '',
    'height' => '',

);

if (isset($_POST['submit'])) {

    if (empty($_POST['sku'])) {
        $error['sku'] = 'A SKU is required. <br />';
    } else {
        $sku = $_POST['sku'];
        if (strlen($sku) < 9) {
            $error['sku'] = 'SKU must be only of small characters and numbers and of length equals to 9.<br />';
        } else {
            if (!$dataConnection->checkSKUValid($sku)) {
                $error['sku'] = 'SKU must be unique <br />';
                $uniqueSku = '*Try another SKU please*<br/>';
            }
        }
    }

    if (empty($_POST['name'])) {
        $error['name'] = 'A name is required <br />';
    } else {
        $name = $_POST['name'];
        if (strlen($name) < 1) {
            $error['name'] = 'Name must be only  letters and of length greater than 1<br />';
        }
    }

    if (empty($_POST['price'])) {
        $error['price'] = 'Price is required <br />';
    } else {
        $price = $_POST['price'];
        if (!is_numeric($price) || $price <= 0) {
            $error['price'] = 'Price must be a number greater than 0.<br />';
        }
    }

    if (empty($_POST['productType'])) {
        $error['type'] = 'Type is required <br />';
    } else {
        $productType = $_POST['productType'];
        if ($productType === 'book') {
            if (empty($_POST['weight'])) {
                $error['weight'] = 'Weight is required <br />';
            } else {
                $weight = $_POST['weight'];
                if (!is_numeric($weight) || $weight <= 0) {
                    $error['weight'] = 'Weight must be a number greater than 0.<br />';
                }
            }
        } elseif ($productType === 'dvd') {
            if (empty($_POST['size'])) {
                $error['size'] = 'Size is required <br />';
            } else {
                $size = $_POST['size'];
                if (!is_numeric($size) || $size <= 0) {
                    $error['size'] = 'Size must be a number greater than 0.<br />';
                }
            }
        } elseif ($productType === 'furniture') {
            if (empty($_POST['length'])) {
                $error['length'] = 'Length is required <br />';
            } else {
                $length = $_POST['length'];
                if (!is_numeric($length) || $length <= 0) {
                    $error['length'] = 'Length must be a number greater than 0.<br />';
                }
            }

            if (empty($_POST['width'])) {
                $error['width'] = 'Width is required <br />';
            } else {
                $width = $_POST['width'];
                if (!is_numeric($width) || $width <= 0) {
                    $error['width'] = 'Width must be a number greater than 0.<br />';
                }
            }

            if (empty($_POST['height'])) {
                $error['height'] = 'Height is required <br />';
            } else {
                $height = $_POST['height'];
                if (!is_numeric($height) || $height <= 0) {
                    $error['height'] = 'Height must be a number greater than 0.<br />';
                }
            }
        } else {
            $error['type'] = 'Type must be (dvd, book, furniture).<br />';
        }
    }

}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Product Add</title>
    <link crossorigin="anonymous" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css"
          integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" rel="stylesheet">
    <link href="./public/assets/style.css" rel="stylesheet">

    <script type="text/javascript">
        function skuGenerate() {
            document.getElementById("sku").defaultValue = Math.random().toString(36).substr(2, 9);
        };
    </script>
</head>
<body onload=skuGenerate()>
<form id="product_form" name="#product_form" method="post" action="#">
    <!-- HEADER -->
    <div class="container" style="padding:20px">
        <div class="row">
            <div class="col-md-8">
                <h2>Product Add</h2>
            </div>
            <div class="col-md-4">
                <div class="button-box">
                    <button type="submit" name="submit" class="btn btn-success" style="margin-right: 20px;"
                            id="save-btn" value="submit"> Save
                    </button>
                    <button type="button" class="btn btn-danger" id="cancel-btn"
                            onclick="location.replace('./productList.php')"> Cancel
                    </button>
                </div>
            </div>
            <hr>
        </div>

        <div class="form-group">
            <label for="sku" class="form-label">SKU :</label>
            <input type="text" name="sku" id="sku" class="form-control"
                   value="<?php if (!empty($sku)) echo htmlspecialchars($sku); ?>">
            <p><?php if (empty($uniqueSku)) {
                    echo "* This is a unique SKU *";
                } else {
                    echo $uniqueSku;
                } ?></p>
            <div class="red-text"> <?php echo $error['sku']; ?></div>
        </div>

        <div class="form-group">
            <label for="name">Name :</label>
            <input type="text" name="name" id="name" class="form-control" placeholder="#Name" required
                   value="<?php echo htmlspecialchars($name); ?>">
            <div class="red-text"> <?php echo $error['name']; ?></div>
        </div>

        <div class="form-group">
            <label for="price">Price :</label>
            <input type="number" name="price" id="price" class="form-control" placeholder="#Price" required
                   value="<?php echo htmlspecialchars($price); ?>">
            <div class="red-text"> <?php echo $error['price']; ?></div>
        </div>
        <div class="dropdown" style="padding: 15px">
            <div class="menu">
                <label for="productType">Type Switcher</label>
                <select id="productType" name="productType">
                    <option value="dvd" <?php if ($productType === "dvd") echo "selected"; ?>>DVD</option>
                    <option value="furniture" <?php if ($productType === "furniture") echo "selected"; ?>>Furniture
                    </option>
                    <option value="book" <?php if ($productType === "book") echo "selected"; ?>>Book</option>
                </select>
            </div>


            <div class="content" style="padding: 15px">

                <div id="dvd" class="data form-group">
                    <label for="size">Size(MB)</label>
                    <input type="number" name="size" id="size" class="form-control"
                           value="<?php echo htmlspecialchars($size); ?>">
                    <p>* Please provide Size in MB</p>
                    <div class="red-text"> <?php echo $error['size']; ?></div>

                </div>
                <div id="furniture" class="data form-group">
                    <div>
                        <label for="height">Height(CM)</label>
                        <input type="number" name="height" id="height" class="form-control"
                               value="<?php echo htmlspecialchars($height); ?>">
                        <div class="red-text"> <?php echo $error['height']; ?></div>

                    </div>
                    <div>
                        <label for="width">Width(CM)</label>
                        <input type="number" name="width" id="width" class="form-control"
                               value="<?php echo htmlspecialchars($width); ?>">
                        <div class="red-text"> <?php echo $error['width']; ?></div>

                    </div>

                    <div>
                        <label for="length">Length(CM)</label>
                        <input type="number" name="length" id="length" class="form-control"
                               value="<?php echo htmlspecialchars($length); ?>">
                        <div class="red-text"> <?php echo $error['length']; ?></div>

                    </div>
                    <p>* Please provide dimensions in HxWxL format</p>

                </div>
                <div id="book" class="data form-group">
                    <label for="weight">Weight(KG)</label>
                    <input type="number" name="weight" id="weight" class="form-control"
                           value="<?php echo htmlspecialchars($weight); ?>">
                    <p>* Please provide Weight in KG</p>
                    <div class="red-text"> <?php echo $error['weight']; ?></div>

                </div>
            </div>
            <hr>
        </div>
    </div>
</form>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script>
    $(document).ready(function () {
        $("#productType").on('change', function () {
            $(".data").hide();
            $("#" + $(this).val()).fadeIn(300);
        }).change();
    });
</script>

<!-- FOOTER -->
<?php include './public/assets/footer.html'; ?>

<?php
$dataConnection = new DataFunctions();


if (!array_filter($error) && !empty($productType)) {
    $values = [
        'sku' => $sku,
        'name' => $name,
        'price' => $price,
        'type' => $productType,
        'size' => $size,
        'weight' => $weight,
        'height' => $height,
        'length' => $length,
        'width' => $width,

    ];


    $dataConnection->add_product($values);
    ?>
    <script type="text/javascript">
        location.href = "productList.php";
    </script>
    <?php
}

?>

</body>
</html>
