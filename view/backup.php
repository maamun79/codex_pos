<?=mi_header();?>
<?php
if (base64_decode($_SESSION['session_type']) !== "mi_1" &&
    base64_decode($_SESSION['session_type']) !== "mi_2"){
    mi_redirect(MI_BASE_URL.'logout.php');
}
?>

<?=mi_sidebar();?>

<div class="main-panel">
    <?=mi_nav();?>

    <div class="content">
        <?php
            if (!empty(mi_get_session('alert'))  && count(mi_get_session('alert'))>0){
                echo mi_notifier(mi_get_session('alert')['msg'], mi_get_session('alert')['status']);
                mi_unset('alert');
            }
        ?>
        <div class="card">
            <div class="card-body table-responsive">
                <div class="row">
                    <div class="col-md-4">
                        <h6 class="card-title p-2">Export</h6>
                        <form action="actions.php" method="post">
                            <button type="submit" class="btn btn-lg btn-info btn-block" name="backup_export" value="1">
                                Generate Backup <i class="nc-icon nc-cloud-download-93 ml-3"></i>
                            </button>
                        </form>
                    </div>
                    <div class="col-md-8">
                        <h6 class="card-title p-2">Exported Files</h6>
                        <table class="table table-bordered table-full-width">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Backup Name</th>
                                <th>Backup Time</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $dir = 'backup';
                            if (is_dir($dir)) {
                                if ($dh = opendir($dir)) {
                                    $i = 1;
                                    while (($file = readdir($dh)) !== false) {
                                        if (!empty($file) && strlen($file) > 10 && $i < 6){
                                            $name = str_replace('.mi', '', $file);
                                            echo '<tr>';
                                            echo '<td>'.$i.'</td>';
                                            echo '<td>'.$name.'</td>';
                                            echo '<td>'.date('d M, Y - h:i:s A', filemtime('backup/'.$file)).'</td>';
                                            echo '<td>
                                                                    <a class="btn btn-info btn-sm" href="'.MI_BASE_URL.'backup/'.$file.'" title="Download" download>
                                                                        <i class="fa fa-download"></i>
                                                                    </a>
                                                                    <button id="removeBackup" class="btn btn-sm btn-danger removeBackup" title="Delete" value="'.$file.'">
                                                                        <i class="fa fa-trash"></i>
                                                                    </button>
                                                                  </td>';
                                            echo '</tr>';
                                            $i++;
                                        }
                                    }
                                    closedir($dh);
                                }
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <h5 class="card-title p-2">Import</h5>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <form action="actions.php" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-10 pr-0">
                                        <input type="file" name="backup_file" class="form-control" placeholder="Choose file" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                    </div>
                                    <div class="col-md-2 pl-0">
                                        <button type="submit" class="btn btn-success btn-block mt-0" name="backup_restore" value="1" type="button" style="height: 45px !important;">
                                            Import <i class="nc-icon nc-cloud-upload-94"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


<?=mi_footer();?>

    <script>
        $('.removeBackup').on('click', function (e) {
            e.preventDefault();
            var file =  $('#removeBackup').val();

            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: 'actions.php',
                        type: 'POST',
                        data: {
                            backup_delete_request: 1,
                            file: file
                        },
                        success:function(data){
                            console.log(data);
                            var res = JSON.parse(data);
                            swal(
                                'Deleted!',
                                res.msg,
                                res.status
                            );
                            setTimeout(function () { location.reload(true); }, 1000);
                        },
                        error: function () {
                            console.log('Ajax not working');
                        }
                    });
                }else{
                    return false;
        }
        });
        });
    </script>
