<?php
$footer = mi_db_read_by_id('settings_meta', array('type'=>'footer'))[0];
$footer_link = mi_db_read_by_id('settings_meta', array('meta_name'=>'footer_link', 'type'=>'footer'))[0];
?>
<footer class="footer footer-black  footer-white ">
    <div class="container-fluid">
        <div class="row">
            <nav class="footer-nav">

            </nav>
            <div class="credits ml-auto">
              <span class="copyright font-weight-bold text-black-50">
                © Copyright
                <script>
                  document.write(new Date().getFullYear())
                </script>, developed by <a style="color: #000;" class="font-weight-bold" href="<?=$footer_link['meta_value']?>" target="_blank"><?=$footer['meta_value']?></a>
              </span>
            </div>
        </div>
    </div>
</footer>
</div>
</div>

<!-- Modal -->
<div id="modalCalculator" class="modal fade" role="dialog" style="max-width: 500px;overflow: hidden;margin: 0px auto;padding-left: 19px; height: 645px;">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <button type="button" class="close mi_close" data-dismiss="modal" style="position: absolute;right: 14px;top: 8px;z-index: 9999; color: #fff;">&times;</button>
            <div class="modal-body col-md-12 calculator" align="center" style="padding: 0 15px;">
                <div class="row displayBox" style="padding: 0 15px;">
                    <input class="displayText" id="display" style="outline:0 !important;color: #ffffff;background-color: none;">
                </div>
                <div class="row numberPad" style="margin-top: 0px;">
                    <div class="col-md-9" style="padding-left: 30px;">
                        <div class="row">
                            <button class="btn clear hvr-back-pulse" id="clear">C</button>
                            <button class="btn btn-calc hvr-radial-out" id="sqrt">√</button>
                            <button class="btn btn-calc hvr-radial-out hvr-radial-out" id="square">x<sup>2</sup></button>
                        </div>
                        <div class="row">
                            <button class="btn btn-calc hvr-radial-out" id="seven">7</button>
                            <button class="btn btn-calc hvr-radial-out" id="eight">8</button>
                            <button class="btn btn-calc hvr-radial-out" id="nine">9</button>
                        </div>
                        <div class="row">
                            <button class="btn btn-calc hvr-radial-out" id="four">4</button>
                            <button class="btn btn-calc hvr-radial-out" id="five">5</button>
                            <button class="btn btn-calc hvr-radial-out" id="six">6</button>
                        </div>
                        <div class="row">
                            <button class="btn btn-calc hvr-radial-out" id="one">1</button>
                            <button class="btn btn-calc hvr-radial-out" id="two">2</button>
                            <button class="btn btn-calc hvr-radial-out" id="three">3</button>
                        </div>
                        <div class="row">
                            <button class="btn btn-calc hvr-radial-out" id="plus_minus">&#177;</button>
                            <button class="btn btn-calc hvr-radial-out" id="zero">0</button>
                            <button class="btn btn-calc hvr-radial-out" id="decimal">.</button>
                        </div>
                    </div>
                    <div class="col-md-3 operationSide">
                        <button id="divide" class="btn btn-operation hvr-fade">÷</button>
                        <button id="multiply" class="btn btn-operation hvr-fade">×</button>
                        <button id="subtract" class="btn btn-operation hvr-fade">−</button>
                        <button id="add" class="btn btn-operation hvr-fade">+</button>
                        <button id="equals" class="btn btn-operation equals hvr-back-pulse" style="margin-bottom: 0 !important;">=</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>


<!--<script src="plugins/calculator/calculate.js"></script>-->

<script src="assets/js/fontawesome.min.js"></script>
<script src="plugins/select/bootstrap-select.min.js"></script>

<script src="assets/js/core/popper.min.js"></script>
<script src="assets/js/core/bootstrap.min.js"></script>

<script src="assets/js/print.min.js"></script>
<script src="plugins/image_uplodify/fileinput.min.js"></script>

<script src="plugins/chart/canvasjs.min.js"></script>

<script src="plugins/dropify/dist/js/dropify.min.js"></script>

<!--  Notifications Plugin    -->
<script src="assets/js/plugins/bootstrap-notify.js"></script>
<!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
<script src="assets/js/paper-dashboard.min.js" type="text/javascript"></script>


<script src="plugins/datatable/datatables.min.js"></script>
<script src="plugins/datatable/Buttons-1.5.6/js/dataTables.buttons.min.js"></script>
<script src="plugins/datatable/Buttons-1.5.6/js/buttons.print.js"></script>
<script src="plugins/datatable/Buttons-1.5.6/js/buttons.colVis.js"></script>
<script src="plugins/datatable/Buttons-1.5.6/js/buttons.flash.min.js"></script>
<script src="plugins/datatable/JSZip-2.5.0/jszip.min.js"></script>
<script src="plugins/datatable/pdfmake-0.1.36/pdfmake.min.js"></script>
<script src="plugins/datatable/pdfmake-0.1.36/vfs_fonts.js"></script>
<script src="plugins/datatable/Buttons-1.5.6/js/buttons.html5.js"></script>
<script src="plugins/datatable/Select-1.3.0/js/dataTables.select.min.js"></script>

<script src="plugins/iconpicker/fontawesome-iconpicker.min.js"></script>
<script src="plugins/datepicker/datepicker.min.js"></script>

<script src="plugins/fancybox/jquery.fancybox.min.js"></script>
<script src="plugins/printjs/divjs.js"></script>
<script src="plugins/bootstrap-select/select2.full.min.js"></script>
<!--<script src="plugins/tail-select/tail.select.min.js"></script>-->

<!--<script src="plugins/printjs/printThis.js"></script>-->
<script src="assets/js/animatedModal.min.js"></script>
<script src="assets/js/custom.js"></script>
</body>
</html>