<?php
/**
 * Created by PhpStorm.
 * User: monir
 * Date: 4/21/2019
 * Time: 1:09 AM
 */

if (count($_REQUEST)<=0){
    mi_redirect(MI_BASE_URL);
}

$currency= mi_db_read_by_id('settings_meta', array('meta_name'=>'shop_currency', 'type'=>'currency'))[0];


function get_pro_serials($data, $qty){
    $array = [];
    $mn = $qty - 1;
    for ($i = 0; $i <= $mn; $i++){
        $array[] = $data[$i];
    }

    return $array;
}

if (isset($_POST['pro_del'])){
    $data = $_POST['pro_del'];

    if ($_POST['del_type'] == 'product'){
        if (!mi_db_delete('mi_products', 'pro_id', $data)){
            header("HTTP/1.0 400 Bad Request");
            die();
        }else{
            echo "Successfully Deleted Product";
            exit;
        }
    }elseif ($_POST['del_type'] == 'category'){
        if (!mi_db_delete('mi_product_category', 'cat_id', $data)){
            header("HTTP/1.0 400 Bad Request");
            die();
        }else{
            echo "Successfully Deleted Category";
            exit;
        }
    }elseif ($_POST['del_type'] == 'brand'){
        if (!mi_db_delete('mi_product_brand', 'br_id', $data)){
            header("HTTP/1.0 400 Bad Request");
            die();
        }else{
            echo "Successfully Deleted Brand";
            exit;
        }
    }elseif ($_POST['del_type'] == 'supplier'){
        if (!mi_db_delete('mi_product_suppliers', 'sup_id', $data)){
            header("HTTP/1.0 400 Bad Request");
            die();
        }else{
            echo "Successfully Deleted Supplier";
            exit;
        }
    }elseif ($_POST['del_type'] == 'orders'){
        foreach ($data as $dat){
            $path = 'order_excels/'.mi_db_read_by_id('mi_orders', array('order_id' => $dat))[0]['trx_id'].'.csv';
            unlink($path);
        }
        if (!mi_db_delete('mi_orders', 'order_id', $data)){
            header("HTTP/1.0 400 Bad Request");
            die();
        }else{
            echo "Successfully Deleted Order";
            exit;
        }
    }elseif ($_POST['del_type'] == 'stockHistory'){

        if (!mi_db_delete('mi_stocks', 'stock_id', $data)){
            header("HTTP/1.0 400 Bad Request");
            die();
        }else{
            echo "Successfully Deleted Order";
            exit;
        }
    }elseif ($_POST['del_type'] == 'users'){

        if (!mi_db_delete('mi_users', 'id', $data)){
            header("HTTP/1.0 400 Bad Request");
            die();
        }else{
            echo "Successfully Deleted User";
            exit;
        }
    }elseif ($_POST['del_type'] == 'expense'){

        if (!mi_db_delete('regular_expenses', 'id', $data)){
            header("HTTP/1.0 400 Bad Request");
            die();
        }else{
            echo "Successfully Deleted Expense";
            exit;
        }
    }elseif ($_POST['del_type'] == 'inv_expense'){

        if (!mi_db_delete('investments', 'id', $data)){
            header("HTTP/1.0 400 Bad Request");
            die();
        }else{
            echo "Successfully Deleted Expense";
            exit;
        }
    }elseif ($_POST['del_type'] == 'customers'){

        if (!mi_db_delete('customers', 'id', $data)){
            header("HTTP/1.0 400 Bad Request");
            die();
        }else{
            echo "Successfully Deleted customer";
            exit;
        }
    }elseif ($_POST['del_type'] == 'vat'){

        if (!mi_db_delete('mi_purchase_vat', 'vid', $data)){
            header("HTTP/1.0 400 Bad Request");
            die();
        }else{
            echo "Successfully Deleted VAT";
            exit;
        }
    }elseif ($_POST['del_type'] == 'expense_type'){

        if (!mi_db_delete('expense_type', 'id', $data)){
            header("HTTP/1.0 400 Bad Request");
            die();
        }else{
            echo "Successfully Deleted Expense type";
            exit;
        }
    }

}

if (isset($_POST['get_pro_grid']) && !empty($_POST['get_pro_grid'])){
    $currency = mi_db_read_by_id('settings_meta', array('meta_name'=>'shop_currency', 'type'=>'currency'))[0];
    $start = mi_secure_input($_POST['start']);
    $end = mi_secure_input($_POST['end']);

    if (isset($_POST['name_value']) && !empty($_POST['name_value'])){

        $title = $_POST['name_value'];
        $data = mi_db_tbl_like('mi_products', 'STARTS', 'pro_title', $title, null, 'pro_id', 'DESC', "{$start}, {$end}");


    }elseif (isset($_POST['catsort']) && !empty($_POST['catsort'])){

        $catid = $_POST['catsort'];
        $data = mi_db_read_by_id('mi_products', array('pro_cat'=>$catid), false, 'pro_id', 'DESC', "{$start}, {$end}");


    }elseif (isset($_POST['brsort']) && !empty($_POST['brsort'])){

        $brid = $_POST['brsort'];
        $data = mi_db_read_by_id('mi_products', array('pro_brand'=>$brid), false, 'pro_id', 'DESC', "{$start}, {$end}");

    }else{
        if (isset($start) && !empty($start) && isset($end) && !empty($end)){
//            $data = mi_db_read_by_id('mi_products','',false, 'pro_id', 'DESC', "{$start}, {$end}");
            $data = mi_db_custom_query("SELECT * FROM `mi_products` WHERE `pro_stock` !=0 ORDER BY `pro_id` DESC LIMIT {$start}, {$end}");
        }else{
//            $data = mi_db_read_by_id('mi_products', '', false, 'pro_id', 'DESC', "1, 4");
            $data = mi_db_custom_query("SELECT * FROM `mi_products` WHERE `pro_stock` !=0 ORDER BY `pro_id` DESC LIMIT 0, 12");
        }
    }


    if (count($data)>0) {
        foreach ($data as $d) {
            ?>
            <div class="mi_sale_product_item col-sm-6 col-6" style="padding-right: 5px">
                <div class="thimbnail_sale_product float-left">
                    <?php if (!empty($d['pro_img'])) { ?>
                        <img src="<?=MI_CDN_URL.$d['pro_img']; ?>" class="float-left mr-2">
                    <?php } else { ?>
                        <img src="<?=MI_CDN_URL;?>uploads/empty-img.png" class="float-left mr-2">
                    <?php } ?>
                    <div class="sale_product_title mb-2">
                        <?=((strlen($d['pro_title'])>10)?substr($d['pro_title'], '0', '10').'...':$d['pro_title']); ?>
                    </div>
                    <label class="font-weight-bold d-block">Price: <?= $d['pro_price']; ?> <?= $currency['meta_value'] ?></label>
                    <label class="text-<?= ($d['pro_stock'] < 5) ? 'danger' : 'dark'; ?>"><?= ($d['pro_stock'] == 0) ? 'Empty' : 'Qty: ' . $d['pro_stock']; ?> L</label>
                </div>
                <div class="btncontainer_sale_product">
                    <a class="sale_product_cart" value="<?= $d['pro_id']; ?>">
                        <i class="nc-icon nc-bag-16"></i>
                    </a>
                </div>
            </div>
        <?php }
    }else{
        echo '';
    }
}
function get_tax_amount_details($amnt){
    $currency= mi_db_read_by_id('settings_meta', array('meta_name'=>'shop_currency', 'type'=>'currency'))[0];
    $data = mi_db_read_by_id('mi_purchase_vat', array('vtaxstatus'=>1));
    if ($data){
        foreach ($data as $dat){
            return '
                    <tr>
                        <th colspan="4" class="text-right">'.$dat['vtaxdetails'].' - '.$dat['vtax'].'%</th>
                        <th class="text-right">'.($dat['vtax'] / 100) * $amnt.' '.$currency['meta_value'].'</th>
                    </tr>
                ';
        }
    }
}

function get_tax_amount_details2($amnt){
    $data = mi_db_read_by_id('mi_purchase_vat', array('vtaxstatus'=>1));
    $currency= mi_db_read_by_id('settings_meta', array('meta_name'=>'shop_currency', 'type'=>'currency'))[0];

    if ($data){
        foreach ($data as $dat){
            return '
                    <tr>
                        <th colspan="5" class="text-right">'.$dat['vtaxdetails'].' - '.$dat['vtax'].'%</th>
                        <th class="text-right">'.($dat['vtax'] / 100) * $amnt.' '.$currency['meta_value'].'</th>
                    </tr>
                ';
        }
    }
}
function get_tax_amount_details_extra(){

    if (!empty(mi_db_read_by_id('mi_purchase_vat', array('vtaxstatus'=>1, 'user_id'=>str_replace('mi_', '', base64_decode($_SESSION['session_id']))))[0])){
        $data = mi_db_read_by_id('mi_purchase_vat', array('vtaxstatus'=>1, 'user_id'=>str_replace('mi_', '', base64_decode($_SESSION['session_id']))))[0];
        return $data;
    }
}

function get_tax_amount_amount($amnt){
    $data = mi_db_read_by_id('mi_purchase_vat', array('vtaxstatus'=>1, 'user_id'=>str_replace('mi_', '', base64_decode($_SESSION['session_id']))));
    if ($data){
        $pm = array();
        foreach ($data as $dat){
            $pm[] = ($dat['vtax'] / 100) * $amnt;
        }
        return array_sum($pm);
    }
}

if (isset($_POST['get_cart']) && !empty($_POST['get_cart'])){
    $user_id = str_replace('mi_', '', base64_decode($_SESSION['session_id']));
    $data = mi_db_read_by_id('mi_product_cart', array('user_id'=> $user_id));
    $total = array();
    $qty_total = array();
    $currency= mi_db_read_by_id('settings_meta', array('meta_name'=>'shop_currency', 'type'=>'currency'))[0];
    $vat_tax = mi_db_read_by_id('mi_purchase_vat', array('vtaxstatus'=> 1));
    $get_paid_amount = mi_db_read_by_id('sales_meta', array('user_id'=> $user_id))[0];

    if (count($data) > 0){

        echo '<table class="table table-shopping table-striped table-cart" style="font-size: smaller">
                            <thead>
                                <tr>
                                    <th class="text-left" colspan="2">Item</th>
                                    <th>Qty (L)</th>
                                    <th>Discount (%)</th>
                                    <th>VAT/Tax</th>
                                    <th class="text-right">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>';


        $all_vat = [];
        $vat_counter = [];
        $nvat = [];
        foreach ($data as $d){

            $getPr = mi_db_read_by_id('mi_products', array("pro_id"=>$d['pro_id']))[0];
            $pro_cart = mi_db_read_by_id('mi_product_cart', array('cart_id'=>$d['cart_id']))[0];

            $price = $getPr['pro_price'] * $d["pro_qty"];
            $discount_amount = ($pro_cart['discount']/100)*$price;
            $sub_total_amount = $price - $discount_amount;
            $total[] = $sub_total_amount;
            $qty_total[] = $d["pro_qty"];

            $get_vats=mi_db_read_by_id('mi_purchase_vat', array('vid'=>$pro_cart['vat_id']))[0];
            if (!in_array($pro_cart['vat_id'], $vat_counter)){
                $vat_counter[] = $pro_cart['vat_id'];
                $nvat[$pro_cart['vat_id']] = ($get_vats['vtax']/100)*$sub_total_amount;
            }else{
                $nvat[$pro_cart['vat_id']]+= ($get_vats['vtax']/100)*$sub_total_amount;
            }

            echo '<tr>
                     <td class="text-left mi_cusomized_selector" colspan="2">
                         <button class="btn btn-danger btn-sm cart_remove_item p-1 rounded-0" type="button" value="'.$d['cart_id'].'"><i class="nc-icon nc-simple-remove"></i></button> &nbsp; 
                         '.((strlen($getPr['pro_title'])>20)?substr($getPr['pro_title'], '0', '20').'...':$getPr['pro_title']).'
                     </td>
                     <td>
                        <div style="width: 80px; margin: 0 auto;">
                            <span class="input-group-btn pull-left">
                                        <button type="button" style="padding: 5px" class="quantity-left-minus btn btn-sm btn-danger btn-number rounded-0" input_id="'.$d["pro_id"].'"  data-type="minus" data-field="">
                                          <span class="nc-icon nc-simple-delete"></span>
                                        </button>
                                    </span>
                       
                        <input type="number" id="quantity'.$d["pro_id"].'" name="quantity" class="form-control input-number pull-left quantity rounded-0" pro-id="'.$d['pro_id'].'" value="'.$d["pro_qty"].'" min="1">
                                    <span class="input-group-btn">
                                        <button type="button" style="padding: 5px" class="quantity-right-plus btn btn-success btn-sm btn-number pull-left rounded-0" input_id="'.$d["pro_id"].'" data-type="plus" data-field="">
                                            <span class="nc-icon nc-simple-add"></span>
                                        </button>
                                    </span>
                            </div>
                     </td>
                     <td style="width: 103px">
                        <input type="number" value="'.$pro_cart['discount'].'" class="form-control cart_discount_input rounded-0" cart-id="'.$d['cart_id'].'" name="discount" id="discount">
                     </td>
                     <td style="width: 103px">
                        <select class="form-control vat_tax_selection rounded-0" name="vat_tax" id="vat_tax_select" cart-id="'.$d['cart_id'].'">
                            <option value="0" selected>None</option>';
                                foreach ($vat_tax as $vt){
                                    echo '<option value="'.$vt['vid'].'" '.($vt['vid'] == $d['vat_id']?'selected':'').'>'. $vt['vtaxdetails'] .'</option>';
                                }
                        echo '</select>
                     </td>
                     <td class="text-right">'.$sub_total_amount.' '.$currency['meta_value'].'</td>
                 </tr>';
        }

        echo '</tbody>
             <tfoot>
                
                <tr>
                    <th class="text-right" colspan="5">Grand total</th>
                    <th class="text-right">'.array_sum($total).' '.$currency['meta_value'].'</th>
                </tr>';

                $payable_vat = [];
                foreach($nvat as $k => $vt){
                    $payable_vat[] = $vt;
                    $get_title = mi_db_read_by_id('mi_purchase_vat', array('vid'=>$k));
                    if (count($get_title)>0){
                        echo '<tr>
                             <th class="text-right" colspan="5">' . $get_title[0]['vtaxdetails'] . ' (' . $get_title[0]['vtax'] . '%)</th>
                             <th class="text-right">' . $vt . ' ' . $currency['meta_value'] . '</th>
                         </tr>';
                    }
                }

           echo '<tr>
                    <th colspan="4">
                        <textarea name="note" id="note" placeholder="Due note" cols="30" rows="5" class="form-control" style="height: 40px; padding: 5px; font-size: 11px; line-height: 15px">'.$get_paid_amount['note'].'</textarea>
                    </th>
                    <th>
                        <span style="float:right">Due:</span>
                    </th>
                    <th>
                       <span style="float:right"><span>'.number_format(((array_sum($total)+array_sum($payable_vat))-((isset($get_paid_amount['paid_amount'])?$get_paid_amount['paid_amount']:array_sum($total)+array_sum($payable_vat)))), 2).' '.$currency['meta_value'].'</span> </span>

                    </th>
                </tr>
                
                
                <tr>

                    <th class="text-left">Total Products: '.count($data).'<br>Total Qty: '.array_sum($qty_total).' L</th>
                    <th class="text-right" colspan="4" style="font-size:18px">
                        <span>Total Amount:</span><br>
                        Paid:
                       
                    </th>

                    <th class="text-right">'.

                        "<span style='font-size:18px' class='totalpayable' payableamount=".(array_sum($total)+array_sum($payable_vat)).">".(array_sum($total)+array_sum($payable_vat)).' '.$currency['meta_value'].'</span><br>'.

                        '<input class="form-control rounded-0" name="paid_amount" id="paid_amount" value="'.(!isset($get_paid_amount['paid_amount']) && $get_paid_amount['paid_amount'] == null ?(array_sum($total)+array_sum($payable_vat)):$get_paid_amount['paid_amount']).'">'.'
               
                    </th>

                    <span class="get_main_total" main_amount='.((array_sum($total) + get_tax_amount_amount(array_sum($total)))+get_tax_amount_details_extra()['extra_amount']).' style="display:none"><span>

                </tr>
                
            </tfoot>
        </table>';
        exit;

    }else{
        echo "<h3 class='mt-4'>No Product Added to Basket Yet</h3>";
        exit;
    }
}


if (isset($_POST['extra_updater']) && !empty($_POST['extra_updater'])){
    $uid = str_replace('mi_', '', base64_decode($_SESSION['session_id']));
    if (empty($_POST['amount'])){
        $amount = 0;
    }else{
        $amount = mi_secure_input($_POST['amount']);
    }
    $note = mi_secure_input($_POST['note']);
    $data = mi_db_read_by_id('mi_purchase_vat', array('vtaxstatus'=>1))[0];
    $id = $data['vid'];

    $update = mi_db_update('mi_purchase_vat', array('purchase_extra'=>$note, 'extra_amount'=>$amount), array('vid'=>$id));

    if ($update){
        echo "Extra amount Added";
    }else{
        echo "Error to add extra amount";
    }
}

