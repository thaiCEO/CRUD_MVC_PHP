<?php

include '../database/config.php';

class Products
{
    private $id;
    public $title;
    public $price;
    public $qty;
    public $image;
    public $conn;


    public function setId($id)
    {
        $this->id = $id;
    }

    public function __construct()
    {

        $db = new Database();
        $this->conn = $db->connect();  // Initialize the connection
    }

    public function saveProduct()
    {

        // Use the object properties directly
        $title = mysqli_real_escape_string($this->conn, $this->title);
        $price = mysqli_real_escape_string($this->conn, $this->price);
        $qty = mysqli_real_escape_string($this->conn, $this->qty);
        $image = mysqli_real_escape_string($this->conn, $this->image);
      

        $sql = "INSERT INTO `products` (title, price, qty, image) 
                VALUES ('$title', '$price', '$qty', '$image')";


        $result = mysqli_query($this->conn, $sql);

        if ($result) {
            return true;
            echo "Product saved successfully!";
        } else {
            throw new mysqli_sql_exception(mysqli_error($this->conn));
        }
    }




    public function AllProducts()
    {
        $sql = "SELECT * FROM products ";
        $result = mysqli_query($this->conn, $sql);

        $Products = [];

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $Products[] = $row;
            }
        }
        return $Products;
    }




    public function deleteProducts($id)
    {

        $id = intval($id);
        $sql = "DELETE FROM `products` WHERE `id` = $id";

        $result = mysqli_query($this->conn, $sql);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }




    public function selectProductById($id)
    {
        // Fetch the product data by id
        $sql = "SELECT * FROM products WHERE id = $id LIMIT 1";
        $result = mysqli_query($this->conn, $sql);
        return mysqli_fetch_assoc($result);
    }


    public function update()
    {
        $sql = "UPDATE `products` SET `title`='{$this->title}',`price`='{$this->price}',`qty`='{$this->qty}', `image` = '{$this->image}' WHERE id = $this->id";

        $result = mysqli_query($this->conn, $sql);

        return $result;
    }


    public function search($search) {
    

        $sql = "SELECT * FROM products WHERE title LIKE '%$search%'";
        $result = mysqli_query($this->conn, $sql);

        return $result;
    }
    
}
