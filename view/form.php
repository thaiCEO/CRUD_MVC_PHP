<?php include 'components/header.php'; ?>
<?php
include '../controller/productController.php';
$productController = new ProductController();

// Handle form submission for adding products
if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['submit'])) {
    $title = $_POST['product_title'];
    $price = $_POST['product_price'];
    $qty = $_POST['product_qty'];


     // Step 1: Get the file name and temp directory
    $image = $_FILES['product_image']['name'];
    $imageDir = $_FILES['product_image']['tmp_name'];

    // Step 2: Define the target folder where the image will be saved
    $targetFolder = "C:/xampp/htdocs/CRUD_MVC/public/image/";
    
    // Step 3: Define the full path (folder + image name)
    $targetFile = $targetFolder . basename($image);

    // Step 4:You can then move the uploaded file
    if (move_uploaded_file($imageDir, $targetFile)) {
        echo "Image uploaded successfully!";
    } else {
        echo "Failed to upload the image.";
    }

//  echo "<pre>";
//     var_dump($_FILES['product_image']);
//     echo "</pre>";
//     exit;








    // Validate input fields
    if (empty($title) || empty($price) || empty($qty)) {
        $_SESSION['error'] = 'Please fill in all fields.';
    } else {
        // Add a new product
        $addSuccess = $productController->store($title, $price, $qty,$image);
        if ($addSuccess) {
            $_SESSION['status'] = "Product added successfully!";
        } else {
            $_SESSION['error'] = "Failed to add the product.";
        }
    }

    header('location: main.php');
    exit();
}


?>

<div class="d-flex justify-content-end m-lg-4  position-sticky top-50">
    <button class="btn btn-outline-primary">
        <a class="text-decoration-none" href="main.php">View Table</a>
    </button>
</div>

<!-- Centered Form -->
<div class="form-container">
    <div class="card p-4 shadow-lg" style="width: 100%; max-width: 500px;">
        <!-- Invalid alert -->
        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Warning! </strong><?php echo $_SESSION['error']; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php unset($_SESSION['error']); endif; ?>

        <!-- Success alert -->
        <?php if (isset($_SESSION['status'])): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success! </strong><?php echo $_SESSION['status']; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php unset($_SESSION['status']); endif; ?>

        <!-- Add Product Form -->
        <h2 class="text-center mb-4">Add Product</h2>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="productTitle" class="form-label">Product Title</label>
                <input type="text" class="form-control" id="productTitle" name="product_title"
                       placeholder="Enter product title" required>
            </div>

            <div class="mb-3">
                <label for="productPrice" class="form-label">Price</label>
                <input type="number" step="0.01" class="form-control" id="productPrice" name="product_price"
                       placeholder="Enter price" required>
            </div>

            <div class="mb-3">
                <label for="productQty" class="form-label">Quantity (Qty)</label>
                <input type="number" class="form-control" id="productQty" name="product_qty"
                       placeholder="Enter quantity" required>
            </div>

            <div class="mb-3">
                <label for="productImage" class="form-label">Product Image</label>
                <input type="file" class="form-control" id="productImage" name="product_image" accept="image/*">
            </div>

            <button name="submit" type="submit" class="btn btn-primary w-100">Submit</button>
        </form>
    </div>
</div>

<?php include 'components/footer.php'; ?>