if (isset($_POST['due_updater']) && !empty($_POST['due_updater'])){
    $uid = str_replace('mi_', '', base64_decode($_SESSION['session_id']));
    if (empty($_POST['amount'])){
        $amount = 0;
    }else{
        $amount = mi_secure_input($_POST['amount']);
    }

    $data = mi_db_read_by_id('mi_purchase_vat', array('vtaxstatus'=>1))[0];
    $id = $data['vid'];

    $update = mi_db_update('mi_purchase_vat', array('due'=>$amount), array('vid'=>$id));

    if ($update){
        echo "Due amount Added";
    }else{
        echo "Error to add extra amount";
    }
}

//--------------------discount updater-------------------------
if (isset($_POST['discount_updater']) && !empty($_POST['discount_updater'])){
    $uid = str_replace('mi_', '', base64_decode($_SESSION['session_id']));
    $cart_id = mi_secure_input($_POST['cart_id']);
    if (empty($_POST['amount'])){
        $amount = 0;
    }else{
        $amount = mi_secure_input($_POST['amount']);
    }

    $update = mi_db_update('mi_product_cart', array('discount'=>$amount), array('cart_id'=>$cart_id));

    if ($update){
        echo "Discount Added";
    }else{
        echo "Error to add discount";
    }
}

//--------------------VAT updater-------------------------
if (isset($_POST['vat_updater']) && !empty($_POST['vat_updater'])){
    $uid = str_replace('mi_', '', base64_decode($_SESSION['session_id']));
    $cart_id = mi_secure_input($_POST['cart_id']);
    if (empty($_POST['vat'])){
        $vat = 0;
    }else{
        $vat = mi_secure_input($_POST['vat']);
    }

    $update = mi_db_update('mi_product_cart', array('vat_id'=>$vat), array('cart_id'=>$cart_id));

    if ($update){
        echo "VAT Added";
    }else{
        echo "Error to add VAT";
    }
}
//------------------------paid amount inserting-------------------------
if (isset($_POST['paid_amount_updater']) && !empty($_POST['paid_amount_updater'])){
    $uid = str_replace('mi_', '', base64_decode($_SESSION['session_id']));
    $check_user = mi_db_read_by_id('sales_meta', array('user_id'=> $uid));
    if (empty($_POST['amount'])){
        $amount = 0;
    }else{
        $amount = mi_secure_input($_POST['amount']);
    }

    if (count($check_user) > 0){
        $update = mi_db_update('sales_meta', array('paid_amount'=>$amount), array('user_id'=>$uid));

        if ($update){
            echo "Paid amount updated";
        }else{
            echo "Error to update paid amount";
        }
    }else{
        $data = array(
            'paid_amount' => $amount,
            'user_id' => $uid
        );
        $insert = mi_db_insert('sales_meta', $data);

        if ($insert){
            echo "Paid amount inserted";
        }else{
            echo "Error to insert paid amount";
        }
    }
}

//--------------------Note updater-------------------------
if (isset($_POST['note_updater']) && !empty($_POST['note_updater'])){
    $uid = str_replace('mi_', '', base64_decode($_SESSION['session_id']));
    $check_user = mi_db_read_by_id('sales_meta', array('user_id'=> $uid));
    if (empty($_POST['note'])){
        $note = '';
    }else{
        $note = mi_secure_input($_POST['note']);
    }

    if (count($check_user) > 0){
        $update = mi_db_update('sales_meta', array('note'=>$note), array('user_id'=>$uid));

        if ($update){
            echo "Note updated";
        }else{
            echo "Error to update note";
        }
    }else{
        $data = array(
            'note' => $note,
            'user_id' => $uid
        );
        $insert = mi_db_insert('sales_meta', $data);

        if ($insert){
            echo "Note inserted";
        }else{
            echo "Error to insert note";
        }
    }
}



function row_repeater($number){
    $get_i = 22 - $number;
    $html = '';
    for ($i=1;$i<=$get_i;$i++){
        $html .= '<tr>
                      <td class="invoice_border"></td>
                      <td class="invoice_border"></td>
                      <td class="invoice_border"></td>
                      <td class="invoice_border"></td>
                      <td class="invoice_border"></td>
                      <td class="invoice_border"></td>
                      <td class="invoice_border"></td>
                      <td class="invoice_border"></td>
                  </tr>';
    }
    return $html;
}


if (isset($_POST['get_cart_plain']) && !empty($_POST['get_cart_plain'])){
    $currency = mi_db_read_by_id('settings_meta', array('meta_name'=>'shop_currency'))[0];
    $user_id = str_replace('mi_', '', base64_decode($_SESSION['session_id']));
    $data = mi_db_read_by_id('mi_product_cart', array('user_id'=>$user_id));
    $total = array();
    $qty_total = array();
    $due_data = mi_db_read_by_id('mi_purchase_vat', array('vtaxstatus'=> 1))[0];
    $get_paid_amount = mi_db_read_by_id('sales_meta', array('user_id'=> $user_id))[0];

    if (count($data) > 0){
        $viewdat = '<table class="table table-shopping table-borderless border" style="font-size: smaller">
                            <thead style="border-bottom: 1px solid #e3e3e3;">
                                <tr style="font-size: 10px">
                                    <th class="text-left" style="width: 40px;">SL.</th>
                                    <th class="text-left invoice_border">Item</th>
                                    <th class="text-center invoice_border">Qty</th>
                                    <th class="text-center invoice_border">Unit Price</th>
                                    <th class="text-center invoice_border">Discount (%)</th>
                                    <th class="text-center invoice_border">VAT (%)</th>
                                    <th class="text-center invoice_border">VAT amount</th>
                                    <th class="text-right invoice_border">Total</th>
                                </tr>
                            </thead>
                        <tbody style="border-bottom: 1px solid #e3e3e3; line-height: 0">';

        $rounder = 1;
        $nvat = [];
        $vat_counter = [];
        foreach ($data as $d){
            $get_product = mi_db_read_by_id('mi_products', array("pro_id"=>$d['pro_id']))[0];
            $price = $get_product['pro_price'] * $d["pro_qty"];
            $discount_amount = ($d['discount']/100)*$price;
            $sub_total_amount = $price - $discount_amount;
            $total[] = $sub_total_amount;
            $qty_total[] = $d["pro_qty"];

            $get_vats=mi_db_read_by_id('mi_purchase_vat', array('vid'=>$d['vat_id']))[0];
            if (!in_array($d['vat_id'], $vat_counter)){
                $vat_counter[] = $d['vat_id'];
                $nvat[$d['vat_id']] = ($get_vats['vtax']/100)*$sub_total_amount;
            }else{
                $nvat[$d['vat_id']]+= ($get_vats['vtax']/100)*$sub_total_amount;
            }

            $viewdat .= '<tr> 
                             <td style="width: 40px;">'.$rounder.'</td>
                             <td class="text-left invoice_border">
                                 '.$get_product['pro_title'].'
                             </td>
                             <td class="text-center invoice_border">
                                '.$d['pro_qty'].' L
                             </td>
                             <td class="text-center invoice_border">
                                '.$get_product['pro_price'].' '.$currency['meta_value'].'
                             </td>
                             <td class="text-center invoice_border">
                                '.$d['discount'].' %
                             </td>
                             <td class="text-center invoice_border">
                                '.(!empty($get_vats['vtax'])?$get_vats['vtax']:'0').' %
                             </td>
                             <td class="text-center invoice_border">
                                '.(($get_vats['vtax']/100)*$sub_total_amount).' '.$currency['meta_value'].'
                             </td>
                             <td class="text-right invoice_border">'.$sub_total_amount.' '.$currency['meta_value'].'</td>
                         </tr>';
            $rounder++;
        }
        $viewdat.= row_repeater(count($data));
        $viewdat .= '</tbody>
                         <tfoot>
                            <tr>
                                <th class="text-right" colspan="7" style="padding: 3px">Sub total</th>
                                <th class="text-right" style="padding: 3px">'.array_sum($total).' '.$currency['meta_value'].'</th>
                            </tr>';

        $payable_vat = [];
        foreach($nvat as $k => $vt){
            $payable_vat[] = $vt;
            $get_title = mi_db_read_by_id('mi_purchase_vat', array('vid'=>$k));
            if (count($get_title)>0){
                $viewdat .= '<tr>
                             <th class="text-right" colspan="7" style="padding: 3px">' . $get_title[0]['vtaxdetails'] . ' (' . $get_title[0]['vtax'] . '%)</th>
                             <th class="text-right" style="padding: 3px">' . $vt . ' ' . $currency['meta_value'] . '</th>
                         </tr>';
            }
        }

        $viewdat .=    '<tr>
                       
                        <th class="text-right" colspan="7" style="padding: 3px">Due: </th>
                       <th class="text-right" style="padding: 3px">'.number_format(((array_sum($total)+array_sum($payable_vat))-((isset($get_paid_amount['paid_amount'])?$get_paid_amount['paid_amount']:array_sum($total)+array_sum($payable_vat)))), 2).' '.$currency['meta_value'].'</th>
                    </tr>';

        $viewdat .=  '<tr>

                            <th class="text-left" colspan="2">Total Products: '.count($data).'<br>Total Qty: '.array_sum($qty_total).' L</th>
                            <th class="text-right" colspan="5" style="font-size:18px">
                                <span>Total Amount:</span><br>
                                Paid:
                               
                            </th>
        
                            <th class="text-right" style="font-size:18px">'.

                                "<span class='totalpayable' payableamount=".(array_sum($total)+array_sum($payable_vat)).">".(array_sum($total)+array_sum($payable_vat)).' '.$currency['meta_value'].'</span><br>'.

                                '<span>'.(isset($get_paid_amount['paid_amount'])?$get_paid_amount['paid_amount']: array_sum($total)+array_sum($payable_vat)).' ' . $currency['meta_value'] . '</span>'.'
                       
                            </th>
        
                     </tr>
                        </tfoot>
                    </table>';
    }else{
        $viewdat.= "<h3 class='mt-4'>No Product Added to Basket Yet</h3>";
    }

    echo json_encode(array('data'=>$viewdat, 'due'=>((array_sum($total)+array_sum($payable_vat)) - ((isset($get_paid_amount['paid_amount'])?$get_paid_amount['paid_amount']: array_sum($total)+array_sum($payable_vat)))), 'note'=> $get_paid_amount['note']));
}


if (isset($_POST['add_pro_cart']) && !empty($_POST['add_pro_cart'])){
    $id = mi_secure_input($_POST['pro_id']);
    $qty = 1;

    $credentials_chk = array(
        'pro_id' => $id,
        'user_id' => str_replace('mi_', '', base64_decode($_SESSION['session_id']))
    );

    $chk = mi_db_read_by_id('mi_product_cart', $credentials_chk);

    if (count($chk) > 0){

        $chkProStock = mi_db_read_by_id('mi_products', array('pro_id'=>$id))[0];

        if ($chkProStock['pro_stock'] != 0){

            if (($chkProStock['pro_stock']-1) < $chk[0]['pro_qty']){
                $msg = array('status' => 'error', 'message'=>'Product quantity not available');
            }else{
                $newQty = $chk[0]['pro_qty'] + $qty;
                $cup = mi_db_update('mi_product_cart', array('pro_qty'=>$newQty), array('pro_id'=>$id, 'user_id' => str_replace('mi_', '', base64_decode($_SESSION['session_id']))));

                if ($cup){
                    $msg = array('status' => 'success', 'message'=>'Successfully Updated Product in Basket');
                }else{
                    $msg = array('status' => 'error', 'message'=>'Product not found');
                }
            }
        }else{
            $msg = array('status' => 'error', 'message'=>'Insufficient Stock');
        }
    }else{
        $chkProStock = mi_db_read_by_id('mi_products', array('pro_id'=>$id))[0];

        if ($chkProStock['pro_stock'] != 0){
            $user_id = str_replace('mi_', '', base64_decode($_SESSION['session_id']));
            $credentials = array(
                'pro_id' => $id,
                'pro_qty' => $qty,
                'user_id' => $user_id
            );

            $data = mi_db_insert('mi_product_cart', $credentials);

            if ($data){
                //------------calculate total amount----------------
//                $totalAmount = [];
//                $cart_items = mi_db_read_by_id('mi_product_cart', array('user_id'=> $user_id));
//                foreach ($cart_items as $item){
//                    $product = mi_db_read_by_id('mi_products', array('pro_id' => $item['pro_id']))[0];
//
//                    $price = $product['pro_price'] * $item['pro_qty'];
//                    $discount = ($item['discount']/100) * $price;
//                    $priceWithoutDiscount = $price - $discount;
//
//                    $vat = ($item['vat']/100) * $priceWithoutDiscount;
//                    $totalAmount[] = $priceWithoutDiscount + $vat;
//
//                }
//                mi_db_insert('sales_meta', array(
//                        'paid_amount'=> array_sum($totalAmount),
//                        'user_id' => $user_id,
//                        'note' => ''
//                        )
//                );
                $msg = array('status' => 'success', 'message'=>'Successfully Updated Product in Basket');
            }else{
                $msg = array('status' => 'error', 'message'=>'Product not found');
            }
        }else{
            $msg = array('status' => 'error', 'message'=>'Insufficient Stock');
        }
    }

    echo json_encode($msg);
}



if (isset($_POST['remove_pro_cart']) && !empty($_POST['remove_pro_cart'])){
    $uid = str_replace('mi_', '', base64_decode($_SESSION['session_id']));
    $id = $_POST['cart_id'];

    $data = mi_db_delete('mi_product_cart', 'cart_id', array($id));

    if ($data){
        echo 'Successfully Remove Basket Item';
        exit;
    }else{
        header("HTTP/1.0 400 Bad Request");
        die();
    }
}

if (isset($_POST['plus_cart_item_id']) && !empty($_POST['plus_cart_item_id'])){
    $uid = str_replace('mi_', '', base64_decode($_SESSION['session_id']));
    $idd = mi_secure_input($_POST['plus_cart_item_id']);
    $credentials_chk = array(
        'pro_id' => $idd,
        'user_id' => $uid
    );

    $chk = mi_db_read_by_id('mi_product_cart', $credentials_chk);

    if (count($chk) > 0){
        $chkProStock = mi_db_read_by_id('mi_products', array('pro_id'=>$idd))[0];

        if (($chkProStock['pro_stock']-1) < $chk[0]['pro_qty']){
            $msg = array('status' => 'error', 'message'=>'Product quantity not available');
        }else{
            $mainQty = $chk[0]['pro_qty'] + 1;

            $cuppp = mi_db_update('mi_product_cart', array('pro_qty' => $mainQty), array('pro_id' => $idd, 'user_id'=>$uid));

            if ($cuppp){
                echo 'Cart Item Quantity Increased';
                exit;
            }else{
                header("HTTP/1.0 400 Bad Request");
                die();
            }

        }

    }
    echo json_encode($msg);
}

if (isset($_POST['quantity_updater']) && !empty($_POST['quantity_updater'])){
    $uid = str_replace('mi_', '', base64_decode($_SESSION['session_id']));
    $pro_id = mi_secure_input($_POST['pro_id']);
    $quantity = mi_secure_input($_POST['quantity']);
    $credentials_chk = array(
        'pro_id' => $pro_id,
        'user_id' => $uid
    );

    $chk = mi_db_read_by_id('mi_product_cart', $credentials_chk);

    if (count($chk) > 0){
        $chkProStock = mi_db_read_by_id('mi_products', array('pro_id'=>$pro_id))[0];

        if (($chkProStock['pro_stock']-1) < $quantity){
            $msg = array('status' => 'error', 'message'=>'Product quantity not available');
        }elseif ($quantity < 1){
            $msg = array('status' => 'error', 'message'=>'Invalid product quantity');
        }else{

            $cuppp = mi_db_update('mi_product_cart', array('pro_qty' => $quantity), array('pro_id' => $pro_id, 'user_id'=>$uid));

            if ($cuppp){
                echo 'Cart Item Quantity Increased';
                exit;
            }else{
                header("HTTP/1.0 400 Bad Request");
                die();
            }

        }

    }
    echo json_encode($msg);
}


if (isset($_POST['minus_cart_item_id']) && !empty($_POST['minus_cart_item_id'])){
    $uid = str_replace('mi_', '', base64_decode($_SESSION['session_id']));
    $idd = mi_secure_input($_POST['minus_cart_item_id']);
    $credentials_chk = array(
        'pro_id' => $idd,
        'user_id' => $uid
    );

    $chk = mi_db_read_by_id('mi_product_cart', $credentials_chk);

    if (count($chk) > 0){

        if ($chk[0]['pro_qty'] <= 1){
            echo "Quantity cannot be less then 1";
            exit;
        }else{
            $mainQty = $chk[0]['pro_qty'] - 1;

            $cuppp = mi_db_update(
                    'mi_product_cart',
                    array('pro_qty' => $mainQty),
                    array('pro_id' => $idd, 'user_id'=>$uid)
            );

            if ($cuppp){
                echo 'Basket Item Quantity Decreased';
                exit;
            }else{
                header("HTTP/1.0 400 Bad Request");
                die();
            }
        }
    }
}


