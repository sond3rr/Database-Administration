<?php
include("connect.php");

$successMsg = '';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['addUser'])) {
  $firstName = $_POST["firstName"];
  $lastName = $_POST["lastName"];
  $birthDay = $_POST["birthDay"];

  $insert = "INSERT INTO userInfo (firstName, lastName, birthDay, isDeleted) VALUES ('$firstName', '$lastName', '$birthDay', 'no')";
  if (executeQuery($insert)) {
    $successMsg = "User successfully added!";
  }
}

if (isset($_POST['deleteUserId'])) {
  $deleteId = $_POST['deleteUserId'];
  $softDelete = "UPDATE userInfo SET isDeleted='yes' WHERE userInfoID=$deleteId";
  if (executeQuery($softDelete)) {
    $successMsg = "User deleted.";
  }
}

$query = "SELECT * FROM userInfo WHERE isDeleted='no'";
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
        <button type="submit" class="btn btn-secondary" style="background-color: #1c1c1c" name="addUser">Add User</button>
      </form>
    </div>
  </div>

  <div class="container border-container">
    <div class="col-lg-8 center-container">
      <h2 class="text-center">User List</h2>
      <?php if ($successMsg) {
        echo "<p class='success-message'>$successMsg</p>";
      } ?>
      <div class="row">
        <?php if (mysqli_num_rows($result)) {
          while ($user = mysqli_fetch_assoc($result)) { ?>
            <div class="col-12">
              <div class="card rounded-3 my-3" style="border: 2px solid #D3d3d3; background-color: #FFF9E3; min-height: 100px; padding: 20px;">
                <div class="card-body d-flex align-items-center">
                  <div>
                    <h5 class="card-title mb-1">
                      <?php echo ($user["firstName"]) . " " . ($user["lastName"]); ?>
                    </h5>
                    <p class="card-text mb-0" style="color: #716868">
                      <?php echo ($user["birthDay"]); ?>
                    </p>
                  </div>
                  <div class="ms-auto d-flex gap-2">
                    <form method="POST" action="" class="ms-3 mb-0">
                      <input type="hidden" name="deleteUserId" value="<?php echo $user['userInfoID']; ?>">
                      <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                    <form method="GET" action="edituser.php" class="ms-3 mb-0">
                      <input type="hidden" name="id" value="<?php echo $user['userInfoID']; ?>">
                      <button type="submit" class="btn btn-primary">Edit</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
        <?php }
        } ?>
      </div>
    </div>
  </div>
</body>

</html>