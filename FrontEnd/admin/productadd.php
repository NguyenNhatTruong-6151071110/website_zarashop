<?php
    include "header.php";
    include "slider.php";
    include "class/product_class.php";
?>
<?php
    $product = new product;
    if($_SERVER['REQUEST_METHOD']=== 'POST'){
         $insert_product = $product ->insert_product($_POST, $_FILES);
     }
?>

<div class="admin-content-right">
            <div class="admin-content-right-product-add">
                    <h1>Thêm Sản Phẩm</h1><br>
                    <form action="" method="POST" enctype="multipart/form-data">
                        <label for="">Nhập Tên Sản Phẩm<span style="color: red;" >*</span></label>
                        <input name="product_name" required type="text">
                        <label for="">Chọn Danh Mục<span style="color: red;" >*</span></label>
                        <select name="cartegory_id" id="cartegory_id">
                        <option value="#"> --Chọn Danh Mục </option>
                            <?php 
                            $show_cartegory = $product->show_cartegory();
                            if($show_cartegory){
                                while($result = $show_cartegory->fetch_assoc()){
                            ?>
                            <option value="<?php echo $result['cartegory_id'] ?>"><?php echo $result['cartegory_name'] ?></option>
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
                            <option value="<?php echo $result['brand_id'] ?>"><?php echo $result['brand_name'] ?></option>
                            <?php 
                                }
                            }
                            ?>
                        </select>
                        <label for="">Chọn size sản phẩm<span style="color: red">*</span></label><br>
                        <input type="text" name="size_product" required>
                        <label for="">Giá Sản Phẩm<span style="color: red;" >*</span></label>
                        <input name="product_price" required type="text">
                        <label for="">Giá Khuyến Mãi<span style="color: red;" >*</span></label>
                        <input name="product_price_sale" required type="text">
                        <label for="">Mô Tả Sản Phẩm<span style="color: red;" >*</span></label>
                        <textarea required name="product_desc" id="" cols="30" rows="10"></textarea>
                        <label for="">Chi Tiết Sản Phẩm<span style="color: red;" >*</span></label>
                        <textarea required name="product_detail" id="" cols="30" rows="10"></textarea>
                        <label for="">Bảo Quản Sản Phẩm<span style="color: red;" >*</span></label>
                        <textarea required name="product_preservation" id="" cols="30" rows="10"></textarea>
                        <label for="">Ảnh Sản Phẩm<span style="color: red;" >*</span></label>
                        <input multiple name="product_img" type="file">
                        <label for="">Ảnh Mô Tả<span style="color: red;" >*</span></label>
                        <input multiple name="product_img_desc[]" type="file">
                        <button type="submit">Thêm</button>
                    </form>
                </div>
            </div>
        </section>
    </body>
    <!-- <script>
        ClassicEditor
            .create( document.querySelector( '#editor' ) )
            .catch( error => {
                console.error( error );
            } );
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
</html>