if (isset($_POST['clear_all_basket']) && !empty($_POST['clear_all_basket'])){
    $id = array(str_replace('mi_', '', base64_decode($_SESSION['session_id'])));
    $data = mi_db_delete('mi_product_cart', 'user_id', $id);
    $del_sales_meta = mi_db_delete('sales_meta', 'user_id', $id);

    if ($data){
        echo "All Records Deleted";
    }else{
        header("HTTP/1.0 400 Bad Request");
        die();
    }
}

function generate_uuid() {
    return sprintf( '%04x%04x',
        mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),
        mt_rand( 0, 0xffff ),
        mt_rand( 0, 0x0C2f ) | 0x4000,
        mt_rand( 0, 0x3fff ) | 0x8000,
        mt_rand( 0, 0x2Aff ), mt_rand( 0, 0xffD3 ), mt_rand( 0, 0xff4B )
    );

}



if (isset($_POST['complete_purchase_item']) && !empty($_POST['complete_purchase_item'])){
    $ucomid = str_replace('mi_', '', base64_decode($_SESSION['session_id']));
    $currency = mi_db_read_by_id('settings_meta', array('meta_name'=>'shop_currency'))[0];
    $proid = array();
    $amount = array();
    $total = array();
    $get_pid = array();

    if (!empty($_POST['cid']) && $_POST['cid']){
        $customer_id = $_POST['cid'];
    }else{
        $customer_id = 0;
    }
    $data = mi_db_read_by_id('mi_product_cart', array('user_id'=>$ucomid));

    if($data){

        $vats = [];
        foreach ($data as $dat){

            $get_product = mi_db_read_by_id('mi_products', array('pro_id' => $dat['pro_id']))[0];
            $get_vat = mi_db_read_by_id('mi_purchase_vat', array('vid' => $dat['vat_id']))[0];

            $price = $get_product['pro_price'] * $dat['pro_qty'];
            $discount_amount = ($dat['discount']/100) * $price;
            $sub_total_amount = $price - $discount_amount;
            $total[] = $sub_total_amount;

            $vats[] = ($get_vat['vtax']/100) * $sub_total_amount;
//            $amount[] = ($amn['pro_price'] * $dat['pro_qty']);
            $proid[] = json_encode(
                array(
                    'pro_id' => $dat['pro_id'],
                    'pro_qty' => $dat['pro_qty'],
                    'pro_price' => $get_product['pro_price'],
                    'discount' => $dat['discount'],
                    'vat_id' => $dat['vat_id'],
                    'vat' => $get_vat['vtax']
                )
            );
            $get_pid[] = array('prid'=>$dat['pro_id'], 'prqty'=>$dat['pro_qty']);
        }

        $user_id = str_replace('mi_', '', base64_decode($_SESSION['session_id']));
        $get_sales_meta = mi_db_read_by_id('sales_meta', array('user_id' => $user_id))[0];
        $trxid = generate_uuid().rand(0, 999);
        if (count(mi_db_read_by_id('mi_purchase_vat', array('vtaxstatus' => 1, 'user_id'=>$ucomid))) > 0){
            $txdata = mi_db_read_by_id('mi_purchase_vat', array('vtaxstatus' => 1, 'user_id'=>$ucomid))[0];
        }
        $order_product_details = implode(', ', $proid);
//        print_r(array_sum($vats)); return;
        $total_amount = (array_sum($total) + array_sum($vats));

        if (isset($get_sales_meta['paid_amount'])){
            $paid_amount = $get_sales_meta['paid_amount'];
        }else{
            $paid_amount = $total_amount;
        }

        $inser_data = array(
            'order_products_details' => $order_product_details,
            'trx_id'                 => $trxid,
            'total_amount'           => $total_amount,
            'paid_amount'            => $paid_amount,
            'order_extra_note'       => $get_sales_meta['note'],
            'user_id'                => $user_id,
            'customer_id'            => $customer_id
        );
//        print_r($inser_data); return;

        $insert_order = mi_db_insert('mi_orders', $inser_data);

        if ($insert_order){

            foreach ($get_pid as $upstk){
                $crntqty = mi_db_read_by_id('mi_products', array('pro_id'=>$upstk['prid']))[0]['pro_stock'] - $upstk['prqty'];
                mi_db_update(
                    'mi_products',
                    array(
                        'pro_stock'=>$crntqty
                    ),
                    array('pro_id'=>$upstk['prid'])
                );
            }

            $htmlData = ''.

            $htmlData.= '<div class="info mi_invoice_id">
                                <h2 style="font-size: 15px !important;float: left; margin-bottom: 2px">Invoice ID: '.$trxid.'</h2>
                            </div>';
            $htmlData.= '<table class="table table-shopping table-borderless border" style="font-size: smaller">
                            <thead style="border-bottom: 1px solid #e3e3e3;">
                                <tr style="font-size: 10px">
                                    <th class="text-left" style="width: 40px;">SL.</th>
                                    <th class="text-left invoice_border">Item</th>
                                    <th class="text-center invoice_border">Qty</th>
                                    <th class="text-center invoice_border">Unit Price</th>
                                    <th class="text-center invoice_border">Discount (%)</th>
                                    <th class="text-center invoice_border">VAT (%)</th>
                                    <th class="text-center invoice_border">VAT amount</th>
                                    <th class="text-right invoice_border">Total</th>
                                </tr>
                            </thead>
                        <tbody style="border-bottom: 1px solid #e3e3e3; line-height: 0">';
            $rounder1 = 1;

            $bewDat = mi_db_read_by_id('mi_orders', array("trx_id"=>$trxid))[0];
            $fetcher = explode(', ', $bewDat['order_products_details']);

            $total_invoice = [];

            $nvat = [];
            $vat_counter = [];

            foreach ($fetcher as $d){
                $proDtl = json_decode($d, true);
                $product = mi_db_read_by_id('mi_products', array("pro_id"=>$proDtl['pro_id']))[0];
//                $total[] = $price['pro_price'] * $proDtl["pro_qty"];
                $qty_total[] = $proDtl["pro_qty"];

                $price_invoice = $proDtl["pro_qty"] * $proDtl["pro_price"];
                $discount_amount = ($proDtl['discount']/100)*$price_invoice;
                $sub_total_amount = $price_invoice - $discount_amount;
                $total_invoice[] = $sub_total_amount;

                if (!in_array($proDtl['vat_id'], $vat_counter)){
                    $vat_counter[] = $proDtl['vat_id'];
                    $nvat[$proDtl['vat_id']] = ($proDtl['vat']/100)*$sub_total_amount;
                }else{
                    $nvat[$proDtl['vat_id']]+= ($proDtl['vat']/100)*$sub_total_amount;
                }

                $htmlData.= '<tr>
                         <td>'.$rounder1.'</td>
                         <td class="text-left invoice_border">
                             '.$product['pro_title'].'
                         </td>
                         <td class="text-center invoice_border">
                            '.$proDtl['pro_qty'].' L
                         </td>
                         <td class="text-center invoice_border">
                            '.$proDtl['pro_price'].' '.$currency['meta_value'].'
                         </td>
                         <td class="text-center invoice_border">
                            '.$proDtl['discount'].' %
                         </td>
                         <td class="text-center invoice_border">
                            '.(!empty($proDtl['vat'])?$proDtl['vat']:'0').' %
                         </td>
                         <td class="text-center invoice_border">
                            '.($proDtl['vat']/100)*$sub_total_amount.' '.$currency['meta_value'].'
                         </td>
                         <td class="text-right invoice_border">'.$sub_total_amount.' '.$currency['meta_value'].'</td>
                     </tr>';
                $rounder1++;
            }
            $htmlData.= row_repeater(count($fetcher));

            $htmlData.= '</tbody>
                 <tfoot>
                    <tr>
                        <th class="text-right" colspan="7" style="padding: 3px">Sub total</th>
                        <th class="text-right" style="padding: 3px">'.array_sum($total_invoice).' '.$currency['meta_value'].'</th>
                    </tr>';

            $payable_vat_invoice = [];
//            print_r($nvat);
            foreach($nvat as $k => $vt){
                $payable_vat[] = $vt;
                $get_title = mi_db_read_by_id('mi_purchase_vat', array('vid'=>$k));
                if (count($get_title)>0){
                    $htmlData .= '<tr>
                             <th class="text-right" colspan="7" style="padding: 3px">' . $get_title[0]['vtaxdetails'] . '</th>
                             <th class="text-right" style="padding: 3px">' . $vt . ' ' . $currency['meta_value'] . '</th>
                         </tr>';
                }
            }

            $htmlData.= ' <tr>
                        <th class="text-right" colspan="7" style="padding: 3px">Due: </th>
                       <th class="text-right" style="padding: 3px">'.($bewDat['total_amount'] - $bewDat['paid_amount']).' '.$currency['meta_value'].'</th>
                    </tr>';



            $htmlData.= '<tr>

                            <th class="text-left" colspan="2">Total Products: '.count($data).'<br>Total Qty: '.array_sum($qty_total).' L</th>
                                    <th class="text-right" colspan="5" style="font-size:18px">
                                        <span >Total Amount:</span><br>
                                        Paid:
                                       
                            </th>
                
                            <th class="text-right" style="font-size:18px">'.

                                "<span class='totalpayable' payableamount=".($bewDat['total_amount']).">".($bewDat['total_amount']).' '.$currency['meta_value'].'</span><br>'.

                                '<span>'.($bewDat['paid_amount']).' ' . $currency['meta_value'] . '</span>'.'
                               
                            </th>
                        </tr>
                </tfoot>
            </table>';

            mi_db_update('sales_meta', array('paid_amount'=>'0', 'note'=>''), array('user_id'=>str_replace('mi_', '', base64_decode($_SESSION['session_id']))));

        }else{
            $htmlData.= "Order Not Submitted";
        }
    }else{
        $htmlData.= "<h2>No Products Found In Cart</h2>";
    }

    echo json_encode(array('data'=>$htmlData, 'due'=>($bewDat['total_amount']-$bewDat['paid_amount'])));
}




if (isset($_POST['mi_authenticator_user_id']) && !empty($_POST['mi_authenticator_user_id']) && isset($_POST['mi_authenticator_user_password']) && !empty($_POST['mi_authenticator_user_password'])){
    $uid = mi_secure_input($_POST['mi_authenticator_user_id']);
    $ups = mi_secure_input(md5($_POST['mi_authenticator_user_password']));

    $datauser = mi_db_read_by_id('mi_users', array('user_id' => $uid));

    if (count($datauser) != 0){

        if ($ups !== $datauser[0]['pass']){
            $msg = array('status' => 'error', 'message' => 'Password not matching.');
        }else{
            if ($datauser[0]['status'] == 1){
                $_SESSION['session_id'] = base64_encode("mi_".$datauser[0]['id']);
                $_SESSION['session_type'] = base64_encode("mi_".$datauser[0]['user_type']);

                $msg = array('status' => 'success', 'message' => 'Authenticated Successfully!!!');
            }else{
                $msg = array('status' => 'error', 'message' => 'Your are not activated yet!!!');
            }
        }

    }else{
        $msg = array('status' => 'error', 'message' => 'User not available.');
    }

    echo json_encode($msg);
}


if (isset($_POST['refundOrder']) && !empty($_POST['refundOrder'])){
    $id = mi_secure_input($_POST['refundOrder']);

    $selPro = mi_db_read_by_id('mi_orders', array('order_id'=>$id))[0];
    $vvl = explode(', ', $selPro['order_products_details']);

    foreach ($vvl as $v){
        $get_pro_id = json_decode($v)->{'pro_id'};
        $get_pro_qty = json_decode($v)->{'pro_qty'};

        $pro_qty = mi_db_read_by_id('mi_products', array('pro_id'=>$get_pro_id))[0];
        $upst = $pro_qty['pro_stock'] + $get_pro_qty;


        $upStock = mi_db_update('mi_products', array('pro_stock'=>$upst), array('pro_id'=>$get_pro_id));
    }

    if ($upStock){
        $dtRefund = date('Y-m-d H:i:s');
        $data = mi_db_update('mi_orders', array('refund_date'=>$dtRefund), array('order_id'=>$id));

        if ($data){
            $msg = array('status' => 'success', 'message' => 'Order refunded Successfully!');
        }else{
            $msg = array('status' => 'error', 'message' => 'Order not refunded');
        }
    }else{
        $msg = array('status' => 'error', 'message' => 'Product stock is not updating');
    }
    echo json_encode($msg);
}

function show_error($status, $msg){
    echo json_encode(array('status'=>$status, 'message'=>$msg));
    exit;
}
//------------------single product refund---------------------

if (isset($_POST['singleRefundSubmit']) && !empty($_POST['singleRefundSubmit'])){
    $order_id = $_POST['order_id'];
    $data = $_POST['ref_data'];
//    $dataForm = [];
    $selPro = mi_db_read_by_id('mi_orders', array('order_id' => $order_id))[0];
    $productData = explode(', ', $selPro['order_products_details']);

    foreach ($data['id'] as $k => $val){
        if (!empty($data['qty'][$k])){
            $refund_data[] = ['id' => $val, 'qty'=> $data['qty'][$k]];
        }
    }
    $actual_data = [];
    $minusAmountUps = [];
    $chk_refund_qty = [];
    foreach ($productData as $k => $pro){
        $new_pro = json_decode($pro, true);
        $search = array_search($new_pro['pro_id'], array_column($refund_data, 'id'));
        $chk_refund_qty[] = $refund_data[$search]['qty'];
        if ($new_pro['pro_id'] == $refund_data[$search]['id']){
            if ($refund_data[$search]['qty'] > $new_pro['pro_qty'] || $refund_data[$search]['qty'] < 1){
                show_error('error', 'Invalid refund quantity');
            }else{
                //----------update product stock--------------
                $product_from_stock = mi_db_read_by_id('mi_products', array('pro_id'=> $new_pro['pro_id']))[0];
                $stock_data = $product_from_stock['pro_stock'] + $refund_data[$search]['qty'];
                $update_stock = mi_db_update('mi_products', array('pro_stock'=> $stock_data), array('pro_id' => $new_pro['pro_id']));
                if ($update_stock == true){
                    //---------minus refund qty from main qty--------------
                    $new_pro['pro_qty'] = $new_pro['pro_qty'] - $refund_data[$search]['qty'];
                    $actual_data[] = json_encode($new_pro);
                    //-----------calculating refunded product price----------
                    $discount_amount = ($new_pro['discount']/100) * $new_pro['pro_price'];
                    $prod_price = $new_pro['pro_price'] - $discount_amount;
                    if ($new_pro['vat'] == null){
                        $vat = 0;
                    }else{
                        $vat = ($new_pro['vat']/100) * $prod_price;
                    }
                    $minusAmountUps[] = ($prod_price + $vat) * $refund_data[$search]['qty'];
                }else{
                    echo "Error to update stock";
                }

            }
        }else{
            $actual_data[] = json_encode($new_pro);
        }
    }
//    print_r($actual_data); return;
    if (array_sum($chk_refund_qty) == 0){
        $msg = array('status' => 'error', 'message' => 'Please enter refund quantity!');
        echo json_encode($msg);
        return;
    }else{
        $due = $selPro['total_amount'] - $selPro['paid_amount'];
        $updated_amount = $selPro['total_amount'] - array_sum($minusAmountUps);
        

        if($due > array_sum($minusAmountUps)){
            $update_paid_amount = $selPro['paid_amount'];
        }else{
            $update_paid_amount = $selPro['paid_amount'] - (array_sum($minusAmountUps) - $due);
        }
        
        $updatedData = array(
            'order_products_details' => implode(', ',$actual_data),
            'total_amount' => $updated_amount,
            'paid_amount' => $update_paid_amount
        );

        $updateOrder = mi_db_update('mi_orders', $updatedData, array('order_id' => $order_id));
        if ($updateOrder == true){
            $chk_refund = [];
            $ref = mi_db_read_by_id('mi_orders', array('order_id' => $order_id))[0];

            $refDetails = explode(', ', $ref['order_products_details']);
            foreach ($refDetails as $k => $od) {
                $chk_refund[] = json_decode($od, true)['pro_qty'];
            }

            if (array_sum($chk_refund) == 0){
                $refundDate = date('Y-m-d H:i:s');
                mi_db_update('mi_orders', array('refund_date' => $refundDate), array('order_id' => $order_id));
            }
            $msg = array('status' => 'success', 'message' => 'Product refunded successfully!');
        }else{
            $msg = array('status' => 'error', 'message' => 'Error to refund product');
        }
    }

    echo json_encode($msg);
}


