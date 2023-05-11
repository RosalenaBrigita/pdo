<?php 
  include ('conn.php'); 
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
        table
        {
            border: 1;
            border-collapse: collapse;
            margin-left: 50px;
            margin-bottom: 20px;
        }
        
        table, th, td
        {
            border: 1px solid gainsboro;
            padding: 10px;
        }
        #update {
            color:green;
        }
        #delete {
            color:red;
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
                <form id="form" method="GET" action="customer.php" style="text-align: left">
                    <input type="text" name="search" method="GET" action="customer.php" placeholder="  Search..." id="mysearch" value="<?php if(isset($_GET['search'])){echo $_GET['search']; } ?>">
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
                <div class="title">
                    <i class="uil uil-tachometer-fast-alt"></i>
                    <span class="text">Data Customer</span>
                </div>

                <div class="database-data">
                    <div class="center">
                    <table>
                        <thead>
                            <tr>
                            <th>Customer Number</th>
                            <th>Customer Name</th>
                            <th>Contact Last Name</th>
                            <th>Contact First Name</th>
                            <th>Phone</th>
                            <th>Address Line 1</th>
                            <th>Address Line 2</th>
                            <th>City</th>
                            <th>State</th>
                            <th>Postal Code</th>
                            <th>Country</th>
                            <th>Sales Rep Employee Number</th>
                            <th>Credit Limit</th>
                            <th colspan="2">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            //proses menampilkan data dari database:
                            //siapkan query SQL
                            if(isset($_GET['search'])) {
                                $searching = $_GET['search'];
                                $query = "select * from customers where customerNumber like '%"
                                .$searching."%' or customerName like '%".$searching."%' 
                                or contactLastName like '%".$searching."%' or contactFirstName like '%".$searching."%' 
                                or phone like '%".$searching."%' or addressLine1 like '%".$searching."%' 
                                or addressLine2 like '%".$searching."%' or city like '%".$searching."%' 
                                or state like '%".$searching."%' or postalCode like '%".$searching."%'  
                                or country like '%".$searching."%' or salesRepEmployeeNumber like '%".$searching."%' 
                                or creditLimit like '%".$searching."%' order by customerNumber asc"; 
                            }   
                            else {
                                $query = "select * from customers";
                            }

                            $result = $conn->query($query);
                            while ($data = $result->fetch(PDO::FETCH_ASSOC)): {
                    
                            ?>

                            <tr>
                                <td><?php echo $data['customerNumber'];  ?></td>
                                <td><?php echo $data['customerName'];  ?></td>
                                <td><?php echo $data['contactLastName'];  ?></td>
                                <td><?php echo $data['contactFirstName'];  ?></td>
                                <td><?php echo $data['phone'];  ?></td>
                                <td><?php echo $data['addressLine1'];  ?></td>
                                <td><?php echo $data['addressLine2'];  ?></td>
                                <td><?php echo $data['city'];  ?></td>
                                <td><?php echo $data['state'];  ?></td>
                                <td><?php echo $data['postalCode'];  ?></td>
                                <td><?php echo $data['country'];  ?></td>
                                <td><?php echo $data['salesRepEmployeeNumber'];  ?></td>
                                <td><?php echo $data['creditLimit']; } ?></td>  
                                <td>
                                        <a href="<?php echo "updateCustomer.php?customerNumber=".$data['customerNumber']; ?>" ><i class="fa-sharp fa-solid fa-pen" id="update"></i></a>
                                </td>
                                <td>    
                                        <a href="<?php echo "deleteCustomer.php?customerNumber=".$data['customerNumber']; ?>" ><i class="fa-solid fa-trash" id="delete"></i></a>
                                </td>
                            </tr> 
                            <?php endwhile ?>
                        </tbody>
                    </table>
                    </div>
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
