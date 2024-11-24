<?php
include "../database/header.php";
include '../database/sidebar.php';
include "../class/brand_class.php";
?>
<?php
    $brand = new brand;
    $show_brand = $brand->show_brand();
?>
        <div class="admin-content-right">
            <div class="admin-content-right-cartegory_list">
                <h1>Danh sách danh mục</h1>
                    <table>
                        <tr>
                            <th>STT</th>
                            <th>ID</th>
                            <th>Danh mục</th>
                            <th>Tùy chỉnh</th>
                        </tr>
                        <?php
                        if($show_brand){$i=0;
                            while($result = $show_brand->fetch_assoc()) {$i++;
                        
                        ?>
                        <tr>
                            <td><?php echo $i ?></td>
                            <td><?php echo $result['brand_id']?></td>
                            <td><?php echo $result['brand_name']?></td>
                            <td><a href="brandedit.php?id=<?php echo $result['brand_id'] ?>">Sửa</a>|<a href="branddelete.php?id=<?php echo $result['brand_id'] ?>">Xóa</a></td>
                        </tr><?php
                    }
                }
                    ?>
                    </table>
            </div>
        </div>
</body>
</html>