if (isset($_POST['deleteStock']) && !empty($_POST['deleteStock'])){
    $id = mi_secure_input($_POST['deleteStock']);

    $selPro = mi_db_read_by_id('mi_stocks', array('stock_id'=>$id))[0];
    $selSerial = json_decode($selPro['pro_serials'], true);
    $arrOut = [];

    $get_pr = mi_db_read_by_id('mi_products', array('pro_id'=>$selPro['product_id']))[0];
    $upst = $get_pr['pro_stock'] - $selPro['stock_qty'];
    $serials = json_decode($get_pr['pro_serial'], true);

    foreach ($serials as $sls){
        if (!in_array($sls, $selSerial)){

            $arrOut[] = $sls;
        }

    }

    $upStock = mi_db_update('mi_products', array('pro_stock'=>$upst, 'pro_serial'=>json_encode($arrOut)), array('pro_id'=>$selPro['product_id']));

    if ($upStock){
        $dtRefund = date('Y-m-d H:i:s');
        $data = mi_db_update('mi_stocks', array('refund_date'=>$dtRefund), array('stock_id'=>$id));
        if ($data){
            $msg = array('status' => 'success', 'message' => 'Stock refunded Successfully!');
        }else{
            $msg = array('status' => 'error', 'message' => 'Stock not refunded');
        }
    }else{
        $msg = array('status' => 'error', 'message' => 'Product stock is not updating');
    }
    echo json_encode($msg);
}


if (isset($_POST['mi_user_adding_form']) && !empty($_POST['mi_user_adding_form'])){
    $created = mi_secure_input($_POST['created_by']);
    $udi = mi_secure_input($_POST['usr_id']);
    $unm = mi_secure_input($_POST['usr_name']);
    $fatherName = mi_secure_input($_POST['father_name']);
    $motherName = mi_secure_input($_POST['mother_name']);
    $uph = mi_secure_input($_POST['usr_phone']);
    $address = mi_secure_input($_POST['address']);
    $uem = mi_secure_input($_POST['usr_email']);
    $ups = mi_secure_input($_POST['usr_pass']);
    $nid_no = mi_secure_input($_POST['nid_no']);
    $salary = mi_secure_input($_POST['salary']);
    $ust = mi_secure_input($_POST['usr_status']);
    $utp = mi_secure_input($_POST['usr_type']);

    $nid_photo = $_FILES['staff_nid'];
    $user_photo = $_FILES['staff_photo'];

    $check = mi_db_read_all('mi_users');

    $last_id = mi_db_read_all('mi_users', 'id', 'DESC', '1')[0];

    if (empty($udi)){
        $msg = array('status' => 'error', 'message' => 'User id is required');
    }elseif (empty($udi)){
        $msg = array('status' => 'error', 'message' => 'User Undefined');
    }elseif (empty($unm)){
        $msg = array('status' => 'error', 'message' => 'User Name is required');
    }elseif (empty($ups)){
        $msg = array('status' => 'error', 'message' => 'User Password is required');
    }elseif (empty($ust)){
        $msg = array('status' => 'error', 'message' => 'User status is required');
    }elseif (empty($utp)){
        $msg = array('status' => 'error', 'message' => 'User type is required');
    }elseif (count($check) >= 3){
        $msg = array('status' => 'error', 'message' => 'You can not add more than 3 staff');
    }else{
        $checkUser = mi_db_read_by_id('mi_users', array('user_id'=>$udi));
        if (count($checkUser) > 0){
            $msg = array('status' => 'error', 'message' => 'User id already exists');
        }else{
            $up_nid = mi_uploader(
                $nid_photo['name'],
                $nid_photo['tmp_name'],
                'uploads/staff-images/',
                array('png', 'PNG', 'jpg', 'jpeg', 'JPG', 'gif', 'JPEG')
            );
            $up_photo = mi_uploader(
                $user_photo['name'],
                $user_photo['tmp_name'],
                'uploads/staff-images/',
                array('png', 'PNG', 'jpg', 'jpeg', 'JPG', 'gif', 'JPEG')
            );

            if (!empty($nid_photo['name']) && !empty($user_photo['name'])) {

                $data = array(
                    'user_id'           => $udi,
                    'pass'              => md5($ups),
                    'user_name'         => $unm,
                    'father_name'       => $fatherName,
                    'mother_name'       => $motherName,
                    'address'           => $address,
                    'nid_no'            => $nid_no,
                    'salary'            => $salary,
                    'user_designation'  => ($utp == 2)?'Accounts':'Sales Man',
                    'status'            => $ust,
                    'user_type'         => $utp,
                    'created_by'        => $created,
                    'email'             => $uem,
                    'phone'             => $uph,
                    'nid_photo'         => $up_nid,
                    'user_photo'        => $up_photo
                );
            }elseif (!empty($nid_photo['name'])){
                $data = array(
                    'user_id'           => $udi,
                    'pass'              => md5($ups),
                    'user_name'         => $unm,
                    'father_name'       => $fatherName,
                    'mother_name'       => $motherName,
                    'address'           => $address,
                    'nid_no'            => $nid_no,
                    'salary'            => $salary,
                    'user_designation'  => ($utp == 2)?'Accounts':'Sales Man',
                    'status'            => $ust,
                    'user_type'         => $utp,
                    'created_by'        => $created,
                    'email'             => $uem,
                    'phone'             => $uph,
                    'nid_photo'         => $up_nid
                );
            }elseif (!empty($user_photo['name'])){
                $data = array(
                    'user_id'           => $udi,
                    'pass'              => md5($ups),
                    'user_name'         => $unm,
                    'father_name'       => $fatherName,
                    'mother_name'       => $motherName,
                    'address'           => $address,
                    'nid_no'            => $nid_no,
                    'salary'            => $salary,
                    'user_designation'  => ($utp == 2)?'Accounts':'Sales Man',
                    'status'            => $ust,
                    'user_type'         => $utp,
                    'created_by'        => $created,
                    'email'             => $uem,
                    'phone'             => $uph,
                    'user_photo'        => $up_photo
                );
            }else{
                $data = array(
                    'user_id'           => $udi,
                    'pass'              => md5($ups),
                    'user_name'         => $unm,
                    'father_name'       => $fatherName,
                    'mother_name'       => $motherName,
                    'address'           => $address,
                    'nid_no'            => $nid_no,
                    'salary'            => $salary,
                    'user_designation'  => ($utp == 2)?'Accounts':'Sales Man',
                    'status'            => $ust,
                    'user_type'         => $utp,
                    'created_by'        => $created,
                    'email'             => $uem,
                    'phone'             => $uph
                );
            }

            $insert = mi_db_insert('mi_users', $data);

            if ($insert){
                $msg = array('status' => 'success', 'message' => 'User created successfully');
            }else{
                $msg = array('status' => 'error', 'message' => 'Error to add user');
            }
        }
    }

    echo json_encode($msg);
}





if (isset($_POST['mi_user_updating_form']) && !empty($_POST['mi_user_updating_form'])){

    $uid = mi_secure_input(base64_decode($_POST['csxrf']));

    $udi = mi_secure_input($_POST['usr_id']);
    $unm = mi_secure_input($_POST['usr_name']);
    $fatherName = mi_secure_input($_POST['father_name']);
    $motherName = mi_secure_input($_POST['mother_name']);
    $uph = mi_secure_input($_POST['usr_phone']);
    $address = mi_secure_input($_POST['address']);
    $uem = mi_secure_input($_POST['usr_email']);
    $ups = mi_secure_input($_POST['usr_pass']);
    $nid_no = mi_secure_input($_POST['nid_no']);
    $salary = mi_secure_input($_POST['salary']);
    $ust = mi_secure_input($_POST['usr_status']);
    $utp = mi_secure_input($_POST['usr_type']);

    $nid_photo = $_FILES['staff_nid'];
    $user_photo = $_FILES['staff_photo'];


    if (empty($uid)){
        $msg = array('status' => 'error', 'message' => 'User Undefined');
    }elseif (empty($unm)){
        $msg = array('status' => 'error', 'message' => 'User Name is required');
    }elseif (empty($ust)){
        $msg = array('status' => 'error', 'message' => 'User status is required');
    }elseif (empty($utp)){
        $msg = array('status' => 'error', 'message' => 'User type is required');
    }else{

        $staff_info = mi_db_read_by_id('mi_users', array('id' => $uid))[0];

        if (isset($ups) && !empty($ups)){
            $password = md5($ups);
        }else{
            $password = $staff_info['pass'];
        }

        if (!empty($nid_photo['name'])){
            $up_nid = mi_uploader(
                $nid_photo['name'],
                $nid_photo['tmp_name'],
                'uploads/staff-images/',
                array('png', 'PNG', 'jpg', 'jpeg', 'JPG', 'gif', 'JPEG')
            );
            if ($up_nid != false){
                unlink($staff_info['nid_photo']);
            }
        }else{
            $up_nid = $staff_info['nid_photo'];
        }

        if (!empty($user_photo['name'])){
            $up_photo = mi_uploader(
                $user_photo['name'],
                $user_photo['tmp_name'],
                'uploads/staff-images/',
                array('png', 'PNG', 'jpg', 'jpeg', 'JPG', 'gif', 'JPEG')
            );
            if ($up_photo != false){
                unlink($staff_info['user_photo']);
            }
        }else{
            $up_photo = $staff_info['user_photo'];
        }

        $data = array(
            'user_id'           => $staff_info['user_id'],
            'pass'              => $password,
            'user_name'         => $unm,
            'father_name'       => $fatherName,
            'mother_name'       => $motherName,
            'address'           => $address,
            'nid_no'            => $nid_no,
            'salary'            => $salary,
            'user_designation'  => ($utp == 2)?'Accounts':'Sales Man',
            'status'            => $ust,
            'user_type'         => $utp,
            'email'             => $uem,
            'phone'             => $uph,
            'nid_photo'         => $up_nid,
            'user_photo'        => $up_photo
        );


        $insert = mi_db_update('mi_users', $data, array('id'=>$uid));

        if ($insert){
            $msg = array('status' => 'success', 'message' => 'User updated successfully');
        }else{
            $msg = array('status' => 'error', 'message' => 'Error to update user');
        }
    }

    echo json_encode($msg);
}
//----------------------------------------------------------------------
//                            backup
//----------------------------------------------------------------------

//------------export backup-------------
if (isset($_POST['backup_export']) && !empty($_POST['backup_export']) && $_POST['backup_export'] == 1){
    $name = 'MI_BACKUP';
    $extension = 'mi';
    $path = dirname(__FILE__).DIRECTORY_SEPARATOR.'backup/';

    $flag = false;
    if (is_dir($path)){
        $data = [];
        foreach (scandir($path) as $files){
            if (strlen($files) > 10){
                $data[] = $files;
            }
        }
        if (count($data)<5){
            $flag = true;
        }
    }

    if ($flag == true){
        $exported = mi_db_export($name, $extension, $path, true);
        if ($exported !== false){
            $msg = array('status'=>'success', 'msg'=>'Backup Created Successfully', 'file'=>$exported);
        }else{
            $msg = array('status'=>'error', 'msg'=>'Error to create backup');
        }
    }else{
        $msg = array('status'=>'error', 'msg'=>"Error to create more then 5 backups.");
    }

    mi_set_session('alert', $msg);
    mi_redirect(MI_BASE_URL.'backup.php');
}

//----------------import backup------------------
if (isset($_POST['backup_restore']) && !empty($_POST['backup_restore']) && $_POST['backup_restore'] == 1){
    $file = $_FILES['backup_file'];
    $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
    if ($ext == 'mi'){
        $import = mi_db_import($file);
        if (in_array(0, $import)){
            $msg = array('status'=>'error', 'msg'=>'Some data not imported!');
        }else{
            $msg = array('status'=>'success', 'msg'=>'Data imported successfully');
        }
    }else{
        $msg = array('status'=>'error', 'msg'=>'File not exists');
    }

    mi_set_session('alert', $msg);
    mi_redirect(MI_BASE_URL.'backup.php');
}

//-----------------------delete backup--------------------
if (isset($_POST['backup_delete_request']) && !empty($_POST['backup_delete_request']) && $_POST['backup_delete_request'] == 1){
    $path = dirname(__FILE__).DIRECTORY_SEPARATOR.'backup'.DIRECTORY_SEPARATOR.mi_secure_input($_POST['file']);
    if (file_exists($path)){

        if (unlink($path)){
            $msg = array('status'=>'success', 'msg'=>'Backup deleted successfully');
        }else{
            $msg = array('status'=>'error', 'msg'=>'Error to delete backup');
        }

    }else{
        $msg = array('status'=>'error', 'msg'=>'File not exists');
    }

    echo json_encode($msg);
}
//---------------------------add VAT--------------------------
if (isset($_POST['add_vat'])){
    $title = mi_secure_input($_POST['vat_details']);
    $parcent = mi_secure_input($_POST['vat_percent']);
    $status = mi_secure_input($_POST['vat_status']);

    if (empty($title)){
        $msg = array('status'=>'error', 'msg'=>"VAT title is required");
    }elseif (empty($parcent)){
        $msg = array('status'=>'error', 'msg'=>"VAT percentage is required");
    }elseif (empty($status)){
        $msg = array('status'=>'error', 'msg'=>"VAT status is required");
    }else{
        $data = array(
            'vtaxdetails' => $title,
            'vtax' => $parcent,
            'vtaxstatus' => $status
        );

        $insert = mi_db_insert('mi_purchase_vat', $data);
        if ($insert == true){
            $msg = array('status'=>'success', 'msg'=>"VAT added successfully");
        }else{
            $msg = array('status'=>'error', 'msg'=>"Error to add VAT");
        }
    }

    mi_set_session('alert', $msg);
    mi_redirect(MI_BASE_URL.'vat.php');
}
//--------------------------------edit vat----------------------------
if (isset($_POST['editVatSubmit'])){
    $vatId = mi_secure_input($_POST['vat_edit_id']);
    $vat_details = mi_secure_input($_POST['vat_details']);
    $vat_percent = mi_secure_input($_POST['vat_percent']);
    $vat_status = mi_secure_input($_POST['vat_status']);

    if (empty($vat_details)){
        $msg = array('status'=>'error', 'msg'=>"VAT details is required");
    }elseif (empty($vat_percent)){
        $msg = array('status'=>'error', 'msg'=>"VAT percentage is required");
    }elseif (empty($vat_percent)){
        $msg = array('status'=>'error', 'msg'=>"VAT percentage is required");
    }elseif ($vat_percent < 1){
        $msg = array('status'=>'error', 'msg'=>"VAT percentage can't be less than 1");
    }else{
        $data = array(
            'vtax' => $vat_percent,
            'vtaxdetails' => $vat_details,
            'vtaxstatus' => $vat_status
        );
        $update = mi_db_update('mi_purchase_vat', $data, array('vid'=> $vatId));

        if ($update == true){
            $msg = array('status'=>'success', 'msg'=>"VAT updated successfully");
        }else{
            $msg = array('status'=>'error', 'msg'=>"Error to update VAT");
        }
    }
    mi_set_session('alert', $msg);
    mi_redirect(MI_BASE_URL.'vat.php?ve='.$vatId);
}

//---------------------------add expense type--------------------------
if (isset($_POST['add_type'])){
    $title = mi_secure_input($_POST['title']);

    if (empty($title)){
        $msg = array('status'=>'error', 'msg'=>"VAT title is required");
    }else{
        $data = array(
            'type' => $title
        );

        $insert = mi_db_insert('expense_type', $data);
        if ($insert == true){
            $msg = array('status'=>'success', 'msg'=>"Expense type added successfully");
        }else{
            $msg = array('status'=>'error', 'msg'=>"Error to add expense type");
        }
    }

    mi_set_session('alert', $msg);
    mi_redirect(MI_BASE_URL.'expense_type.php');
}

//--------------------------------edit expense type----------------------------
if (isset($_POST['editTypeSubmit'])){
    $typeId = mi_secure_input($_POST['type_edit_id']);
    $title = mi_secure_input($_POST['title']);

    if (empty($title)){
        $msg = array('status'=>'error', 'msg'=>"Expense type title is required");
    }else{
        $data = array(
            'type' => $title
        );
        $update = mi_db_update('expense_type', $data, array('id'=> $typeId));

        if ($update == true){
            $msg = array('status'=>'success', 'msg'=>"Expense type updated successfully");
        }else{
            $msg = array('status'=>'error', 'msg'=>"Error to update expense type");
        }
    }
    mi_set_session('alert', $msg);
    mi_redirect(MI_BASE_URL.'expense_type.php?et='.$typeId);
}

//--------------------------change shop logo---------------------
if (isset($_POST['changeLogoSubmit'])){
    $id = mi_secure_input($_POST['shop_logo_id']);
    $logo = $_FILES['shop_logo'];

    if (empty($logo['name'])){
        $msg = array('status'=>'error', 'message'=>'Shop logo is required');
    }else{
        $existingData = mi_db_read_by_id('settings_meta', array('id'=>$id))[0];
        $existingLogo = $existingData['meta_value'];

        $newLogo = mi_uploader(
            $logo['name'],
            $logo['tmp_name'],
            'uploads/settings-img/',
            array('png', 'PNG', 'jpg', 'jpeg', 'JPG', 'gif', 'GIF', 'JPEG', 'svg', 'SVG')
        );
        if ($newLogo != false){
            unlink($existingLogo);
        }
        $data = array(
                'meta_value' => $newLogo
        );
        $update = mi_db_update('settings_meta', $data, array('id'=>$id));
        if ($update == true){
            $msg = array('status'=>'success', 'message'=>'Shop logo changed successfully');
        }else{
            $msg = array('status'=>'error', 'message'=>'Error to change shop logo');
        }

    }
    echo json_encode($msg);
}

