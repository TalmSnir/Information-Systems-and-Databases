<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="https://unpkg.com/open-props" />
    <link
      rel="stylesheet"
      href="https://unpkg.com/open-props/normalize.min.css"
    />
    <link rel="stylesheet" href="style.css" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
      integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
  </head>
  <body>
    <aside>
    <nav>
      <span class="nav_title">Menu</span>
      <ul>
        <li>
          <span><i class="fa-solid fa-house"></i></span
          ><a href="index.php">home</a>
        </li>
        <li >
          <span><i class="fa-solid fa-user-pen"></i></span
          ><a href="cashier-shift.php">assign shift</a>
        </li>
        <li class="active">
          <span><i class="fa-solid fa-utensils"></i></span
          ><a href="order.php" >search order</a>
        </li>
      </ul>
    </nav>
    </aside>
    <main>
      <header class="search-order">
        <h1>Order details</h1>
      </header>
      <section>
      <?php 
        if ($_SERVER["REQUEST_METHOD"] == "POST"){
            $conn=mysqli_connect('localhost', 'root', '','chefexpress');
            if (!$conn) {
            echo "Unable to connect to the database server at this time";
            exit(0);
            }
            $orderNum=$_POST['order-num'];
            if ($orderNum!=NULL){
              $sql_order_details="SELECT o.orderNum, o.shiftNum , o.shiftDate, o.payment , o.cashierNum ,c.customerNum, c.name,e.name as employeeName
                                  FROM Customer c, Orders o, CoursesInOrder cio,Employee e
                                  WHERE c.customerNum = o.customerNum AND
                                  o.orderNum=$orderNum AND o.orderNum = cio.orderNum AND o.cashierNum = e.employeeNum";

              $rs_details=mysqli_query($conn,$sql_order_details);
              if($row= mysqli_fetch_array($rs_details))
              { 
                echo "<div class='order_details'>";
                  echo "<div class='details'>";
                  echo "<h2>General details</h2>";
                  echo "<div class='detail'><span>Order Number</span><span>{$row['orderNum']}</span></div>";
                  echo "<div class='detail'><span>Payment</span><span>{$row['payment']}</span></div>";
                  echo "<div class='detail'><span>Customer</span><span>{$row['name']} / {$row['customerNum']}</span></div>";
                  echo "<div class='detail'><span>Shift</span><span>{$row['shiftDate']} / {$row['shiftNum']}</span></div>";
                  echo "<div class='detail'><span>Cashier</span><span>{$row['employeeName']} / {$row['cashierNum']}</span></div>";
                  echo "</div>";
                echo "<div class='details'>";
                echo "<h3>Courses in order</h3>";

                $sql_courses="Select distinct(cio.courseNum), c.name, c.courseDesc, c.price ,cio.quantity,(c.price * cio.quantity) as total
                              From Coursesinorder  cio inner join Course c 
                              ON cio.courseNum= c.courseNum
                              where cio.orderNum={$orderNum}";
                              

                $rs_courses=mysqli_query($conn,$sql_courses); 
                $total=0;
                
                while($row=mysqli_fetch_array($rs_courses)){
                      echo "<div class='course'>";
                        echo "<div class='detail'><span>Number</span><span>{$row['courseNum']}</span></div>";
                        echo "<div class='detail'><span>Name</span><span>{$row['name']}</span></div>";
                        echo "<div class='detail'><span>Description</span><p>{$row['courseDesc']}</p></div>";
                        echo "<div class='detail'><span>Price</span><span>{$row['price']}</span></div>";
                        echo "<div class='detail'><span>Quantity</span><span>{$row['quantity']}</span></div>";
                      echo "</div>";
                      $total=$total+$row['total'];
              }
                echo "</div>";
                echo "<div class='total'>";
                echo "<h4>Total Price</h4>";
                echo "<div >{$total}</span></div>";
                echo "</div>";
                echo "<a href='order.php' class='btn' style='margin:unset;margin-block-end:var(--size-4)'>search for another order<i class='fa-solid fa-arrow-right-long'></i></a>";
                echo "</div>";
              }else{
                    echo "<p class='error'>No such order number exists!</p>";
                    echo "<a href='order.php' class='btn'>Try different order number<i class='fa-solid fa-arrow-right-long'></i></a>";
              }
        }else{
          echo "<p class='error'>you must enter a valid order number</p>";
          echo "<a href='order.php' class='btn'>Click to go back<i class='fa-solid fa-arrow-right-long'></i></a>";
        }}
      ?>
      </section>
    </main>
  </body>
</html>
