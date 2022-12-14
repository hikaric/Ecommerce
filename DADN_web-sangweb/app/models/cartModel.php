<?php
class CartModel
{
    private $product=[];
    private $id="";
    private $productId="";
    
    public function __construct($Id)
    {
        $db = DB::getInstance();
        $sql = "SELECT * FROM products WHERE id='$Id' AND status=1";
        $result = mysqli_query($db->con, $sql);
        if($result){
            while($row = $result->fetch_assoc()){
                if($row['id']==$Id){
                   $this->product=$row;
                }
            }
        }
        if(isset($_SESSION['user_id'])){
            $this->id = $_SESSION['user_id'];
        }
        $this->productId= $Id;
        
    }
// Khách
    public function storeProduct(){
        if(!isset($_SESSION['cart'])){
            $_SESSION['cart'][]=$this->product;
        }else{
            $ids=[];
            foreach($_SESSION['cart'] as $key => $value){
                array_push($ids,$value['id']);
            }
            //Kiểm tra xem sản phẩm này có trong giỏ hàng chưa
            if(!in_array($this->product['id'],$ids)){ 
                $_SESSION['cart'][]=$this->product;
            }
        }
        /*highlight_string("<?php". var_export($_SESSION['cart'], true).";?>");*/
    }

    public function removeItem(){
        if(isset($_SESSION['cart'])){
            foreach($_SESSION['cart'] as $key => $value){
                if($value['id']==$this->product['id']){
                    unset($_SESSION['cart'][$key]);
                }
            }    
        }
    }

    public function updateQuantity($quant){
        foreach($_SESSION['cart'] as $key => $value){
            if($value['id']==$this->product['id']){
                $_SESSION['cart'][$key]['status']= $quant;
            }
        }    
        
    }

    public static function getNumberCart()
    {
        return count($_SESSION['cart']);
    }

    public static function getTotalPrice(){
        $sum = 0;
        foreach($_SESSION['cart'] as $value){
            $sub_sum = $value['originalPrice']*$value['status'];
            $sum+=$sub_sum;
        }
        return $sum;
    }
    public static function clearCart()
    {
        unset($_SESSION['cart']);
    }


// Đã đăng nhập


    public static function getCartFromId($id){
        $db = DB::getInstance();
        $sql = "SELECT * FROM cart c, products p WHERE c.userId='$id' AND c.productId=p.id";
        $result = mysqli_query($db->con, $sql);
        return $result;
    }
    public function storeProductUser(){
        $db = DB::getInstance();
        $sql = "SELECT * FROM cart c, products p WHERE c.userId=".$this->id." AND p.id=c.productId AND c.productId=".$this->productId;
        $result = mysqli_query($db->con, $sql);
        if($result&&mysqli_num_rows($result)>0){
            $value=$result->fetch_assoc();
            if($value['quanty']<5){

                $qty= $value['quanty']+1;
                $sql = "UPDATE cart SET quanty=".$qty." WHERE userId='$this->id' AND productId=".$this->productId;
                mysqli_query($db->con, $sql);
            }  
        }else{
            echo mysqli_error($db->con);
            $sql = "INSERT INTO cart(userId,productId,quanty) VALUES
            ('".$this->id."','".$this->productId."','1')";
            mysqli_query($db->con, $sql);
        }
        /*highlight_string("<?php". var_export($_SESSION['cart'], true).";?>");*/
    }

    public function removeItemUser(){
        $db = DB::getInstance();
        $sql= "DELETE FROM cart WHERE userId=".$this->id." AND productId=".$this->productId;
        mysqli_query($db->con, $sql);
    }

    public function updateQuantityUser($quant){
        $db = DB::getInstance();
        $sql= "UPDATE cart SET quanty=".$quant." WHERE userId=".$this->id." AND productId=".$this->productId;
        mysqli_query($db->con, $sql);
        mysqli_error($db->con);
    }

    public static function getNumberCartUser()
    {
        $db = DB::getInstance();
        $sql= "SELECT * FROM cart WHERE userId=".$_SESSION['user_id'];
        $result=mysqli_query($db->con, $sql);
        if($result&&mysqli_num_rows($result)>0){
            return mysqli_num_rows($result);
        }
    }

    public static function getTotalPriceUser(){
        $db = DB::getInstance();
        $sql= "SELECT * FROM cart c, products p WHERE userId=".$_SESSION['user_id']." AND c.productId=p.id";
        $result=mysqli_query($db->con, $sql);
        $sum=0;
        if($result&&mysqli_num_rows($result)>0){
            while($value=$result->fetch_assoc()){
                $sum+=$value['originalPrice']*$value['quanty'];
            }
        }
        return $sum;
    }
    public static function clearCartUser()
    {
        $db = DB::getInstance();
        $sql= "DELETE FROM cart WHERE userId=".$_SESSION['user_id'];
        mysqli_query($db->con, $sql);
    }
    
}

?>