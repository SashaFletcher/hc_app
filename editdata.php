<?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/core/config.php';

    use \hcdata\hcdata;

    //$cookies->_check('signedin');

    $hcdata = new hcdata;

    $hcedata = $hcdata->get($_GET['i']);
    
    if(isset($_POST['saveMessage'])) {
        $hcdata->save($_POST);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Edit Data</title>
<meta charset="utf-8">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="/commBanner/css/dashboard.css" />
</head>
<body class="mess-form">

<div class="container-fluid con-fluid">

    <? include 'views/header.php'; ?>

    <div class="row mess-form-row">

        <?php include 'views/sidebar.php'; ?>

            <div class="col-md-11 ml-sm-auto">

                <div class="p-2">

                    <div class="col-md-12 mt-5">
                        <h2>Edit Data</h2>
                        <p>Edit your informaation here:</p>
                    </div>

                    <form action="" method="POST" class="row pb-5">

                        <div class="col-md-6">

                            <div class="form-group">
                                <label for="first_name">First Name</label>
                                <input type="text" name="firstname" class="form-control" id="first_name" value="<?php echo $hcedata->first_name; ?>">
                            </div>
                            <div class="form-group">
                                <label for="Last Name">Password</label>
                                <input type="text" name="lastname" class="form-control" id="Last Name" value="<?php echo $hcedata->last_name; ?>">
                            </div>
                            <div class="form-group">
                                <label for="Email">Email address</label>
                                <input type="text" name="email" class="form-control" id="Email" aria-describedby="emailHelp" value="<?php echo $hcedata->email; ?>">
                                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                            </div>
                            <div class="form-group">
                                <label for="phone_number">Phone Number</label>
                                <input type="text" name="phone" class="form-control" id="phone_number" value="<?php echo $hcedata->phone_number; ?>">
                            </div>
                            <div class="form-group">
                                <label for="nhs_no">NHS Number</label>
                                <input type="text" name="nhsno" class="form-control" id="nhs_no"  value="<?php echo $hcedata->nhs_no; ?>">
                            </div>
                            <div class="form-group">
                                <label for="address">Address</label>
                                <textarea type="text" name="address" class="form-control" id="address"><?php echo $hcedata->address; ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="dob">Date of Birth</label>
                                <input type="text" name="dob" class="form-control" id="dob"  value="<?php echo $hcedata->dob; ?>">
                        
                            </div>
                            <div class="form-group">
                                <label for="gender">Gender</label>
                                <input type="text" name="gender" class="form-control" id="gender" value="<?php echo $hcedata->gender; ?>">
                            </div>


                            <hr />
                            
                            <div class="form-group">
                                <hr />
                                <input type="submit" name="saveMessage" class="btn btn-xl btn-save" value="Save Message">
                                <a href="message" class="float-right"><button type="button" class="btn btn-primary">Back</button></a>
                            </div>

                        </div>

                        <input type="hidden" name="id" value="<?php echo $hcedata->id; ?>">

                    </form>
                
                </div>

            </div>


</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/165d8d35ed.js" crossorigin="anonymous"></script>
<script src="https://cdn.tiny.cloud/1/np578xheem9fd8af1uadzxjstd1goqa8g2eri7ozyd39ukzp/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
        /*$(function() {

            tinymce.init({
            selector: 'textarea',
            browser_spellcheck: true,
            plugins: '',
            toolbar: ' undo redo | bold italic underline | link | tinycomments | backcolor forecolor fontsize | removeformat',
            tinycomments_mode: 'embedded',
            tinycomments_author: 'Author name',
            font_size_formats: '8pt 10pt 12pt 14pt 16pt 18pt 24pt 36pt 48pt 60pt 72pt 96pt',
            mergetags_list: [
                { value: 'First.Name', title: 'First Name' },
                { value: 'Email', title: 'Email' },
            ],
            ai_request: (request, respondWith) => respondWith.string(() => Promise.reject("See docs to implement AI Assistant"))

            });

        });*/
</script>

</body>
</html>