<?php
  include('reusable/conn.php');
  include('inc/functions.php');

  if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $query = 'SELECT * FROM users WHERE email = ? AND password = ? LIMIT 1';
    $stmt = $connect->prepare($query);
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $record = $result->fetch_assoc();
        $_SESSION['id'] = $record['id'];
        $_SESSION['name'] = $record['name'];
        $_SESSION['email'] = $record['email'];
        header('Location: admin.php');
        die();
    } else {
        set_message('No records found!', 'danger');
        header('Location: login.php');
        die();
    }

    $stmt->close();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Public Art Gallery</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="assets/css/styles.css">
</head>

<body>
    <header>
    <nav class="navbar navbar-expand-lg position-relative p-0 h-100">
        <div class="container">
            <a class="navbar-brand" href="login.php"><img src="./assets/images/logo.png" alt="Galleria-Logo" /></a>
        </div>
    </nav>
    </header>
    <main>
        <section class="section-body">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-6 col-lg-5 p-2 p-5 shadow rounded">
                        <h2 class="mb-4">Login</h2>
                        <form method="POST" action="login.php">
                            <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" class="form-control" name="email" id="email">
                            </div>
                            <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" name="password" id="password">
                            </div>
                            <button type="submit" class="btn btn-primary" name="login">
                                <svg height="45.6" width="125.738"><rect height="45.6" width="125.738"></rect></svg>
                                <span class="btn-text">Login</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <?php include ('reusable/scripts.php'); ?>
</body>

</html>