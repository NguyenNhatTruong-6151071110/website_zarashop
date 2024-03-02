<?php
    include "header.php";
    include "slider.php";
    include "class/product_class.php";
?>
<?php
    $product = new product; 
    $product_id = $_GET['product_id'];
    $get_product = $product -> get_product($product_id);
    if($get_product){
        $resultA = $get_product ->fetch_assoc();
    }
?>
<?php
    $product = new product;
    if($_SERVER['REQUEST_METHOD']=== 'POST'){
        $product_name = $_POST['product_name'];
        $cartegory_id = $_POST ['cartegory_id'];
        $brand_id = $_POST['brand_id'] ;
        $product_price = $_POST['product_price'];
        $product_price_sale = $_POST['product_price_sale'];
        $product_desc = $_POST['product_desc'];
        $product_img = $_POST['product_img'];
        $size_product = $_POST['size_product'];
        $product_detail = $_POST['product_detail'];
        $product_preservation = $_POST['product_preservation'];
        $insert_product = $product->update_product($product_id, $product_name, $cartegory_id, $brand_id, $product_price, $product_price_sale, $product_desc, $product_img, $size_product, $product_detail, $product_preservation);
    }
    if (isset($_GET['product_id'])) {
        $product_id = $_GET['product_id'];
        $product = new product;
        $product_info = $product->get_product_by_id($product_id);
    }
?>
<div class="admin-content-right">
            <div class="admin-content-right-product-add">
                        <h1>Sửa Sản Phẩm</h1><br>
                        <form action="" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                        <label for="">Nhập Tên Sản Phẩm<span style="color: red;" >*</span></label>
                        <input name="product_name" required type="text" value="<?php echo isset($product_info['product_name']) ? $product_info['product_name'] : ''; ?>">
                        <label for="">Chọn Danh Mục<span style="color: red;" >*</span></label>
                        <select name="cartegory_id" id="cartegory_id">
                            <option value="#"> --Chọn Danh Mục </option>
                                <?php 
                                $show_cartegory = $product->show_cartegory();
                                if($show_cartegory){
                                    while($result = $show_cartegory->fetch_assoc()){
                                ?>
                                <option <?php if ($resultA['cartegory_id'] == $result['cartegory_id']){ echo"SELECTED";} ?>
                                value="<?php echo $result['cartegory_id'] ?>"><?php echo $result['cartegory_name'] ?></option>
                                <?php 
                                    }
                                }
                                ?>
                        </select>
                        <label for="">Chọn Loại Sản Phẩm<span style="color: red;" >*</span></label>
                        <select name="brand_id" id="brand_id">
                            <option value="#"> --Chọn Loại Sản Phẩm</option>
                            <?php 
                            $show_brand = $product->show_brand();
                            if($show_brand){
                                while($result = $show_brand->fetch_assoc()){
                            ?>
                            <option <?php if ($resultA['brand_id'] == $result['brand_id']){ echo "SELECTED";} ?>
                             value="<?php echo $result['brand_id'] ?>"><?php echo $result['brand_name'] ?></option>
                            <?php 
                                }
                            }
                            ?>
                        </select>
                        <label for="">Chọn size sản phẩm<span style="color: red">*</span></label><br>
                        <input type="text" name="size_product" required value="<?php echo isset($product_info['size_product']) ? $product_info['size_product'] : ''; ?>">
                        <label for="">Giá Sản Phẩm<span style="color: red;" >*</span></label>
                        <input name="product_price" required type="text" value="<?php echo isset($product_info['product_price']) ? $product_info['product_price'] : ''; ?>">
                        <label for="">Giá Khuyến Mãi<span style="color: red;" >*</span></label>
                        <input name="product_price_sale" required type="text" value="<?php echo isset($product_info['product_price_sale']) ? $product_info['product_price_sale'] : ''; ?>">
                        <label for="">Mô Tả Sản Phẩm<span style="color: red;" >*</span></label>
                        <textarea required name="product_desc" id="" cols="30" rows="10" ><?php echo isset($product_info['product_desc']) ? $product_info['product_desc'] : ''; ?></textarea>
                        <label for="">Chi Tiết Sản Phẩm<span style="color: red;" >*</span></label>
                        <textarea required name="product_detail" id="" cols="30" rows="10"><?php echo isset($product_info['product_detail']) ? $product_info['product_detail'] : ''; ?></textarea>
                        <label for="">Bảo Quản Sản Phẩm<span style="color: red;" >*</span></label>
                        <textarea required name="product_preservation" id="" cols="30" rows="10"><?php echo isset($product_info['product_preservation']) ? $product_info['product_preservation'] : ''; ?></textarea>
                        <label for="">Ảnh Sản Phẩm<span style="color: red;" >*</span></label>
                        <input multiple name="product_img" type="file">
                        <!-- <div id="fileList"></div> -->
                        <label for="">Ảnh Mô Tả<span style="color: red;" >*</span></label>
                        <input multiple name="product_img_desc[]" type="file">
                        <button type="submit">Thêm</button>
                    </form>
                </div>
            </div>
        </section>
    </body>
    <!-- <script>
    function updateFileList(input) {
        var fileList = document.getElementById('fileList');
        fileList.innerHTML = ''; // Xóa nội dung cũ

        if (input.files && input.files.length > 0) {
            for (var i = 0; i < input.files.length; i++) {
                var fileName = input.files[i].name;
                var listItem = document.createElement('div');
                listItem.textContent = fileName;
                fileList.appendChild(listItem);
            }
        }
    }
</script> -->
    <script>
        $(document).ready(function(){
            $("#cartegory_id").change(function(){
                var x = $(this).val()
                $.get("productadd_ajax.php",{cartegory_id:x},function(data){
                    $("#brand_id").html(data);
                })
            })
        })
    </script>