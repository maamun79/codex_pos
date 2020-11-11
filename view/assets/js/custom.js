/**
 * Created by monir on 4/21/2019.
 */
$(document).ready(function () {

    var i = document.location.href.lastIndexOf("/");
    var currentPHP = document.location.href.substr(i+1);

    var replaced = currentPHP.substring(0, currentPHP.lastIndexOf('.'));
    var replacedpro = currentPHP.substring(0, currentPHP.lastIndexOf('pro_id'));
    var replacedcat = currentPHP.substring(0, currentPHP.lastIndexOf('cat_edit'));
    var replacedbr = currentPHP.substring(0, currentPHP.lastIndexOf('br_edit'));
    var replacedsup = currentPHP.substring(0, currentPHP.lastIndexOf('sup_edit'));

    if (replaced == 'index' || replaced == ''){
        $(".mi_titles_page").html("Dashboard");
    }else if (replaced == 'orders'){
        $('.mi_title_btn').show();
        $(".mi_titles_page").html("Sales History");
    }else if(replaced == 'single_product'){
        $('.mi_title_btn').show();
        if (replacedpro == 'single_product.php?mi_'){
            $(".mi_titles_page").html("Update Product");
        }else{
            $(".mi_titles_page").html("Add Product");
        }
    }else if(replaced == 'categories'){
        $('.mi_title_btn').show();
        if (replacedcat == 'categories.php?mi_'){
            $(".mi_titles_page").html("Update Category");
        }else{
            $(".mi_titles_page").html("categories");
        }
    }else if(replaced == 'brands'){
        $('.mi_title_btn').show();
        if (replacedbr == 'brands.php?mi_'){
            $(".mi_titles_page").html("Update Brand");
        }else{
            $(".mi_titles_page").html("brands");
        }
    }else if(replaced == 'suppliers'){
        $('.mi_title_btn').show();

        if (replacedsup == 'suppliers.php?mi_'){
            $(".mi_titles_page").html("Update Supplier");
        }else{
            $(".mi_titles_page").html("suppliers");
        }
    }else if(replaced == 'add-stock'){
        $('.mi_title_btn').show();
        $(".mi_titles_page").html("Stock");
    }else if(replaced == 'invoice-report'){
        $('.mi_title_btn').show();
        $(".mi_titles_page").html("Invoice Report");
    }else if(replaced == 'view_orders'){
        $('.mi_title_btn').show();
        $(".mi_titles_page").html("View Orders");
    }else if(replaced == 'shop-settings'){
        $('.mi_title_btn').show();
        $(".mi_titles_page").html("Shop Settings");
    }else if(replaced == 'product_report'){
        $('.mi_title_btn').show();
        $(".mi_titles_page").html("Product Report");
    }else{
        $('.mi_title_btn').show();
        $(".mi_titles_page").html(replaced);
    }
    if (replaced != 'sales'){
        $('.sales_pg').show();
    }



    $('.delAll').click(function (e) {
        e.preventDefault();
        var dat = $(this).attr('datatype');
        delete_data(dat);
    });


    function delete_data(dltype) {
        var mydata = [];
        var id = $('.selectorcheck:checkbox').filter(':checked');
        for (var i = 0; i < id.length; i++){
            mydata.push(id[i].value);
        }
        if (id.length === 0){
            swal("Sorry!", "You Do Not Select Any One to Delete!", "error");
        }else{
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this data!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        type:'post',
                        url:'actions.php',
                        data: {pro_del: mydata, del_type: dltype},
                        success:function(data){
                            swal(data, {
                                icon: "success",
                            })
                            .then((deleted) => {

                                if(dltype == 'product'){
                                    window.location = "warehouse.php";
                                }else if(dltype == 'stocks'){
                                    window.location = "stocks.php";
                                }else if(dltype == 'category'){
                                    window.location = "categories.php";
                                }else if(dltype == 'brand'){
                                    window.location = "brands.php";
                                }else if (dltype == 'orders'){
                                    $('#mi_orders_datatable').dataTable().api().ajax.reload();
                                }else if (dltype == 'supplier'){
                                    window.location = "suppliers.php";
                                }else if (dltype == 'stockHistory'){
                                    window.location = "add-stock.php";
                                }else if (dltype == 'users'){
                                    window.location = "users.php";
                                }else if (dltype == 'inv_expense'){
                                window.location = "investment.php";
                                }else if (dltype == 'vat'){
                                window.location = "vat.php";
                                }else if (dltype == 'vat'){
                                window.location = "vat.php";
                                }else if (dltype == 'expense_type'){
                                    window.location = "expense_type.php";
                                }else if (dltype == 'customers'){
                                window.location = "customers.php";
                            }
                            });
                        },
                        error:function () {
                            swal("Sorry! Some Error Occurring to Delete Products!", {
                                icon: "error",
                            });
                        }
                    });
                } else {
                    swal("Great! Delete Cancelled!", {
                        icon: "warning",
                    });
                }
            });
        }
    }

    $('.mi_datatable').DataTable({
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'colvis',
                text: 'Column Visibility',
                className: 'btn btn-primary mi_custom_dt_btn',
            },
            {
                extend: 'csv',
                text: 'Export CSV',
                className: 'btn btn-primary mi_custom_dt_btn',
            },
            {
                extend: 'print',
                text: 'Print PDF',
                className: 'btn btn-primary mi_custom_dt_btn',
                exportOptions: {
                    modifier: {
                        selected: null
                    }
                },
                customize: function ( win ) {
                    $(win.document.body)
                        .css( 'font-size', '10pt' )
                        .prepend(
                            '<img src="https://png.pngtree.com/element_pic/17/02/28/745c75d504f336a83a10e6dcf8db44fa.jpg" style="float:left;margin-right:10px;width: 50px;height: 50px;" />'
                        );

                    $(win.document.body).find( 'table' )
                        .addClass( 'compact' )
                        .css( 'font-size', 'inherit' );
                }
            }
        ],
        language: {
            paginate: {
                next: '&#8594;',
                previous: '&#8592;'
            }
        }
    });



    $('#mi_orders_datatable').DataTable({
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'colvis',
                text: 'Column Visibility',
                className: 'btn btn-primary mi_custom_dt_btn',
            },
            {
                extend: 'csv',
                text: 'Export CSV',
                className: 'btn btn-primary mi_custom_dt_btn',
            },
            {
                extend: 'print',
                text: 'Print PDF',
                className: 'btn btn-primary mi_custom_dt_btn',
                exportOptions: {
                    modifier: {
                        selected: null
                    }
                },
                customize: function ( win ) {
                    $(win.document.body)
                        .css( 'font-size', '10pt' )
                        .prepend(
                            '<img src="https://png.pngtree.com/element_pic/17/02/28/745c75d504f336a83a10e6dcf8db44fa.jpg" style="float:left;margin-right:10px;width: 50px;height: 50px;" />'
                        );

                    $(win.document.body).find( 'table' )
                        .addClass( 'compact' )
                        .css( 'font-size', 'inherit' );
                }
            }
        ],
        language: {
            paginate: {
                next: '&#8594;',
                previous: '&#8592;'
            }
        },
        processing: true,
        serverSide: true,
        ajax: {
            url: "actions.php",
            data: {mi_custom_key_for_orderData:1}
        }
    });








    $('.mi_datatable_sale').DataTable({
        lengthChange: false,
        language: {
            searchPlaceholder: "Search Products By Name"
        }
    });


    $('body').on('click', '.selectAll', function () {
        if(this.checked) {

            $('body .selectorcheck:checkbox').each(function() {
                this.checked = true;
            });
        }else {
            $('body .selectorcheck:checkbox').each(function() {
                this.checked = false;
            });
        }
    });

    var defaultLimit = 12;
    var start = 0;

    get_all_products_grid(start, defaultLimit);

    function get_all_products_grid(start, end){
        $.ajax({
            type:'post',
            url:'actions.php',
            data: {
                get_pro_grid: 1,
                start : start,
                end : end
            },
            success:function(data){
                if (data.length != 0){
                    $('#all_of_product_grid').html(data);
                    $('#page-next').attr('disabled', false);
                }else{
                    $('#page-next').attr('disabled', true);
                }
                if (start == 0){
                    $('#page-prev').attr('disabled', true);
                }else{
                    $('#page-prev').attr('disabled', false);
                }
            },
            error:function () {
                console.log('Sorry! Error to get product data!');
            }
        });
    }

    // ---------------------------sales pagination-----------------------
    $('#page-next').on('click', function () {
        start = defaultLimit+start;
        get_all_products_grid(start, defaultLimit);
    });

    $('#page-prev').on('click', function () {
        start = start-defaultLimit;
        get_all_products_grid(start, defaultLimit);
    });

    function reload_all_products_grid(){
        $.ajax({
            type:'post',
            url:'actions.php',
            data: {get_pro_grid: 1},
            success:function(data){
                $('#all_of_product_grid').html(data);
            },
            error:function () {
                console.log('Sorry! Error to get product data!');
            }
        });
    }

    function get_cart_items(){
        $.ajax({
            type:'post',
            url:'actions.php',
            data: {get_cart: 1},
            success:function(data){
                $('#get_cart_products').html(data);
                $('#getnewcustomer').addClass('selectpicker');
                $('#getnewcustomer').attr('data-live-search', 'true');
                $('#getnewcustomer').selectpicker('refresh');
            },
            error:function () {
                console.log('Sorry! Error to get cart data!');
            }
        });
    }
    get_cart_items();


    $('body').on('click', '.quantity-right-plus', function (e) {

        e.preventDefault();

        var input_id = $(this).attr('input_id');

        $.ajax({
            type:'post',
            url:'actions.php',
            data: {plus_cart_item_id: input_id},
            success:function(data){
                get_cart_items();
                var jsonDat = JSON.parse(data);
                // console.log(jsonDat);

                if (jsonDat['status'] == 'error'){
                    swal(jsonDat['message'],{
                        icon: 'error'
                    });
                }

            },
            error:function () {
                console.log('Sorry! Error to get cart data!');
            }
        });
    });

    $('body').on('blur', '.quantity', function (e) {

        e.preventDefault();
        var quantity = $(this).val();
        var pro_id = $(this).attr('pro-id');

        $.ajax({
            type:'post',
            url:'actions.php',
            data: {
                quantity_updater: 1,
                quantity: quantity,
                pro_id: pro_id
            },
            success:function(data){
                get_cart_items();
                var jsonDat = JSON.parse(data);
                // console.log(jsonDat);

                if (jsonDat['status'] == 'error'){
                    swal(jsonDat['message'],{
                        icon: 'error'
                    });
                }

            },
            error:function () {
                console.log('Sorry! Error to get cart data!');
            }
        });
    });

    $('body').on('blur', '#mi_purchase_extra', function (e) {
        e.preventDefault();
        var amment = $(this).val();
        var note = $('#mi_purchase_extra_note').attr('note');

        $.ajax({
            type: 'post',
            url: 'actions.php',
            data: {amount: amment, note: note, extra_updater: 1},
            success: function (data) {
                get_cart_items();
                console.log(data)
            },
            error: function () {
                console.log('Sorry! extra not added');
            }
        });
    });

    $('body').on('blur', '#total_due', function (e) {
        e.preventDefault();
        var amment = $(this).val();
        // var note = $('#mi_purchase_extra_note').val();

        $.ajax({
            type: 'post',
            url: 'actions.php',
            data: {amount: amment, due_updater: 1},
            success: function (data) {
                get_cart_items();
                console.log(data)
            },
            error: function () {
                console.log('Sorry! extra not added');
            }
        });
    });




    $('body').on('click', '.quantity-left-minus', function (e) {

        e.preventDefault();

        var input_id = $(this).attr('input_id');
        var currentVal = parseInt($('#quantity'+input_id).val());

        if (currentVal > 1){

            $.ajax({
                type:'post',
                url:'actions.php',
                data: {minus_cart_item_id: input_id},
                success:function(data){
                    get_cart_items();
                    console.log(data);
                },
                error:function () {
                    console.log('Sorry! Error to get cart data!');
                }
            });
        }else{
            swal("Sorry! Quantity cannot be less then 1", {
                icon: "error",
            });
        }
    });

    function mi_real_add_to_cart(pid){
        $.ajax({
            type:'post',
            url:'actions.php',
            dataType: 'json',
            data: {add_pro_cart: 1, pro_id: parseInt(pid)},
            success:function(data){
                if (data.status == "error"){
                    swal(data.message, {
                        icon: "error",
                    });
                }else{
                    get_cart_items();
                }
            },
            error:function () {
                console.log("Sorry! Error to add product to cart!");
            }
        });
    }

    $('body').on('click', '.sale_product_cart', function (e) {
        e.preventDefault();

        var id = $(this).attr('value');

        mi_real_add_to_cart(id);

    });


    $('body').on('click', '.cart_remove_item', function (e) {
        e.preventDefault();

        var rmid = $(this).val();
        $.ajax({
            type:'post',
            url:'actions.php',
            data: {remove_pro_cart: 1, cart_id: rmid},
            success:function(data){
                console.log(data);
                get_cart_items();
            },
            error:function () {
                console.log('Sorry! Error to Remove product from cart!');
            }
        });
    });

    $('body').on('keyup', '#get_product_search', function (e) {
        e.preventDefault();

        var title = $(this).val();
        if (title != ""){
            $.ajax({
                type:'post',
                url:'actions.php',
                data: {get_pro_grid: 1, name_value: title, start: start, end: defaultLimit},
                success:function(data){
                    $('#all_of_product_grid').html(data);
                },
                error:function () {
                    console.log('Sorry! Error to get product data!');
                }
            });
        }else {
            get_all_products_grid(start, defaultLimit);
        }
    });
    function clear_cart_all_item() {
        $.ajax({
            type:'post',
            url:'actions.php',
            data: {clear_all_basket: 1},
            success:function(data){
                console.log(data);
                get_cart_items();
            },
            error:function () {
                swal("No items in Basket to Clear", {
                    icon: "error"
                });
            }
        });
    }



    $('.cart_clear_btn').click(function (e) {
        e.preventDefault();
        clear_cart_all_item();
    });

    $('#sort_category').change(function (e) {
        e.preventDefault();
        var catid = $(this).val();

        if (catid == "" || catid == 0){
            get_all_products_grid(start, defaultLimit);
        }else{
            $.ajax({
                type:'post',
                url:'actions.php',
                data: {get_pro_grid: 1, catsort: catid, start: start, end: defaultLimit},
                success:function(data){
                    $('#all_of_product_grid').html(data);
                },
                error:function () {
                    swal("No items with this category", {
                        icon: "error"
                    });
                }
            });
        }
    });


    $('#sort_brand').change(function (e) {
        e.preventDefault();
        var brid = $(this).val();

        if (brid == "" || brid == 0){
            get_all_products_grid(start, defaultLimit);
        }else {
            $.ajax({
                type:'post',
                url:'actions.php',
                data: {get_pro_grid: 1, brsort: brid, start: start, end: defaultLimit},
                success:function(data){
                    $('#all_of_product_grid').html(data);
                },
                error:function () {
                    swal("No items with this category", {
                        icon: "error"
                    });
                }
            });
        }
    });
    
    $('body').on('click', '.mi_print_btn', function (e) {
        e.preventDefault();
        $.ajax({
            type:'post',
            url:'actions.php',
            data: {get_cart_plain: 1},
            success:function(data){
                var response = JSON.parse(data);
                if (response.due > 0){
                    $('.paid_or_due_seal h1').html('DUE').removeClass('due-color-green').addClass('due-color-red');
                }else{
                    $('.paid_or_due_seal h1').html('PAID').removeClass('due-color-red').addClass('due-color-green');
                }
                $('#sales_due_note span').html(response.note);
                $('#mi_billing_table').html(response.data);
                $('#animatedModal').show();
                $('#billing-modal').trigger('click');
            },
            error:function () {
                console.log('Sorry! Error to get cart data!');
            }
        });
    });

    $('body').on('click', '#mi_print_pdf_recipt', function (e) {
        e.preventDefault();
        printJS({
            printable: 'invoice-POS',
            type: 'html',
            targetStyles: ['*']
        });
    });


    $('body').on('click', '.mi_complete_purchase', function (e) {
        // console.log(customer_name);

        //alert(totalpayable);

        //return false;
        var customer_id = $('#getnewcustomer').val();

        e.preventDefault();
        $.ajax({
            type: 'post',
            url: 'actions.php',
            data: {
                complete_purchase_item: 1,
                cid: customer_id
            },
            success:function (data) {
                var response = JSON.parse(data);
                // $('#mi_invoice_id h2').html("Invoice No: "+123);
                if (response.due > 0){
                    $('.paid_or_due_seal h1').html('DUE').removeClass('due-color-green').addClass('due-color-red');
                }else{
                    $('.paid_or_due_seal h1').html('PAID').removeClass('due-color-red').addClass('due-color-green');
                }
                $('#mi_billing_table').html(response.data);
                $('#animatedModal').show();
                $('#billing-modal').trigger('click');
                $('.mi_close').val('reload_sales');

                clear_cart_all_item();
                get_all_products_grid(start, defaultLimit);
            },
            error:function () {
                alert("Error in Purchase Ajax");
            }
        });
    });

    // $('#newAnimateModal').on()

    if ($('#billing-modal') && $('#billing-modal').length > 0){
        $('#animatedModal').show();
        $("#billing-modal").animatedModal({
            animatedIn:'zoomIn',
            animatedOut:'zoomOut',
            color:'#39BEB9'
        });
    }

    $('body').on('click', '.mi_close', function (e) {
        e.preventDefault();
        if ($(this).val() == "reload_sales"){
            window.location = "sales.php";
        }
    });

    $('body').on('change', '#radio1', function (e) {
        e.preventDefault();

        $('.radio2element').hide('fade');
        $('.radio1element').show('fade');
    });

    $('body').on('change', '#radio2', function (e) {
        e.preventDefault();

        $('.radio2element').show('fade');

        $('.radio1element').hide('fade');
    });




    $('body').on('submit', '#add_cat_form_mi', function (e) {
        e.preventDefault();
        var formDataCat = new FormData(this);

        $.ajax({
            url: 'actions.php',
            type: 'POST',
            data: formDataCat,
            contentType: false,
            cache: false,
            processData:false,
            success: function (data) {
                console.log(data);
            },
            error: function () {
                swal('Error to get response of category saving',{
                    icon: 'error'
                });
            }
        });
    });


    $('body').on('submit', '#mi_barcode_proCart', function (e) {
        e.preventDefault();
        var barcode_data = $('#mi_pro_for_bar').val();
        mi_real_add_to_cart(parseInt(barcode_data));
        barScanFocus();
        console.log(barcode_data);
    });




    $('body').on('submit', '#mi_authen_form', function (e) {
        e.preventDefault();
        var formDataCat = new FormData(this);

        $.ajax({
            url: 'actions.php',
            type: 'POST',
            data: formDataCat,
            contentType: false,
            cache: false,
            processData:false,
            success: function (data) {
                var jsonDat = JSON.parse(data);
                // console.log(data);

                if (jsonDat['status'] == 'error'){
                    swal(jsonDat['message'],{
                        icon: 'error'
                    });
                }else{
                    swal(jsonDat['message'],{
                        icon: 'success'
                    });
                    setInterval(function (){
                        window.location.href = 'index.php';
                    }, 700);
                }

            },
            error: function () {
                swal('Connection error!',{
                   icon: 'error'
                });
            }
        });
    });



    $('body').on('submit', '#mi_user_adding_form', function (e) {
        e.preventDefault();
        var formDataCat = new FormData(this);

        $.ajax({
            url: 'actions.php',
            type: 'POST',
            data: formDataCat,
            contentType: false,
            cache: false,
            processData:false,
            success: function (data) {
                // console.log(data);
                var jsonDat = JSON.parse(data);

                if (jsonDat['status'] == 'error'){
                    swal(jsonDat['message'],{
                        icon: 'error'
                    });

                }else{
                    swal(jsonDat['message'],{
                        icon: 'success'
                    });
                    setInterval(function (){
                        window.location.href = 'users.php';
                    }, 1000);
                }

            },
            error: function () {
                swal('Connection error!',{
                   icon: 'error'
                });
            }
        });
    });



    $('.iconpicker').iconpicker();

    function expiry_notification(time) {
        $('body').append('<div class="alert alert-danger alert-with-icon alert-dismissible fade show" style="position: absolute;height: 135px; bottom: 0px; left: 0px; width: 100%; z-index: 99999999999;" data-notify="container"> <button type="button" aria-hidden="true" class="close" data-dismiss="alert" aria-label="Close"> </button> <span data-notify="icon" class="nc-icon nc-alert-circle-i" style="font-size: 50px; top: 40%;float: left;"></span> <span data-notify="message" style="margin-left: 40px;margin-top: 25px;font-size: 20px;">Your monthly membership will be expired within '+time+' days! <br><a href="subscription.php" style="color: #fff; text-decoration: underline;">Please Renew your membership here.</a></span> </div>');
    }

    $('.datepicker').datepicker();


    $("[data-fancybox]").fancybox({
        'width':300,
        'height':100,
        'autoSize' : false
    });

    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    });

    $('#miReportPrintBtn').click(function () {
        $('#miReportPrint').printElement({
            css: 'extend',
            ecss: '.mi_print_show_table{display:block;width:100%;} .mi_canvas_hide_in_print{display:none;}'
        });
    });

    $('#miReportPrintBtn2').click(function (e) {
        e.preventDefault();
        $('#miReportPrint2').printElement();
        // $('#miReportPrint2').printThis({
        //     importCSS: true,
        //     importStyle: true,
        //     pageTitle: "Invoice Printer",
        //     loadCss: ""
        // });
    });

    $('.products_serials').select2({
        tags: true,
        tokenSeparators: [' ', ' ']
    });

    $("#miStockUnitPrice").blur(function (e) {
        e.preventDefault();
        var value = $(this).val();
        var qty = $("#miStockQtyUp").val();

        $("#miTotalStockAddExpenses").val(value*qty);
    });

    $("#miStockQtyUp").blur(function (e) {
        e.preventDefault();
        var qty = $(this).val();
        var value = $("#miStockUnitPrice").val();

        $("#miTotalStockAddExpenses").val(value*qty);
    });

    $('body').on('click', '.mi_customer_btn', function (e) {
        e.preventDefault();

        if ($(this).hasClass('notShow')){
            $(this).removeClass('notShow');
            $('#miCustInfo').fadeIn('slow');
            $('#miCustInfos').fadeIn('slow');
        }else{
            $(this).addClass('notShow');
            $('#miCustInfo').fadeOut('slow');
            $('#miCustInfos').fadeOut('slow');
        }
    });


    $('#last_inv_id').on('click', function (e) {
        e.preventDefault();
        var inv = $(this).attr('miinv');
        $('input[name=stock_invoice_id]').val(inv);
    });

    $('.serialCheck1').change(function (e) {
        e.preventDefault();
        if (e.target.checked == true){
            $('.serialCheck2').prop('checked', false);
            $('.miSerialBlock').fadeIn();
        }else{
            $('.serialCheck2').prop('checked', true);
            $('.miSerialBlock').fadeOut();
        }
    });
    $('.serialCheck2').change(function (e) {
        e.preventDefault();
        if (e.target.checked == true){
            $('.serialCheck1').prop('checked', false);
            $('.miSerialBlock').fadeOut();
        }else{
            $('.serialCheck1').prop('checked', true);
            $('.miSerialBlock').fadeIn();
        }
    });


    $('body').on('change', '.mi_get_serials', function (e) {
        e.preventDefault();

        var cart_id = $(this).attr('mi_cid');
        var cart_val = $(this).val();

        $.ajax({
            url: 'actions.php',
            type: 'POST',
            data: {
                mi_do_cart_serial_update: 1,
                cid:cart_id,
                cvl: cart_val
            },
            success: function (data) {
                console.log(data);
            },
            error: function () {
                swal('Error to get response of category saving',{
                    icon: 'error'
                });
            }
        });
    });

    // -------------------------Change shop logo-----------------------
    $('#changeLogoForm').on('submit', function (e) {
        e.preventDefault();
        var logo = new FormData(this);
        // var shopId = shopPassword.get('shopId');
        $.ajax({
            url: 'actions.php',
            type: 'POST',
            data: logo,
            contentType: false,
            cache: false,
            processData:false,
            success: function (data) {
                // console.log(data);
                var jsonDat = JSON.parse(data);

                if (jsonDat['status'] == 'error'){
                    swal(jsonDat['message'],{
                        icon: 'error'
                    });

                }else{
                    swal(jsonDat['message'],{
                        icon: 'success'
                    });
                    setInterval(function (){
                        window.location.href = 'shop-settings.php';
                    }, 1000);
                }

            },
            error: function () {
                swal('Connection error!',{
                    icon: 'error'
                });
            }
        });


    });

    // -------------------------Change shop details-----------------------
    $('.changeDetailsForm').on('submit', function (e) {
        e.preventDefault();
        var details = new FormData(this);
        $.ajax({
            url: 'actions.php',
            type: 'POST',
            data: details,
            contentType: false,
            cache: false,
            processData:false,
            success: function (data) {
                // console.log(data);
                var jsonDat = JSON.parse(data);

                if (jsonDat['status'] == 'error'){
                    swal(jsonDat['message'],{
                        icon: 'error'
                    });

                }else{
                    swal(jsonDat['message'],{
                        icon: 'success'
                    });
                    setInterval(function (){
                        window.location.href = 'shop-settings.php';
                    }, 1000);
                }

            },
            error: function () {
                swal('Connection error!',{
                    icon: 'error'
                });
            }
        });


    });

    // -------------------------Change shop footer text-----------------------
    $('#changeFooterTextForm').on('submit', function (e) {
        e.preventDefault();
        var text = new FormData(this);
        // var shopId = shopPassword.get('shopId');
        $.ajax({
            url: 'actions.php',
            type: 'POST',
            data: text,
            contentType: false,
            cache: false,
            processData:false,
            success: function (data) {
                // console.log(data);
                var jsonDat = JSON.parse(data);

                if (jsonDat['status'] == 'error'){
                    swal(jsonDat['message'],{
                        icon: 'error'
                    });

                }else{
                    swal(jsonDat['message'],{
                        icon: 'success'
                    });
                    setInterval(function (){
                        window.location.href = 'shop-settings.php';
                    }, 1000);
                }

            },
            error: function () {
                swal('Connection error!',{
                    icon: 'error'
                });
            }
        });


    });


    // -------------------------Change shop footer text-----------------------
    $('#changeShopLogoForm').on('submit', function (e) {
        e.preventDefault();
        var text = new FormData(this);
        // var shopId = shopPassword.get('shopId');
        $.ajax({
            url: 'actions.php',
            type: 'POST',
            data: text,
            contentType: false,
            cache: false,
            processData:false,
            success: function (data) {
                // console.log(data);
                var jsonDat = JSON.parse(data);

                if (jsonDat['status'] == 'error'){
                    swal(jsonDat['message'],{
                        icon: 'error'
                    });

                }else{
                    swal(jsonDat['message'],{
                        icon: 'success'
                    });
                    setInterval(function (){
                        window.location.href = 'shop-settings.php';
                    }, 1000);
                }

            },
            error: function () {
                swal('Connection error!',{
                    icon: 'error'
                });
            }
        });


    });




    // -------------------------Change shop footer link-----------------------
    $('#changeFooterLinkForm').on('submit', function (e) {
        e.preventDefault();
        var link = new FormData(this);
        // var shopId = shopPassword.get('shopId');
        $.ajax({
            url: 'actions.php',
            type: 'POST',
            data: link,
            contentType: false,
            cache: false,
            processData:false,
            success: function (data) {
                // console.log(data);
                var jsonDat = JSON.parse(data);

                if (jsonDat['status'] == 'error'){
                    swal(jsonDat['message'],{
                        icon: 'error'
                    });

                }else{
                    swal(jsonDat['message'],{
                        icon: 'success'
                    });
                    setInterval(function (){
                        window.location.href = 'shop-settings.php';
                    }, 1000);
                }

            },
            error: function () {
                swal('Connection error!',{
                    icon: 'error'
                });
            }
        });


    });
    // -------------------------Change shop currency-----------------------
    $('#changeCurrencyForm').on('submit', function (e) {
        e.preventDefault();
        var currency = new FormData(this);
        // var shopId = shopPassword.get('shopId');
        $.ajax({
            url: 'actions.php',
            type: 'POST',
            data: currency,
            contentType: false,
            cache: false,
            processData:false,
            success: function (data) {
                // console.log(data);
                var jsonDat = JSON.parse(data);

                if (jsonDat['status'] == 'error'){
                    swal(jsonDat['message'],{
                        icon: 'error'
                    });

                }else{
                    swal(jsonDat['message'],{
                        icon: 'success'
                    });
                    setInterval(function (){
                        window.location.href = 'shop-settings.php';
                    }, 1000);
                }

            },
            error: function () {
                swal('Connection error!',{
                    icon: 'error'
                });
            }
        });


    });

    // ------------------------dashboard today sale--------------------
    $('#today').on('click', function () {
        document.getElementById("today").classList.add("filter-active");
        document.getElementById("lastWeek").classList.remove("filter-active");
        document.getElementById("lastMonth").classList.remove("filter-active");
        $.ajax({
            url: "actions.php",
            type: 'GET',
            data: {filter_today: 'today'},
            success: function(data) {
                $('#sales_filter').html(data);
            }
        });
    });

    // ------------------------dashboard lastweek sale--------------------
    $('#lastWeek').on('click', function () {
        document.getElementById("lastWeek").classList.add("filter-active");
        document.getElementById("today").classList.remove("filter-active");
        document.getElementById("lastMonth").classList.remove("filter-active");
        $.ajax({
            url: "actions.php",
            type: 'GET',
            data: {filter_lastWeek: 'lastWeek'},
            success: function(data) {
                $('#sales_filter').html(data);
            }
        });
    });

    // ------------------------dashboard lastmonth sale--------------------
    $('#lastMonth').on('click', function () {
        document.getElementById("lastMonth").classList.add("filter-active");
        document.getElementById("today").classList.remove("filter-active");
        document.getElementById("lastWeek").classList.remove("filter-active");
        $.ajax({
            url: "actions.php",
            type: 'GET',
            data: {filter_lastMonth: 'lastMonth'},
            success: function(data) {
                $('#sales_filter').html(data);
            }
        });
    });

    // ------------------------dashboard today expense--------------------
    $('#exp_today').on('click', function () {
        document.getElementById("exp_today").classList.add("filter-active");
        document.getElementById("exp_lastWeek").classList.remove("filter-active");
        document.getElementById("exp_lastMonth").classList.remove("filter-active");
        document.getElementById("exp_total").classList.remove("filter-active");
        $.ajax({
            url: "actions.php",
            type: 'GET',
            data: {filter_today_exp: 'today'},
            success: function(data) {
                $('#exp_filter_result').html(data);
            }
        });
    });

    // ------------------------dashboard lastweek expense--------------------
    $('#exp_lastWeek').on('click', function () {
        document.getElementById("exp_lastWeek").classList.add("filter-active");
        document.getElementById("exp_today").classList.remove("filter-active");
        document.getElementById("exp_lastMonth").classList.remove("filter-active");
        document.getElementById("exp_total").classList.remove("filter-active");
        $.ajax({
            url: "actions.php",
            type: 'GET',
            data: {filter_lastWeek_exp: 'lastweek'},
            success: function(data) {
                $('#exp_filter_result').html(data);
            }
        });
    });

    // ------------------------dashboard lastmonth expense--------------------
    $('#exp_lastMonth').on('click', function () {
        document.getElementById("exp_lastMonth").classList.add("filter-active");
        document.getElementById("exp_today").classList.remove("filter-active");
        document.getElementById("exp_lastWeek").classList.remove("filter-active");
        document.getElementById("exp_total").classList.remove("filter-active");
        $.ajax({
            url: "actions.php",
            type: 'GET',
            data: {filter_lastMonth_exp: 'lastmonth'},
            success: function(data) {
                $('#exp_filter_result').html(data);
            }
        });
    });

    // ------------------------dashboard total expense--------------------
    $('#exp_total').on('click', function () {
        document.getElementById("exp_total").classList.add("filter-active");
        document.getElementById("exp_today").classList.remove("filter-active");
        document.getElementById("exp_lastWeek").classList.remove("filter-active");
        document.getElementById("exp_lastMonth").classList.remove("filter-active");
        $.ajax({
            url: "actions.php",
            type: 'GET',
            data: {filter_total_exp: 'total'},
            success: function(data) {
                $('#exp_filter_result').html(data);
            }
        });
    });

    // -------------------------add expense-----------------------
    $('#addExpenseForm').on('submit', function (e) {
        e.preventDefault();
        var expenseData = new FormData(this);

        $.ajax({
            url: 'actions.php',
            type: 'POST',
            data: expenseData,
            contentType: false,
            cache: false,
            processData:false,
            success: function (data) {
                // console.log(data);
                var jsonDat = JSON.parse(data);

                if (jsonDat['status'] == 'error'){
                    swal(jsonDat['message'],{
                        icon: 'error'
                    });

                }else{
                    swal(jsonDat['message'],{
                        icon: 'success'
                    });
                    setInterval(function (){
                        window.location.href = 'index.php';
                    }, 1000);
                }

            },
            error: function () {
                swal('Connection error!',{
                    icon: 'error'
                });
            }
        });

    });

    // -------------------------add investment expense-----------------------
    $('#addInvExpenseForm').on('submit', function (e) {
        e.preventDefault();
        var expenseData = new FormData(this);

        $.ajax({
            url: 'actions.php',
            type: 'POST',
            data: expenseData,
            contentType: false,
            cache: false,
            processData:false,
            success: function (data) {
                // console.log(data);
                var jsonDat = JSON.parse(data);

                if (jsonDat['status'] == 'error'){
                    swal(jsonDat['message'],{
                        icon: 'error'
                    });

                }else{
                    swal(jsonDat['message'],{
                        icon: 'success'
                    });
                    setInterval(function (){
                        window.location.href = 'index.php';
                    }, 1000);
                }

            },
            error: function () {
                swal('Connection error!',{
                    icon: 'error'
                });
            }
        });

    });

    // ---------------------------due collection-----------------------
    $('body').on('click','.showduetk',function(){

        var amount_due=$(this).attr('amount_due');
        var order_id  =$(this).attr('order_id');
        var payable   =$(this).attr('payable');

        var paid=payable-amount_due;

        $('#current_due').html(amount_due);
        $('#totalpayable').html(payable);
        $('#totalpaid').html(paid);

        $('#keep_amount').val(amount_due);
        $('#keep_id').val(order_id);
        $('#keep_paid').val(paid);
        $('#due_amount').attr('max',amount_due);
        $('#due_amount').val(amount_due)
    });

    // --------------------------due update-----------------------

    $('body').on('click','#add_due_update',function(e){

        let due=$('#keep_amount').val();
        let oid=$('#keep_id').val();
        let provided_due=$('#due_amount').val();

        //alert(due+"   "+provided_due);
        e.preventDefault();

        $.ajax({

            type:"POST",
            url:'actions.php',
            data:{
                rr_add_due:1,
                due:due,
                oid:oid,
                provided_due:provided_due
            },

            success:function(response){
                data=JSON.parse(response);
                if (data.status=='error') {
                    swal(data['message'],{
                        icon: 'error'
                    });
                }else{
                    swal(data['message'],{
                        icon: 'success'
                    });

                    setInterval(function (){
                        window.location.href = 'orders.php';
                    }, 700);
                }

            }

        });
    });

    // -----------------------single stock refund---------------------
    $('.singleStockRefundForm').on('submit', function (e) {
        e.preventDefault();
        var refundStockData = $(this).serialize();
        // console.log(refundData);
        swal({
            title: "Are you sure?",
            text: "Once refunded, you will not be able to recover this!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    url: 'actions.php',
                    type: 'POST',
                    data: refundStockData,
                    success: function (data) {

                        var respon = JSON.parse(data);
                        console.log(respon);
                        if (respon.status == "success"){
                            swal(respon.message, {
                                icon: "success",
                            });
                            setInterval(function (){
                                location.reload();
                            }, 1000);
                        }else{
                            swal(respon.message, {
                                icon: "error",
                            });
                        }

                    }
                });
            }else{
                return false;
    }
    });
    });

    // -----------------------full stock refund---------------------
    $('.stockRefundForm').on('submit', function (e) {
        e.preventDefault();
        var stockData = $(this).serialize();
        // console.log(refundData);
        swal({
            title: "Are you sure?",
            text: "Once refunded, you will not be able to recover this!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    url: 'actions.php',
                    type: 'POST',
                    data: stockData,
                    success: function (data) {

                        var respon = JSON.parse(data);
                        console.log(respon);
                        if (respon.status == "success"){
                            swal(respon.message, {
                                icon: "success",
                            });
                            setInterval(function (){
                                location.reload();
                            }, 1000);
                        }else{
                            swal(respon.message, {
                                icon: "error",
                            });
                        }

                    }
                });
            }else{
                return false;
    }
    });
    });

    // -----------------------stock due---------------------------
    $('body').on('click','.showStockduetk',function(){

        var amount_stock_due=$(this).attr('amount_stock_due');
        var stock_id  =$(this).attr('stock_id');
        var stock_payable   =$(this).attr('stock_payable');

        var stock_paid=stock_payable-amount_stock_due;

        $('#stock_current_due').html(amount_stock_due);
        $('#totalStockpayable').html(stock_payable);
        $('#totalStockpaid').html(stock_paid);

        $('#keep_stock_amount').val(amount_stock_due);
        $('#keep_stock_id').val(stock_id);
        $('#keep_stock_paid').val(stock_paid);
        $('#due_stock_amount').attr('max',amount_stock_due);
        $('#due_stock_amount').val(amount_stock_due);
    });



    $('body').on('click','#add_stock_due_update',function(e){

        let stock_due=$('#keep_stock_amount').val();
        let sid=$('#keep_stock_id').val();
        let provided_stock_due=$('#due_stock_amount').val();

        //alert(due+"   "+provided_due);
        e.preventDefault();

        $.ajax({

            type:"POST",
            url:'actions.php',
            data:{
                stock_add_due:1,
                stock_due:stock_due,
                sid:sid,
                provided_stock_due:provided_stock_due
            },

            success:function(response){
                data=JSON.parse(response);
                if (data.status=='error') {
                    swal(data['message'],{
                        icon: 'error'
                    });
                }else{
                    swal(data['message'],{
                        icon: 'success'
                    });

                    setInterval(function (){
                        window.location.href = 'add-stock.php';
                    }, 700);
                }

            }

        });


    });

    // ---------------------add customer from sales-------------------

    $('body').on('submit', '#addCustomerForm', function (e) {
        e.preventDefault();
        var formDataCustomer = new FormData(this);
        // console.log(formDataCustomer);

        $.ajax({
            url: 'actions.php',
            type: 'POST',
            data: formDataCustomer,
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                var jsonDat = JSON.parse(data);
                // console.log(data);

                if (jsonDat['status'] == 'error') {
                    swal(jsonDat['message'], {
                        icon: 'error'
                    });
                } else {
                    swal(jsonDat['message'], {
                        icon: 'success'
                    });
                    setInterval(function () {
                        window.location.reload();
                    }, 1000);
                }

            },
            error: function () {
                swal('Connection error!', {
                    icon: 'error'
                });
            }
        });
    });


