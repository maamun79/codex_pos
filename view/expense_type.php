<?=mi_header();?>
<?php
if (base64_decode($_SESSION['session_type']) !== "mi_1"){
    mi_redirect(MI_BASE_URL.'logout.php');
}

if (isset($_GET['et'])){
    $expenseType_edit_id = $_GET['et'];
    $type_edit = mi_db_read_by_id('expense_type', array('id'=>$expenseType_edit_id))[0];
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
                        <h5 class="card-title"><?=($expenseType_edit_id?'Edit':'Add')?> Expense Type</h5>
                    </div>
                    <div class="card-body">
                        <form class="form-horizontal" action="actions.php" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <?php if (isset($_GET['et']) && !empty($_GET['et'])){?>
                                    <input type="hidden" name="type_edit_id" value="<?=$type_edit['id']?>">
                                <?php }else{?>
                                    <input type="hidden" name="add_type">
                                <?php }?>
                                <div class="col-md-12 form-group">
                                    <label>Title</label>
                                    <input type="text" name="title" id="title" class="form-control" value="<?=(isset($_GET['et']) && !empty($_GET['et'])?$type_edit['type']:'')?>">
                                </div>

                                <div class="col-md-12 btn-block">
                                    <?php
                                    if (isset($expenseType_edit_id)){
                                        ?>
                                        <input type="hidden" name="editTypeSubmit" value="1">
                                    <?php }?>
                                    <button type="submit" name="<?=(isset($expenseType_edit_id)?'editTypeSubmit':'addTypeSubmit')?>" class="btn btn-primary pull-right"><i class="nc-icon nc-refresh-69"></i>&nbsp; <?=(isset($expenseType_edit_id)?'Edit':'Add')?> Type</button>
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
                        <h5 class="card-title pull-left">Expense Types</h5>
                        <div class="showmsg"></div>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-full-width mi_datatable">
                            <thead class="text-primary text-center">
                            <tr>
                                <th style="max-width: 50px; padding-top: 0">
                                    <button class="btn btn-sm btn-danger btn-rounded pull-left delAll" datatype="expense_type"><i class="nc-icon nc-simple-remove"></i>&nbsp;Delete</button>
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
                                <th class="table_font_small">Title</th>
                                <th class="table_font_small">Create Date</th>
                                <th class="table_font_small">Action</th>
                            </tr>
                            </thead>
                            <tbody class="text-center">
                            <?php

                            $data = mi_db_read_all('expense_type');
                            foreach ($data as $d){
                                ?>
                                <tr>
                                    <td style="padding-left: 18px !important;max-width: 50px;">
                                        <div class="checkbox">
                                            <label style="font-size: 1.5em">
                                                <input type="checkbox" value="<?=$d['id'];?>" class="selectorcheck">
                                                <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                            </label>
                                        </div>
                                    </td>
                                    <td><?=$d['type']?></td>
                                    <td><?=$d['created_at']?></td>
                                    <td>
                                        <a title="Edit" class="btn btn-sm btn-dark btn-rounded" href="expense_type.php?et=<?=$d['id'];?>" value="<?=$d['id'];?>"><i class="nc-icon nc-settings"></i>&nbsp;Edit</a>
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

