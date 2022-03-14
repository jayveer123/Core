<?php 

$medias = $this->getMedias(); 

?>

<h3 align="center">* Product Media Grid *</h3>

    <form action="<?php echo $this->getUrl('product_media','edit') ?>" method="POST" align=center>
        <input type="submit" value="update">
        <button><a href="<?php echo $this->getUrl('product','grid',[],true); ?>">Cancel</a></button>
        <table border=3 align=center width=100% cellspacing=4>
            <tr>
                <th>Image Id</th>
                <th>Product Id</th>
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
                <td><?php echo $media->productId ?></td>
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
            <tr>
                <td>
                    <script type="text/javascript">
                    function pprFunction()
                    {
                        const pprValue = document.getElementById('ppr').selectedOptions[0].value;
                        let url = window.location.href;
                        
                        if(!url.includes('ppr'))
                        {
                            url+='&ppr=20';
                        }
                        const urlArray = url.split("&");

                        for (i = 0; i < urlArray.length; i++)
                        {
                            if(urlArray[i].includes('p='))
                            {
                                urlArray[i] = 'p=1';
                            }
                            if(urlArray[i].includes('ppr='))
                            {
                                urlArray[i] = 'ppr=' + pprValue;
                            }
                        }
                        const finalUrl = urlArray.join("&");  
                        location.replace(finalUrl);
                    }
                </script>

                <select id="ppr" onchange="pprFunction()">
                    <option selected>select</option>
                        <?php foreach ($this->pager->perPageCountOption as $pageCount):?>
                    <option value="<?php echo $pageCount?>"><?php echo $pageCount?></option>
                        <?php endforeach; ?>
                </select>
                <button>
                    <a href="<?php echo ($this->pager->getStart()==NULL) ? '#' : $this->getUrl(null,null,['p' => $this->getPager()->getStart()]) ?>">
                        Start
                    </a>
                </button>

                <button>
                    <a href="<?php echo ($this->pager->getPrev()==NULL) ? '#' : $this->getUrl(null,null,['p' => $this->getPager()->getPrev()]) ?>">
                        Prev
                    </a>
                </button>

                <button>
                    <a href="<?php echo $this->getUrl(null,null,['p' => $this->pager->getCurrent()]) ?>">Current</a>
                </button>

                <button>
                    <a href="<?php echo ($this->pager->getNext()==NULL) ? '#' : $this->getUrl(null,null,['p' => $this->getPager()->getNext()]) ?>">
                        Next
                    </a>
                </button>
                <button>
                    <a href="<?php echo ($this->pager->getEnd()==NULL) ? '#' : $this->getUrl(null,null,['p' => $this->getPager()->getEnd()]) ?>">
                        End
                    </a>
                </button>
                </td>
            </tr>
        </table>
    </form>

    <form action="<?php echo $this->getUrl('product_media','save') ?>" method="POST" enctype="multipart/form-data">
        <input type="file" name="imageName">
        <input type="submit" value="upload">
    </form>
