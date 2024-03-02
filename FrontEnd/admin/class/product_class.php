<?php
    include "database.php";
?>

<?php

    Class product{
        private $db;
        private $link;
        public function __construct() {
            $this->db = new Database();
        }
        public function insert_product(){
            $product_name = $_POST['product_name'];
            $cartegory_id = $_POST['cartegory_id'];
            $brand_id = $_POST['brand_id'];
            $size_product = $_POST['size_product'];
            $product_price = $_POST['product_price'];
            $product_price_sale = $_POST['product_price_sale'];
            $product_desc = $_POST['product_desc'];
            $product_preservation = $_POST['product_preservation'];
            $product_detail = $_POST['product_detail'];
            $product_img = $_FILES['product_img']['name'];
            $filetarget = basename($_FILES['product_img']['name']);
            if(file_exists("uploads/$filetarget")){
                $alert = "File đã tồn tại";
                return $alert;
            }else{
            move_uploaded_file($_FILES['product_img']['tmp_name'],"uploads/".$_FILES['product_img']['name']);
            $query = "INSERT INTO tbl_product(
                product_name, 
                cartegory_id,
                brand_id,
                size_product,
                product_price,
                product_price_sale,
                product_desc,
                product_preservation,
                product_detail,
                product_img) 
                VALUES (
                    '$product_name',
                    '$cartegory_id',
                    '$brand_id',
                    '$size_product',
                    '$product_price',
                    '$product_price_sale',
                    '$product_desc',
                    '$product_preservation',
                    '$product_detail',
                    '$product_img')";
            $result = $this->db->insert($query);
            if($result){
                $query = "SELECT * FROM tbl_product ORDER BY product_id DESC LIMIT 1";
                $result = $this->db->select($query)->fetch_assoc();
                $product_id = $result['product_id'];
                $filename = $_FILES['product_img_desc']['name'];
                $filttmp = $_FILES['product_img_desc']['tmp_name'];
                foreach($filename as $key => $value){
                    move_uploaded_file($filttmp[$key],"uploads/".$value);
                    $query = "INSERT INTO tbl_product_img_desc (product_id,product_img_desc) VALUE('$product_id', '$value')";
                    $result =$this->db->insert($query);
                }
            }
        }
            header('Location:productlist.php');
           return $result;
        }
        public function show_cartegory(){
            $query = "SELECT * FROM tbl_cartegory ORDER BY cartegory_id DESC";
            $result =$this->db->select($query);
            return $result;
        }
        public function show_brand(){
            //$query = "SELECT * FROM tbl_brand ORDER BY brand_id DESC";
            $query = "SELECT tbl_brand.*, tbl_cartegory.cartegory_name
            FROM tbl_brand INNER JOIN tbl_cartegory ON tbl_brand.cartegory_id = tbl_cartegory.cartegory_id
            ORDER BY tbl_brand.brand_id DESC";
            $result =$this->db->select($query);
            return $result;
        }
        public function show_brand_ajax($cartegory_id){
            $query ="SELECT * FROM tbl_brand WHERE cartegory_id = '$cartegory_id'";
            $result = $this->db->select($query);
            return $result;
        }
        // public function show_product($product_id){
        //     //$query = "SELECT * FROM tbl_brand ORDER BY brand_id DESC";
        //     $query = "SELECT tbl_product.*, tbl_cartegory.cartegory_name, tbl_brand.brand_name,
        //     FROM tbl_brand INNER JOIN tbl_cartegory ON tbl_brand.cartegory_id = tbl_cartegory.cartegory_id
        //     ORDER BY tbl_brand.brand_id DESC";
        //     $result =$this->db->select($query);
        //     return $result;
        // }
        public function show_product($product_id){
            $query = "SELECT
                        tbl_product.product_id,
                        tbl_product.product_name,
                        tbl_product.product_price,
                        tbl_product.product_price_sale,
                        tbl_product.product_desc,
                        tbl_product.product_img,
                        tbl_product.size_product,
                        tbl_product.product_detail,
                        tbl_product.product_preservation,
                        tbl_cartegory.cartegory_name,
                        tbl_brand.brand_name
                      FROM tbl_product
                      INNER JOIN tbl_cartegory ON tbl_product.cartegory_id = tbl_cartegory.cartegory_id
                      INNER JOIN tbl_brand ON tbl_product.brand_id = tbl_brand.brand_id";
        
            // Thêm điều kiện WHERE nếu có product_id được truyền vào
            if ($product_id) {
                $query .= " WHERE tbl_product.product_id = $product_id";
            }
        
            $query .= " ORDER BY tbl_brand.brand_id DESC";
        
            $result = $this->db->select($query);
            return $result;
        }
        // public function update_brand($cartegory_id, $brand_name, $brand_id){
        //     $query ="UPDATE tbl_brand SET brand_name ='$brand_name', cartegory_id='$cartegory_id' WHERE brand_id ='$brand_id' ";
        //     $result = $this->db->update($query);
        //     header('Location:brandlist.php');
        //     return $result;
        // }
        
        public function update_product($product_id, $product_name, $cartegory_id, $brand_id, $product_price, $product_price_sale, $product_desc, $product_img, $size_product, $product_detail, $product_preservation) {
    // Escape các giá trị để tránh SQL injection
            $product_name = $this->db->escape($product_name);
            $product_desc = $this->db->escape($product_desc);
            $product_img = $this->db->escape($product_img);
            $size_product = $this->db->escape($size_product);
            $product_detail = $this->db->escape($product_detail);
            $product_preservation = $this->db->escape($product_preservation);

             $query = "UPDATE tbl_product
                SET product_name = '$product_name',
                    cartegory_id = '$cartegory_id',
                    brand_id = '$brand_id',
                    product_price = '$product_price',
                    product_price_sale = '$product_price_sale',
                    product_desc = '$product_desc',
                    product_img = '$product_img',
                    size_product = '$size_product',
                    product_detail = '$product_detail',
                    product_preservation = '$product_preservation'
                WHERE product_id = '$product_id'";

        $result = $this->db->update($query);

    // Kiểm tra xem cập nhật có thành công không trước khi chuyển hướng
    if ($result) {
        header('Location: productlist.php');
    } else {
        echo "Cập nhật không thành công.";
    }

    return $result;
}  
        public function get_product_by_id($product_id) {
            $query = "SELECT * FROM tbl_product WHERE product_id = '$product_id'";
            $result = $this->db->select($query);
            return $result->fetch_assoc(); // Trả về một mảng chứa thông tin sản phẩm
        }
        public function get_product($product_id){
            $query ="SELECT * FROM tbl_product WHERE product_id = '$product_id'";
            $result = $this->db->select($query);
            return $result;
        }
        public function delete_product($product_id){
            $query ="DELETE FROM tbl_product WHERE product_id ='$product_id' ";
            $result = $this->db->delete($query);
            header('Location:productlist.php');
            return $result;
        }
    }