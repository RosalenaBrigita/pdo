<?php 
 include ('conn.php'); 

  $status = '';
  //melakukan pengecekan apakah ada variable GET yang dikirim
  if ($_SERVER['REQUEST_METHOD'] === 'GET') {
      if (isset($_GET['customerNumber'])) {
          //query SQL
          $customerNumber_upd = $_GET['customerNumber'];
          $query = $conn->prepare("SELECT * FROM customers WHERE customerNumber = :customerNumber");
          //binding data
          $query->bindParam(':customerNumber', $customerNumber_upd);
          //eksekusi query
          $query->execute(); 
      }  
  }

  //melakukan pengecekan apakah ada form yang dipost
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $customerNumber = $_POST['customerNumber'];
    $customerName = $_POST['customerName'];
    $contactLastName = $_POST['contactLastName'];
    $contactFirstName = $_POST['contactFirstName'];
    $phone = $_POST['phone'];
    $addressLine1 = $_POST['addressLine1'];
    $addressLine2 = isset($_POST['addressLine2']) ? $_POST['addressLine2'] : NULL;
    $city = $_POST['city'];
    $state = isset($_POST['state']) ? $_POST['state'] : NULL;
    $postalCode = isset($_POST['postalCode']) ? $_POST['postalCode'] : NULL;
    $country = $_POST['country'];
    $salesRepEmployeeNumber = isset($_POST['salesRepEmployeeNumber']) ? $_POST['salesRepEmployeeNumber'] : NULL;
    $creditLimit = isset($_POST['creditLimit']) ? $_POST['creditLimit'] : NULL;
      
    //query SQL
      $query = $conn->prepare("UPDATE customers  SET 
      customerName=:customerName, contactLastName=:contactLastName, contactFirstName=:contactFirstName,
      phone=:phone, addressLine1=:addressLine1, addressLine2=:addressLine2,
      city=:city, state=:state, postalCode=:postalCode,
      country=:country, salesRepEmployeeNumber=:salesRepEmployeeNumber, postalCode=:postalCode WHERE customerNumber=:customerNumber"); 
      //binding data
      $query->bindParam(':customerNumber',$customerNumber);
      $query->bindParam(':customerName',$customerName);
      $query->bindParam(':contactLastName',$contactLastName);
      $query->bindParam(':contactFirstName',$contactFirstName);
      $query->bindParam(':phone',$phone);
      $query->bindParam(':addressLine1',$addressLine1);
      $query->bindParam(':addressLine2',$addressLine2);
      $query->bindParam(':city',$city);
      $query->bindParam(':state',$state);
      $query->bindParam(':postalCode',$postalCode);
      $query->bindParam(':country',$country);
      $query->bindParam(':salesRepEmployeeNumber',$salesRepEmployeeNumber);
      $query->bindParam(':creditLimit',$postalCode);

      //eksekusi query
      if ($query->execute()) {
        $status = 'ok';
      }
      else{
        $status = 'err';
      }
      //redirect ke halaman lain
      header('Location: customer.php?status='.$status);
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
                <a href="<?php echo "customer.php"; ?>" class="active">
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
                <a href="<?php echo "product.php"; ?>">
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
                    <input name="search" method="GET" action="customer.php" placeholder="  Search..." id="mysearch" value="<?php if(isset($_GET['search'])){echo $_GET['search']; } ?>">
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
            
                <h1><center>Update Data Customer</center></h1>

                <div class="database-data">

                    <form action="updateCustomer.php" method="POST">  
                    <?php         
                        $customerNumber = $_GET['customerNumber'];
                        $query = "select * from customers WHERE customerNumber='$customerNumber'";
                        $result = $conn->query($query);
                        while($data = $result->fetch(PDO::FETCH_ASSOC)): ?>
                    <table id="db">
                        <tr>
                            <td width="200">Customer Number</td>
                            <td>:</td>
                            <td><input type="number" name="customerNumber" value="<?php echo $data['customerNumber'];  ?>" readonly required></td>
                        </tr>
                        <tr>
                            <td>Customer Name</td>
                            <td>:</td>
                            <td><input type="text" name="customerName" size="30" value="<?php echo $data['customerName'];  ?>" required></td>
                        </tr>
                        <tr>
                            <td>Contact Last Name</td>
                            <td>:</td>
                            <td><input type="text" name="contactLastName" size="30" value="<?php echo $data['contactLastName'];  ?>" required></td>
                        </tr>
                        <tr>
                            <td>Contact First Name</td>
                            <td>:</td>
                            <td><input type="text" name="contactFirstName" size="30" value="<?php echo $data['contactFirstName'];  ?>" required></td>
                        </tr>
                        <tr>
                            <td>Phone</td>
                            <td>:</td>
                            <td><input type="number" name="phone" size="30" value="<?php echo $data['phone'];  ?>" required></td>
                        </tr>
                        <tr>
                            <td>Address Line 1</td>
                            <td>:</td>
                            <td><input type="text" name="addressLine1" size="30" value="<?php echo $data['addressLine1'];  ?>" required></td>
                        </tr>
                        <tr>
                            <td>Address Line 2</td>
                            <td>:</td>
                            <td><input type="text" name="addressLine2" size="30" value="<?php echo $data['addressLine2'];  ?>"></td>
                        </tr>
                        <tr>
                            <td>City</td>
                            <td>:</td>
                            <td><input type="text" name="city" size="30" value="<?php echo $data['city'];  ?>" required></td>
                        </tr>
                        <tr>
                            <td>State</td>
                            <td>:</td>
                            <td><input type="text" name="state" size="30" value="<?php echo $data['state'];  ?>"></td>
                        </tr>
                        <tr>
                            <td>Postal Code</td>
                            <td>:</td>
                            <td><input type="number" name="postalCode" size="30" value="<?php echo $data['postalCode'];  ?>"></td>
                        </tr>
                        <tr>
                            <td>Country</td>
                            <td>:</td>
                            <td><input type="text" name="country" size="30" value="<?php echo $data['country'];  ?>" required></td>
                        </tr>
                        <tr>
                            <td>Sales Rep Employee</td>
                            <td>:</td>
                            
                            <td><select type="text" name="salesRepEmployeeNumber">
                                <option><?php echo $data['salesRepEmployeeNumber'];  ?></option>
                                <?php
                                include "conn.php";
                                $query = "select * from employees where jobTitle = 'Sales Rep';" ;
                                $result = $conn->query($query);
                                
                                while($data = $result->fetch(PDO::FETCH_ASSOC)){ 

                                    echo "<option value=$data[employeeNumber]> $data[employeeNumber] - $data[lastName] $data[firstName] </option>";
                                }
                                ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Credit Limit</td>
                            <td>:</td>
                            <td><input type="number" name="creditLimit" size="30" value="<?php echo $data['creditLimit'];  ?>"></td>
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