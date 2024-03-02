<?php
    include "header.php";
    include "slider.php";
    include "class/product_class.php";
?>
<?php
    $product = new product;
    $product_id = 0;
    $show_product = $product->show_product($product_id);
?>
<div class="admin-content-right">
    <div class="admin-content-right-product-list">
        <h1>Danh Sách Sản Phẩm</h1>
        <table>
            <tr>
                <th>STT</th>
                <th>ID</th>
                <th>Tên Sản Phẩm</th>
                <th>Tên Danh Mục</th>
                <th>Tên Sản Phẩm</th>
                <th>Giá Sản Phẩm</th>
                <th>Giá Khuyến Mãi</th>
                <th>Mô Tả</th>
                <th>Chi tiết</th>
                <th>Bảo Quản</th>
                <th>Size</th>
                <th>Ảnh Sản Phẩm</th>
                <th>Tùy Biến</th>
            </tr>
            <?php
                if($show_product){$i=0;
                    while($result=$show_product->fetch_assoc()){
                    $i++;
            ?>
            <tr>
                <td><?php echo $i ?></td>
                <td><?php echo $result['product_id']; ?></td>
                <td><?php echo $result['product_name']; ?></td>
                <td><?php echo $result['cartegory_name']; ?></td>
                <td><?php echo $result['brand_name']; ?></td>
                <td><?php echo $result['product_price']; ?></td>
                <td><?php echo $result['product_price_sale']; ?></td>
                <td><?php echo $result['product_desc']; ?></td>
                <td><?php echo $result['product_detail']; ?></td>
                <td><?php echo $result['product_preservation']; ?></td>
                <td><?php echo $result['size_product']; ?></td>
                <td><img src="uploads/<?php echo $result['product_img']; ?>" alt="" width="200px"></td>
                <td><a href="productedit.php?product_id=<?php echo $result['product_id'] ?>">Sửa</a>|<a href="productdelete.php?product_id=<?php echo $result['product_id'] ?>">Xóa</a></td>
            </tr>
            <?php
                    }
                }
            ?>
        </table>
    </div>
</div>