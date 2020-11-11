<?=mi_header();?>
<?php
if (base64_decode($_SESSION['session_type']) !== "mi_1"){
    mi_redirect(MI_BASE_URL.'logout.php');
}

if (isset($_GET['ve'])){
    $vat_edit_id = $_GET['ve'];
    $vat_edit = mi_db_read_by_id('mi_purchase_vat', array('vid'=>$vat_edit_id))[0];
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
        <div class="row">
            <div class="col-md-4 col-sm-12 col-xs-12" style="padding-right: 5px">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title"><?=($vat_edit_id?'Edit':'Add')?> VAT</h5>
                    </div>
                    <div class="card-body">
                        <form class="form-horizontal" action="actions.php" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <?php if (isset($_GET['ve']) && !empty($_GET['ve'])){?>
                                    <input type="hidden" name="vat_edit_id" value="<?=$vat_edit['vid']?>">
                                <?php }else{?>
                                    <input type="hidden" name="add_vat">
                                <?php }?>
                                <div class="col-md-12 form-group">
                                    <label>VAT Details</label>
                                    <input type="text" name="vat_details" id="vat_details" class="form-control" value="<?=(isset($_GET['ve']) && !empty($_GET['ve'])?$vat_edit['vtaxdetails']:'')?>">
                                </div>
                                <div class="col-md-12 form-group">
                                    <label>VAT Percentage (%)</label>
                                    <input type="number" name="vat_percent" id="vat_percent" class="form-control" value="<?=(isset($_GET['ve']) && !empty($_GET['ve'])?$vat_edit['vtax']:'')?>">
                                </div>
                                <div class="col-md-12 col-sm-12 form-group">
                                    <label>Choose Status</label>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="funkyradio">
                                                <div class="funkyradio-primary">
                                                    <input type="radio" name="vat_status" id="radioActive" value="1" <?=(isset($_GET['ve']) && $vat_edit['vtaxstatus']==1?'checked':'')?>/>
                                                    <label for="radioActive">Active</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="funkyradio">
                                                <div class="funkyradio-primary">
                                                    <input type="radio" name="vat_status" id="radioActive1" value="2" <?=(isset($_GET['ve']) && $vat_edit['vtaxstatus']==2?'checked':'')?>/>
                                                    <label for="radioActive1">Inactive</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12 btn-block">
                                    <?php
                                        if (isset($vat_edit_id)){
                                    ?>
                                        <input type="hidden" name="editVatSubmit" value="1">
                                    <?php }?>
                                    <button type="submit" name="<?=(isset($vat_edit_id)?'editVatSubmit':'addVatSubmit')?>" class="btn btn-primary pull-right"><i class="nc-icon nc-refresh-69"></i>&nbsp; <?=(isset($vat_edit_id)?'Edit':'Add')?> VAT</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer"></div>
                </div>
            </div>

            <div class="col-md-8 col-sm-12 col-xs-12">
                <div class="card ">
                    <div class="card-header">
                        <h5 class="card-title pull-left">All VAT Info</h5>
                        <div class="showmsg"></div>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-full-width mi_datatable">
                            <thead class="text-primary text-center">
                            <tr>
                                <th style="max-width: 50px; padding-top: 0">
                                    <button class="btn btn-sm btn-danger btn-rounded pull-left delAll" datatype="vat"><i class="nc-icon nc-simple-remove"></i>&nbsp;Delete</button>
                                </th>
                                <th colspan="8"></th>
                            </tr>
                            <tr>
                                <th style="max-width: 50px;">
                                    <div class="checkbox pull-left">
                                        <label style="font-size: 1.5em">
                                            <input type="checkbox" value="" class="selectAll">
                                            <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                        </label>
                                    </div>
                                </th>
                                <th class="table_font_small">VAT Details</th>
                                <th class="table_font_small">VAT Percentage</th>
                                <th class="table_font_small">Status</th>
                                <th class="table_font_small">Action</th>
                            </tr>
                            </thead>
                            <tbody class="text-center">
                            <?php

                            $data = mi_db_read_all('mi_purchase_vat');
                            foreach ($data as $d){
                                ?>
                                <tr>
                                    <td style="padding-left: 18px !important;max-width: 50px;">
                                        <div class="checkbox">
                                            <label style="font-size: 1.5em">
                                                <input type="checkbox" value="<?=$d['vid'];?>" class="selectorcheck">
                                                <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                            </label>
                                        </div>
                                    </td>
                                    <td><?=$d['vtaxdetails']?></td>
                                    <td><?=$d['vtax']?> %</td>
                                    <td><?=($d['vtaxstatus']==1?'Active':'Inactive')?></td>
                                    <td>
                                        <a title="Edit" class="btn btn-sm btn-dark btn-rounded" href="vat.php?ve=<?=$d['vid'];?>" value="<?=$d['vid'];?>"><i class="nc-icon nc-settings"></i>&nbsp;Edit</a>
                                    </td>
                                </tr>
                            <?php }?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>






    <?=mi_footer();?>