//        ----------------------------total product refund------------------------
    $('body').on('click', '.refundForm', function (e) {
        e.preventDefault();
        var inputValue = $(this).val();
        swal({
            title: "Are you sure?",
            text: "Once refunded, you will not be able to recover this!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
            .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    url: 'actions.php',
                    type: 'POST',
                    data: {refundOrder: inputValue},
                    success: function (data) {

                        var respon = JSON.parse(data);
                        console.log(respon);
                        if (respon.status == "success"){
                            swal(respon.message, {
                                icon: "success",
                            });
                            $('#mi_orders_datatable').dataTable().api().ajax.reload();
                        }else{
                            swal(respon.message, {
                                icon: "error",
                            });
                        }

                    }
                });
            }else{
                return false;
            }
        });
    });



    $('body').on('click', '.singleRefundForm', function (e) {
        var id = $(this).val();
        var modal = $(this).attr('mi-data-target');
        $.ajax({
            url: 'actions.php',
            type: 'POST',
            data: {
                mi_get_single_refund_form: 1,
                order_id: id
            },
            success: function (data) {

                var respon = JSON.parse(data);
                if (respon.status == 'success'){
                    $('.singleRefundFormSubmitter input[name=order_id]').val(id);
                    $('#mi-get-refund-fields').html(respon.data);
                    $('#singleRefundFormModal').modal('show');
                }else{
                    swal(respon.message, {
                        icon: "error",
                    });
                }
            }
        });
    });



    //        ----------------------------single product refund------------------------
    $('body').on('submit', '.singleRefundFormSubmitter', function (e) {
        e.preventDefault();
        var refundData = $(this).serialize();

        swal({
            title: "Are you sure?",
            text: "Once refunded, you will not be able to recover this!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    url: 'actions.php',
                    type: 'POST',
                    data: refundData,
                    success: function (data) {

                        var respon = JSON.parse(data);
                        console.log(respon);
                        if (respon.status == "success"){
                            swal(respon.message, {
                                icon: "success",
                            });
                            $('#mi_orders_datatable').dataTable().api().ajax.reload();
                            $('#singleRefundFormModal').modal('hide');
                        }else{
                            swal(respon.message, {
                                icon: "error",
                            });
                        }

                    }
                });
            }else{
                return false;
    }
    });
    });

    // -------------------product sales discount---------------------

    $('body').on('blur', '#discount', function (e) {
        e.preventDefault();
        var amment = $(this).val();
        var cart_id = $(this).attr('cart-id');
        // console.log(cart_id);
        // var note = $('#mi_purchase_extra_note').val();

        $.ajax({
            type: 'post',
            url: 'actions.php',
            data: {
                amount: amment,
                cart_id: cart_id,
                discount_updater: 1
            },
            success: function (data) {
                get_cart_items();
                console.log(data)
            },
            error: function () {
                console.log('Sorry! extra not added');
            }
        });
    });

    // ---------------------product vat choosing option-----------------------
    $('body').on('change', '#vat_tax_select', function (e) {
        e.preventDefault();
        var vat = $(this).find(':selected').val();
        var cart_id = $(this).attr('cart-id');
        console.log(vat);

        $.ajax({
            type: 'post',
            url: 'actions.php',
            data: {
                vat: vat,
                cart_id: cart_id,
                vat_updater: 1
            },
            success: function (data) {
                get_cart_items();
                console.log(data)
            },
            error: function () {
                console.log('Sorry! extra not added');
            }
        });

    });

    // -------------------Paid amount inserting---------------------

    $('body').on('blur', '#paid_amount', function (e) {
        e.preventDefault();
        var amment = $(this).val();
        // console.log(cart_id);
        // var note = $('#mi_purchase_extra_note').val();

        $.ajax({
            type: 'post',
            url: 'actions.php',
            data: {
                amount: amment,
                paid_amount_updater: 1
            },
            success: function (data) {
                get_cart_items();
                console.log(data)
            },
            error: function () {
                console.log('Sorry! extra not added');
            }
        });
    });

    // -------------------Sales note---------------------

    $('body').on('blur', '#note', function (e) {
        e.preventDefault();
        var note = $(this).val();
        // console.log(note);
        // var note = $('#mi_purchase_extra_note').val();

        $.ajax({
            type: 'post',
            url: 'actions.php',
            data: {
                note: note,
                note_updater: 1
            },
            success: function (data) {
                get_cart_items();
                console.log(data)
            },
            error: function () {
                console.log('Sorry! extra not added');
            }
        });
    });

    // ---------------------get customer---------------------
    $('body').on("change",'#getnewcustomer',function(){
        var customer_id_new=$(this).val();

        $.ajax({
            url:'actions.php',
            type:"POST",
            data:{customer_id_new:customer_id_new},
            success:function (data){
                var data=JSON.parse(data);
                if (data['status']=='success') {
                    console.log(data['message']);

                    $(".rrcname").text(data['message']['0']['customer_name']);
                    $(".rrcphone").text(data['message']['0']['phone']);
                    $(".rrcaddress").text(data['message']['0']['address']);

                }else{
                    console.log(data['message']);
                }
            }
        });
    });


});
