<?php

    if (file_exists('setup')) {
        mi_redirect('setup');
    }

    $filename = basename($_SERVER['REQUEST_URI'], '?' . $_SERVER['QUERY_STRING']);

    if ($filename !== 'login.php'){
        if (!isset($_SESSION['session_id']) || empty($_SESSION['session_id'])){
            mi_redirect(MI_BASE_URL.'login.php');
        }
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="assets/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>
        Point of Sale
    </title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" media='all'/>
    <link href="assets/css/fontawesome.min.css" rel="stylesheet" media='all'>
    <!-- CSS Files -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" media='all'/>
    <link href="assets/css/paper-dashboard.css?v=2.0.0" rel="stylesheet" media='all'/>
    <link href="plugins/datatable/datatables.min.css" rel="stylesheet" media='all'/>
    <link href="plugins/select/bootstrap-select.min.css" rel="stylesheet" media='all'/>
    <link href="plugins/image_uplodify/fileinput.min.css" rel="stylesheet" media='all'/>
    <link href="plugins/iconpicker/fontawesome-iconpicker.min.css" rel="stylesheet" media='all'/>
    <link href="plugins/datepicker/datepicker.min.css" rel="stylesheet" media='all'/>
    <link href="plugins/calculator/creative.min.css" rel="stylesheet" media='all'/>
    <link href="plugins/fancybox/jquery.fancybox.min.css" rel="stylesheet" media='all'/>
    <link href="plugins/bootstrap-select/select2.min.css" rel="stylesheet" media='all'/>
    <link href="plugins/dropify/dist/css/dropify.min.css" rel="stylesheet" media='all'/>
    <link rel="stylesheet" href="assets/animate.min.css">

    <script src="assets/js/core/jquery.min.js"></script>
    <script src="plugins/sweetalert/sweetalert.min.js"></script>
    
    <?php
        function mi_notifier($msg, $con){
            if ($con == "error"){?>

                <script>
                    $(function() {
                        $(".mi_notify_msg_error").text("<?=$msg;?>");
                        $("#mi_notifier_global_error").addClass("show");
                        setInterval(function (){
                            $("#mi_notifier_global_error").removeClass("show");
                        }, 2000);
                    })
                </script>

            <?php }else{?>

                <script>
                    $(function() {
                        $(".mi_notify_msg_success").text("<?=$msg;?>");
                        $("#mi_notifier_global_success").addClass("show");
                        setInterval(function (){
                            $("#mi_notifier_global_success").removeClass("show");
                        }, 2000);
                    })
                </script>

            <?php }
        }
    ?>

</head>

<body class="" style="padding-top: 0;">
<div class="wrapper">