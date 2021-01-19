<!DOCTYPE html>
<html lang="en">
<?php
	include("core/config.php");
	include("include/header.php");
	$a = $_GET['a'];
	switch($a) {
		case "AddOrder": include("account/AddOrder.php"); break;
		case "AddProduct": include("account/AddProduct.php"); break;
		case "Category": include("account/Category.php"); break;
		case "Product": include("account/Product.php"); break;
		case "editProduct": include("account/EditProduct.php"); break;
		case "HisProduct": include("account/HisProduct.php"); break;
		case "OrderAll": include("account/OrderAll.php"); break;
		case "detailOrder": include("account/detailOrder.php"); break;
		case "ExportData": include("account/ExportData.php"); break;
		case "Summary": include("account/Summary.php"); break;
		break;
		default: include("account/main.php");
	}
	include("include/footer.php");
?>
</body>

</html>