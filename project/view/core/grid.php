<?php
    $pager = $this->getCollection()->getPagerModel();
    $headers = $this->getCollection()->getHeaders();
    $columns = $this->getCollection()->getColumns();    
    $actions = $this->getCollection()->getActions();
?>
<button><a href="<?php echo $this->getUrl('add') ?>">Add New</a></button>
<table border = "1" width="100%">
    <tr>
        <?php foreach ($headers as $header) :?>
            <th><?php echo $header ?></th>
        <?php endforeach; ?>
        <?php foreach ($actions as $title => $action) :?>
            <th><?php echo $title ?></th>
        <?php endforeach; ?>
    </tr>
    <?php if(!$columns){ ?>
        <tr>
            <td>No Record Found</td>
        </tr>
    <?php }else{ ?>
    <?php foreach ($columns as $columnData) :?>
    <tr>
        <?php foreach ($columnData as $column):?>
            <td><?php echo $column ?></td>
        <?php endforeach; ?>
        <?php foreach ($actions as $action) :?>
            <td><a href="<?php echo $this->getActionUrl($action['title'],$columnData[0]); ?>"><?php echo $action['title'] ?></td>
        <?php endforeach; ?>
    </tr>
    <?php endforeach; ?>
    <?php } ?>

</table>

<table>
        <tr>
            <select onchange="ppr()" id="ppr">
                <option selected>select</option>
                <?php foreach($pager->getPerPageCountOption() as $perPageCount) :?>  
                <option value="<?php echo $perPageCount ?>" ><?php echo $perPageCount ?></a></option>
                <?php endforeach;?>
            </select>
        </tr>
        <tr><button><a style="<?php echo ($pager->getStart()==NULL)? "pointer-events: none" : "" ?>" href="<?php echo $this->getUrl(null,null,['p' => $pager->getStart()]) ?>">Start</a></button></tr>
            <tr><button><a style="<?php echo ($pager->getPrev()==NULL)? "pointer-events: none" : "" ?>" href="<?php echo $this->getUrl(null,null,['p' => $pager->getPrev()]) ?>">Prev</a></button>
            &nbsp;&nbsp;&nbsp;&nbsp;<?php echo "<b>".$pager->getCurrent()."</b>"?>&nbsp;&nbsp;&nbsp;&nbsp;</tr>
            <tr><button><a style="<?php echo ($pager->getNext()==NULL)? "pointer-events: none" : "" ?>" href="<?php echo $this->getUrl(null,null,['p' => $pager->getNext()]) ?>">Next</a></button></tr>
            <tr><button><a style="<?php echo ($pager->getEnd()==NULL)? "pointer-events: none" : "" ?>" href="<?php echo $this->getUrl(null,null,['p' => $pager->getEnd()]) ?>">End</a></button></tr>

    </table>
<script type="text/javascript"> 
            
        document.getElementById('selectaction').onclick = function() {
            var checkboxes = document.querySelectorAll('input[type="checkbox"]');
            for (var checkbox of checkboxes)
             {
                checkbox.checked = this.checked;
            }
        }

        document.getElementById('deleteact').onclick = function() {
            var checkbox =  document.getElementById('selectaction');
            if(!this.checked)
            {
                checkbox.checked = false;   
            }
            
        }
 

            function ppr() {
                const pprValue = document.getElementById('ppr').selectedOptions[0].value;
                let language = window.location.href;
                if(!language.includes('ppr'))
                {
                    language+='&ppr=20';
                }
                const myArray = language.split("&");
                for (i = 0; i < myArray.length; i++)
                {
                    if(myArray[i].includes('p='))
                    {
                        myArray[i]='p=1';
                    }
                    if(myArray[i].includes('ppr='))
                    {
                        myArray[i]='ppr='+pprValue;
                    }
                }
                const str = myArray.join("&");  
                location.replace(str);
            }
</script>
