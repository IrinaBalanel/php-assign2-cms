<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Public Art Gallery</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" 
            integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" 
            integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="assets/css/styles.css">
    </head>
    <body>
        <?php
            include('reusable/nav.php');

            include( 'inc/conn.php' );
            include( 'inc/functions.php' );
        
            if( isset( $_POST['email'] ) ) {
            
                $query = 'SELECT *
                    FROM users
                    WHERE email = "'.$_POST['email'].'"
                    AND password = "'.md5( $_POST['password'] ).'"
                    AND active = "Yes"
                    LIMIT 1';
                $result = mysqli_query( $connect, $query );
                
                if( mysqli_num_rows( $result ) )
                {
                    
                    $record = mysqli_fetch_assoc( $result );
                    
                    $_SESSION['id'] = $record['id'];
                    $_SESSION['email'] = $record['email'];
                    
                    header( 'Location: admin.php' );
                    die();
                    
                }
                else
                {
                    
                    set_message( 'Incorrect email and/or password' );
                    
                    header( 'Location: login.php' );
                    die();
                    
                } 
            
            }
        ?>
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
                    <form method="post" style="max-width: 400px; margin:auto">
                        <div class="form-group col-12 col-md-6 mb-3">    
                            <label class="form-label" for="email">Email:</label>
                            <input class="form-control" type="text" id="email" name="email" required>
                        </div>
                        <div class="form-group col-12 col-md-6 mb-3">    
                            <label class="form-label" for="password">Password:</label>
                            <input class="form-control" type="password" id="password" name="password" required>
                        </div>
                        <div class="form-group col-12 mt-4">
                            <button class="btn btn-primary" type="submit">
                                <svg height="45.6" width="125.738"><rect height="45.6" width="125.738"></rect></svg>
                                <span class="btn-text">Login</span>
                            </button>
                        </div>
                    </form>
                </div>
            </section>
        </main>
    </body>
</html>