<?=mi_header();?>
<?php
if (base64_decode($_SESSION['session_type']) !== "mi_1"){
    mi_redirect(MI_BASE_URL.'logout.php');
}


$expense_edit = mi_db_read_by_id('investments', array('id'=>$_GET['ie']))[0];
$currency = mi_db_read_by_id('settings_meta', array('meta_name'=>'shop_currency','type'=>'currency'))[0];
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
            <?php if (isset($_GET['ie'])){?>
                <div class="col-md-4 col-sm-12 col-xs-12" style="padding-right: 5px">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Edit Investment Expense</h5>
                        </div>
                        <div class="card-body">
                            <form class="form-horizontal" action="actions.php" method="post" enctype="multipart/form-data">
                                <?php if (isset($_GET['ie']) && !empty($_GET['ie'])){?>
                                    <input type="hidden" name="inv_edit_id" value="<?=$expense_edit['id']?>">
                                <?php }?>
                                <div class="row">
                                    <div class="col-md-12 form-group">
                                        <label for="title">Expense Title</label>
                                        <input type="text" class="form-control" name="title" id="title" value="<?=$expense_edit['title']?>" placeholder="Enter Expense Title">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 form-group">
                                        <label for="amount">Expense Amount</label>
                                        <input type="number" class="form-control" name="amount" id="amount" value="<?=$expense_edit['amount']?>"  placeholder="Enter Expense Amount">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 form-group">
                                        <label for="exp_date">Expense Date</label>
                                        <div class="input-group">
                                            <input type="text" name="exp_date" class="form-control datepicker" value="<?=$expense_edit['expense_date']?>"  data-date-format="yyyy-mm-dd" placeholder="Choose Expense Date" autocomplete="off">
                                            <div class="input-group-prepend">
                                              <span class="input-group-text">
                                                  <i class="nc-icon nc-calendar-60"></i>
                                              </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <input type="hidden" name="editInvExpenseSubmit" value="1">
                                    <button type="submit" name="editInvExpenseSubmit" class="btn btn-primary"><i class="far fa-edit"></i> Edit Expense</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            <?php }?>

            <div class="col-md-<?=(isset($_GET['ie'])?'8':'12')?> col-sm-12 col-xs-12">
                <div class="card ">
                    <div class="card-header">
                        <h5 class="card-title pull-left">Investment Expenses</h5>
                        <div class="showmsg"></div>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-full-width mi_datatable">
                            <thead class="text-primary text-center">
                            <tr>
                                <th style="max-width: 50px; padding-top: 0">
                                    <button class="btn btn-sm btn-danger btn-rounded pull-left delAll" datatype="inv_expense"><i class="nc-icon nc-simple-remove"></i>&nbsp;Delete</button>
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
                                <th class="table_font_small">Expense Title</th>
                                <th class="table_font_small">Expense Amount</th>
                                <th class="table_font_small">Expense Date</th>
                                <th class="table_font_small">Added By</th>
                                <th class="table_font_small">Action</th>
                            </tr>
                            </thead>
                            <tbody class="text-center">
                            <?php

                            $expenses = mi_db_read_all('investments');
                            foreach ($expenses as $data){
                                $added_by = mi_db_read_by_id('mi_users', array('id'=> $data['user_id']))[0];
                                ?>
                                <tr>
                                    <td style="padding-left: 18px !important;max-width: 50px;">
                                        <div class="checkbox">
                                            <label style="font-size: 1.5em">
                                                <input type="checkbox" value="<?=$data['id'];?>" class="selectorcheck">
                                                <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                            </label>
                                        </div>
                                    </td>
                                    <td><?=$data['title']?></td>
                                    <td><?=$data['amount']?> <?=$currency['meta_value']?></td>
                                    <td><?=$data['expense_date']?></td>
                                    <td><?=$added_by['user_name']?></td>
                                    <td>
                                        <a title="Edit" class="btn btn-sm btn-dark btn-rounded" href="investment.php?ie=<?=$data['id'];?>" value="<?=$data['id'];?>"><i class="nc-icon nc-settings"></i>&nbsp;Edit</a>
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

