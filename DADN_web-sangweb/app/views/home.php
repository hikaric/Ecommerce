<?php 
    session_start();
    require_once("inc/head.php");
    require_once("../DB.php");
    require_once '../models/ProductModel.php';
 ?>

<title>Trang chủ</title>
</head>

<body>
    <?php require_once("inc/nav.php"); ?>
    <!-- Carousel-->
    <div id="thecarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#thecarousel" data-bs-slide-to="0" class="active"></button>
            <button type="button" data-bs-target="#thecarousel" data-bs-slide-to="1"></button>
            <button type="button" data-bs-target="#thecarousel" data-bs-slide-to="2"></button>
            <!--<button type="button" data-bs-target="#thecarousel" data-bs-slide-to="3"></button>
                <button type="button" data-bs-target="#thecarousel" data-bs-slide-to="4"></button>-->
        </div>

        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="https://img.freepik.com/free-vector/online-shopping-banner-with-3d-shopping-cart-clouds-social-icons-vector-illustration_548887-100.jpg"
                    alt="First slide" class="d-block w-100" height="300px">
            </div>
            <div class="carousel-item">
                <img src="https://pixelixe.com/blog/images/67/ecommerce-banner-automation.jpg" alt="Second slide"
                    class="d-block w-100" height="300px">
            </div>
            <div class="carousel-item">
                <img src="https://cdn3.vectorstock.com/i/1000x1000/79/37/black-friday-sale-design-vector-10817937.jpg"
                    alt="Third slide" class="d-block w-100" height="300px">
            </div>
            <!--<div class="carousel-item">
                    <img src="https://www.crushpixel.com/static17/preview2/black-friday-sale-banner-background-2649923.jpg" alt="Third slide" class="d-block w-100" height="300px">
                </div>
                <div class="carousel-item">
                    <img src="https://u6wdnj9wggobj.vcdn.cloud/media/mgs_blog/s/i/sinh-nhat-mykingdom-1004.jpg" alt="Third slide" class="d-block w-100" height="300px">
                </div>-->
        </div>

        <button type="button" class="carousel-control-prev" data-bs-target="#thecarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button type="button" class="carousel-control-next" data-bs-target="#thecarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
    </div>

    <div class="category">
        <div class="container text-center bg-dark">
            <div class="row">
                <?php
                foreach ($listCategory as $category) {
                  $id = $category['id']
                ?>
                <div class="col-2 p-1 bg-light border border-right-1 border-bottom-1  ">
                    <!-- thêm thẻ img vào cho giống shopee -->

                    <a class="text-decoration-none text-dark d-flex flex-column justify-center align-items-center"
                        href='../views/home.php?cateid=<?= $id ?>'>
                        <img style="width: 50px;"
                            src="data:image/jpeg;base64,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"
                            alt="">
                        <p><?= $category['name'] ?></p>
                    </a>
                </div>
                <?php }
                ?>
            </div>

        </div>

    </div>

    <!-- product card grid-->
    <div class="container my-5">
        <div class="row row-cols-2 row-cols-md-3 g-4">
            <!--<span class="row row-cols-2 row-cols-md-3 g-4">ABC</span>-->
            <?php 
			    // Fetching the products from the JSON file 
                $prod = new ProductModel();

                // Look for a GET variable page if not found default is 1.        
                if (isset($_GET["page"])) {    
                    $page  = $_GET["page"];    
                }    
                else {    
                    $page=1;    
                }
                if(isset($_GET['search-submit'])){
                    $key = $_GET['search-key'];
                    $result=$prod->getPageandSearch($page,$key);
                    if($result&&mysqli_num_rows($result)>0){
                        
                    }else{
                        echo "<div class='message'>Không tồn tại sản phẩm tìm kiếm</div>";
                    }
                } else{
                    if(isset($_GET['cateid'])){
                        $result=$prod->getPageandCateid($page,$_GET['cateid']);
                    }
                    else{
                        $result = $prod->getPage($page);
                    }
                }
                if($result){
                    while($data=$result->fetch_assoc()) 
			    {
				?>
            <!-- The product element -->
            <div class="col">
                <div class="card h-100 text-center">
                    <!-- The products image -->
                    <a href="../controllers/orderController.php?action=viewDetail&id=<?=$data['id']?>">
                        <div class="zoom">
                            <img src="<?php echo "../../image/".$data['image'] ?>" class="card-img-top" alt="...">
                        </div>
                    </a>
                    <!-- The products name -->
                    <div class="card-body bg-custom">
                        <h5 class="card-title"><?php echo $data['name'] ?></h5>
                        <!--p class="name"><,?php echo $data['name'] ?></p-->
                        <!-- The products price formatted with two decimals  -->
                        <p class="card-text text-danger"><?php echo number_format($data['originalPrice']) ?> VNĐ</p>
                        <!--p class="price">$<,?php echo number_format($data['originalPrice'], 2) ?></p-->
                        <!-- The add cart button -->
                        <?php 
                                if(!isset($_SESSION['user_id'])){
                                    $url = "../controllers/script.php?store-product-id=".$data['id'];
                                }else{
                                    $url = "../controllers/script.php?store-product-id-user=".$data['id'];
                                }
                                
                            ?>
                        <a class="btn btn-dark" href="<?=$url?>">Thêm vào giỏ hàng</a>
                    </div>
                </div>
            </div> <!-- End of product element -->
            <?php				
			}
            }     
		 ?>
        </div> <!-- End of products -->

        <nav aria-label="Page navigation" class="my-3 text-dark">
            <ul class="pagination justify-content-center">
                <?php  
                if(isset($_GET['cateid'])){
                    $result=$prod->getByCateid($_GET['cateid']);
                }
                else if(isset($_GET['search-submit'])){
                    $key=$_GET['search-key'];
                    $result=$prod->searchKey($key);
                }
                else{
                    $result = $prod->getAll();
                }
                $total_records = mysqli_num_rows($result);    
          
                $per_page_record = 6;
                $total_pages = ceil($total_records / $per_page_record);    
                $pagLink = "";
                if($page >= 2) {      
            ?>
                <li class="page-item">
                    <a class="page-link" href="home.php?page=<?=($page-1) ?>"><i
                            class="fa-solid fa-chevron-left"></i></a>
                </li>

                <?php 
                }
                for ($i=1; $i<=$total_pages; $i++) {   
                    if ($i == $page) {   
                    $pagLink .= "<li class='page-item active'><a class = 'page-link' href='home.php?page="  
                                                .$i."'>".$i." </a></li>";   
                }               
                else  {   
                    $pagLink .= "<li class='page-item'><a class = 'page-link' href='home.php?page="  
                                                .$i."'>".$i." </a></li>";     
                }   
                };     
                echo $pagLink;   
  
                if($page<$total_pages) {
                ?>
                <li class="page-item">
                    <a class="page-link" href='home.php?page=<?=($page+1) ?>'><i
                            class="fa-solid fa-chevron-right"></i></a>
                </li>
                <?php } ?>
            </ul>
        </nav>
    </div>

    <?php require_once("inc/footer.php"); ?>
</body>

</html>