//--------------------------change shop details---------------------
if (isset($_POST['shopDetailsSubmit'])){
    $id = mi_secure_input($_POST['details_id']);
    $details = mi_secure_input($_POST['details']);

    if (empty($details)){
        $msg = array('status'=>'error', 'message'=>'Shop details is required');
    }else{
        $data = array(
            'meta_value' => $details
        );
        $update = mi_db_update('settings_meta', $data, array('id'=>$id));
        if ($update == true){
            $msg = array('status'=>'success', 'message'=>'Shop detail changed successfully');
        }else{
            $msg = array('status'=>'error', 'message'=>'Error to change shop detail');
        }

    }
    echo json_encode($msg);
}

//--------------------------change shop footer text---------------------
if (isset($_POST['footerTextSubmit'])){
    $id = mi_secure_input($_POST['footer_id']);
    $text = mi_secure_input($_POST['footer_text']);

    if (empty($text)){
        $msg = array('status'=>'error', 'message'=>'Footer text is required');
    }else{
        $data = array(
            'meta_value' => $text
        );
        $update = mi_db_update('settings_meta', $data, array('id'=>$id));
        if ($update == true){
            $msg = array('status'=>'success', 'message'=>'Footer text changed successfully');
        }else{
            $msg = array('status'=>'error', 'message'=>'Error to change footer text');
        }

    }
    echo json_encode($msg);
}

//--------------------------change shop footer link---------------------
if (isset($_POST['footerLinkSubmit'])){
    $id = mi_secure_input($_POST['footer_link_id']);
    $link = mi_secure_input($_POST['footer_link']);

    if (empty($link)){
        $msg = array('status'=>'error', 'message'=>'Footer link is required');
    }else{
        $data = array(
            'meta_value' => $link
        );
        $update = mi_db_update('settings_meta', $data, array('id'=>$id));
        if ($update == true){
            $msg = array('status'=>'success', 'message'=>'Footer link changed successfully');
        }else{
            $msg = array('status'=>'error', 'message'=>'Error to change footer link');
        }

    }
    echo json_encode($msg);
}

//--------------------------change shop currency---------------------
if (isset($_POST['currencySubmit'])){
    $id = mi_secure_input($_POST['currency_id']);
    $currency = mi_secure_input($_POST['currency']);

    if (empty($currency)){
        $msg = array('status'=>'error', 'message'=>'Currency is required');
    }else{
        $data = array(
            'meta_value' => $currency
        );
        $update = mi_db_update('settings_meta', $data, array('id'=>$id));
        if ($update == true){
            $msg = array('status'=>'success', 'message'=>'Currency changed successfully');
        }else{
            $msg = array('status'=>'error', 'message'=>'Error to change currency');
        }

    }
    echo json_encode($msg);
}


//--------------------------change shop currency---------------------
if (isset($_POST['shopLogoSubmit'])){
    $id = mi_secure_input($_POST['shopLogo_id']);
    $logo = $_FILES['shop_logo'];

    if (!isset($logo) || empty($logo['name'])){
        $msg = array('status'=>'error', 'message'=>'Logo is required');
    }else{
        $getSettings = mi_db_read_by_id('settings_meta', array('id'=>$id));
        if (count($getSettings)>0){
            $image = mi_uploader($logo['name'], $logo['tmp_name'], 'uploads/settings-img/', array('JPG', 'jpg', 'PNG', 'png'));
            if (!empty($image)){
                unlink($getSettings[0]['meta_value']);
                $data = array(
                    'meta_value' => $image
                );
                $update = mi_db_update('settings_meta', $data, array('id'=>$id));
                if ($update == true){
                    $msg = array('status'=>'success', 'message'=>'Shop Logo changed successfully');
                }else{
                    $msg = array('status'=>'error', 'message'=>'Error to change logo');
                }
            }else{
                $msg = array('status'=>'error', 'message'=>'Error to upload new logo');
            }
        }else{
            $msg = array('status'=>'error', 'message'=>'Invalid settings to update');
        }

    }
    echo json_encode($msg);
}

//--------------------------dashboard today sales filter-----------------------
if (isset($_GET['filter_today'])){
    $currency = mi_db_read_by_id('settings_meta', array('meta_name'=>'shop_currency','type'=>'currency'))[0];
    $todaySale = count(mi_db_tbl_val_between('mi_orders', 'order_created', date('Y-m-d 00:00:01'), date('Y-m-d 23:59:59'), array('refund_date'=> '0000-00-00 00:00:00')));

    $todaySales = array();
    $todaysAmnt = mi_db_tbl_val_between('mi_orders', 'order_created', date('Y-m-d 00:00:01'), date('Y-m-d 23:59:59'), array('refund_date'=> '0000-00-00 00:00:00'));
    foreach ($todaysAmnt as $tvl){
        $todaySales[] = $tvl['total_amount'];
    }
    $todaySaleAmount = number_format(array_sum($todaySales), 2);

    echo '<h1 class="display-1" style="font-size: 5rem;padding: 1.6rem 0rem;line-height: 100px;">
            <strong>'. $todaySale .'</strong>
          </h1>
          <h5>Sale Amount:
             <strong>'.$todaySaleAmount.' '.$currency['meta_value'].'</strong>
          </h5>
          ';
}

//--------------------------dashboard lastweek sales filter-----------------------
if (isset($_GET['filter_lastWeek'])){
    $currency = mi_db_read_by_id('settings_meta', array('meta_name'=>'shop_currency','type'=>'currency'))[0];
    $lastWeek = date("Y-m-d 00:00:01", strtotime("-6 days"));
    $lastWeekSale = count(mi_db_tbl_val_between('mi_orders', 'order_created', $lastWeek, date('Y-m-d 23:59:59'), array('refund_date'=> '0000-00-00 00:00:00')));

    $lastWeekSales = array();
    $lastWeekAmnt = mi_db_tbl_val_between('mi_orders', 'order_created', $lastWeek, date('Y-m-d 23:59:59'), array('refund_date'=> '0000-00-00 00:00:00'));
    foreach ($lastWeekAmnt as $tvl){
        $lastWeekSales[] = $tvl['total_amount'];
    }
    $lastWeekSaleAmount = number_format(array_sum($lastWeekSales), 2);
    
    echo '<h1 class="display-1" style="font-size: 5rem;padding: 1.6rem 0rem;line-height: 100px;">
            <strong>'. $lastWeekSale .'</strong>
          </h1>
          <h5>Sale Amount:
             <strong>'.$lastWeekSaleAmount.' '.$currency['meta_value'].'</strong>
          </h5>
          ';

}

//--------------------------dashboard lastmonth sales filter-----------------------
if (isset($_GET['filter_lastMonth'])){
    $currency = mi_db_read_by_id('settings_meta', array('meta_name'=>'shop_currency','type'=>'currency'))[0];
    $lastMonth = date("Y-m-d 00:00:01", strtotime("-29 days"));
    $lastMonthSale = count(mi_db_tbl_val_between('mi_orders', 'order_created', $lastMonth, date('Y-m-d 23:59:59'), array('refund_date'=> '0000-00-00 00:00:00')));

    $lastMonthSales = array();
    $lastMonthAmnt = mi_db_tbl_val_between('mi_orders', 'order_created', $lastMonth, date('Y-m-d 23:59:59'), array('refund_date'=> '0000-00-00 00:00:00'));
    foreach ($lastMonthAmnt as $tvl){
        $lastMonthSales[] = $tvl['total_amount'];
    }
    $lastMonthSaleAmount = number_format(array_sum($lastMonthSales), 2);

    echo '<h1 class="display-1" style="font-size: 5rem;padding: 1.6rem 0rem;line-height: 100px;">
            <strong>'. $lastMonthSale .'</strong>
          </h1>
          <h5>Sale Amount:
             <strong>'.$lastMonthSaleAmount.' '.$currency['meta_value'].'</strong>
          </h5>
          ';

}

//--------------------------dashboard today expense filter-----------------------
if (isset($_GET['filter_today_exp'])){
    $currency = mi_db_read_by_id('settings_meta', array('meta_name'=>'shop_currency','type'=>'currency'))[0];

    $todayExp = array();
    $todaysExpAmnt = mi_db_tbl_val_between('regular_expenses', 'expense_date', date('Y-m-d 00:00:01'), date('Y-m-d 23:59:59'));

    foreach ($todaysExpAmnt as $tvl){
        $todayExp[] = $tvl['amount'];
    }
    $todayExpAmount = array_sum($todayExp);

    echo '<span class="display-1" style="font-size: 4rem;padding: 3rem 0rem;line-height: 169px;">
            <strong>'. number_format($todayExpAmount, 2) .'</strong>
          </span>
          <span style="font-size: 2rem;">'.$currency['meta_value'].'</span>';
}

//--------------------------dashboard lastweek expense filter-----------------------
if (isset($_GET['filter_lastWeek_exp'])){
    $currency = mi_db_read_by_id('settings_meta', array('meta_name'=>'shop_currency','type'=>'currency'))[0];
    $lastWeek = date("Y-m-d 00:00:01", strtotime("-6 days"));

    $lastWeekExp = array();
    $lastWeekExpAmnt = mi_db_tbl_val_between('regular_expenses', 'expense_date', $lastWeek, date('Y-m-d 23:59:59'));
    foreach ($lastWeekExpAmnt as $tvl){
        $lastWeekExp[] = $tvl['amount'];
    }
    $lastWeekExpAmount = array_sum($lastWeekExp);

    echo '<span class="display-1" style="font-size: 4rem;padding: 3rem 0rem;line-height: 169px;">
            <strong>'. number_format($lastWeekExpAmount, 2) .'</strong>
          </span>
          <span style="font-size: 2rem;">'.$currency['meta_value'].'</span>';
}

//--------------------------dashboard lastmonth expense filter-----------------------
if (isset($_GET['filter_lastMonth_exp'])){
    $currency = mi_db_read_by_id('settings_meta', array('meta_name'=>'shop_currency','type'=>'currency'))[0];
    $lastMonth = date("Y-m-d 00:00:01", strtotime("-29 days"));


    $lastMonthExp = array();
    $lastMonthExpAmnt = mi_db_tbl_val_between('regular_expenses', 'expense_date', $lastMonth, date('Y-m-d 23:59:59'));
    foreach ($lastMonthExpAmnt as $tvl){
        $lastMonthExp[] = $tvl['amount'];
    }
    $lastMonthExpAmount = array_sum($lastMonthExp);

    echo '<span class="display-1" style="font-size: 4rem;padding: 3rem 0rem;line-height: 169px;">
            <strong>'. number_format($lastMonthExpAmount, 2) .'</strong>
          </span>
          <span style="font-size: 2rem;">'.$currency['meta_value'].'</span>';
}

//--------------------------dashboard total expense filter-----------------------
if (isset($_GET['filter_total_exp'])){
    $currency = mi_db_read_by_id('settings_meta', array('meta_name'=>'shop_currency','type'=>'currency'))[0];

    $totalExp = array();
    $totalExpAmnt = mi_db_read_all('regular_expenses');
    foreach ($totalExpAmnt as $tvl){
        $totalExp[] = $tvl['amount'];
    }
    $totalExpAmount = array_sum($totalExp);

    echo '<span class="display-1" style="font-size: 4rem;padding: 3rem 0rem;line-height: 169px;">
            <strong>'. number_format($totalExpAmount, 2) .'</strong>
          </span>
          <span style="font-size: 2rem;">'.$currency['meta_value'].'</span>';
}

//----------------------add expense----------------------------
if (isset($_POST['addExpenseForm']) && !empty($_POST['addExpenseForm'])){
    $title = mi_secure_input($_POST['title']);
    $amount = mi_secure_input($_POST['amount']);
    $expDate = mi_secure_input($_POST['exp_date']);
    $userId = str_replace('mi_', '', base64_decode($_SESSION['session_id']));


    if (empty($title)){
        $msg = array('status' => 'error', 'message' => 'Expense Title is required');
    }elseif (empty($amount)){
        $msg = array('status' => 'error', 'message' => 'Expense Amount is required');
    }elseif (!is_numeric($amount)){
        $msg = array('status' => 'error', 'message' => 'Expense Amount should number');
    }elseif (empty($expDate)){
        $msg = array('status' => 'error', 'message' => 'Expense Date is required');
    }else{
        $data = array(
            'type_id' => $title,
            'amount' => $amount,
            'expense_date' => $expDate.' '.date('H:i:s'),
            'user_id' => $userId,
            'type' => 'regular'
        );
        $insert = mi_db_insert('regular_expenses', $data);
        if ($insert == true){
            $msg = array('status' => 'success', 'message' => 'Expense added successfully');
        }else{
            $msg = array('status' => 'error', 'message' => 'Error to add expense');
        }

    }
    echo json_encode($msg);
}

//------------------------------edit expense----------------------------
if (isset($_POST['editExpenseSubmit'])){
    $id = mi_secure_input($_POST['exp_edit_id']);
    $title = mi_secure_input($_POST['title']);
    $amount = mi_secure_input($_POST['amount']);
    $expDate = mi_secure_input($_POST['exp_date']);
    $userId = str_replace('mi_', '', base64_decode($_SESSION['session_id']));

    if (empty($title)){
        $msg = array('status'=>'error', 'msg'=>"Expense Title is required");
    }elseif (empty($amount)){
        $msg = array('status'=>'error', 'msg'=>"Expense Amount is required");
    }elseif (empty($expDate)){
        $msg = array('status'=>'error', 'msg'=>"Expense Date is required");
    }else{
        $data = array(
            'type_id' => $title,
            'amount' => $amount,
            'expense_date' => $expDate.' '.date('H:i:s'),
            'user_id' => $userId
        );
        $update = mi_db_update('regular_expenses', $data, array('id'=> $id));

        if ($update == true){
            $msg = array('status'=>'success', 'msg'=>"Expense updated successfully");
        }else{
            $msg = array('status'=>'error', 'msg'=>"Error to update Expense");
        }
    }
    mi_set_session('alert', $msg);
    mi_redirect(MI_BASE_URL.'expense.php');
}

//----------------------add investment expense----------------------------
if (isset($_POST['addInvExpenseForm']) && !empty($_POST['addInvExpenseForm'])){
    $title = mi_secure_input($_POST['title']);
    $amount = mi_secure_input($_POST['amount']);
    $expDate = mi_secure_input($_POST['exp_date']);
    $userId = str_replace('mi_', '', base64_decode($_SESSION['session_id']));


    if (empty($title)){
        $msg = array('status' => 'error', 'message' => 'Expense Title is required');
    }elseif (empty($amount)){
        $msg = array('status' => 'error', 'message' => 'Expense Amount is required');
    }elseif (!is_numeric($amount)){
        $msg = array('status' => 'error', 'message' => 'Expense Amount should number');
    }elseif (empty($expDate)){
        $msg = array('status' => 'error', 'message' => 'Expense Date is required');
    }else{
        $data = array(
            'title' => $title,
            'amount' => $amount,
            'expense_date' => $expDate.' '.date('H:i:s'),
            'user_id' => $userId
        );
        $insert = mi_db_insert('investments', $data);
        if ($insert == true){
            $msg = array('status' => 'success', 'message' => 'Expense added successfully');
        }else{
            $msg = array('status' => 'error', 'message' => 'Error to add expense');
        }

    }
    echo json_encode($msg);
}

//------------------------------edit investment expense----------------------------
if (isset($_POST['editInvExpenseSubmit'])){
    $id = mi_secure_input($_POST['inv_edit_id']);
    $title = mi_secure_input($_POST['title']);
    $amount = mi_secure_input($_POST['amount']);
    $expDate = mi_secure_input($_POST['exp_date']);
    $userId = str_replace('mi_', '', base64_decode($_SESSION['session_id']));

    if (empty($title)){
        $msg = array('status'=>'error', 'msg'=>"Expense Title is required");
    }elseif (empty($amount)){
        $msg = array('status'=>'error', 'msg'=>"Expense Amount is required");
    }elseif (empty($expDate)){
        $msg = array('status'=>'error', 'msg'=>"Expense Date is required");
    }else{
        $data = array(
            'title' => $title,
            'amount' => $amount,
            'expense_date' => $expDate.' '.date('H:i:s'),
            'user_id' => $userId
        );
        $update = mi_db_update('investments', $data, array('id'=> $id));

        if ($update == true){
            $msg = array('status'=>'success', 'msg'=>"Expense updated successfully");
        }else{
            $msg = array('status'=>'error', 'msg'=>"Error to update Expense");
        }
    }
    mi_set_session('alert', $msg);
    mi_redirect(MI_BASE_URL.'investment.php');
}

