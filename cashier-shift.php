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
        $conn=mysqli_connect('localhost', 'root', '','chefexpress');
        if (!$conn) {
        echo "Unable to connect to the database server at this time";
        exit(0);
        }
        echo "<form action='insert-shift.php' method='post'>";
        $sql="SELECT c.EmployeeNum 
                FROM Cashier c"; 
        $rs_employee=mysqli_query($conn,$sql);

        $sql_2="SELECT sd.ShiftDate,sd.ShiftNum
                  FROM Shiftindate sd
                  Order by sd.ShiftDate, sd.ShiftNum"; 
        $rs_shift_date=mysqli_query($conn,$sql_2);

        if (mysqli_num_rows($rs_shift_date) == 0 || mysqli_num_rows($rs_employee) == 0) {
        echo "<p>There is no data matching your request</p>" ;
        exit (0);
        }
        echo "<fieldset>
        <label for='cashier-number'>choose cashier by number</label>
        <select name='employee-num' id='cashier-number'>";
        while($row= mysqli_fetch_array($rs_employee))
        { 
          echo "<option value={$row['EmployeeNum']}>{$row['EmployeeNum']}</option>";
        }
        
        echo "</select>
              </fieldset>";
        echo "<fieldset>
        <label for='shift-num'>choose shift number</label>
        <select name='shift' id='shift-num'>";
        while($row= mysqli_fetch_array($rs_shift_date))
        { 
          echo "<option value='{$row['ShiftDate']} / {$row['ShiftNum']}'>Date: {$row['ShiftDate']} / Number: {$row['ShiftNum']}</option>";
        }
        echo "</select>
              </fieldset>";
        echo "<button type='submit' name='submit-btn'>Submit</button>";
        echo "</form>";
      ?>
      </section>
    </main>
  </body>
</html>
