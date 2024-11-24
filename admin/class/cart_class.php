<?php
include "../database/database.php";
?>
<?php
class cart
{
    private $db;
    public function __construct()
    {
        $this->db = new Database;
    }

    public function show_cart()
    {
        $query = "SELECT cart.cart_id, cart.cart_code, cart.cart_status AS cart_status, users.user AS user, users.address, users.phone 
              FROM cart 
              JOIN users ON cart.user_id = users.user_id 
              ORDER BY cart.cart_id DESC";
        $result = $this->db->select($query);
        return $result;
    }

    public function show_cartdetail($cart_code)
    {
        $query = "
            SELECT 
                c.cart_code,
                p.product_name,
                p.product_price,
                cd.quantity,
                cd.size
            FROM 
                cart_details cd
            JOIN 
                cart c ON cd.cart_code = c.cart_code
            JOIN 
                products p ON cd.product_id = p.product_id
            WHERE 
                c.cart_code = '$cart_code'
        ";
        $result = $this->db->select($query);
        return $result;
    }

    
}
?>