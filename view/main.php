<?php
include 'components/header.php';
include '../controller/productController.php';
include '../handle/Redirect.php';
include '../handle/modal.php';

$showProduct = new ProductController();
$Products = $showProduct->getAllProducts();

if (isset($_POST['deleteProduct'])) {
    $delete_from_id = $_POST['deleteproductid'];

    $deleteSuccess = $showProduct->getdeleteProduct($delete_from_id);
    if ($deleteSuccess) {
        $_SESSION['status'] = "Product deleted successfully!";
        Redirect('main.php');
    } else {
        echo "Failed to delete the product.";
    }
}

if (isset($_GET['btn_search'])) {
    $search = $_GET['search'];
    $Products = $showProduct->searchProduct($search);

    // Display the results
    if ($Products) {
        while ($Product = mysqli_fetch_assoc($Products)) {
        }
    } else {
        echo "No results found.";
    }
}

?>

<!-- this is a alert success or wrong start -->

<?php if (isset($_SESSION['status'])): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Product: </strong><?php echo $_SESSION['status']; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php
    unset($_SESSION['status']); // Clear the success message after displaying it
endif;
?>
<!-- this is a alert end -->




<!--alert modal-->

<?php alertdelete() ?>

<!--alert modal-->


<!-- Search Bar Form -->
<div class="searchbar">
    <form method="GET">
        <input type="text" name="search" placeholder="Search...." required>
        <button type="submit" name="btn_search">Search</button>
    </form>
</div>
<!-- Search Bar Form -->



<div class="d-flex justify-content-end m-lg-4">
    <button class="btn btn-outline-primary ">
        <a class="text-decoration-none" href="form.php">View form</a>
    </button>
</div>

<div class="container mt-5">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Image</th>
                <th scope="col">Product title</th>
                <th scope="col">Price</th>
                <th scope="col">Qty</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($Products as $Product) : ?>
                <tr>
                    <th scope="row"><?php echo $Product['id'] ?></th>
                    <th><img style="width: 80px; height: 80px;" src="../public/image/<?php echo $Product['image'] ?>" alt="image"></th>
                    <td><?php echo $Product['title'] ?></td>
                    <td><?php echo $Product['price'] ?></td>
                    <td><?php echo $Product['qty'] ?></td>
                    <td>
                        <!-- Delete Button with Modal Trigger -->
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteproduct" onclick="deletealert(<?php echo $Product['id']; ?>)">Delete</button>

                        <!-- Edit Button -->
                        <a href="edit.php?id=<?php echo $Product['id']; ?>"><button type="button" class="btn btn-success" name="edit_id">Edit</button></a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include 'components/footer.php'; ?>