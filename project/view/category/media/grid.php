<?php 


$medias = $this->getMedias();


?>

<h3 align="center">* Proceess Record With Category Media*</h3>
    <form action="<?php echo $this->getUrl('category_media','edit') ?>" method="POST" align=center>
        <input type="submit" value="update">
        <button><a href="<?php echo $this->getUrl('category','grid',[],true); ?>">Cancel</a></button>
        <table border=3 align=center width=100% cellspacing=4>
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
            <?php if(!$medias): ?>
                <tr>
                    <td colspan=8>No Recored Found</td>
                </tr>
            <?php else: ?>
            <?php $i = 1; ?>
            <?php foreach ($medias as $media): ?>
            <tr>
                <td><?php echo $media->imageId ?></td>
                <td><?php echo $media->categoryId ?></td>
                <td><?php echo $media->imageName ?></td>
                
                <td>
                    <input type="radio" name="media[base]" value = "<?php echo $media->imageId ?>" <?php echo $this->selected($media->imageId,'base'); ?> >
                </td>
                <td>
                    <input type="radio" name="media[thumb]" value = "<?php echo $media->imageId ?>" <?php echo $this->selected($media->imageId,'thumb'); ?> >
                </td>
                <td>
                    <input type="radio" name="media[small]" value = "<?php echo $media->imageId ?>" <?php echo $this->selected($media->imageId,'small'); ?> >
                </td>
                <td>
                    <input type="checkbox" name="media[gallery][]" value="<?php echo $media->imageId ?>" <?php echo $media->gallery == 1 ? 'checked' : ''; ?>>
                </td>
                <td>
                    <input type="checkbox" name="media[remove][]" value="<?php echo $media->imageId ?>">
                </td>
            </tr>
            <?php $i++; endforeach; ?>
            <?php  endif; ?>
           
        </table>

    </form>

    <form action="<?php echo $this->getUrl('category_media','save') ?>" method="POST" enctype="multipart/form-data">
        <input type="file" name="imageName">
        <input type="submit" value="upload">
    </form>
