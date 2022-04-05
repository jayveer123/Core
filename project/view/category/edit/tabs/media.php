<?php $medias = $this->getMedia(); ?>

<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">Category Media Information</h3>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Image Id</th>
                    <th>Category Id</th>
                    <th>Name</th>
                    <th>Base</th>
                    <th>Thumb</th>
                    <th>Small</th>
                    <th>Gallery</th>
                    <th>Remove</th>
                </tr>
            </thead>
            <tbody>
                <?php if(!$medias): ?>
                <tr>
                    <td colspan=8>No Records Found</td>
                </tr>
                <?php else: ?>
                <?php foreach ($medias as $media): ?>
                <tr>
                    <div class="row">
                        <div class="col-sm-10">
                            <td><?php echo $media->imageId; ?></td>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-10">
                            <td><?php echo $media->categoryId; ?></td>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-10">
                            <td><img src="<?php  echo $media->getImgPath();?>" alt="No Image found" width=50 height=50></td>
                        </div>
                    </div> 

                    <div class="row">
                        <div class="col-sm-10">
                            <div class="form-check">
                                <td>
                                    <input type="radio" class="" name="media[base]" value = "<?php echo $media->imageId ?>" <?php echo $this->selected($media->imageId,'base'); ?> >
                                </td>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-10">
                            <div class="form-check">
                                <td>
                                    <input type="radio" class="" name="media[thumb]" value = "<?php echo $media->imageId ?>" <?php echo $this->selected($media->imageId,'thumb'); ?> >
                                </td>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-10">
                            <div class="form-check">
                                <td>
                                    <input type="radio" class="" name="media[small]" value = "<?php echo $media->imageId ?>" <?php echo $this->selected($media->imageId,'small'); ?> >
                                </td>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-10">
                            <div class="form-check">
                                <td>
                                    <input type="checkbox" class="" name="media[gallery][]" value = "<?php echo $media->imageId ?>" <?php echo $media->gallery == 1 ? 'checked' : ''; ?>>
                                </td>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-10">
                            <div class="form-check">
                                <td>
                                    <input type="checkbox" class="" name="media[remove][]" value = "<?php echo $media->imageId ?>" >
                                </td>
                            </div>
                        </div>
                    </div>
                </tr>
                <?php endforeach; ?>
                <?php endif; ?>
                <tr>
                    <td colspan="8">
                        <input type="file" class="btn btn-warning" name="imageName" id="image" onChange="fileUpload(this)">
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        <button type="button" class="btn btn-info" id="categoryMediaUpdate" <?php echo (!$medias) ? 'disabled' : ''; ?>>Save</button>
        <button type="button" class="btn btn-default" id="categoryCancel">Cancel</button>
    </div>
</div>

<script type="text/javascript">
    jQuery("#categoryCancel").click(function(){
        admin.setData({'id' : null});
        admin.setUrl("<?php echo $this->getUrl('gridBlock','category',['id' => null]); ?>");
        admin.load();
    });

    jQuery("#categoryMediaUpdate").click(function(){
        admin.setForm(jQuery("#indexForm"));
        admin.setUrl("<?php echo $this->getUrl('saveMedia','Category'); ?>");
        admin.load();
    });

    function fileUpload(fileData) {
        var file = fileData.files[0];
        var formData = new FormData();
        formData.append('imageName', file);

        $.ajax({
            type: "POST",
            url: "<?php echo $this->getUrl('saveMedia','Category'); ?>", 
            contentType: false,
            processData: false,
            data: formData,
            success: function (data) {
                admin.manageElemants(data.elements);
            }
        });
    }
</script>
