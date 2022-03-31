<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $this->getTitle(); ?></title>

    <script src="skin/admin/jquery-3.6.0.min.js"></script>
    <script src="skin/admin/admin.js"></script>
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
</head>