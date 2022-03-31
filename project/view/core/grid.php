<?php
    $collections = $this->getCollection();
    $columns = $this->getColumns();
    $actions =  $this->getActions();
    $pager = $this->getPager();    
?>
<button type="button" id="addNew">Add</button>
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
            <select id="ppr">
                <option selected>select</option>
                <?php foreach($pager->getPerPageCountOption() as $perPageCount) :?>  
                <option value="<?php echo $perPageCount ?>" ><?php echo $perPageCount ?></a></option>
                <?php endforeach;?>
            </select>
        </tr>


        <tr>
            <button type="button" class="pagerBtn" style="<?php echo ($pager->getStart()==NULL)? "pointer-events: none" : "" ?>" value="<?php echo $this->getUrl('gridBlock',null,['p' => $pager->getStart()]) ?>">Start
            </button>
        </tr>

        <tr>
            <button type="button" class="pagerBtn" style="<?php echo ($pager->getPrev()==NULL)? "pointer-events: none" : "" ?>" value="<?php echo $this->getUrl('gridBlock',null,['p' => $pager->getPrev()]) ?>">Prev
            </button>
            
        <tr>
            <?php echo $pager->getCurrent();?>
        </tr>

        <tr>
            <button type="button" class="pagerBtn" style="<?php echo ($pager->getNext()==NULL)? "pointer-events: none" : "" ?>" value="<?php echo $this->getUrl('gridBlock',null,['p' => $pager->getNext()]) ?>">Next
            </button>
        </tr>
        
        <tr>
            <button type="button" class="pagerBtn" style="<?php echo ($pager->getEnd()==NULL)? "pointer-events: none" : "" ?>" value="<?php echo $this->getUrl('gridBlock',null,['p' => $pager->getEnd()]) ?>">End
            </button>
        </tr>

    </table>

<script type="text/javascript">
    $("#addNew").click(function(){
        admin.setData({'id' : null});
        admin.setUrl("<?php echo $this->getUrl('addBlock'); ?>");
        admin.load();
    });

    $(".delete").click(function(){
        var data = $(this).val();
        admin.setData({'id' : data});
        admin.setType('GET');
        admin.setUrl("<?php echo $this->getUrl('delete'); ?>");
        admin.load();
    });

    $(".edit").click(function(){
        var data = $(this).val();
        admin.setData({'id' : data});
        admin.setUrl("<?php echo $this->getUrl('editBlock'); ?>");
        admin.setType('GET');
        admin.load();
    });

    $(".price").click(function(){
        var data = $(this).val();
        admin.setData({'id' : data});
        admin.setUrl("<?php echo $this->getUrl('gridBlock','customer_price'); ?>");
        admin.setType('GET');
        admin.load();
    });

    $("#ppr").click(function(){
        var data = $(this).val();
        admin.setUrl("<?php echo $this->getUrl('gridBlock',null,['p'=>1,'ppr'=>null]); ?>&ppr="+data);
        admin.setType('GET');
        admin.load();
    });
    $(".pagerBtn").click(function(){
        var data = $(this).val();
        admin.setUrl(data);
        admin.setType('GET');
        admin.load();
    });

</script>

