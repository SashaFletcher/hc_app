<?php

    require_once $_SERVER['DOCUMENT_ROOT'] . '/core/config.php';

    use \stats\stats;
    use \user\user;
    
    $cookies->_check('signedin');
    $stats = new stats;
    $user = new user;
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Home </title>
<meta charset="utf-8">
<meta name="csrf-token" content="<?php echo $_SESSION['csrf_token']; ?>">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="css/dashboard.css" />
</head>
<body>

<div class="container-fluid">

    <?php include 'views/header.php'; ?>

    <div class="row">

        <?php include 'views/sidebar.php'; ?>

        <main role="main" class="col-md-11 ml-sm-auto">

            <div class="row">

                <div class="col-12">
                    <h2>Welcome, <?php echo $user->_get()->firstname; ?></h1>
                </div>
            
            </div>
        
        </main>

    </div>

</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/165d8d35ed.js" crossorigin="anonymous"></script>

<script type="text/javascript">
var shownNotification = false;

function createHash(dataArray, csrfToken, returned) {

    return $.ajax({
        url: '/script/createHash',
        type: 'POST',
        data: {
            array: dataArray,
            csrfToken: csrfToken
        },
        headers: {
            'CsrfToken': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            returned["shaSigned"] = response;
        }
    });

}

</script>

</body>
</html>