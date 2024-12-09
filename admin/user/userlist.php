<?php
include "../database/header.php";
include '../database/sidebar.php';
include "../class/user_class.php";
?>
<?php
    $user = new user;
    $show_user = $user->show_user();
?>
        <div class="admin-content-right">
            <div class="admin-content-right-cartegory_list">
                <h1>Danh sách người dùng</h1>
                    <table>
                        <tr>
                            <th>STT</th>
                            <th>ID</th>
                            <th>Tên người dùng</th>
                            <th>Email</th>
                            <th>Số điện thoại</th>
                            <th>Địa chỉ</th>
                            <th>Vai trò</th>
                            <th>Tùy chỉnh</th>
                        </tr>
                        <?php
                        if($show_user){$i=0;
                            while($result = $show_user->fetch_assoc()) {$i++;
                        
                        ?>
                        <tr>
                            <td><?php echo $i ?></td>
                            <td><?php echo $result['user_id']?></td>
                            <td><?php echo $result['user']?></td>
                            <td><?php echo $result['email']?></td>
                            <td><?php echo $result['phone']?></td>
                            <td><?php echo $result['address']?></td>
                            <td><?php if ($result['role'] == 0 ){
                                    echo "khách hàng"; }
                                    else { echo "Admin"; } ?>
                            </td>
                            <td><a href="useredit.php?id=<?php echo $result['user_id'] ?>">Sửa</a>|<a href="userdelete.php?id=<?php echo $result['user_id'] ?>">Xóa</a></td>
                        </tr><?php
                    }
                }
                    ?>
                    </table>
            </div>
        </div>
</body>
</html>