//---------------------order due update---------------------
if (isset($_POST['rr_add_due']) && !empty($_POST['rr_add_due'])) {

    $provided_due=mi_secure_input($_POST['provided_due']);
    $due         =mi_secure_input($_POST['due']);
    $oid         =mi_secure_input($_POST['oid']);

    if ($provided_due < 1) {
        $msg = array('status' => 'error', 'message' => 'Provided due should be grater than 0 TK.');
    }elseif ($provided_due> $due) {
        $msg = array('status' => 'error', 'message' => 'Provided due should not be grater than current due.');
    }else{
        $prev_paid_amount = mi_db_read_by_id('mi_orders', array('order_id'=> $oid))[0];

        $total_paid = ($prev_paid_amount['paid_amount'] + $provided_due);

        $updated=mi_db_update('mi_orders', array('paid_amount'=>$total_paid), array('order_id'=>$oid));
        if ($updated) {
            $msg = array('status' => 'success', 'message' => 'Due added successfully.');
        }else{
            $msg = array('status' => 'error', 'message' => 'Something went wrong.');
        }

    }


    echo json_encode($msg);

}

//--------------------------single stock refund-------------------------
if (isset($_POST['singleStockRefundSubmit']) && $_POST['singleStockRefundSubmit'] == 1){
    $stock_id = mi_secure_input($_POST['stock_id']);
    $ref_qty = mi_secure_input($_POST['ref_stock_qty']);

    $stock = mi_db_read_by_id('mi_stocks', array('stock_id' => $stock_id))[0];
    $product = mi_db_read_by_id('mi_products', array('pro_id' => $stock['product_id']))[0];

    if (empty($ref_qty) || $ref_qty < 1){
        $msg = array('status' => 'error', 'message' => 'Refund quantity can not be empty or negative');
    }elseif ($ref_qty > $product['pro_stock']){
        $msg = array('status' => 'error', 'message' => 'Product stock quantity not available');
    }elseif ($ref_qty > $stock['stock_qty']){
        $msg = array('status' => 'error', 'message' => 'Invalid refund quantity for this stock');
    }else{
        $stock_ref_amount = $ref_qty * $stock['unit_price'];
        $total_amount = $stock['expanse'];
        $paid_amount = $stock['ex_paid'];
        $due = $total_amount - $paid_amount;

        $up_total_expense = $total_amount - $stock_ref_amount;
        
        if($due > $stock_ref_amount){
            $up_paid_amount = $paid_amount;
        }else{
            $up_paid_amount = $paid_amount - ($stock_ref_amount - $due);
        }

        $data = array(
            'ex_paid' => $up_paid_amount,
            'expanse' => $up_total_expense
        );

        $stock_update = mi_db_update('mi_stocks', $data, array('stock_id'=>$stock_id));

        if ($stock_update == true){
            $product_update = mi_db_update('mi_products', array('pro_stock' => $product['pro_stock']-$ref_qty), array('pro_id' => $product['pro_id']));
            $stock_update = mi_db_update('mi_stocks', array('stock_qty'=> $stock['stock_qty'] - $ref_qty), array('stock_id'=> $stock_id));

            if ($product_update && $stock_update == true){
                $msg = array('status' => 'success', 'message' => 'Product stock refunded');
            }
        }
    }
    echo json_encode($msg);
}

//----------------------------full stock refund-------------------------
if (isset($_POST['refundStock']) && !empty($_POST['refundStock'])){
    $stock_id = mi_secure_input($_POST['refundStock']);

    $stock = mi_db_read_by_id('mi_stocks', array('stock_id' => $stock_id))[0];
    $product = mi_db_read_by_id('mi_products', array('pro_id' => $stock['product_id']))[0];

    if ($stock['stock_qty'] > $product['pro_stock']){
        $msg = array('status' => 'error', 'message' => 'Invalid refund quantity');
    }else{
        $stock_update = mi_db_update('mi_stocks', array('refund_date' => date('Y-m-d h:i:s')), array('stock_id'=>$stock_id));

        if ($stock_update == true){
            $data = array(
                'pro_stock' => $product['pro_stock']- $stock['stock_qty'],
            );
            $product_update = mi_db_update('mi_products', $data, array('pro_id' => $stock['product_id']));

            if ($product_update == true){
                $update_due = mi_db_update('mi_stocks', array('ex_due' => 0), array('stock_id' => $stock_id));
                $msg = array('status' => 'success', 'message' => 'Stock refunded');
            }else{
                $msg = array('status' => 'error', 'message' => 'Error to refund stock');
            }
        }
    }
    echo json_encode($msg);
}

//------------------------stock due add-------------------------
if (isset($_POST['stock_add_due']) && !empty($_POST['stock_add_due'])) {

    $provided_stock_due =mi_secure_input($_POST['provided_stock_due']);
    $due_stock          =mi_secure_input($_POST['stock_due']);
    $sid                =mi_secure_input($_POST['sid']);

    $stock = mi_db_read_by_id('mi_stocks', array('stock_id'=> $sid))[0];
    $total_paid = $stock['ex_paid'] + $provided_stock_due;

    if ($provided_stock_due < 1) {
        $msg = array('status' => 'error', 'message' => 'Provided due should be grater than 0 TK.');
    }elseif ($provided_stock_due> $due_stock) {

        $msg = array('status' => 'error', 'message' => 'Provided due should not be grater than current due.');
    }else{

        $updated=mi_db_update('mi_stocks', array('ex_paid'=>$total_paid), array('stock_id'=>$sid));
        if ($updated) {
            $msg = array('status' => 'success', 'message' => 'Due added successfully.');
        }else{
            $msg = array('status' => 'error', 'message' => 'Something went wrong.');
        }

    }


    echo json_encode($msg);

}

//----------------------add customer from sales---------------------------

if (isset($_POST['AddCustomerSales']) && !empty($_POST['AddCustomerSales'])){
    $name = mi_secure_input($_POST['customer_name']);
    $phone = mi_secure_input($_POST['phone']);
    $address = mi_secure_input($_POST['address']);

    if (empty($name)){
        $msg = array('status' => 'error', 'message' => 'Customer name is required');
    }else{
        $data = array(
            'customer_name' => $name,
            'phone' => $phone,
            'address' => $address
        );
        $insert = mi_db_insert('customers', $data);
        if ($insert == true){
            $msg = array('status' => 'success', 'message' => 'Customer added successfully');
        }else{
            $msg = array('status' => 'error', 'message' => 'Error to add customer');
        }
    }

    echo json_encode($msg);
}

//---------------------------add customers--------------------------
if (isset($_POST['mi_customer_adding_form'])){
    $name = mi_secure_input($_POST['customer_name']);
    $phone = mi_secure_input($_POST['phone']);
    $address = mi_secure_input($_POST['address']);
    $type = mi_secure_input($_POST['customertype']);

    if (empty($name)){
        $msg = array('status'=>'error', 'msg'=>"Customer name is required");
    }else{
        $data = array(
                'customer_name' => $name,
                'phone' => $phone,
                'address' => $address,
                'type' => $type
        );

        $insert = mi_db_insert('customers', $data);
        if ($insert == true){
            $msg = array('status'=>'success', 'msg'=>"Customer added successfully");
        }else{
            $msg = array('status'=>'error', 'msg'=>"Error to add customer");
        }
    }

    mi_set_session('alert', $msg);
    mi_redirect(MI_BASE_URL.'customers.php');
}

//---------------------------edit customers--------------------------
if (isset($_POST['mi_customer_updating_form'])){
    $id = mi_secure_input($_POST['cid']);
    $name = mi_secure_input($_POST['customer_name']);
    $phone = mi_secure_input($_POST['phone']);
    $address = mi_secure_input($_POST['address']);
    $type = mi_secure_input($_POST['customertype']);

    if (empty($name)){
        $msg = array('status'=>'error', 'msg'=>"Customer name is required");
    }else{
        $data = array(
            'customer_name' => $name,
            'phone' => $phone,
            'address' => $address,
            'type' => $type
        );

        $update = mi_db_update('customers', $data, array('id'=> $id));
        if ($update == true){
            $msg = array('status'=>'success', 'msg'=>"Customer updated successfully");
        }else{
            $msg = array('status'=>'error', 'msg'=>"Error to update customer");
        }
    }

    mi_set_session('alert', $msg);
    mi_redirect(MI_BASE_URL.'customers.php');
}





if (isset($_GET['mi_custom_key_for_orderData']) && !empty($_GET['mi_custom_key_for_orderData']) && $_GET['mi_custom_key_for_orderData'] == 1) {
    $start_number = mi_secure_input($_GET['start']);
    $length = mi_secure_input($_GET['length']);
    $order = mi_secure_input($_GET['order'][0]['dir']);
    $search = mi_secure_input($_GET['search']['value']);

    $date_search = mi_secure_input($_GET['is_date_search']);
    $start = mi_secure_input($_GET['start_date']);
    $end = mi_secure_input($_GET['end_date']);

    if (!empty($search)) {
        $data_query = "SELECT 
                            mi_orders.order_id, 
                            mi_orders.order_products_details,
                            mi_orders.trx_id, 
                            mi_orders.total_amount, 
                            mi_orders.paid_amount, 
                            mi_orders.refund_date,
                            mi_orders.order_created,
                            customers.id as cid,
                            customers.customer_name as cname
                    FROM mi_orders LEFT OUTER JOIN customers ON mi_orders.customer_id = customers.id 
                    WHERE mi_orders.trx_id LIKE '%".$search."%' 
                    ORDER BY '".$order."' LIMIT ".$start_number.",".$length."
                    ";
    }elseif ($date_search == 'yes'){
        $data_query = "SELECT 
                            mi_orders.order_id,
                            mi_orders.order_products_details, 
                            mi_orders.trx_id, 
                            mi_orders.total_amount, 
                            mi_orders.paid_amount, 
                            mi_orders.refund_date,
                            mi_orders.order_created,
                            customers.id as cid,
                            customers.customer_name as cname
                    FROM mi_orders LEFT OUTER JOIN customers ON mi_orders.customer_id = customers.id 
                    WHERE mi_orders.order_created BETWEEN '".$start."' AND '".$end."'
                    ORDER BY mi_orders.order_id DESC LIMIT ".$start_number.",".$length." 
                    ";

    }else{
        $data_query = "SELECT 
                            mi_orders.order_id,
                            mi_orders.order_products_details, 
                            mi_orders.trx_id, 
                            mi_orders.total_amount, 
                            mi_orders.paid_amount, 
                            mi_orders.refund_date,
                            mi_orders.order_created,
                            customers.id as cid,
                            customers.customer_name as cname
                    FROM mi_orders LEFT OUTER JOIN customers ON mi_orders.customer_id = customers.id 
                    ORDER BY mi_orders.order_id DESC LIMIT ".$start_number.",".$length." 
                    ";
    }
    $currency = mi_db_read_by_id('settings_meta', array('meta_name'=>'shop_currency','type'=>'currency'))[0];
    $query_execute = mi_db_custom_query($data_query);
    $data = [];
    $total_amount = [];
    $total_due = [];
    foreach ($query_execute as $key => $d) {
        $vvl = explode(', ', $d['order_products_details']);
        $get_pro_img = array();
        $due = $d['total_amount'] - $d['paid_amount'];

        if ($d['refund_date'] == '0000-00-00 00:00:00'){
            $total_amount[] = $d['total_amount'];
            $total_due[] = $due;
        }

        $order_items = 0;
        $order_qty = [];
        foreach ($vvl as $k => $v){
            $get_pro_id = json_decode($v)->{'pro_qty'};
            $order_items += 1;
            $order_qty[] = $get_pro_id;
        }

        $data[] = [
            '<div class="checkbox">
                <label style="font-size: 1.5em">
                    <input type="checkbox" value="'.$d['order_id'].'" class="selectorcheck">
                    <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                </label>
            </div>',
            $d['trx_id'],
            ($d['cid'] !=0 ?$d['cname']:'Unknown'),
            'Items: '.$order_items.'<br>Qty: '.array_sum($order_qty). ' L',
            (number_format($d['total_amount'], 2))." ".$currency['meta_value']."
                <br>
            ".(($d['refund_date'] !== '0000-00-00 00:00:00')?'<span class="badge badge-dark" style="font-size: 12px;">Returned</span><br><sub>'.$d['refund_date'].'</sub>':''),
            date('d M Y', strtotime($d['order_created'])).'<br>'.date('h:i:s A', strtotime($d['order_created'])),
            (($due > 0)?number_format($due, 2).' '.$currency['meta_value']:'Paid').
            (($due>0)?'<br><button class="showduetk btn btn-sm btn-info" type="button" data-toggle="modal" data-placement="top" title="Due collection" data-target="#update_due" amount_due="'.$due.'" order_id="'.$d['order_id'].'" payable="'.$d['total_amount'].'"><i class="fa fa-edit"></i></button>':''),
            '<div class="btn-group mi-custom-button">
                <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-ellipsis-v"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-right" style="border: 1px solid #d4cece;">
                    <a    href="view_orders.php?mi_order_view='.$d['order_id'].'"
                                                      class="dropdown-item">
                        View
                    </a>
                    '.(($d['refund_date'] == "0000-00-00 00:00:00")?'<button class="dropdown-item refundForm" type="button" value="'.$d['order_id'].'">Return</button>':'').'
                    '.(($d['refund_date'] == "0000-00-00 00:00:00")?'<button class="dropdown-item singleRefundForm" type="button" value="'.$d['order_id'].'">Single Refund</button>':'').'    
                </div>
            </div>'

        ];
    }

    $table_footer_total_amount_data = number_format(array_sum($total_amount), 2).' '.$currency['meta_value'];
    $table_footer_total_due_data = number_format(array_sum($total_due), 2).' '.$currency['meta_value'];


    echo json_encode(
            array(
                'draw'=> mi_secure_input($_GET['draw']),
                'recordsTotal'=> count($data),
                'recordsFiltered' => count(mi_db_read_all('mi_orders')),
                'data'=>$data,
                'footDataTotalAmount'=> $table_footer_total_amount_data,
                'footDataTotalDue'=> $table_footer_total_due_data
            )
        );
}




if (isset($_POST['mi_get_single_refund_form']) && !empty($_POST['mi_get_single_refund_form']) && $_POST['mi_get_single_refund_form'] == 1){

    $order_id = mi_secure_input($_POST['order_id']);
    $get_order = mi_db_read_by_id('mi_orders', array('order_id'=>$order_id));
    if (count($get_order)>0){
        $refProd = [];
        $prod_details = explode(', ', $get_order[0]['order_products_details']);
        foreach ($prod_details as $itms){
            $refProd[] = json_decode($itms, true);
        }

        $htmls = '';
        foreach ($refProd as $kp => $prod){
            $get_ref_pro = mi_db_read_by_id('mi_products', array('pro_id' => $prod['pro_id']))[0];
            $htmls.= '<div class="row">
                          <input type="hidden" name="ref_data[id]['.$kp.']" value="'.$get_ref_pro['pro_id'].'">
                          <div class="col-md-2 d-flex justify-content-center">'.($kp + 1).'</div>
                          <div class="col-md-6">'.$get_ref_pro['pro_title'].'</div>
                          <div class="col-md-2 d-flex justify-content-center">'.$prod['pro_qty'].' L</div>
                          <div class="col-md-2 d-flex justify-content-center">
                              <input name="ref_data[qty]['.$kp.']" class="form-control" type="'.($prod['pro_qty']==0?'hidden':'number').'" min="1" max="'.$prod['pro_qty'].'">
                          </div>
                      </div>
                      <hr>';
        }

        $msg = array('status'=>'success', 'msg'=>"Data fetched", 'data'=>$htmls);
    }else{
        $msg = array('status'=>'error', 'msg'=>"Some error occurred, please try again.");
    }

    echo json_encode($msg);
}
//---------------------get sales customer----------------------------
if (isset($_POST['customer_id_new']) && !empty($_POST['customer_id_new'])) {
    $customer_id=mi_secure_input($_POST['customer_id_new']);
    $data=mi_db_read_by_id('customers', array('id' =>$customer_id));

    if ($data) {
        $msg=array('status'=>'success','message'=>$data);
    }else{
        $msg=array('status'=>'error','message'=>'Something went wrong');
    }

    echo json_encode($msg);

}

// ----------------------single stock refund modal--------------------
if (isset($_POST['mi_get_single_stock_refund_form']) && !empty($_POST['mi_get_single_stock_refund_form']) && $_POST['mi_get_single_stock_refund_form'] == 1){

    $stock_id = mi_secure_input($_POST['stock_id']);
    $get_stock = mi_db_read_by_id('mi_stocks', array('stock_id'=>$stock_id));

    $htmls = '';
    foreach($get_stock as $k=> $stock){
        $product = mi_db_read_by_id('mi_products', array('pro_id'=> $stock['product_id']))[0];
        $htmls.= '<div class="row">
                            <div class="col-md-6 col-sm-3">'.$product['pro_title'].'</div>
                                <div class="col-md-2 col-sm-3 d-flex justify-content-center">'.$stock['stock_qty'].' L</div>
                                <div class="col-md-2 col-sm-3 d-flex justify-content-center">'.$product['pro_stock'].' L</div>
                                <div class="col-md-2 col-sm-3 d-flex justify-content-center">
                                    <input name="ref_stock_qty"
                                           class="form-control" type="'.($product['pro_stock']==0?'hidden':'number').'">
                                </div>
                    </div>
                    <hr>';

    }
    $msg = array('status'=>'success', 'msg'=>"Data fetched", 'data'=>$htmls);

    echo json_encode($msg);
}

