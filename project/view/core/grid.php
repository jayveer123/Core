<?php
    $collections = $this->getCollection();
    $columns = $this->getColumns();
    $actions =  $this->getActions();
    $pager = $this->getPager();



    
?>
<button><a href="<?php echo $this->getUrl('add') ?>">Add New</a></button>
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
            <td><?php echo $this->getColumnData($column['key'],$collection); ?></td>
        <?php endforeach; ?>
        <?php foreach ($actions as $action) : ?>
        <?php if($action['title'] == 'delete'): ?>
            <?php $key = $columns['id']['key']; ?>
            <td><button type="button" class="delete" value="<?php echo $collection->$key; ?>"><?php echo $action['title']; ?></button></td>
        <?php else: ?>
            <?php $method = $action['method']; ?>
            <td><a href="<?php echo $collection->$method(); ?>"><button><?php echo $action['title'] ?></button></a></td>
        <?php endif; ?>
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

