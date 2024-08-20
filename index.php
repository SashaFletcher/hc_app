<?php
    use login\login;
    
    require_once $_SERVER['DOCUMENT_ROOT'] . '/core/config.php';
    
    $login = new login();
    if(isset($_POST['signin'])) {
        $login = $login->_run($_POST);
    }
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Index </title>
<meta name="theme-color" content="#702d90">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<link href="css/login.css" rel="stylesheet" type="text/css">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body class="text-center">

<div class="container">

    <form method="POST" action="" class="form-signin text-center" autocomplete="off">

        <img class="mb-4" src="/imgs/logos/logo.jpg" alt="Logo" style="max-height: 75px; max-width: 95%;">

        <h1 class="h5 mb-3 font-weight-normal">Please sign in</h1>

<?php
        if(isset($_POST['signin'])) {

            echo '<div class="mb-3 alert alert-danger bg-danger text-left text-light" role="alert"><p class="mb-0">' . $login . '</p></div>';

        }
?>
        
        <div class="input-group mb-3">
            <label for="inputEmail" class="sr-only">Email address</label>
            <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email address" required value="<?php if(isset($_POST['signin'])) echo $_POST['email']; ?>">
        </div>
    
        <div class="input-group mb-3">
            <label for="inputPassword" class="sr-only">Password</label>
            <input type="password" name="pass" id="inputPassword" class="form-control" placeholder="Password" required value="<?php if(isset($_POST['signin'])) echo $_POST['pass']; ?>">
        </div>

        <div class="input-group input-group-sm mb-3">
            <button class="btn btn-success btn-block" type="submit" name="signin">Sign in</button>
        </div>

        <p class="text-muted">&copy; <a href="#" target="_blank">HealthCare App</a> 2024</p>

    </form>

</div>
	
<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</body>
</html>