<?php
namespace globals {

        /* Global namespace for all global variables*/

    class globals {

        /*SHA key variable
            * 
            * Used as a key for encypting requests for verification*/
        public static $shaKey = "gHjHGhJhGyJnMjYHU";

            /*Error code array
            * 
            * 101 = a request has been made too many times in a specified time frame.
            * 102 = a successful request has been made
            * 103 = the request failed with a specified message*/
        public static $errorCodes = array(
            "request-limit" => 101,
            "success" => 102,
            "failed" => 103
        );

    }

}
?>