//------------------------salary due add-------------------------
if (isset($_POST['salary_add_due']) && !empty($_POST['salary_add_due'])) {

    $provided_salary_due = mi_secure_input($_POST['provided_salary_due']);
    $due_salary          = mi_secure_input($_POST['salary_due']);
    $staff_id            = mi_secure_input($_POST['staff_id']);
    $user_id             = str_replace('mi_', '', base64_decode($_SESSION['session_id']));

    if ($provided_salary_due < 1){
        $msg = array('status' => 'error', 'message' => 'Provided salary should be grater than 0 TK.');
    }else{
        $paid_salary = mi_db_custom_query("SELECT * FROM regular_expenses WHERE staff_id =".$staff_id." AND  MONTH(created_at) = MONTH(CURDATE()) AND YEAR(created_at) = YEAR(CURDATE())");
        if (count($paid_salary) > 0){
            $total_salary = $paid_salary[0]['amount'] + $provided_salary_due;
            $data = array(
                    'amount' => $total_salary
            );
            $update = mi_db_update('regular_expenses', $data, array('staff_id' => $staff_id));
            if ($update == true){
                $msg = array('status' => 'success', 'message' => 'Salary updated');
            }else{
                $msg = array('status' => 'error', 'message' => 'Error to update salary');
            }

        }else{
            $data = array(
                    'amount' => $provided_salary_due,
                    'user_id' => $user_id,
                    'expense_date' => date('Y-m-d h:i:s'),
                    'staff_id' => $staff_id,
                    'type' => 'salary'
            );
            $insert = mi_db_insert('regular_expenses', $data);
            if ($insert == true){
                $msg = array('status' => 'success', 'message' => 'Salary updated');
            }else{
                $msg = array('status' => 'error', 'message' => 'Error to update salary');
            }
        }
    }

    echo json_encode($msg);

}

//--------------------product datatable---------------------

if (isset($_GET['mi_custom_key_for_productData']) && !empty($_GET['mi_custom_key_for_productData']) && $_GET['mi_custom_key_for_productData'] == 1) {
    $start_number = mi_secure_input($_GET['start']);
    $length = mi_secure_input($_GET['length']);
    $order = mi_secure_input($_GET['order'][0]['dir']);
    $search = mi_secure_input($_GET['search']['value']);

    $cat_sort = mi_secure_input($_GET['cat_sort']);
    $cat_id = mi_secure_input($_GET['cat_id']);
    $color_sort = mi_secure_input($_GET['color_sort']);
    $color_id = mi_secure_input($_GET['color_id']);

    if (!empty($search)) {
        $data_query = "SELECT 
                            mi_products.pro_id, 
                            mi_products.pro_title,
                            mi_products.pro_price, 
                            mi_products.pro_img, 
                            mi_products.pro_stock, 
                            mi_products.pro_model_number,
                            mi_products.pro_added,
                            mi_product_category.cat_id as catId,
                            mi_product_category.cat_title as catName,
                            mi_product_brand.br_id as brId,
                            mi_product_brand.br_title as brTitle
                    FROM mi_products LEFT OUTER JOIN mi_product_category ON mi_products.pro_cat = mi_product_category.cat_id
                                     LEFT OUTER JOIN mi_product_brand ON mi_products.pro_brand = mi_product_brand.br_id
                    WHERE mi_products.pro_title
                    LIKE '%".$search."%' 
                    ORDER BY '".$order."' LIMIT ".$start_number.",".$length."
                    ";
    }elseif($cat_sort == 'yes'){
        $data_query = "SELECT 
                            mi_products.pro_id, 
                            mi_products.pro_title,
                            mi_products.pro_price, 
                            mi_products.pro_img, 
                            mi_products.pro_stock, 
                            mi_products.pro_model_number,
                            mi_products.pro_added,
                            mi_product_category.cat_id as catId,
                            mi_product_category.cat_title as catName,
                            mi_product_brand.br_id as brId,
                            mi_product_brand.br_title as brTitle
                    FROM mi_products LEFT OUTER JOIN mi_product_category ON mi_products.pro_cat = mi_product_category.cat_id
                                     LEFT OUTER JOIN mi_product_brand ON mi_products.pro_brand = mi_product_brand.br_id
                    WHERE mi_products.pro_cat = ".$cat_id."
                    ORDER BY mi_products.pro_id DESC LIMIT ".$start_number.",".$length."
                    ";
    }elseif ($color_sort == 'yes'){
        $data_query = "SELECT 
                            mi_products.pro_id, 
                            mi_products.pro_title,
                            mi_products.pro_price, 
                            mi_products.pro_img, 
                            mi_products.pro_stock, 
                            mi_products.pro_model_number,
                            mi_products.pro_added,
                            mi_product_category.cat_id as catId,
                            mi_product_category.cat_title as catName,
                            mi_product_brand.br_id as brId,
                            mi_product_brand.br_title as brTitle
                    FROM mi_products LEFT OUTER JOIN mi_product_category ON mi_products.pro_cat = mi_product_category.cat_id
                                     LEFT OUTER JOIN mi_product_brand ON mi_products.pro_brand = mi_product_brand.br_id
                    WHERE mi_products.pro_brand = ".$color_id."
                    ORDER BY mi_products.pro_id DESC LIMIT ".$start_number.",".$length."
                    ";
    }else{
        $data_query = "SELECT 
                            mi_products.pro_id, 
                            mi_products.pro_title,
                            mi_products.pro_price, 
                            mi_products.pro_img, 
                            mi_products.pro_stock, 
                            mi_products.pro_model_number,
                            mi_products.pro_added,
                            mi_product_category.cat_id as catId,
                            mi_product_category.cat_title as catName,
                            mi_product_brand.br_id as brId,
                            mi_product_brand.br_title as brTitle
                    FROM mi_products LEFT OUTER JOIN mi_product_category ON mi_products.pro_cat = mi_product_category.cat_id
                                     LEFT OUTER JOIN mi_product_brand ON mi_products.pro_brand = mi_product_brand.br_id 
                    ORDER BY mi_products.pro_id DESC LIMIT ".$start_number.",".$length."
                    ";
    }
    $currency = mi_db_read_by_id('settings_meta', array('meta_name'=>'shop_currency','type'=>'currency'))[0];
    $query_execute = mi_db_custom_query($data_query);
    $data = [];
    $total_qty = [];
    $total_price = [];
    foreach ($query_execute as $key => $d) {
        $total_qty[] = $d['pro_stock'];
        $total_price[] = $d['pro_price'];

        $data[] = [
            '<div class="checkbox">
                <label style="font-size: 1.5em">
                    <input type="checkbox" value="'.$d['pro_id'].'" class="selectorcheck">
                    <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                </label>
            </div>',

            '<div class="text-left">
                '.(!empty($d['pro_img'])?
                        '<img src="'.MI_CDN_URL.$d['pro_img'].'" alt="" class="img-fluid img-thumbnail" style="max-width: 50px; height: 70px">':
                        '<img src="'.MI_CDN_URL.'assets/img/empty-img.png" alt="" class="img-fluid img-thumbnail" style="max-width: 50px; height: 70px">').
            '</div>',
            '<div class="">
                '.(!empty($d['pro_model_number']))? $d['pro_model_number']:''.'
            </div>',
            '<strong>
                    '.(!empty($d['pro_title']))?$d['pro_title']:'N/A'.'.
            </strong>',
            '<div class="text-right">
                '.(!empty($d['pro_stock']) && $d['pro_stock'] != 0)? (($d['pro_stock'] > 10)?'<label class="badge badge-primary text-white">'.$d['pro_stock'].' L</label>':'<label class="badge badge-danger text-white">'.$d['pro_stock'].' L</label>'):'<label class="badge badge-danger text-white">Empty</label>'.'
            </div>',
            '<div class="text-center">
                '.(!empty($d['catName']))?$d['catName']:'N/A'.'
            </div>',

            (!empty($d['brTitle']))?$d['brTitle']:'N/A',
            $d['pro_price']. $currency['meta_value'],
            '<div>
                    <a title="Edit" href="single_product.php?mi_pro_id='.$d['pro_id'].'" class="btn btn-sm btn-success btn-rounded mt-1"><i class="fa fa-edit"></i></a>
                    <a title="Analytics" href="product_report.php?mi_pro_id='.$d['pro_id'].'" class="btn btn-sm btn-dark btn-rounded mt-1"><i class="nc-icon nc-chart-bar-32"></i></a>
             </div>'

        ];
    }

    $total_qty_footer_data = number_format(array_sum($total_qty)).' L';
    $total_price_footer_data = number_format(array_sum($total_price)).' '.$currency['meta_value'];


    echo json_encode(
        array(
            'draw'=> mi_secure_input($_GET['draw']),
            'recordsTotal'=> count($data),
            'recordsFiltered' => count(mi_db_read_all('mi_products')),
            'data'=>$data,
            'footDataQty' => $total_qty_footer_data,
            'footDataPrice' => $total_price_footer_data
        )
    );
}
//------------------------------server side stock datatable-----------------------------------
if (isset($_GET['mi_custom_key_for_stockData']) && !empty($_GET['mi_custom_key_for_stockData']) && $_GET['mi_custom_key_for_stockData'] == 1) {
    $start_number = mi_secure_input($_GET['start']);
    $length = mi_secure_input($_GET['length']);
    $order = mi_secure_input($_GET['order'][0]['dir']);
    $search = mi_secure_input($_GET['search']['value']);

    $date_search = mi_secure_input($_GET['is_date_search']);
    $start = mi_secure_input($_GET['start_date']);
    $end = mi_secure_input($_GET['end_date']);


    if (!empty($search)) {
        $data_query = "SELECT 
                            mi_stocks.stock_id, 
                            mi_stocks.stock_qty,
                            mi_stocks.expanse, 
                            mi_stocks.ex_paid,  
                            mi_stocks.refund_date,
                            mi_stocks.upload_date,
                            mi_products.pro_id as pid,
                            mi_products.pro_title as proTitle,
                            mi_product_suppliers.sup_id as sid,
                            mi_product_suppliers.sup_name as sname
                    FROM mi_stocks LEFT OUTER JOIN mi_products ON mi_stocks.product_id = mi_products.pro_id
                                   LEFT OUTER JOIN mi_product_suppliers ON mi_stocks.supplier_id = mi_product_suppliers.sup_id
                    WHERE mi_product_suppliers.sup_name LIKE '%".$search."%' 
                    ORDER BY '".$order."' LIMIT ".$start_number.",".$length."
                    ";
    }elseif ($date_search == 'yes'){
        $data_query = "SELECT 
                            mi_stocks.stock_id, 
                            mi_stocks.stock_qty,
                            mi_stocks.expanse, 
                            mi_stocks.ex_paid,  
                            mi_stocks.refund_date,
                            mi_stocks.upload_date,
                            mi_products.pro_id as pid,
                            mi_products.pro_title as proTitle,
                            mi_product_suppliers.sup_id as sid,
                            mi_product_suppliers.sup_name as sname
                    FROM mi_stocks LEFT OUTER JOIN mi_products ON mi_stocks.product_id = mi_products.pro_id
                                   LEFT OUTER JOIN mi_product_suppliers ON mi_stocks.supplier_id = mi_product_suppliers.sup_id
                    WHERE mi_stocks.upload_date BETWEEN '".$start."' AND '".$end."'
                    ORDER BY mi_stocks.stock_id DESC LIMIT ".$start_number.",".$length." 
                    ";

    }else{
        $data_query = "SELECT 
                            mi_stocks.stock_id, 
                            mi_stocks.stock_qty,
                            mi_stocks.expanse, 
                            mi_stocks.ex_paid,  
                            mi_stocks.refund_date,
                            mi_stocks.upload_date,
                            mi_products.pro_id as pid,
                            mi_products.pro_title as proTitle,
                            mi_product_suppliers.sup_id as sid,
                            mi_product_suppliers.sup_name as sname
                    FROM mi_stocks LEFT OUTER JOIN mi_products ON mi_stocks.product_id = mi_products.pro_id
                                   LEFT OUTER JOIN mi_product_suppliers ON mi_stocks.supplier_id = mi_product_suppliers.sup_id
                    ORDER BY mi_stocks.stock_id DESC LIMIT ".$start_number.",".$length." 
                    ";
    }
    $currency = mi_db_read_by_id('settings_meta', array('meta_name'=>'shop_currency','type'=>'currency'))[0];
    $query_execute = mi_db_custom_query($data_query);
    $data = [];
    $total_qty = [];
    $total_expense = [];
    $total_due = [];
    $table_footer_data = '';
    foreach ($query_execute as $key => $d) {
        if ($d['refund_date'] == "0000-00-00 00:00:00"){
            $total_qty[] = $d['stock_qty'];
            $total_expense[] = $d['expanse'];
            $total_due[] = $d['expanse'] - $d['ex_paid'];
        }

        $data[] = [
            '<div class="checkbox text-left">
                <label style="font-size: 1.5em">
                    <input type="checkbox" value="'.$d['stock_id'].'" class="selectorcheck">
                    <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                </label>
            </div>',
            $d['proTitle'],
            $d['sname'],
            '<div class="text-center">
                '.$d['stock_qty'].' L
            </div>',
            '<div class="text-center">
                '.date('d M Y', strtotime($d['upload_date'])).'<br>'.date('h:i:s A', strtotime($d['upload_date'])).'
            </div>',

            '<div class="text-center">
                '.(number_format($d['expanse'], 2))." ".$currency['meta_value']."
                <br>
            ".(($d['refund_date'] !== '0000-00-00 00:00:00')?'<span class="badge badge-dark" style="font-size: 12px;">Returned</span><br><sub>'.$d['refund_date'].'</sub>':'').'
            </div>',

            '<div class="text-center">
                '.((($d['expanse'] - $d['ex_paid']) > 0)?number_format($d['expanse'] - $d['ex_paid'], 2).' '.$currency['meta_value']:'Paid').
                ((($d['expanse'] - $d['ex_paid']) > 0)?'<br><button class="showStockduetk btn btn-sm btn-info" type="button" data-toggle="modal" data-placement="top" title="Due collection" data-target="#update_stock_due" amount_stock_due="'.($d['expanse'] - $d['ex_paid']).'" stock_id="'.$d['stock_id'].'" stock_payable="'.$d['expanse'].'"><i class="fa fa-edit"></i></button>':'').'
            </div>',

            '<div class="text-center">
                <div class="btn-group mi-custom-button">
                    <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" style="border: 1px solid #d4cece;">
                        <a href="view-stock.php?view='.$d['stock_id'].'" class="dropdown-item">
                            View
                        </a>
                        '.(($d['refund_date'] == "0000-00-00 00:00:00")?'<button class="dropdown-item stockRefundForm" type="button" value="'.$d['stock_id'].'">Return</button>':'').'
                        '.(($d['refund_date'] == "0000-00-00 00:00:00")?'<button class="dropdown-item singleStockRefundForm" type="button" value="'.$d['stock_id'].'">Single Refund</button>':'').'    
                    </div>
                </div>
            </div>'

        ];
    }

    $table_stock_footer_data_qty = number_format(array_sum($total_qty)).' L';
    $table_stock_footer_data_expense = number_format(array_sum($total_expense),2).' '.$currency['meta_value'];
    $table_stock_footer_data_due = number_format(array_sum($total_due),2).' '.$currency['meta_value'];


    echo json_encode(
        array(
            'draw'=> mi_secure_input($_GET['draw']),
            'recordsTotal'=> count($data),
            'recordsFiltered' => count(mi_db_read_all('mi_stocks')),
            'data'=>$data,
            'footDataQty' => $table_stock_footer_data_qty,
            'footDataAmount' => $table_stock_footer_data_expense,
            'footDataDue' => $table_stock_footer_data_due
        )
    );
}


