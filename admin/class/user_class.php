<?php
include "../database/database.php";
?>
<?php
class user
{
    private $db;
    public function __construct()
    {
        $this->db = new Database;
    }

    public function show_user()
    {
        $query = "SELECT * FROM users ORDER BY user_id DESC";
        $result = $this->db->select($query);
        return $result;
    }
    public function get_user($user_id)
    {
        $query = "SELECT * FROM users WHERE user_id = '$user_id'";
        $result = $this->db->select($query);
        return $result;
    }
    // Trong file user_class.php
    public function update_user($user_id, $user_name, $email, $role, $address, $phone)
    {
        $query = "UPDATE users SET 
                user = '$user_name', 
                email = '$email', 
                role = '$role', 
                address = '$address', 
                phone = '$phone' 
              WHERE user_id = '$user_id'";

        // Debug câu SQL trước khi thực hiện
        echo $query;

        $result = $this->db->update($query);
        if (!$result) {
            echo "Lỗi: " . $this->db->error; // In lỗi từ database
        }
        return $result;
    }
}
?>