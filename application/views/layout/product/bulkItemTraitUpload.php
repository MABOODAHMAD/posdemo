<div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0 font-size-18">ITEMS TRAIT BULK UPLOAD</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
                        

                       
                        
                
                
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <div class="card-body">
                                                <div class="card-body border-bottom">
                                                    <div class="d-flex align-items-center">
                                                        <h5 class="mb-0 card-title flex-grow-1">Item trait bulk upload</h5>
                                                        <div class="flex-shrink-0">
                                                            <?php if(dashRole(["role_check"=>"PRODUCT_PRODUCT_CREATE"])){?><a href="<?=base_Url('ProductAdd')?>" class="btn btn-primary" >Add New Item</a><?php } ?>
                                                            <a href="#!" class="btn btn-light"><i class="mdi mdi-refresh"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-border mb-3 card card-body border-success"> 
                                                    <h5 class="card-title">Downlaod Excel Tempalate</h5> 
                                                    <a href="<?=base_url('uploads/item/template/ITEM_TRAIT_UPLOAD.xlsx')?>" download="">
                                                        <!-- <button class="mb-2 mr-2 btn-icon-vertical btn btn-primary"><i class="lnr-enter btn-icon-wrapper"> </i>Downlaod File</button> -->
                                                        <button type="button" class="btn btn-primary">Download Template <i class="bx bx-download align-baseline ms-1"></i></button>
                                                    </a> 
                                                </div>
                                        <div class="card-body">
                                            <form id="formdata">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="mb-3">
                                                            <label for="validationCustom03" class="form-label">Upload( Format : xlsx|xls|csv)</label>
                                                                <input type="file" class="form-control" name="item_file" >
                                                                <label id="item_desc-error" class="error"></label>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <button data-aftreload="true" data-control="upload/item-trait-bulk-upload" data-form="formdata" data-sweetalert="<?=$sweetAlertMsg->bulkTraitUpload->msg?>" data-sweetalertcontrol="<?=$sweetAlertMsg->bulkTraitUpload->cont?>" class="ajaxform btn btn-success waves-effect waves-light">Add Items Trait</button>
                                                    </div>
                                                    <span id="outmsg"></span>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="card-body <?=$this->session->flashdata('ITEM_BULK_MSG')?'':'d-none'?>">
                                            <div class="table-responsive">
                                                <table class="table table-bordered border-success mb-0">
            
                                                    <thead>
                                                        <tr>
                                                            <th>Sn</th>
                                                            <th>Item Code</th>
                                                            <th>Upload Status</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?=$msg->FM_MSG?>
                                                        <!-- <tr>
                                                            <th scope="row">1</th>
                                                            <td>Mark</td>
                                                            <td>Otto</td>
                                                            <td>@mdo</td>
                                                        </tr> -->
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>


                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                
                <!-- End Page-content -->
                
                
                
                </div>
            </div>
            <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
            <script>
                $(document).ready(function() {
                    $('.table').DataTable({

                        "lengthMenu": [[-1], ["All"]],

                        "dom": 'Bfrtip',

                        "buttons" : ['excel']

                    });

                });
            </script>