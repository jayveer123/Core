<table border="1" align="center">
	<tr>
	<div class="topnav">
            <?php
            $fileList = glob('Controller/*.php');
            foreach($fileList as $filename){
                if(is_file($filename)){
                    $file = explode("/", $filename);
                    $fileList = explode(".",$file[1]); ?>
                    <td><a href="index.php?c=<?php echo strtolower($fileList[0]); ?>&a=grid"><?php echo $fileList[0]; ?></a></td>
                    <?php
                }   
            }
        ?>
        </div>
    </tr>
</table>