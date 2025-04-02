<?php
include '../model/products.php';

class ProductController
{

    public $id;
    public $title;
    public $price;
    public $qty;

    public function store($title, $price, $qty ,$image)
    {
        $product = new Products();

        $product->title = $title;
        $product->price = $price;
        $product->qty = $qty;
        $product->image = $image;
        // Works because $product->title, $product->price, and $product->qty are already set
        $result = $product->saveProduct();

        return $result;
    }


    public function getAllProducts()
    {
        $products = new Products();
        $Products =  $products->AllProducts();

        return $Products;
    }


    public function getdeleteProduct($id)
    {
        $products = new Products();
        $row = $products->selectProductById($id); // Now calling the correct method to fetch by ID
        
        if ($row) {
            $image = $row['image'];
            $imageDir = "C:/xampp/htdocs/CRUD_MVC/public/image/" . $image;
    
            if (file_exists($imageDir)) {
                unlink($imageDir); // Delete the image
            }
    
            $deleteProduct = $products->deleteProducts($id); // Delete the product
    
            return $deleteProduct;
        } else {
            return false; // If the product wasn't found
        }
    }
    


    public function edit($id)
    {
        $products = new Products();
        return $products->selectProductById($id);
    }


    public function updateProduct($id , $title  , $price , $qty , $image) {
        $product = new Products();
        $product->title = $title;
        $product->price = $price;
        $product->qty = $qty;
        $product->image = $image;
        $product->setId($id);
        $product->update();

    }
    public function deleteOldImage($oldImage, $targetFolder) {
        if (file_exists($targetFolder . $oldImage) && $oldImage !== '') {
            // Delete the old image
            unlink($targetFolder . $oldImage);
        }
    }

    public function searchProduct($search) {
        $product = new Products();
        return $product->search($search);
    }
}
