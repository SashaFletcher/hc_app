<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/core/config.php';

    use \alerts\alerts;
    use \hcdata\hcdata;
    use \user\user;
    use deletedata\deletedata;

    /*$cookies->_check('signedin');*/
    $alerts = new alerts;
    $hcdata = new hcdata;

    if(isset($_POST['delete_hcdata'])) {
        $hcdata->data_delete($POST['delete_hcdata']);
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>page</title>
        <meta charset="utf-8">
        <meta name="csrf-token" content="<? echo $_SESSION['csrf-token']; ?>">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="css/">
        <style>
            .thw {
                width: 20%;
            }

            .bg-info {
                background-color: #91bcc3 !important;
            }
        </style>
    </head>
    <body>

        <div class="container-fluid">
            <div class="row">
                <main role="main" class="col-md-11 ml-sm-auto">

                    <div class="row">
                        <div class="col-md-12 pt-3">
                            <h2 class="pt-5 pl-5">Welcome to your Healthcare App</h2>
                            <hr>
                        </div>

                        <div class="col-md-12 mt-5">
                            <?php $alerts->_show($_GET); ?>
                        </div>

                        <div class="col-md-1"></div>

                        <div class="col-md-5">
                            <p>Your Healthcare Data:</p>
                            <div class="table-responsiive table-borderless">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="thw"></th>
                                            <th></th></th>
                                            <th></th>
                                        </tr>
                                    </thead>

                                    <tbody hc-data-info></tbody>
                                </table>
                            </div>
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
     
        $(function() { 
            
            loadMessages();
            
        });
        
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
                }, 
                error: function(xhr, ajaxOptions, thrownError) { 
                    
                    if(xhr.status == 401) {
                        window.location.replace("/commBanner/editCategory"); 
                        //echo response 
                    } 
                } 
            }); 
        } 
        
        function loadMessages() { 
            
            var returned = {}; 
            
            $.when( 
                createHash('messages', $('meta[name="csrf-token"]').attr('content'), returned)
            
            ).then(function() { 
                
                $.ajax({ 
                    url: '/script/hcdata',
                    type: 'POST', 
                    data: { 
                        shaSigned: returned.shaSigned, 
                    }, 
                    headers: { 
                        'CsrfToken': $('meta[name="csrf-token"]').attr('content')
                    }, 
                    
                    success: function(response) { 
                        
                        var html = ''; 
                        response = JSON.parse(response); 
                        
                        $.each(response, function(i, item) { 
                            html += '<tr>'; 
                                html += '<td><h6>First Name</h6></td>'; 
                                html += '<td class=" bg-info">' + item.first_name + '</td>'; 
                            html += '</tr>';
                            html += '<tr>'; 
                                html += '<td><h6>Last Name</h6></td>'; 
                                html += '<td class=" bg-info">' + item.last_name + '</td>'; 
                            html += '</tr>';
                            html += '<tr>'; 
                                html += '<td><h6>Email</h6></td>'; 
                                html += '<td class=" bg-info">' + item.email + '</td>'; 
                            html += '</tr>';
                            html += '<tr>'; 
                                html += '<td><h6>Phone Number</h6></td>'; 
                                html += '<td class=" bg-info">' + item.phone_number + '</td>'; 
                            html += '</tr>';
                            html += '<tr>'; 
                                html += '<td><h6>NHS Number</h6></td>'; 
                                html += '<td class=" bg-info">' + item.nhs_no + '</td>'; 
                            html += '</tr>';
                            html += '<tr>'; 
                                html += '<td><h6>Address</h6></td>'; 
                                html += '<td class=" bg-info">' + item.address + '</td>'; 
                            html += '</tr>';
                            html += '<tr>'; 
                                html += '<td><h6>Date of Birth</h1></h6></td>'; 
                                html += '<td class=" bg-info">' + item.dob + '</td>'; 
                            html += '</tr>';
                            html += '<tr>'; 
                                html += '<td><h6>Gender</h1></h6></td>'; 
                                html += '<td class=" bg-info">' + item.gender + '</td>'; 
                            html += '</tr>';
                            html += '<tr>'; 
                                html += '<td align="right" class="thw">'; 
                                    html += '<a href="editdata?i=' + item.id + '">';
                                        html += '<button type="button" class="btn btn-link btn-save">Edit data </button>'; 
                                    html += '</a> ';
                                html += '</td>';
                                html += '<td>';
                                    html += '<form action="deleteData.php" method="post" class="del-btn">';
                                        html += '<button type="submit" name="delete_hcdata" value="' + item.id + '" class="btn btn-xl btn-primary">Delete Data</button>'; 
                                    html += '</form>'; 
                                html += '</td>';
                            html += '</tr>';
                        }); 
                            
                        $('[hc-data-info]').html(html); 
                        
                    },
                    
                    error: function(xhr, ajaxOptions, thrownError) {
                        if(xhr.status == 401) {
                            window.location.replace("/commBanner/newMessage"); 
                            //echo response 
                        } 
                    } 
                }); 
            }); 
        } 
    </script>
    </body>
</html>