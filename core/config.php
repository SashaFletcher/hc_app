<?php
  /**
   * Shows/Hides PHP errors & Warnings
   */
  // ini_set('display_errors', 1);
  // error_reporting(E_ALL);

    /**
     * Sets the SESSION parameters for security
     * 
     * cookie_httponly = Prevents javascript XSS attacks aimed to steal the session ID
     * cookie_secure = Uses a secure connection (HTTPS) if possible
     */
    ini_set('session.cookie_httponly', 1);
    ini_set('session.cookie_secure', 1);

    /**
     * Security headers as defined by AP-34
     */
    header("X-Frame-Options: SAMEORIGIN");
    header("X-XSS-Protection: 0");
    header('X-Content-Type-Options: nosniff');
    header("Referrer-Policy: no-referrer");

  /**
   * Starts a new session
   */
  session_start();
  
  /**
   * Sets the timezone to always be Europe/London
   */
  date_default_timezone_set('Europe/London');

  /**
   * If there is no CSRF token created, because a new user or session expired, create the new token and save it to the session
   */
  if(empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
  }

  /**
   * Controller configuration file
   */
  require_once $_SERVER['DOCUMENT_ROOT'] . '/controllers/config.php';
  
  use \cookies\cookies;
  $cookies = new cookies;

  if(isset($_GET['signout'])) {
    $cookies->_kill();
  }
?>