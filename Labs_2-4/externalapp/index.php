<?php
    
    session_start();
    if (!isset($_SESSION['username']) && !isset($_SESSION['id'])) {
        header('location:login.php'); 
    }

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Jekyll v3.8.5">
  <title>Orders</title>

  <link rel="canonical" href="https://getbootstrap.com/docs/4.3/examples/album/">

  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
  </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
  </script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
  </script>
  <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
  <script src="placeorder.js"></script>


</head>

<body>
  <header>

    <div class="navbar navbar-dark bg-dark shadow-sm">
      <div class="container d-flex justify-content-between">
        <a href="#" class="navbar-brand d-flex align-items-center">
          <strong>Orders</strong>
        </a>
        </button>
      </div>
    </div>
  </header>

  <main role="main">

    <div class="album py-5 bg-light">
      <div class="container">

        <div class="p-2 m-3 bg-transparent card text-center rounded shadow-lg">
<div class="card-header">

            <h3 class="card-text">Place an Order</h3> 
</div>
          <div class="card-body">

              <form name="order_form" id="order_form" class="form-signin"> 
                  <input type="text" name="name_of_food" id="name_of_food" class="form-control col-10 my-1"
                    placeholder="Food Name" required >
                  <input type="number" name="number_of_units" id="number_of_units" class="form-control col-10 my-1"
                    placeholder="Amount" required>  
                  <input type="number" name="unit_price" id="unit_price" class="form-control col-10 my-1"
                    placeholder="Unit Price" required>
                  <input type="hidden" name="status" id="status" class="form-control col-5 m-1" placeholder="Unit Price"
                    required value="Order Placed">

                  <button id="btn-place-order" class="btn btn-lg btn-primary col-5 my-1" style="margin: 20px;"
                    type="submit">Place Order</button>
              </form> 
          </div>
        </div>
        <div class="card card-sm col-6 shadow">
          <div class="card-header">
            <h3 class="card-text">Check Order Status</h3>
          </div>
          <div class="card-body">
            <form name="order_status_form" id="order_status_form" class="form-signin">
              <input id="order_id" name="order_id" type="number" class="form-control my-1" placeholder="Order ID" required
                 >
              <button id="btn-check-order" class="btn btn-lg btn-warning my-1" type="submit">Check
                Order Status</button>
            </form>
          </div>
        </div>
      </div>
    </div>

  </main>



  </div>


</body>

</html>