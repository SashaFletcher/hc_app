<?php
    namespace alerts {

        class alerts {

            function __construct() { }

            /**
             * Public function _show
             * Shows an alert based on the _GET value
             */
            public function _show($get) {
                
                if(isset($get['success'])) {
                    $alert = '
                        <div class="alert alert-success" role="alert">
                            Your request was completed successfully
                        </div>
                    ';

                }

                if(isset($get['error'])) {

                    $alert = '
                        <div class="alert alert-danger" role="alert">
                            An error occurred, please try again.
                        </div>
                    ';

                }

                if(!empty($alert)) {

                    echo '
                        <div class="col-12 mt-3">
                            ' . $alert . '
                        </div>
                    ';

                }

            }

        }

    }
?>