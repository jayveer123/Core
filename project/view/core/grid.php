<?php
    $collections = $this->getCollection();
    $columns = $this->getColumns();
    $actions =  $this->getActions();
    $pager = $this->getPager();    
?>
<button id="addNew">Add</button>
<table border = "1" width="100%">
    <tr>
        <?php foreach ($columns as $key => $column) :?>
            <th><?php echo $column['title'] ?></th>
        <?php endforeach; ?>
        <?php foreach ($actions as $key => $action) :?>
            <th><?php echo $key ?></th>
        <?php endforeach; ?>
    </tr>

    <?php if(!$collections){ ?>
        <tr>
            <td>No Record Found</td>
        </tr>
    <?php }else{ ?>
    
    <?php foreach ($collections as $collection) :?>
    <tr>
        <?php foreach ($columns as $key => $column):?>
            <td><?php echo $this->getColumnData($column,$collection); ?></td>
        <?php endforeach; ?>
       <?php foreach ($actions as $action) : ?>
            <?php $key = $columns['id']['key']; ?>
            <td><button type="button" class="<?php echo $action['title'] ?>" value="<?php echo $collection->$key; ?>"><?php echo $action['title']; ?></button></td>
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


        <tr>
            <button><a style="<?php echo ($pager->getStart()==NULL)? "pointer-events: none" : "" ?>" href="<?php echo $this->getUrl(null,null,['p' => $pager->getStart()]) ?>">Start</a>
            </button>
        </tr>

        <tr>
            <button><a style="<?php echo ($pager->getPrev()==NULL)? "pointer-events: none" : "" ?>" href="<?php echo $this->getUrl(null,null,['p' => $pager->getPrev()]) ?>">Prev</a>
            </button>
            
        <tr>
            <?php echo $pager->getCurrent();?>
        </tr>

        <tr>
            <button><a style="<?php echo ($pager->getNext()==NULL)? "pointer-events: none" : "" ?>" href="<?php echo $this->getUrl(null,null,['p' => $pager->getNext()]) ?>">Next</a>
            </button>
        </tr>
        
        <tr>
            <button><a style="<?php echo ($pager->getEnd()==NULL)? "pointer-events: none" : "" ?>" href="<?php echo $this->getUrl(null,null,['p' => $pager->getEnd()]) ?>">End</a>
            </button>
        </tr>

    </table>

    <script type="text/javascript"> 
    
        $("#addNew").click(function(){
            var url = "<?php echo $this->getUrl('add'); ?>";
            admin.setUrl(url);
            admin.setType('POST');
            admin.setData($(this).val());
            admin.load();
        });

        $(".delete").click(function(){
            var data = $(this).val();
            admin.setData({'id' : data});
            admin.setUrl("<?php echo $this->getUrl('delete'); ?>");
            admin.callDeleteAjax();
            admin.setUrl("<?php echo $this->getUrl('gridContent'); ?>");
            admin.setData({});
            admin.load();
        });

        $(".edit").click(function(){
            var data = $(this).val();
            admin.setData({'id' : data});
            admin.setUrl("<?php echo $this->getUrl('edit'); ?>");
            admin.setType('GET');
            admin.load();
        });

        /*$(".price").click(function(){
            var data = $(this).val();
            admin.setData({'id' : data});
            admin.setUrl("<?php //echo $this->getUrl('gridContent','customer_price'); ?>");
            admin.setType('GET');
            admin.load();
        });*/

    </script>

