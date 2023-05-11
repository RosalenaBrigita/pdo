<?php 
 include ('conn.php'); 

  $status = '';
  //melakukan pengecekan apakah ada variable GET yang dikirim
  if ($_SERVER['REQUEST_METHOD'] === 'GET') {
      if (isset($_GET['productCode'])) {
          //query SQL
          $productCode_upd = $_GET['productCode'];
          $query = $conn->prepare("SELECT * FROM products WHERE productCode = :productCode");
          //binding data
          $query->bindParam(':productCode', $productCode);
          //eksekusi query
          $query->execute(); 
      }  
  }

  //melakukan pengecekan apakah ada form yang dipost
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productCode = $_POST['productCode'];
    $productName = $_POST['productName'];
    $productLine = $_POST['productLine'];
    $productScale = $_POST['productScale'];
    $productVendor = $_POST['productVendor'];
    $productDescription = $_POST['productDescription'];
    $quantityInStock = $_POST['quantityInStock'];
    $buyPrice = $_POST['buyPrice'];
    $MSRP = $_POST['MSRP'];
      
    //query SQL
      $query = $conn->prepare("UPDATE products  SET 
      productName=:productName, productLine=:productLine, productScale=:productScale,
      productVendor=:productVendor, productDescription=:productDescription, 
      quantityInStock=:quantityInStock, buyPrice=:buyPrice, MSRP=:MSRP 
      WHERE productCode=:productCode"); 
      //binding data
      $query->bindParam(':productCode',$productCode);
      $query->bindParam(':productName',$productName);
      $query->bindParam(':productLine',$productLine);
      $query->bindParam(':productScale',$productScale);
      $query->bindParam(':productVendor',$productVendor);
      $query->bindParam(':productDescription',$productDescription);
      $query->bindParam(':quantityInStock',$quantityInStock);
      $query->bindParam(':buyPrice',$buyPrice);
      $query->bindParam(':MSRP',$MSRP);

      //eksekusi query
      if ($query->execute()) {
        $status = 'ok';
        echo"<script>alert ('Data Produk Berhasil diupdate')</script>";
        header ("refresh:1;product.php");
      }
      else{
        $status = 'err';
        echo"<script>alert ('Data Tidak Berhasil diupdate')</script>";
        header ("refresh:0;product.php");
      }
      //redirect ke halaman lain
      header('Location: product.php?status='.$status);
  }  


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://kit.fontawesome.com/2365b8dab9.js" crossorigin="anonymous"></script>

    <style>
        body {
            margin-top:40px;
            color:#06194d;
            font-weight:900;
            background:#ffdda7;
            font-family: 'Roboto Slab', serif;      
        }

        h1 {
            color:#06194d;;
            margin:20px;
        }
        form {
            margin-left:30px;
            
        }
        input[type=submit], input[type=reset] , input[type=button] , input[type=text] #db {
            background-color: #0b3cc1;;
            color:#fff;
            border: none;
            padding: 16px 32px;
            text-decoration: none;
            font-family: 'Roboto Slab', serif;      
            margin: 4px 2px;
            cursor: pointer;
            border-radius:10px;
        }

        input[type=submit]:hover,input[type=reset]:hover,input[type=button]:hover{
            background-color: #06194d;;
            color: white;
            font-weight:700;
        }
        input[type=text], input[type=number], input[type=text-area], select[type=text] {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            border:0px;
            box-sizing: border-box;
            color:rgb(30, 27, 2);
            opacity:0.5;
            font-weight:700;
        }
        input[type=text]:hover, input[type=number]:hover, select[type=text]:hover{
            opacity:1;
            border:2px;
            border-color:#06194d;;
            border-style:groove;
        }
        </style>

        <title>UTS PEMWEB</title>
