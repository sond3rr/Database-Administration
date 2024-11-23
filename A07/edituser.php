<?php
include("connect.php");

$id = $_GET['id'];
$successMsg = '';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['btnEdit'])) {
  $firstName = $_POST['firstName'];
  $lastName = $_POST['lastName'];
  $birthDay = $_POST['birthDay'];

  $editQuery = "UPDATE userInfo SET firstName='$firstName', lastName='$lastName', birthDay='$birthDay' WHERE userInfoID='$id'";
  if (executeQuery($editQuery)) {
    $successMsg = "User updated successfully!";
    header("Location: ./");
    exit;
  }
}

$query = "SELECT * FROM userInfo WHERE userInfoID='$id'";
$result = executeQuery($query);
$user = mysqli_fetch_assoc($result);
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Edit User</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
  <div class="container mt-5">
    <div class="card shadow p-5">
      <h3 class="text-center">Edit User</h3>
      <?php if ($successMsg) {
        echo "<p class='text-success'>$successMsg</p>";
      } ?>
      <form method="POST">
        <div class="mb-3">
          <label for="firstName" class="form-label">First Name</label>
          <input type="text" class="form-control" id="firstName" name="firstName" value="<?php echo ($user['firstName']); ?>" required>
        </div>
        <div class="mb-3">
          <label for="lastName" class="form-label">Last Name</label>
          <input type="text" class="form-control" id="lastName" name="lastName" value="<?php echo ($user['lastName']); ?>" required>
        </div>
        <div class="mb-3">
          <label for="birthDay" class="form-label">Birthday</label>
          <input type="date" class="form-control" id="birthDay" name="birthDay" value="<?php echo ($user['birthDay']); ?>" required>
        </div>
        <button type="submit" class="btn btn-success" name="btnEdit">Save Changes</button>
        <a href="./" class="btn btn-secondary">Cancel</a>
      </form>
    </div>
  </div>
</body>

</html>