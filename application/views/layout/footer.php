<footer class="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <script>document.write(new Date().getFullYear())</script> © Al Moallim Jewellery.
            </div>
            <div class="col-sm-6">
                <div class="text-sm-end d-none d-sm-block">
                    Design & Develop Mediatech Solution
                </div>
            </div>
        </div>
    </div>
</footer>
</div>

<!-- end main content-->
</div>
<!-- END layout-wrapper -->

<!-- Right Sidebar -->
<!--<div class="right-bar">-->
<!--    <div data-simplebar class="h-100">-->
<!--        <div class="rightbar-title d-flex align-items-center px-3 py-4">-->

<!--            <h5 class="m-0 me-2">Settings</h5>-->

<!--            <a href="javascript:void(0);" class="right-bar-toggle ms-auto">-->
<!--                <i class="mdi mdi-close noti-icon"></i>-->
<!--            </a>-->
<!--        </div>-->

<!-- Settings -->
<!--        <hr class="mt-0" />-->
<!--        <h6 class="text-center mb-0">Choose Layouts</h6>-->

<!--        <div class="p-4">-->
<!--            <div class="mb-2">-->
<!--                <img src="<?= base_url() ?>assets/images/layouts/layout-1.jpg" class="img-thumbnail" alt="layout images">-->
<!--            </div>-->

<!--            <div class="form-check form-switch mb-3">-->
<!--                <input class="form-check-input theme-choice" type="checkbox" id="light-mode-switch" checked>-->
<!--                <label class="form-check-label" for="light-mode-switch">Light Mode</label>-->
<!--            </div>-->

<!--            <div class="mb-2">-->
<!--                <img src="<?= base_url() ?>assets/images/layouts/layout-2.jpg" class="img-thumbnail" alt="layout images">-->
<!--            </div>-->
<!--            <div class="form-check form-switch mb-3">-->
<!--                <input class="form-check-input theme-choice" type="checkbox" id="dark-mode-switch">-->
<!--                <label class="form-check-label" for="dark-mode-switch">Dark Mode</label>-->
<!--            </div>-->

<!--            <div class="mb-2">-->
<!--                <img src="<?= base_url() ?>assets/images/layouts/layout-3.jpg" class="img-thumbnail" alt="layout images">-->
<!--            </div>-->
<!--            <div class="form-check form-switch mb-3">-->
<!--                <input class="form-check-input theme-choice" type="checkbox" id="rtl-mode-switch">-->
<!--                <label class="form-check-label" for="rtl-mode-switch">RTL Mode</label>-->
<!--            </div>-->

<!--            <div class="mb-2">-->
<!--                <img src="<?= base_url() ?>assets/images/layouts/layout-4.jpg" class="img-thumbnail" alt="layout images">-->
<!--            </div>-->
<!--            <div class="form-check form-switch mb-5">-->
<!--                <input class="form-check-input theme-choice" type="checkbox" id="dark-rtl-mode-switch">-->
<!--                <label class="form-check-label" for="dark-rtl-mode-switch">Dark RTL Mode</label>-->
<!--            </div>-->


<!--        </div>-->

<!--    </div> <!-- end slimscroll-menu-->-->
<!--</div>-->
<!-- /Right-bar -->

<!-- Right bar overlay-->

<div class="rightbar-overlay"></div>


        <!-- Static Backdrop modal Button -->
        <!-- <button type="button" class="btn btn-primary waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                            Static backdrop modal
        </button> -->
                                       
        <!-- Static Backdrop Modal -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fixed-modal-head" id="staticBackdropLabel"></h5>
                        <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                    </div>
                    <div class="modal-body fixed-modal-body">
                    </div>
                    <div class="modal-footer fixed-modal-footer">
                            <!-- <button type="button" class="btn btn-light" data-bs-dismiss="modal" class="fixed-modal-close">Close</button>
                            <button type="button" class="btn btn-primary fixed-modal-send">Understood</button> -->
                    </div>
                </div>
            </div>
        </div>
                                      

                                  
             
