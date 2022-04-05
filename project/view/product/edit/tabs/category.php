<?php $categories = $this->getCategory(); ?>

<table class="table table-bordered table-striped">
    <thead>
    <tr>
        <th>Select</th>
        <th>Category Id</th>
        <th>Category Name</th>
        <!-- <th>Category</th> -->
    </tr>
    </thead>
    <tbody>
    <?php if(!$categories): ?>
    <tr>
        <td colspan="8">No Record Found</td>
    </tr>
    <?php else: ?>
        <?php foreach($categories as $category): ?>
    <?php $tag = ($this->selected($category->id) == 'checked') ? 'exists' : 'new'; ?>
    <tr>
        <td> <input type="checkbox" name="category[<?php echo $tag ?>][]" value="<?php echo $category->id ?>" <?php echo $this->selected($category->id); ?>> </td>
        <td><?php echo $category->id; ?></td>
        <td><?php echo $category->c_name; ?></td>
        <td><?php //echo $category->getPath(); ?></td>
    </tr>
    <?php endforeach; ?>
    <?php endif; ?>
    <tr>
        <td colspan="3">
            <input type="button" id="categorySubmit" class="btn btn-primary" name="submit" id="submit" value="save">
            <button type="button" id="categoryCancel" class="btn btn-danger">Cancel</button>
        </td>
    </tr>
    </tbody>
</table>

<script type="text/javascript">
jQuery("#categorySubmit").click(function(){
    admin.setForm(jQuery("#indexForm"));
    admin.setUrl("<?php echo $this->getEdit()->getSaveUrl();?>");
    admin.load();
});

jQuery("#categoryCancel").click(function(){
	admin.setUrl("<?php echo $this->getUrl('gridBlock','product',['id' => null]); ?>");
	admin.load();
});
</script>

