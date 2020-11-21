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
        <div class="row">
          <div class="col-md-12">
            <div class="card ">
              <div class="card-header">
                <h5 class="card-title pull-left" style="margin-top: 18px">All of The Suppliers List</h5>
                <a class="btn btn-primary pull-right"href="single_supplier.php">Add Supplier &nbsp;<i class="nc-icon nc-simple-add"></i></a>
                  <div class="showmsg"></div>
              </div>
              <div class="card-body table-responsive">
                <table class="table table-full-width" id="supplier_datatable">
                  <thead class="text-primary text-center">
                    <tr>
                        <th style="max-width: 50px; padding-top: 0">
                            <button class="btn btn-sm btn-danger btn-rounded pull-left delAll" datatype="supplier"><i class="nc-icon nc-simple-remove"></i>&nbsp;Delete</button>
                        </th>
                        <th colspan="8"></th>
                    </tr>
                    <tr>
                        <th class="text-left" style="max-width: 50px;">
                            #
                        </th>
                        <th class="table_font_small">Image</th>
                        <th class="table_font_small">Supplier Name</th>
                        <th class="table_font_small">Company</th>
                        <th class="table_font_small">Email</th>
                        <th class="table_font_small">Phone</th>
                        <th class="table_font_small">Address</th>
                        <th class="table_font_small">Added</th>
                        <th class="table_font_small">Actions</th>
                    </tr>
                  </thead>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
<?=mi_footer();?>
