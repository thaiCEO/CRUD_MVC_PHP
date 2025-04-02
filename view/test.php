<?php

include '../model/products.php';

try {
    $products = new Products();
    $products->title = 'iphone 15 Pro max';
    $products->price = 2200 ;
    $products->qty = 10;

    $result = $products->saveProduct();  // Attempt to save product

    if ($result) {
        echo 'Product added successfully.';
    }
}catch(Exception $e) {
    echo "Error :".$e->getMessage();
}





?>