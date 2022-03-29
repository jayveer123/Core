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
    customer = {
        url : 'index.php',
        form : null,
        params : {
            email : "jj@gmail.com",
        },
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
        setForm : function(form) {
            this.form = jQuery('#' + form);
            return this;
        },
        getForm : function() {
            return this.form;
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
        }
    };  
    </script>

    <script type="text/javascript">
        customer.setForm('form');
        $(document).ready(function(){
            $("#submit").click(function(){
                var data = $("#form").serializeArray();
                customer.setData(data);
                customer.validate();
            });
        });
    </script>

    <script type="text/javascript">
        
        $(document).ready(function(){
            $(".delete").click(function(){
                var data = $(this).val();
                customer.setData({'id' : data});
                customer.callDeleteAjax();
            });
        });
    </script>
    
</head>