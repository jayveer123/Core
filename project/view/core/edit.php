<form id="form" action="" method="POST">
<?php
    $this->getTab()->toHtml();
    $this->getTabContent()->toHtml();
?>
</form>

<script type="text/javascript">
    $(document).on('click','#cancel',function () {
      event.preventDefault();

      $.ajax({
            type: 'GET',
            url: "<?php echo $this->getUrl('gridContent')?>",
            success: function(data) {
              $('#content').html(data);
          },
          dataType : 'html'
          });

    });
    $(document).ready(function()
    {
        $("#submit").click(function()
        {
            var data = $("#form").serializeArray();
            admin.setData(data);
            admin.validate();
            admin.setUrl("<?php echo $this->getUrl('gridContent') ?>")
            admin.load();
        });
    });
</script>