//------------------------------server side supplier transaction datatable-----------------------------------
if (isset($_GET['mi_custom_key_for_supplierTransactionData']) && !empty($_GET['mi_custom_key_for_supplierTransactionData']) && $_GET['mi_custom_key_for_supplierTransactionData'] == 1) {
    $start_number = mi_secure_input($_GET['start']);
    $length = mi_secure_input($_GET['length']);
    $order = mi_secure_input($_GET['order'][0]['dir']);
    $search = mi_secure_input($_GET['search']['value']);

    $sup_id = mi_secure_input($_GET['sup_id']);
//    print_r($sup_id); return;

    $date_search = mi_secure_input($_GET['is_date_search']);
    $start = mi_secure_input($_GET['start_date']);
    $end = mi_secure_input($_GET['end_date']);


    if (!empty($search)) {
        $data_query = "SELECT 
                            mi_stocks.stock_id, 
                            mi_stocks.stock_qty,
                            mi_stocks.expanse, 
                            mi_stocks.ex_paid,  
                            mi_stocks.refund_date,
                            mi_stocks.supplier_id,
                            mi_stocks.upload_date,
                            mi_products.pro_id as pid,
                            mi_products.pro_title as proTitle,
                            mi_product_suppliers.sup_id as sid,
                            mi_product_suppliers.sup_name as sname
                    FROM mi_stocks LEFT OUTER JOIN mi_products ON mi_stocks.product_id = mi_products.pro_id
                                   LEFT OUTER JOIN mi_product_suppliers ON mi_stocks.supplier_id = mi_product_suppliers.sup_id
                    WHERE mi_stocks.supplier_id = ".$sup_id." AND mi_products.pro_title LIKE '%".$search."%' 
                    ORDER BY '".$order."' LIMIT ".$start_number.",".$length."
                    ";
    }elseif ($date_search == 'yes'){
        $data_query = "SELECT 
                            mi_stocks.stock_id, 
                            mi_stocks.stock_qty,
                            mi_stocks.expanse, 
                            mi_stocks.ex_paid,  
                            mi_stocks.refund_date,
                            mi_stocks.supplier_id,
                            mi_stocks.upload_date,
                            mi_products.pro_id as pid,
                            mi_products.pro_title as proTitle,
                            mi_product_suppliers.sup_id as sid,
                            mi_product_suppliers.sup_name as sname
                    FROM mi_stocks LEFT OUTER JOIN mi_products ON mi_stocks.product_id = mi_products.pro_id
                                   LEFT OUTER JOIN mi_product_suppliers ON mi_stocks.supplier_id = mi_product_suppliers.sup_id
                    WHERE mi_stocks.upload_date BETWEEN '".$start."' AND '".$end."'
                    ORDER BY mi_stocks.stock_id DESC LIMIT ".$start_number.",".$length." 
                    ";

    }else{
        $data_query = "SELECT 
                            mi_stocks.stock_id, 
                            mi_stocks.stock_qty,
                            mi_stocks.expanse, 
                            mi_stocks.ex_paid,  
                            mi_stocks.refund_date,
                            mi_stocks.supplier_id,
                            mi_stocks.upload_date,
                            mi_products.pro_id as pid,
                            mi_products.pro_title as proTitle,
                            mi_product_suppliers.sup_id as sid,
                            mi_product_suppliers.sup_name as sname
                    FROM mi_stocks LEFT OUTER JOIN mi_products ON mi_stocks.product_id = mi_products.pro_id
                                   LEFT OUTER JOIN mi_product_suppliers ON mi_stocks.supplier_id = mi_product_suppliers.sup_id
                    WHERE mi_stocks.supplier_id = ".$sup_id."
                    ORDER BY mi_stocks.stock_id DESC LIMIT ".$start_number.",".$length." 
                    ";
    }
    $currency = mi_db_read_by_id('settings_meta', array('meta_name'=>'shop_currency','type'=>'currency'))[0];
    $query_execute = mi_db_custom_query($data_query);
    $data = [];
    $total_expense = [];
    $total_paid = [];
    $total_due = [];
    $total_qty = [];
    $table_footer_data = '';
    foreach ($query_execute as $key => $d) {
        $total_qty[] = $d['stock_qty'];
        $total_expense[] = $d['expanse'];
        $total_due[] = $d['expanse'] - $d['ex_paid'];
        $total_paid[] = $d['ex_paid'];
        $data[] = [
            $key+1,
            '<a href="product_report.php?mi_pro_id='.$d['pid'].'">'.$d['proTitle'].'</a>',
            '<div class="text-center">
                '.$d['stock_qty'].' L
            </div>',
            '<div class="text-center">
                '.date('d M Y', strtotime($d['upload_date'])).'<br>'.date('h:i:s A', strtotime($d['upload_date'])).'
            </div>',

            '<div class="text-center">
                '.(number_format($d['expanse'], 2))." ".$currency['meta_value'].'
            </div>',
            '<div class="text-center">
                '.(number_format($d['ex_paid'], 2))." ".$currency['meta_value'].'
            </div>',

            '<div class="text-center">
                '.((($d['expanse'] - $d['ex_paid']) > 0)?number_format($d['expanse'] - $d['ex_paid'], 2).' '.$currency['meta_value']:'Paid').
            ((($d['expanse'] - $d['ex_paid']) > 0)?'<br><button class="showStockduetk btn btn-sm btn-info" type="button" data-toggle="modal" data-placement="top" title="Due collection" data-target="#update_stock_due" amount_stock_due="'.($d['expanse'] - $d['ex_paid']).'" stock_id="'.$d['stock_id'].'" stock_payable="'.$d['expanse'].'"><i class="fa fa-edit"></i></button>':'').'
            </div>'

        ];
    }

    $table_footer_qty_data = number_format(array_sum($total_qty)).' L';
    $table_footer_expense_data = number_format(array_sum($total_expense), 2).' '.$currency['meta_value'];
    $table_footer_paid_data = number_format(array_sum($total_paid), 2).' '.$currency['meta_value'];
    $table_footer_due_data = number_format(array_sum($total_due), 2).' '.$currency['meta_value'];


    echo json_encode(
        array(
            'draw'=> mi_secure_input($_GET['draw']),
            'recordsTotal'=> count($data),
            'recordsFiltered' => count(mi_db_read_all('mi_stocks')),
            'data'=>$data,
            'footDataQty' => $table_footer_qty_data,
            'footDataExpense' => $table_footer_expense_data,
            'footDataPaid' => $table_footer_paid_data,
            'footDataDue' => $table_footer_due_data
        )
    );
}

//------------------------------server side supplier datatable-----------------------------------
if (isset($_GET['mi_custom_key_for_supplierData']) && !empty($_GET['mi_custom_key_for_supplierData']) && $_GET['mi_custom_key_for_supplierData'] == 1) {
    $start_number = mi_secure_input($_GET['start']);
    $length = mi_secure_input($_GET['length']);
    $order = mi_secure_input($_GET['order'][0]['dir']);
    $search = mi_secure_input($_GET['search']['value']);


    if (!empty($search)) {
        $data_query = "SELECT 
                            mi_product_suppliers.sup_id, 
                            mi_product_suppliers.sup_name,
                            mi_product_suppliers.sup_company, 
                            mi_product_suppliers.sup_email,  
                            mi_product_suppliers.sup_phone,
                            mi_product_suppliers.sup_address,
                            mi_product_suppliers.sup_added,
                            mi_product_suppliers.sup_img
                    FROM mi_product_suppliers 
                    WHERE mi_product_suppliers.sup_name LIKE '%".$search."%' 
                    ORDER BY '".$order."' LIMIT ".$start_number.",".$length."
                    ";
    }else{
        $data_query = "SELECT 
                            mi_product_suppliers.sup_id, 
                            mi_product_suppliers.sup_name,
                            mi_product_suppliers.sup_company, 
                            mi_product_suppliers.sup_email,  
                            mi_product_suppliers.sup_phone,
                            mi_product_suppliers.sup_address,
                            mi_product_suppliers.sup_added,
                            mi_product_suppliers.sup_img
                    FROM mi_product_suppliers
                    ORDER BY mi_product_suppliers.sup_id DESC LIMIT ".$start_number.",".$length." 
                    ";
    }

    $query_execute = mi_db_custom_query($data_query);
    $data = [];
    foreach ($query_execute as $key => $d) {
        $data[] = [
            '<div class="checkbox">
                 <label style="font-size: 1.5em">
                     <input type="checkbox" value="'.$d['sup_id'].'" class="selectorcheck">
                     <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                 </label>
             </div>',
            '<div>
                '.(!empty($d['sup_img'])?
                '<img src="'.MI_CDN_URL.$d['sup_img'].'" alt="" class="img-fluid img-thumbnail" style="max-width: 70px; height: 70px">':
                '<img src="'.MI_CDN_URL.'assets/img/empty-img.png" alt="" class="img-fluid img-thumbnail" style="max-width: 70px; height: 70px">').
            '</div>',
            '<div class="text-center">
                '.$d['sup_name'].'
            </div>',
            '<div class="text-center">
                '.$d['sup_company'].'
            </div>',
            '<div class="text-center">
                '.$d['sup_email'].'
            </div>',
            '<div class="text-center">
                '.$d['sup_phone'].'
            </div>',
            '<div class="text-center">
                '.$d['sup_address'].'
            </div>',
            '<div class="text-center">
                '.date('d M Y', strtotime($d['sup_added'])).'<br>'.date('h:i:s A', strtotime($d['sup_added'])).'
            </div>',
            '<div class="text-center">
                <a title="Edit" href="single_supplier.php?mi_sup_id='.$d['sup_id'].'" class="btn btn-sm btn-dark btn-rounded"><i class="fa fa-edit"></i></a>
                <a title="View" href="supplier-transaction.php?st='.$d['sup_id'].'" class="btn btn-sm btn-success btn-rounded"><i class="nc-icon nc-chart-bar-32"></i></a>
            </div>'

        ];
    }


    echo json_encode(
        array(
            'draw'=> mi_secure_input($_GET['draw']),
            'recordsTotal'=> count($data),
            'recordsFiltered' => count(mi_db_read_all('mi_product_suppliers')),
            'data'=>$data
        )
    );
}

//------------------------------server side customer datatable-----------------------------------
if (isset($_GET['mi_custom_key_for_customerData']) && !empty($_GET['mi_custom_key_for_customerData']) && $_GET['mi_custom_key_for_customerData'] == 1) {
    $start_number = mi_secure_input($_GET['start']);
    $length = mi_secure_input($_GET['length']);
    $order = mi_secure_input($_GET['order'][0]['dir']);
    $search = mi_secure_input($_GET['search']['value']);


    if (!empty($search)) {
        $data_query = "SELECT 
                            customers.id, 
                            customers.customer_name,
                            customers.phone, 
                            customers.address,  
                            customers.customer_status
                    FROM customers 
                    WHERE customers.customer_name LIKE '%".$search."%' 
                    ORDER BY '".$order."' LIMIT ".$start_number.",".$length."
                    ";
    }else{
        $data_query = "SELECT 
                            customers.id, 
                            customers.customer_name,
                            customers.phone, 
                            customers.address,  
                            customers.customer_status
                    FROM customers 
                    ORDER BY customers.id DESC LIMIT ".$start_number.",".$length." 
                    ";
    }

    $query_execute = mi_db_custom_query($data_query);
    $data = [];
    foreach ($query_execute as $key => $d) {
        $data[] = [
            '<div class="checkbox">
                 <label style="font-size: 1.5em">
                     <input type="checkbox" value="'.$d['id'].'" class="selectorcheck">
                     <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                 </label>
             </div>',
            '<div class="text-left">
                '.$d['customer_name'].'
            </div>',
            '<div class="text-center">
                '.$d['phone'].'
            </div>',
            '<div class="text-center">
                '.$d['address'].'
            </div>',
            '<div>
                <p class="badge badge-dark text-center">'.($d['customer_status'] == 0)?'Active':'Inactive'.'</p>
            </div>',
            '<div class="text-center">
                <a title="Edit" href="customers.php?customer_edit='.$d['id'].'" class="btn btn-sm btn-dark btn-rounded"><i class="fa fa-edit"></i></a>
                <a title="View" href="customers-transaction.php?c='.$d['id'].'" class="btn btn-sm btn-success btn-rounded"><i class="nc-icon nc-chart-bar-32"></i></a>
            </div>',
            '<div class="text-center">
                '.date('d M Y', strtotime($d['sup_added'])).'<br>'.date('h:i:s A', strtotime($d['sup_added'])).'
            </div>'

        ];
    }


    echo json_encode(
        array(
            'draw'=> mi_secure_input($_GET['draw']),
            'recordsTotal'=> count($data),
            'recordsFiltered' => count(mi_db_read_all('customers')),
            'data'=>$data
        )
    );
}

//------------------------------server side customer transaction datatable-----------------------------------
if (isset($_GET['mi_custom_key_for_customerTransactionData']) && !empty($_GET['mi_custom_key_for_customerTransactionData']) && $_GET['mi_custom_key_for_customerTransactionData'] == 1) {
    $start_number = mi_secure_input($_GET['start']);
    $length = mi_secure_input($_GET['length']);
    $order = mi_secure_input($_GET['order'][0]['dir']);
    $search = mi_secure_input($_GET['search']['value']);

    $customer_id = mi_secure_input($_GET['customer_id']);

    $date_search = mi_secure_input($_GET['is_date_search']);
    $start = mi_secure_input($_GET['start_date']);
    $end = mi_secure_input($_GET['end_date']);

    if (!empty($search)) {
        $data_query = "SELECT 
                            mi_orders.order_id, 
                            mi_orders.order_products_details,
                            mi_orders.trx_id, 
                            mi_orders.total_amount, 
                            mi_orders.paid_amount, 
                            mi_orders.refund_date,
                            mi_orders.order_created
                    FROM mi_orders  
                    WHERE mi_orders.customer_id = ".$customer_id." AND mi_orders.trx_id LIKE '%".$search."%' 
                    ORDER BY '".$order."' LIMIT ".$start_number.",".$length."
                    ";
    }elseif ($date_search == 'yes'){
        $data_query = "SELECT 
                            mi_orders.order_id,
                            mi_orders.order_products_details, 
                            mi_orders.trx_id, 
                            mi_orders.total_amount, 
                            mi_orders.paid_amount, 
                            mi_orders.refund_date,
                            mi_orders.order_created
                    FROM mi_orders
                    WHERE mi_orders.customer_id = ".$customer_id." AND mi_orders.order_created BETWEEN '".$start."' AND '".$end."'
                    ORDER BY mi_orders.order_id DESC LIMIT ".$start_number.",".$length." 
                    ";

    }else{
        $data_query = "SELECT 
                            mi_orders.order_id,
                            mi_orders.order_products_details, 
                            mi_orders.trx_id, 
                            mi_orders.total_amount, 
                            mi_orders.paid_amount, 
                            mi_orders.refund_date,
                            mi_orders.order_created
                    FROM mi_orders
                    WHERE mi_orders.customer_id = ".$customer_id." 
                    ORDER BY mi_orders.order_id DESC LIMIT ".$start_number.",".$length." 
                    ";
    }
    $currency = mi_db_read_by_id('settings_meta', array('meta_name'=>'shop_currency','type'=>'currency'))[0];
    $query_execute = mi_db_custom_query($data_query);
    $data = [];
    $total_qty = [];
    $total_amount = [];
    $total_paid = [];
    $total_due = [];
    foreach ($query_execute as $key => $d) {
        $vvl = explode(', ', $d['order_products_details']);
        $get_pro_img = array();
        $due = $d['total_amount'] - $d['paid_amount'];


        $order_items = 0;
        $order_qty = [];
        foreach ($vvl as $k => $v){
            $get_pro_id = json_decode($v)->{'pro_qty'};
            $order_items += 1;
            $order_qty[] = $get_pro_id;
        }

        if ($d['refund_date'] == '0000-00-00 00:00:00'){
            $total_qty[] = array_sum($order_qty);
            $total_amount[] = $d['total_amount'];
            $total_paid[] = $d['paid_amount'];
            $total_due[] = $due;
        }

        $data[] = [
            $key+1,
            '<div class="text-center">
                <a href="view_orders.php?mi_order_view='.$d['order_id'].'">
                    <strong>'.$d['trx_id'].'</strong>
                </a>
            </div>',
            '<div class="text-center">
                '.'Total Items: '.$order_items.'<br>Total Qty: '.array_sum($order_qty). ' L'.'
            </div>',
            '<div class="text-center">
                '.date('d M Y', strtotime($d['order_created'])).'<br>'.date('h:i:s A', strtotime($d['order_created'])).'
            </div>',
            '<div class="text-center">
                '.(number_format($d['total_amount'], 2))." ".$currency['meta_value']."
                <br>
                ".(($d['refund_date'] !== '0000-00-00 00:00:00')?'<span class="badge badge-dark" style="font-size: 12px;">Returned</span><br><sub>'.$d['refund_date'].'</sub>':'').'
            </div>',
            '<div class="text-center">
                '.(number_format($d['paid_amount'], 2))." ".$currency['meta_value'].'
            </div>',
            '<div class="text-center">
                '.(($due > 0)?number_format($due, 2).' '.$currency['meta_value']:'Paid').
                (($due>0)?'<br><button class="showduetk btn btn-sm btn-info" type="button" data-toggle="modal" data-placement="top" title="Due collection" data-target="#update_due" amount_due="'.$due.'" order_id="'.$d['order_id'].'" payable="'.$d['total_amount'].'"><i class="fa fa-edit"></i></button>':'').'
            </div>',

        ];
    }
    $stock_footer_data_qty = number_format(array_sum($total_qty)).' L';
    $stock_footer_data_amount = number_format(array_sum($total_amount),2).' '.$currency['meta_value'];
    $stock_footer_data_paid = number_format(array_sum($total_paid),2).' '.$currency['meta_value'];
    $stock_footer_data_due = number_format(array_sum($total_due),2).' '.$currency['meta_value'];


    echo json_encode(
        array(
            'draw'=> mi_secure_input($_GET['draw']),
            'recordsTotal'=> count($data),
            'recordsFiltered' => count(mi_db_read_by_id('mi_orders', array('customer_id'=> $customer_id))),
            'data'=>$data,
            'footDataQty' => $stock_footer_data_qty,
            'footDataAmount' => $stock_footer_data_amount,
            'footDataPaid' => $stock_footer_data_paid,
            'footDataDue' => $stock_footer_data_due
        )
    );
}