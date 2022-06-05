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
        <li>
          <span><i class="fa-solid fa-user-pen"></i></span>
          <a href="cashier-shift.php">assign shift</a>
        </li>
        <li class="active">
          <span><i class="fa-solid fa-utensils"></i> </span
          ><a href="order.php" >search order</a>
        </li>
      </ul>
    </nav>
    </aside>
    <main>
      <header>
        <h1>Search for order</h1>
      </header>
      <section class="order">
        <form action="search-order.php" method="post">
          <fieldset>
            <label for="order-number">enter order number</label>
            <input name="order-num" id="order-number" placeholder='search for order' type='number'/ >
          </fieldset>
          <button type="submit">Submit</button>
        </form>
      </section>
    </main>
  </body>
</html>
