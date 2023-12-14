            <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0 font-size-18">Form File Upload</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Forms</a></li>
                                            <li class="breadcrumb-item active">Form File Upload</li>
                                        </ol>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
        
                                        <h4 class="card-title">Item Image Upload</h4>
                                        <p class="card-title-desc">Make sure the image file name is the same as the item upload time for the given image column.
                                        </p>
        
                                        <div>
                                            <form action="<?=base_url('upload/imageUploadDB')?>" class="dropzone">
                                                <div class="fallback">
                                                    <input name="image_name" type="file" multiple="multiple">
                                                </div>
                                                <div class="dz-message needsclick">
                                                    <div class="mb-3">
                                                        <i class="display-4 text-muted bx bxs-cloud-upload"></i>
                                                    </div>
                                                    
                                                    <h4>Drop files here or click to upload.</h4>
                                                </div>
                                            </form>
                                        </div>
        
                                        <table id="tables" class="table table-hover table-striped table-bordered dataTable dtr-inline refresh">
                                                <thead>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                            <?php foreach($imageDets as $imageDetsGet):?>
                                                <tr id='tableTr<?=$imageDetsGet->BIU_ID?>'>
                                                    <td>
                                                        <img src="<?=base_url('uploads/images/item/').$imageDetsGet->BIU_NAME?>" height="100px" width='100px' alt="<?=$imageDetsGet->BIU_NAME?>">
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-danger waves-effect waves-light" data-no="<?=count($imageDets)?>" data-id="<?=$imageDetsGet->BIU_ID?>" data-name="<?=$imageDetsGet->BIU_NAME?>" onclick="deleteImg(this)">
                                                            <i class="mdi mdi-delete"></i>
                                                        </button>
                                                        <!-- <button type="button" data-no="<?=count($imageDets)?>" data-id="<?=$imageDetsGet->BIU_ID?>" data-name="<?=$imageDetsGet->BIU_NAME?>" class="mb-2 mr-2 btn-icon btn-icon-only btn-pill btn btn-outline-warning" onclick="deleteImg(this)"><i class="pe-7s-trash btn-icon-wrapper"> </i></button> -->
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </table>
                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div> <!-- end row -->

                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->

<script src="assets/libs/dropzone/min/dropzone.min.js"></script>

<script>
    	window.countImage=0;
    	function deleteImg(trValue) {
            if(confirm('Are you sure you want to delete this image?')){
    		    let id = $(trValue).data('id');
    		    let name = $(trValue).data('name');
    		    let no = $(trValue).data('no');
    		    countImage++;
    		    let final_count = no-countImage;
    		    $('#imageCount').val(final_count);
    		    $('#tableTr'+id).remove();
        		    $.ajax({"url":"<?php echo base_url("common/imageDelete"); ?>","type":"post","data":{id,name},
            		    success:function(data){
            		    }
        		   });
                }
		    }

		setInterval(function() 
		{
		let url = "<?=base_url('bulkImageUpload')?>";
  			  $("#tables").load(""+url+" #tables");
   		
		}, 5000);
    </script>