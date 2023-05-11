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
                <a href="<?php echo "employee.php"; ?>" class="active">
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
                <form method="GET" action="employee.php" style="text-align: left">
                    <input name="search" method="GET" action="employee.php" placeholder="  Search..." id="mysearch" value="<?php if(isset($_GET['search'])){echo $_GET['search']; } ?>">
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
                    <span class="text">Data Employee</span>
                </div>

                <div class="database-data">
                    <div class="center">
                    <table>
                        <thead>
                            <tr>
                                <th>Employee Number</th>
                                <th>Last Name</th>
                                <th>First Name</th>
                                <th>Extension</th>
                                <th>email</th>
                                <th>Office Code</th>
                                <th>Reports To</th>
                                <th>Job Title</th>     
                                <th colspan="2">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            if(isset($_GET['search'])) {
                                $searching = $_GET['search'];
                                $query = "select * from employees where employeeNumber like '%"
                                .$searching."%' or lastName like '%".$searching."%' 
                                or firstName like '%".$searching."%' or extension like '%".$searching."%' 
                                or email like '%".$searching."%' or officeCode like '%".$searching."%' 
                                or reportsTo like '%".$searching."%' or jobTitle like '%".$searching."%' 
                                order by employeeNumber asc"; 
                            }   
                            else {
                                $query = "select * from employees";
                            }

                            $result = $conn->query($query);
                            while ($data = $result->fetch(PDO::FETCH_ASSOC)): {
                    
                            ?>

                            <tr>
                                <td><?php echo $data['employeeNumber'];  ?></td>
                                <td><?php echo $data['lastName'];  ?></td>
                                <td><?php echo $data['firstName'];  ?></td>
                                <td><?php echo $data['extension'];  ?></td>
                                <td><?php echo $data['email'];  ?></td>
                                <td><?php echo $data['officeCode'];  ?></td>
                                <td><?php echo $data['reportsTo'];  ?></td>
                                <td><?php echo $data['jobTitle']; } ?></td>
                                <td>
                                        <a class="icon" href="<?php echo "updateEmployee.php?employeeNumber=".$data['employeeNumber']; ?>" ><i class="fa-sharp fa-solid fa-pen" id="update"></i></a>
                                </td>
                                <td>    
                                        <a class="icon" href="<?php echo "deleteEmployee.php?employeeNumber=".$data['employeeNumber']; ?>" ><i class="fa-solid fa-trash" id="delete"></i></a>
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
