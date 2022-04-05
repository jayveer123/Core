<?php
    $collections = $this->getCollection();
    $columns = $this->getColumns();
    $actions =  $this->getActions();
    $pager = $this->getPager();    
?>

    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>DataTables</h1>
              
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">DataTables</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">DataTable</h3>
              </div>
              
              <!-- /.card-header -->
              <div class="card-body">
                
                <table>
                    <tr>
                        <td>
                          <button type="button" id="addNew" class="btn btn-block btn-success">Add New</button>
                        </td>
                    </tr>
                    <div class="card-tools">
                          <ul class="pagination pagination-sm float-right">
                            <li class="page-item">
                                <select id="ppr">
                                    <option selected>select</option>
                                    <?php foreach($pager->getPerPageCountOption() as $perPageCount) :?>  
                                    <option value="<?php echo $perPageCount ?>" ><?php echo $perPageCount ?></a></option>
                                    <?php endforeach;?>
                                </select>
                            </li>
                            <li class="page-item">
                                <button type="button" class="btn-primary pagerBtn" style="<?php echo ($pager->getStart()==NULL)? "pointer-events: none" : "" ?>" value="<?php echo $this->getUrl('gridBlock',null,['p' => $pager->getStart()]) ?>">Start
                                </button>
                            </li>
                            <li class="page-item">
                                <button type="button" class="btn-primary pagerBtn" style="<?php echo ($pager->getPrev()==NULL)? "pointer-events: none" : "" ?>" value="<?php echo $this->getUrl('gridBlock',null,['p' => $pager->getPrev()]) ?>">Prev
                                </button>
                            </li>
                            <li class="page-item">
                                <?php echo $pager->getCurrent();?>
                            </li>
                            <li class="page-item">
                                <button type="button" class="btn-primary pagerBtn" style="<?php echo ($pager->getNext()==NULL)? "pointer-events: none" : "" ?>" value="<?php echo $this->getUrl('gridBlock',null,['p' => $pager->getNext()]) ?>">Next
                                </button>
                            </li>
                            <li class="page-item">
                                <button type="button" class="btn-primary pagerBtn" style="<?php echo ($pager->getEnd()==NULL)? "pointer-events: none" : "" ?>" value="<?php echo $this->getUrl('gridBlock',null,['p' => $pager->getEnd()]) ?>">End
                                </button>
                            </li>
                          </ul>
                        </div>
                </table>
                <br>

                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                        <?php foreach ($columns as $key => $column) :?>
                            <th><?php echo $column['title'] ?></th>
                        <?php endforeach; ?>
                        <?php foreach ($actions as $key => $action) :?>
                            <th><?php echo $key ?></th>
                        <?php endforeach; ?>
                    </tr>
                  </thead>
                  <tbody>
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
                            <td>
                                <?php if($action['title']=='delete'):?>
                                <button type="button" id="addNew" class="btn btn-block btn-danger <?php echo $action['title'] ?>" value="<?php echo $collection->$key; ?>">
                                    <i class="fa fa-trash"></i>
                                </button>
                                <?php endif;?>

                                <?php if($action['title']=='edit'):?>
                                <button type="button" id="addNew" class="btn btn-block btn-success <?php echo $action['title'] ?>" value="<?php echo $collection->$key; ?>">
                                    <i class="fa fa-pencil"></i>
                                </button>
                                <?php endif;?>

                                <?php if($action['title']=='price'):?>
                                <button type="button" id="addNew" class="btn btn-block btn-primary <?php echo $action['title'] ?>" value="<?php echo $collection->$key; ?>">
                                    <i class="fa fa-dollar"></i>
                                    
                                </button>
                                <?php endif;?>

                                <?php if($action['title']=='Manage'):?>
                                <button type="button" id="addNew" class="btn btn-block btn-primary <?php echo $action['title'] ?>" value="<?php echo $collection->$key; ?>">
                                    <i class="fa fa-manage"></i>
                                    
                                </button>
                                <?php endif;?>

                            </td>
                        <?php endforeach; ?>
                    </tr>
                    <?php endforeach; ?>
                    <?php } ?>
                  </tbody>
                  <tfoot>
                  <tr>
                        <?php foreach ($columns as $key => $column) :?>
                            <th><?php echo $column['title'] ?></th>
                        <?php endforeach; ?>
                        <?php foreach ($actions as $key => $action) :?>
                            <th><?php echo $key ?></th>
                        <?php endforeach; ?>
                    </tr>
                  </tfoot>
                </table>
            </div>
            
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
  

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
    $(".Manage").click(function(){
        var data = $(this).val();
        admin.setData({'id' : data});
        admin.setUrl("<?php echo $this->getUrl('gridBlock','salesmen_SalesmenCustomer'); ?>");
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