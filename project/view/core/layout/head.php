<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $this->getTitle(); ?></title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- For Paging Scrip -->
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
    <!-- Paging Script Over -->

    <script type="text/javascript">
    
    admin = {
        type : 'POST',
        url : 'index.php',
        data : {},
        datatyper : 'json',
        form : null,
        
        setUrl : function(url) {
            this.url = url;
            return this;
        },
        getUrl : function() {
            return this.url;
        },
        setData : function(data) {
            this.data = data;
            return this;
        },
        getData : function() {
            return this.data;
        },
        setType : function(type) {
            this.type = type;
            return this;
        },
        getType : function() {
            return this.type;
        },
        setForm : function(form) {
            this.form = form;
            this.prepareFormParam();
            return this;
        },
        getForm : function() {
            return this.form;
        },
        prepareFormParam : function(){
            this.setUrl(this.getForm().attr('action'));
            this.setType(this.getForm().attr('method'));
            this.setData(this.getForm().serializeArray());
            return this;
        },
        setDataType : function(dataType) {
            this.dataType = dataType;
            return this;
        },
        getDataType : function() {
            return this.dataType;
        },
        validate : function(){
            var canSubmit = true;
            // if(!jQuery("#name").val())
            // {
            //     alert('Plz enter name.');
            //     canSubmit = false;
            // }
            // if(!jQuery("#email").val())
            // {
            //     alert('Plz enter email.');
            //     canSubmit = false;
            // }
            // if(!jQuery("#mobile").val())
            // {
            //     alert('Plz enter mobile.');
            //     canSubmit = false;
            // }
            if(canSubmit == true)
            {
                this.callSaveAjax();
                //this.load();
            }
            return false;
        },
        callSaveAjax : function(){
            $.ajax({
                url: "<?php echo $this->getUrl('save') ?>",
                type: "POST",
                data: this.getData(),
                success: function(data){
                    $("#done").html(data);
                }
            });
        },
        callDeleteAjax : function(){
            $.ajax({
                url: "<?php echo $this->getUrl('delete') ?>",
                type: "GET",
                data: this.getData(),
                success: function(data){
                    $("#done").html(data);
                }
            });
        },
        load : function(){
            $.ajax({
                url: this.getUrl(),
                type: this.getType(),
                data: this.getData(),
                success: function(data){
                    jQuery("#content").html(data);
                    this.setData({});
                }             
            });
        }
    };
   
    </script>

    
    
</head>