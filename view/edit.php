<?php 
if(isset($_GET['id']) == '') {
   header("location:main.php");
} 
?>

<?php include 'components/header.php'; ?>
<?php
include '../controller/productController.php';
include '../handle/Redirect.php';
$productController = new ProductController();


if(isset($_GET['id'])) {
    $edit_id = $_GET['id'];

    $product = $productController->edit($edit_id);

    // echo '<pre>';
    // echo var_dump($product);
    // echo '</pre>';


}


if(isset($_POST['update'])) {
    $id = $_POST['id'];
    $title = $_POST['product_title'];
    $price = $_POST['product_price'];
    $qty = $_POST['product_qty'];
 

    // two step 
    // 1 update new image 
    // 2 រក្សាទុក រូបចាស់នៅដដែល

    $image = $_POST['old_image'];

    // 1 update new image 
   if(!empty($_FILES['product_image']['name'])) {
    $file_image = $_FILES['product_image']['name'];
    $imageDir = $_FILES['product_image']['tmp_name'];

    // Step 2: Define the target folder where the image will be saved
    $targetFolder = "C:/xampp/htdocs/CRUD_MVC/public/image/";
    
    // Step 3: Define the full path (folder + image name)
    $targetFile = $targetFolder . basename($file_image);

    if (move_uploaded_file($imageDir, $targetFile)) {
        // 1 update new image 
        $image = $file_image;

        // 2 រក្សាទុក រូបចាស់នៅដដែល
        if (!empty($_POST['old_image'])) {
            $productController->deleteOldImage($_POST['old_image'], $targetFolder);
        }
    } else {
        $_SESSION['error'] = "Failed to upload new image.";
        Redirect('main.php');
        exit;
    }
       
    }

    if(empty($id) || empty($title) || empty($price) || empty($qty)) {
        $_SESSION['error'] = "Failed updated the product.";
    }else {
        
        $_SESSION['status'] = "Product updated successfully!";
        $productController->updateProduct($id , $title , $price , $qty , $image);
        Redirect('main.php');
       
     
    }

   
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
        <h2 class="text-center mb-4">Update Product</h2>
        <form action="" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id"  value="<?php echo $product['id']?>">

            <div class="mb-3">
                <label for="productTitle" class="form-label">Product Title</label>
                <input type="text" class="form-control" id="productTitle" name="product_title"
                       placeholder="Enter product title" 
                       value="<?php echo $product['title']?>" required>
            </div>

            <div class="mb-3">
                <label for="productPrice" class="form-label">Price</label>
                <input type="number" step="0.01" class="form-control" id="productPrice" name="product_price"
                       placeholder="Enter price"
                       value="<?php echo  $product['price']?>" >
            </div>

            <div class="mb-3">
                <label for="productQty" class="form-label">Quantity (Qty)</label>
                <input type="number" class="form-control" id="productQty" name="product_qty"
                       placeholder="Enter quantity"
                       value="<?php echo  $product['qty']?>" required>
            </div>

            <div class="mb-3">
                <label for="productImage" class="form-label">Product Image</label>
                <input type="file" class="form-control" id="productImage" name="product_image" accept="image/*">
                <img width="80px" src="../public/image/<?php echo $product['image'] ?>"  alt="">

                <input type="text" name="old_image" value="<?php echo $product['image'] ?>">
            </div>

            <button name="update" type="submit" class="btn btn-primary w-100">UPDATE</button>
        </form>
    </div>
</div>

<?php include 'components/footer.php'; ?>
