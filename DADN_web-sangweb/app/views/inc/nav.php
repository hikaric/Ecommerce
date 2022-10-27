    <?php 
      require_once '../models/categoryModel.php';
      require_once '../DB.php';
      require_once '../models/cartModel.php';
      $result2="0";
      if(isset($_SESSION['user_id'])){
        $result2= CartModel::getCartFromId($_SESSION['user_id']);
      }
      $result = CategoryModel::getAllClient();
      $listCategory = $result->fetch_all(MYSQLI_ASSOC);
    ?>
      <nav class="navbar navbar-expand-md navbar-custom navbar-light sticky-top">
        <div class="container-fluid">
          <!--Logo-->
          <a class="navbar-brand" href="../views/home.php">LOGO</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <!--Search bar-->
          <div class="collapse navbar-collapse" id="navbarNav">
          <form action="../views/home.php"class="d-flex me-auto">
            <!--Enter field-->
            <input class="form-control me-2" type="search" placeholder="Tìm kiếm sản phẩm" aria-label="Search" name="search-key" required>
            <!--Search button-->
            <button class="btn btn-outline-dark" type="submit" name="search-submit"><i class="fa-solid fa-magnifying-glass" ></i></button>
          </form>
          <ul class="navbar-nav my-2 my-lg-0">
              <!--Classify-->
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown">
                  Danh mục hàng hóa
                </a>
                  <ul class="dropdown-menu dropdown-menu-light navbar-custom">
                  <?php
      
                    foreach ($listCategory as $category) { 
                      $id=$category['id']
                      ?>
                      <li><a class="dropdown-item" href='../views/home.php?cateid=<?=$id?>'><?= $category['name'] ?></a></li>
                  <?php }
                  ?>
                  </ul>
              </li>
              <!--Intro-->
              <li class="nav-item">
                <a href="../views/intro.php" class="nav-link">Giới thiệu</a>
              </li>
              <!--Account management-->
              <?php
                /*Logged in*/
                if (isset($_SESSION['user_id'])) { ?>
                  <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown">
                    <?=$_SESSION['user_name'] ?>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-light navbar-custom">
                    <li><a class="dropdown-item" href="../controllers/orderController.php?action=myOrder">Đơn hàng của tôi</a></li>
                    <li><a class="dropdown-item" href="../views/infoUser.php?user_id=<?=$_SESSION['user_id']?>">Thông tin tài khoản</a></li>
                    <li><a class="dropdown-item" href="../views/logout.php">Đăng xuất</a></li>
                  </ul>
                </li>
                <?php } else { ?>
                  <!--Have not logged in-->

                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown">
                      Đăng nhập / Đăng ký
                    </a>
                      <ul class="dropdown-menu dropdown-menu-light navbar-custom">
                        <li class="nav-item">
                          <a class="nav-link" href="../views/regist.php">Đăng ký</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="../views/login.php">Đăng nhập</a>
                        </li>
                      </ul>
                  </li>

                
              <?php  }
              ?>
              <!--Cart-->
              <li class="nav-item">
                <a class="nav-link position-relative" href="../views/cart.php" style="width: 34px;"><i class="fa-solid fa-cart-shopping"></i> 
                <span class="position-absolute top-10 start-100 translate-middle badge rounded-circle bg-danger">
                <?php if(!isset($_SESSION['user_id'])&&isset($_SESSION['cart'])){
                  echo count($_SESSION['cart']);
                }else if(!isset($_SESSION['user_id'])){echo"0";}
                else if(isset($_SESSION['user_id'])){ 
                  if($result2&&mysqli_num_rows($result2)>0){
                    echo mysqli_num_rows($result2);
                  }else{
                    echo "0";
                  }
                }
                ?>
                </span>
              </a>
              </li>
          </ul>
          
          </div>
        </div>
      </nav>
