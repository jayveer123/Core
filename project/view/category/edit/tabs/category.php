<?php 

$categoryData =  $this->getCategory();  
$categories = $this->getCategories(); ?>

<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">Category Information</h3>
    </div>
    <div class="card-body">
        <div class="form-group row">
            <label for="name" class="col-sm-2 col-form-label">Category Name</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="category[c_name]" id="cname" value="<?php echo $categoryData->c_name; ?>" placeholder="Category Name">
            </div>
        </div>
        <div class="form-group row">
            <label for="parentId" class="col-sm-2 col-form-label">Subcategory</label>
            <div class="col-sm-10">
                <select class="form-control" name="category[parent_id]" id="parent_id">
                        <option value="" <?php echo ($categoryData->parent_id==NULL) ? "selected" : ''; ?>>Main Category</option>
                        <?php foreach ($categories as $category) { ?>
                            <?php if($categoryData->id != $category->id){ ?>
                            <option value="<?php echo $category->id; ?>" <?php echo ($category->id==$categoryData->parent_id) ? "selected" : ''; ?>>
                                <?php echo $this->getPath($category->id,$category->path); ?>
                            </option>
                            <?php } ?>
                        <?php }?>
                    </select>
            </div>
        </div>
        <div class="form-group">
                    <label for="exampleInputPassword1">Stetus</label>
                    <div class="col-sm-6">
                    <!-- radio -->
                    <div class="form-group clearfix">
                      <div class="icheck-success d-inline">
                        <input type="radio" id="radioPrimary1" name="category[status]" <?php echo ($categoryData->getStatus($categoryData->status)=='Active')? 'checked' : ''; ?> value="1">
                        <label for="radioPrimary1">
                            Active
                        </label>
                      </div>
                      &nbsp;
                      <div class="icheck-danger d-inline">
                        <input type="radio" id="radioPrimary2" name="category[status]" <?php echo ($categoryData->getStatus($categoryData->status)=='Inactive')? 'checked' : ''; ?> value="2">
                        <label for="radioPrimary2">
                            Inactive
                        </label>
                      </div>
                    </div>
                  </div>
                  </div>
        <div class="card-footer">
            <button type="button" class="btn btn-info" id="categorySubmit">Save</button>
            <button type="button" class="btn btn-default" id="categoryCancel">Cancel</button>
        </div>
    </div>
</div>
<script type="text/javascript">
    
    jQuery("#categoryCancel").click(function(){
        admin.setData({'id' : null});
        admin.setUrl("<?php echo $this->getUrl('gridBlock','category',['id' => null]); ?>");
        admin.load();
    });

    jQuery("#categorySubmit").click(function(){
        admin.setForm(jQuery("#indexForm"));
        admin.setUrl("<?php echo $this->getEdit()->getSaveUrl();?>");
        admin.load();
    });
</script>
