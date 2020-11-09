<?=mi_header();?>
<?php
if (base64_decode($_SESSION['session_type']) !== "mi_1"){
    mi_redirect(MI_BASE_URL.'logout.php');
}

$details = mi_db_read_by_id('settings_meta', array('type'=>'shop_details'));
$currency = mi_db_read_by_id('settings_meta', array('meta_name'=>'shop_currency','type'=>'currency'))[0];
$shop_logo = mi_db_read_by_id('settings_meta', array('meta_name'=>'shop_logo','type'=>'image'))[0];
?>

<?=mi_sidebar();?>

    <div class="main-panel">
        <?=mi_nav();?>

        <div class="content">
            <div class="row">
                <?php foreach ($details as $data){?>
                    <div class="col-lg-4 col-md-6 col-sm-6" style="padding: 8px">
                        <div class="card card-stats">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-7 col-md-8">
                                        <div class="">
                                            <p><?=$data['meta_value']?></p>
                                        </div>
                                    </div>
                                    <div class="col-5 col-md-4">
                                        <div class="icon text-center icon-warning">
                                            <button class="btn" data-toggle="modal" data-target="#changeDetails<?=$data['id']?>" type="button">
                                                <i class="fa fa-edit text-warning"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer ">
                                <hr>
                                <div class="stats">
                                    <i class="fa fa-tag"></i> <?=ucwords(str_replace('_',' ', $data['meta_name']))?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php }?>


                <div class="col-lg-4 col-md-6 col-sm-6" style="padding: 8px">
                    <div class="card card-stats">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-7 col-md-8">
                                    <div class="">
                                        <p><?=$currency['meta_value']?></p>
                                    </div>
                                </div>
                                <div class="col-5 col-md-4">
                                    <div class="icon text-center icon-warning">
                                        <button class="btn" data-toggle="modal" data-target="#changeCurrency" type="button">
                                            <i class="fa fa-edit text-warning"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer ">
                            <hr>
                            <div class="stats">
                                <i class="fa fa-tag"></i> Currency
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-lg-4 col-md-6 col-sm-6" style="padding: 8px">
                    <div class="card card-stats">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-7 col-md-8">
                                    <div class="">
                                        <img src="<?=MI_CDN_URL.$shop_logo['meta_value']?>" style="width: 200px;">
                                    </div>
                                </div>
                                <div class="col-5 col-md-4">
                                    <div class="icon text-center icon-warning">
                                        <button class="btn" data-toggle="modal" data-target="#changeShopLogo" type="button">
                                            <i class="fa fa-edit text-warning"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer ">
                            <hr>
                            <div class="stats">
                                <i class="fa fa-tag"></i> Shop Logo
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-----------------------------------change site details modal------------------------------>
            <?php foreach ($details as $data){?>
            <div class="modal fade" id="changeDetails<?=$data['id']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-sm modal-dialog-centered" role="document" style="width: 500px">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Change <?=ucwords(str_replace('_',' ', $data['meta_name']))?></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form id="changeDetailsForm<?=$data['id']?>" class="changeDetailsForm" enctype="multipart/form-data">
                            <input type="hidden" name="details_id" value="<?=$data['id']?>">
                            <div class="modal-body">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <textarea name="details" class="form-control" cols="30" rows="10"><?=$data['meta_value']?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <input type="hidden" name="shopDetailsSubmit" value="1">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" name="shopDetailsSubmit" class="btn btn-primary"> Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <?php }?>

            <!--------------------------------------change footer text---------------------------------->
            <div class="modal fade" id="changeCurrency" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-sm modal-dialog-centered" role="document" style="width: 500px">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Change Currency</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form id="changeCurrencyForm" class="changeCurrencyForm" enctype="multipart/form-data">
                            <input type="hidden" name="currency_id" value="<?=$currency['id']?>">
                            <div class="modal-body">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <textarea name="currency" class="form-control" cols="30" rows="10"><?=$currency['meta_value']?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <input type="hidden" name="currencySubmit" value="1">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" name="currencySubmit" class="btn btn-primary"> Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


            <!--------------------------------------change shop logo---------------------------------->
            <div class="modal fade" id="changeShopLogo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-sm modal-dialog-centered" role="document" style="width: 500px">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Change Currency</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form id="changeShopLogoForm" class="changeCurrencyForm" enctype="multipart/form-data">
                            <input type="hidden" name="shopLogo_id" value="<?=$shop_logo['id']?>">
                            <div class="modal-body">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <input class="form-control" type="file" name="shop_logo">
                                        <?php if (isset($shop_logo['meta_value']) && !empty($shop_logo['meta_value'])){?>
                                        <img src="<?=MI_CDN_URL.$shop_logo['meta_value']?>" style="width: 200px;">
                                        <?php }?>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <input type="hidden" name="shopLogoSubmit" value="1">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" name="shopLogoSubmit" class="btn btn-primary"> Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

</div>

    <script>
        $(document).ready(function () {
            $("#mi_uploader").fileinput({
                theme: 'fas',
                allowedFileExtensions: ['jpg', 'png', 'gif', 'jpeg', 'JPG', 'JPEG', 'PNG', 'GIF'],
                overwriteInitial: false,
                maxFilesNum: 1,
                slugCallback: function (filename) {
                    return filename.replace('(', '_').replace(']', '_');
                },
                <?php if (!empty($logo['meta_value'])){?>
                initialPreviewAsData: true,
                initialPreview: [
                    "<?=$logo['meta_value'];?>"
                ],
                initialPreviewConfig: [
                    {size: 329892, width: "100%", url: "{$url}", key: 1, height:"150px !important"}
                ]
                <?php }?>
            });

        });
    </script>
<?=mi_footer();?>