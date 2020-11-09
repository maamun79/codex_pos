<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-absolute fixed-top navbar-transparent" style="padding-bottom: 5px">
    <div class="container-fluid">
        <div class="navbar-wrapper">
            <div class="navbar-toggle">
                <button type="button" class="navbar-toggler">
                    <span class="navbar-toggler-bar bar1"></span>
                    <span class="navbar-toggler-bar bar2"></span>
                    <span class="navbar-toggler-bar bar3"></span>
                </button>
            </div>
            <a class="btn btn-primary btn-sm mi_title_btn" style="text-transform: uppercase;display: none;" href="index.php"><i class="nc-icon nc-minimal-left" style="font: normal normal bolder 14px/1 'nucleo-icons';"></i>&nbsp;<label style="line-height: 0;">Back to Dashboard</label></a>&nbsp;&nbsp;
            <a class="navbar-brand mi_titles_page" style="text-transform: uppercase;"></a>
        </div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navigation">

            <ul class="navbar-nav">
                <li>
                    <a href="profile.php" style="padding: 2px 7px;display: block;border: 2px solid #51cbce;color: #51cbce;margin-right: 20px;border-radius: 100px;">
                        <i class="nc-icon nc-single-02" style="font: normal normal bolder 14px/1 'nucleo-icons';font-size: 22px;line-height: 1.5;"></i>
                    </a>
                </li>
                <li>
                    <a class="btn btn-primary m-0 sales_pg" style="text-transform: uppercase;display: none;" href="sales.php"><label style="line-height: 0;">Go to Sales</label>&nbsp;<i class="nc-icon nc-minimal-right" style="font: normal normal bolder 14px/1 'nucleo-icons';"></i></a>
                </li>
            </ul>
        </div>
    </div>

    <div class="alert alert-success alert-dismissible fade" id="mi_notifier_global_success" style="position: absolute;right: 10px;top: 61px; display: none">
        <button type="button" aria-hidden="true" class="close" data-dismiss="alert" aria-label="Close">
            <i class="nc-icon nc-simple-remove"></i>
        </button>
        <span>
        <b> Success - </b> <label class="mi_notify_msg_success"></label></span>
    </div>
    <div class="alert alert-danger alert-dismissible fade" id="mi_notifier_global_error" style="position: absolute;right: 10px;top: 61px; display: none">
        <button type="button" aria-hidden="true" class="close" data-dismiss="alert" aria-label="Close">
            <i class="nc-icon nc-simple-remove"></i>
        </button>
        <span>
        <b> Error - </b> <label class="mi_notify_msg_error"></label></span>
    </div>
</nav>
<!-- End Navbar -->