<!-- <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#standard_model" onClick="addCountry()">Add New Country</a> -->
<!-- sample modal content -->
<div id="standard_model" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-layout-control">
        <!-- <div class="modal-content st-content" style="width: 800px;"> -->
        <div class="modal-content st-content">
            <div class="modal-header">
                <h5 class="modal-title st_model_head" id="myModalLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body st_model_body">
            </div>
            <div class="modal-footer">
                <span id="modal-out-msg"></span>
                <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>
                <span id="form-control-modal">
                    <button type="button" class="form-modal btn btn-primary waves-effect waves-light st_model_send"
                        onClick="stModelSent(this)"></button>
                </span>
                <!-- <button type="button" data-control="sale/sale-add" data-form="formdata" class="form-modal btn btn-primary waves-effect waves-light st_model_send" onClick="stModelSent(this)"></button> -->
            </div>
        </div><!-- /.modal-content -->
       
        <!-- JAVASCRIPT -->
        <!--<script src="<?= base_url() ?>assets/js/custom.js"></script>-->
        <!--<script src="<?= base_url() ?>assets/libs/jquery/jquery.min.js"></script>-->
        <!--<script src="<?= base_url() ?>assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>-->
        <!--<script src="<?= base_url() ?>assets/libs/metismenu/metisMenu.min.js"></script>-->
        <!--<script src="<?= base_url() ?>assets/libs/simplebar/simplebar.min.js"></script>-->
        <!--<script src="<?= base_url() ?>assets/libs/node-waves/waves.min.js"></script>-->

        <!-- apexcharts -->
        <!--<script src="<?= base_url() ?>assets/libs/apexcharts/apexcharts.min.js"></script>-->

        <!-- dashboard init -->
        <!--<script src="<?= base_url() ?>assets/js/pages/dashboard.init.js"></script>-->

        <!-- App js -->
        <!--<script src="<?= base_url() ?>assets/js/app.js"></script>-->




        <!-- ======================================================================== -->




        <!-- form advanced init -->




        <!-- =========================================================================/= -->

        <script src="<?= base_url() ?>assets/js/custom.js"></script>
        <?php $jsMinCon = isset($js_min_con) ? $js_min_con : TRUE;
        if ($jsMinCon) { ?>
            <script src="<?= base_url() ?>assets/libs/jquery/jquery.min.js"></script>
        <?php } ?>
        <script src="<?= base_url() ?>assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="<?= base_url() ?>assets/libs/metismenu/metisMenu.min.js"></script>
        <script src="<?= base_url() ?>assets/libs/simplebar/simplebar.min.js"></script>
        <script src="<?= base_url() ?>assets/libs/node-waves/waves.min.js"></script>

        <!-- Required datatable js -->
        <script src="<?= base_url() ?>assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="<?= base_url() ?>assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
        <!-- Buttons examples -->
        <script src="<?= base_url() ?>assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
        <script src="<?= base_url() ?>assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
        <script src="<?= base_url() ?>assets/libs/jszip/jszip.min.js"></script>
        <script src="<?= base_url() ?>assets/libs/pdfmake/build/pdfmake.min.js"></script>
        <script src="<?= base_url() ?>assets/libs/pdfmake/build/vfs_fonts.js"></script>
        <script src="<?= base_url() ?>assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
        <script src="<?= base_url() ?>assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
        <script src="<?= base_url() ?>assets/libs/datatables.net-buttons/js/buttons.colVis.min.js"></script>

        <!-- Responsive examples -->
        <script src="<?= base_url() ?>assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
        <script
            src="<?= base_url() ?>assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>

        <script src="<?= base_url() ?>assets/libs/apexcharts/apexcharts.min.js"></script>

        <!-- Datatable init js -->
        <script src="<?= base_url() ?>assets/js/pages/datatables.init.js"></script>
        <!-- mode -->
        <script src="<?= base_url() ?>assets/js/pages/modal.init.js"></script>

        <script src="<?= base_url() ?>assets/libs/select2/js/select2.min.js"></script>
        <script src="<?= base_url() ?>assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
        <script src="<?= base_url() ?>assets/libs/spectrum-colorpicker2/spectrum.min.js"></script>
        <script src="<?= base_url() ?>assets/libs/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
        <script src="<?= base_url() ?>assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
        <script src="<?= base_url() ?>assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js"></script>
        <script src="<?= base_url() ?>assets/libs/%40chenfengyuan/datepicker/datepicker.min.js"></script>
        <script src="<?= base_url() ?>assets/js/pages/form-advanced.init.js"></script>

        <script src="<?= base_url() ?>assets/js/app.js"></script>



        </body>



        </html>