</head>
<body>
    <div class="sidebar close">
     
            <div class="logo-details">
                <i class='bx bxs-data'></i>
            <span class="logo_name">Database</span>           

            </div>
       
        <ul class="nav-links">
            <li>
                <div class="iocn-link">
                <a href="<?php echo "customer.php"; ?>" >
                    <i class='bx bxs-user' ></i>
                    <span class="link_name">Customer</span>
                </a>
                <i class='bx bxs-chevron-down arrow' ></i>
                </div>
                <ul class="sub-menu">
                <li><a class="link_name" href="#">Customer</a></li>
                <li><a href="<?php echo "insertCustomer.php"; ?>">Insert Data</a></li>
                </ul>
            </li>
            <li>
                <div class="iocn-link">
                <a href="<?php echo "employee.php"; ?>">
                    <i class='bx bxs-id-card'></i>
                    <span class="link_name">Employee</span>
                </a>
                <i class='bx bxs-chevron-down arrow' ></i>
                </div>
                <ul class="sub-menu">
                <li><a class="link_name" href="#">Employee</a></li>
                <li><a href="<?php echo "insertEmployee.php"; ?>">Insert Data</a></li>
                </ul>
            </li>   
            <li>
                <div class="iocn-link">
                <a href="<?php echo "product.php"; ?>" class="active">
                    <i class='bx bxs-basket'></i>
                    <span class="link_name">Product</span>
                </a>
                <i class='bx bxs-chevron-down arrow' ></i>
                </div>
                <ul class="sub-menu">
                <li><a class="link_name" href="#">Product</a></li>
                <li><a href="<?php echo "insertProduct.php"; ?>">Insert Data</a></li>
                </ul>
            </li>
        </ul>
    </div>

    <section class="dashboard">
        <div class="top">
            <div class="sidebar-button">
                <i class='bx bx-menu sidebar-toggle'></i>
            </div>
            <div class="search-box">
                <i class='bx bx-search' ></i>
                <form method="GET" action="customer.php" style="text-align: left">
                    <input name="search" method="GET" action="product.php" placeholder="  Search..." id="mysearch" value="<?php if(isset($_GET['search'])){echo $_GET['search']; } ?>">
                </form>
                <span class="clear" onclick="document.getElementById('mysearch').value = ''"><i class="fa fa-times" aria-hidden="true"></i></span>

            </div>  
           
            <div class="profile-details">
                <span class="admin_name">Rosalena Brigita</span>
                <i class='bx bx-chevron-down' ></i>
            </div>
        </div>
        

        <div class="dash-content">
            <div class="database">
            
                <h1><center>Update Data Product</center></h1>

                <div class="database-data">

                    <form action="updateProduct.php" method="POST">  
                    <?php         
                        $productCode = $_GET['productCode'];
                        $query = "select * from products WHERE productCode='$productCode'";
                        $result = $conn->query($query);
                        while($data = $result->fetch(PDO::FETCH_ASSOC)): ?>
                    <table id="db">
                        <tr>
                            <td width="200">Product Code</td>
                            <td>:</td>
                            <td><input type="text" name="productCode" value="<?php echo $data['productCode'];  ?>" readonly required></td>
                        </tr>
                        <tr>
                            <td>Product Name</td>
                            <td>:</td>
                            <td><input type="text" name="productName" size="100" value="<?php echo $data['productName'];  ?>" required></td>
                        </tr>
                        <tr>
                            <td>Product Line</td>
                            <td>:</td>
                            <td><input type="text" name="productLine" value="<?php echo $data['productLine'];  ?>" readonly required></td>
                        </tr>
                        <tr>
                            <td>Product Scale</td>
                            <td>:</td>
                            <td><input type="text" name="productScale" size="30" value="<?php echo $data['productScale'];  ?>" required></td>
                        </tr>
                        <tr>
                            <td>Product Vendor</td>
                            <td>:</td>
                            <td><input type="text" name="productVendor" size="30" value="<?php echo $data['productVendor'];  ?>" required></td>
                        </tr>
                        <tr>
                            <td>Product Description</td>
                            <td>:</td>
                            <td><input type="text" name="productDescription" size="30" value="<?php echo $data['productDescription'];  ?>" required></td>
                        </tr>
                        <tr>
                            <td>Quantity In Stock</td>
                            <td>:</td>
                            <td><input type="text" name="quantityInStock" size="30" value="<?php echo $data['quantityInStock'];  ?>"></td>
                        </tr>
                        <tr>
                            <td>Buy Price</td>
                            <td>:</td>
                            <td><input type="number" name="buyPrice" size="30" value="<?php echo $data['buyPrice'];  ?>" required></td>
                        </tr>
                        <tr>
                            <td>MSRP</td>
                            <td>:</td>
                            <td><input type="number" name="MSRP" size="30" value="<?php echo $data['MSRP'];  ?>"></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                                <td>
                                    <input type="submit" value="Save" name="save">
                                    <input type="reset" value="Cancel" name="cancel">
                                    <input type="button" value="Back" name="back" onclick="self.history.back()">
                                </td>
                            </tr>
                            <?php endwhile; ?>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!--<script src="script.js"></script>-->
    <script>
        
        const body = document.querySelector("body"),
        modeToggle = body.querySelector(".mode-toggle");
        sidebar = body.querySelector(".sidebar");
        sidebarToggle = body.querySelector(".sidebar-toggle");
        
        let arrow = document.querySelectorAll(".arrow");
        for (var i = 0; i < arrow.length; i++) {
            arrow[i].addEventListener("click", (e)=>{
        let arrowParent = e.target.parentElement.parentElement;//selecting main parent of arrow
        arrowParent.classList.toggle("showMenu");
            });
        }

        let getStatus = localStorage.getItem("status");
        if(getStatus && getStatus ==="close"){
            sidebar.classList.toggle("close");
        }

        sidebarToggle.addEventListener("click", () => {
            sidebar.classList.toggle("close");
            if(sidebar.classList.contains("close")){
                localStorage.setItem("status", "close");
            }else{
                localStorage.setItem("status", "open");
            }
        })
        
        
        sidebarToggle.onclick = function() {
        sidebar.classList.toggle("active");
        if(sidebar.classList.contains("active")){
        sidebarToggle.classList.replace("bx-menu" ,"bx-menu-alt-right");
        }else
        sidebarToggle.classList.replace("bx-menu-alt-right", "bx-menu");
        }
        
    </script>
</body>
</html>