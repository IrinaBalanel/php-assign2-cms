<?php
session_start();
include ('reusable/conn.php');
include ('inc/functions.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = mysqli_real_escape_string($connect, $_POST['email']);
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE email = ? AND active = 'Yes' LIMIT 1";
    $stmt = $connect->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $record = $result->fetch_assoc();

        if (password_verify($password, $record['password'])) {
            $_SESSION['id'] = $record['id'];
            $_SESSION['email'] = $record['email'];
            header('Location: admin.php');
            exit();
        } else {
            set_message('Incorrect email and/or password', 'alert-danger');
            header('Location: login.php');
            exit();
        }
    } else {
        set_message('Incorrect email and/or password', 'alert-danger');
        header('Location: login.php');
        exit();
    }
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
    <?php include ('reusable/nav.php'); ?>
    <main>
        <section>
            <div class="section-header">
                <div class="container h-100 align-items-center d-flex">
                    <h2 class="section-header-title text-white text-uppercase">Login</h2>
                </div>
            </div>
        </section>
        <section class="section-body">
            <div class="container">
                <?php get_message(); ?>
                <form method="post" style="max-width: 400px; margin:auto">
                    <div class="form-group mb-3">
                        <label class="form-label" for="email">Email:</label>
                        <input class="form-control" type="email" id="email" name="email" required>
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label" for="password">Password:</label>
                        <input class="form-control" type="password" id="password" name="password" required>
                    </div>
                    <div class="form-group mt-4">
                        <button class="btn btn-primary" type="submit">Login</button>
                    </div>
                </form>
            </div>
        </section>
    </main>
    <?php include ('reusable/scripts.php'); ?>
</body>

</html>