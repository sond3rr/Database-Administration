<?php
include("connect.php");

$successMsg = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $birthDay = $_POST["birthDay"];

    $insert = "INSERT INTO userInfo (firstName, lastName, birthDay) VALUES ('$firstName', '$lastName', '$birthDay')";
    
    if (executeQuery($insert)) {
        $successMsg = "User successfully added!";
    }
}

$query = "SELECT * FROM userInfo";
$result = executeQuery($query);
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>User List</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #FFF9E3;
      padding-bottom: 80px;
    }
    .center-container {
      border: 2px solid #1c1c1c;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      background-color: #f8f9fa;
      margin-bottom: 30px;
    }
    .border-container {
      display: flex;
      flex-direction: column;
      align-items: center;
    }
    .logo-img {
      width: 40px;
      height: 40px;
      margin-right: 10px;
    }
    .success-message {
      color: green;
      margin-top: 15px;
    }
  </style>
</head>

<body>
  <div class="container-fluid mb-5 p-3 d-flex align-items-center" style="background-color: #1c1c1c; color: white">
    <img src="man.png" style="width: 50px; height: auto; margin-right: 15px;">
  </div>

  <div class="container border-container mb-5">
    <div class="col-lg-8 center-container">
      <h2 class="text-center">Add New User</h2>
      <form method="POST" action="">
        <div class="mb-3">
          <label for="firstName" class="form-label">First Name</label>
          <input type="text" class="form-control" id="firstName" name="firstName" required>
        </div>
        <div class="mb-3">
          <label for="lastName" class="form-label">Last Name</label>
          <input type="text" class="form-control" id="lastName" name="lastName" required>
        </div>
        <div class="mb-3">
          <label for="birthDay" class="form-label">Birthday</label>
          <input type="date" class="form-control" id="birthDay" name="birthDay" required>
        </div>
        <button type="submit" class="btn btn-secondary" style="background-color: #1c1c1c">Add User</button>
      </form>

      <?php
      if ($successMsg) {
          echo "<p class='success-message'>$successMsg</p>";
      }
      ?>
    </div>
  </div>

  <div class="container border-container">
    <div class="col-lg-8 center-container">
      <h2 class="text-center">User List</h2>
      <div class="row">
        <?php
        if (mysqli_num_rows($result)) {
            while ($user = mysqli_fetch_assoc($result)) {
                echo "<div class='col-12'>
                        <div class='card rounded-3 my-3' style='border: 2px solid #D3d3d3; background-color: #FFF9E3; padding: 20px;'>
                          <div class='card-body d-flex align-items-center'>
                            <img src='user.png' class='logo-img'>
                            <div>
                              <h5 class='card-title mb-1'>{$user['firstName']} {$user['lastName']}</h5>
                              <p class='card-text mb-0' style='color: #716868'>{$user['birthDay']}</p>
                            </div>
                          </div>
                        </div>
                      </div>";
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
    <p class="text-center text-muted">© 2024 Company, Inc</p>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
