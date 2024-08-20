<?
    session_start();
    $headers = apache_request_headers();

    if(!isset($headers['Csrftoken'])) {

        /*
            Throw a 401 Unauthorised error if the CSRF Tokens do not match
        */
        header("HTTP/1.1 401 Unauthorized");
        exit;

    }

    if($headers['Csrftoken'] != $_SESSION['csrf_token']) {

        /*
            Throw a 401 Unauthorised error if the CSRF Tokens do not match
        */
        header("HTTP/1.1 401 Unauthorized");
        exit;

    }
            
    $str = $_POST['array'] . $_POST['csrfToken'] . "gHjHGhJhGyJnMjYHU";
    $sha512 = hash("sha512", $str);

    echo $sha512;
    die();
?>