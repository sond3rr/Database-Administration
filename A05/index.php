<?php
include("connect.php");

$query = "SELECT * FROM userInfo";
$result = executeQuery($query);
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>User List</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

  <style>
    body {
      background-color: #FFF9E3;
      padding-bottom: 80px; 
    }
    .center-container {
      border: 2px solid #1c1c1c;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
      background-color: #f8f9fa;
      border: 2px solid #36454f;
      margin-bottom: 30px; 
    } 
    .border-container {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: flex-start; 
      padding-top: 20px; 
    }
    .logo-img {
      width: 40px; 
      height: 40px;
      margin-right: 10px;
    }
    .footer {
      position: absolute;
      bottom: 0;
      width: 100%;
      text-align: center;
      padding: 20px;
      background-color: #1c1c1c; 
      color: white;
    }
  </style>
</head>

<body>
<div class="container-fluid mb-5 p-3 d-flex align-items-center" style="background-color: #1c1c1c; color: white">
  <img src="man.png" alt="Logo" style="width: 50px; height: auto; margin-right: 15px;">
</div>


  <div class="container border-container">
    <div class="col-lg-8 center-container">
      <h2 class="text-center">User List</h2>
      <div class="row"> 
      <?php
      if (mysqli_num_rows($result)) {
        while ($user = mysqli_fetch_assoc($result)) {
          ?>
          <div class="col-12">
            <div class="card rounded-3 my-3" style="border: 2px solid #D3d3d3; background-color: #FFF9E3; min-height: 100px; padding: 20px;">
              <div class="card-body d-flex align-items-center">
                <img src="user.png" alt="User Logo" class="logo-img">
                <div>
                  <h5 class="card-title mb-1">
                    <?php echo ($user["firstName"]) . " " . ($user["lastName"]); ?>
                  </h5>
                  <p class="card-text mb-0" style="color: #716868">
                    <?php echo ($user["birthDay"]); ?>
                  </p>
                </div>
              </div>
            </div>
          </div>
          <?php
        }
      }
      ?>
      </div>
    </div>
  </div>

  <footer class="py-3 my-4">
    <ul class="nav justify-content-center border-bottom pb-3 mb-3">
      <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Home</a></li>
      <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Features</a></li>
      <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Pricing</a></li>
      <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">FAQs</a></li>
      <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">About</a></li>
    </ul>
    <p class="text-center text-muted">© 2021 Company, Inc</p>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
</body>

</html>
