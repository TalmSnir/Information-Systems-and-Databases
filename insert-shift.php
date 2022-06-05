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
        <li class="active">
          <span><i class="fa-solid fa-user-pen"></i></span
          ><a href="cashier-shift.php">assign shift</a>
        </li>
        <li>
          <span><i class="fa-solid fa-utensils"></i></span
          ><a href="order.php">search order</a>
        </li>
      </ul>
    </nav>
    </aside>
    <main>
      <header class="select-shift">
        <h1>Select shift</h1>
      </header>
      <section class="assign-shift">
      <?php 
        if ($_SERVER["REQUEST_METHOD"] == "POST"){
            $conn=mysqli_connect('localhost', 'root', '','chefexpress');
            if (!$conn) {
            echo "Unable to connect to the database server at this time";
            exit(0);
            }
            $employee_num=$_POST['employee-num'];
            $shift=explode("/", $_POST['shift']);
            $shiftDate=trim($shift[0]," ");
            $shiftNum=trim($shift[1]," ");
    
            $sql_check="Select count(*) as amount
                    From Cashiersinshifts as cis
                    Where cis.shiftDate='$shiftDate' and cis.shiftNum='$shiftNum' and cis.CashierNum='$employee_num'";
            $rs_already_in=mysqli_query($conn,$sql_check);

            if (mysqli_fetch_array($rs_already_in)['amount']==0){
                $sql_insert="Insert into Cashiersinshifts (CashierNum,shiftDate,shiftNum)
                Values ('$employee_num','$shiftDate','$shiftNum')";
                $rs_insert=mysqli_query($conn,$sql_insert);
                if ($rs_insert){
                    echo "<p class='success'>Shift assigned successfully!</p>";
                    echo "<a href='cashier-shift.php' class='btn'>Assign more <i class='fa-solid fa-arrow-right-long'></i></a>";
                }
                else{
                    echo "<p class='error'>Shift assignment failed!</p>";
                    echo "<a href='cashier-shift.php' class='btn'>Try again <i class='fa-solid fa-arrow-right-long'></i></a>";
                }
            }
            else{
                echo "<p class='warning'>Shift already assigned!</p>";
                echo "<a href='cashier-shift.php' class='btn'>Try different shift or employee <i class='fa-solid fa-arrow-right-long'></i></a>";
            }
            
        }
      ?>
      </section>
    </main>
  </body>
</html>
