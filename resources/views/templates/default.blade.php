<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Vanila</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
        <style>
        
            input[type="submit"] {
                
         ;       border:0px;
                border-radius:5px;
                background-position: 0 -335px;
                background-color: aquamarine;
/*                text-shadow: 0 -1px 0 rgba(0, 0, 0, .2);*/
                padding: 4px;
            }
               
            
            form {
                 background: #f5f5f5;
                padding: 20px;
                border-radius: 7px; 
                
                padding: 10px;
                margin: 2opx auto;
            }
        
        
        
        </style>
    </head>
    <body>
      @include('templates.partials.navigation')
       <div class="container">
        @include('templates.partials.alerts')
          
           @yield('content')
           
       </div>
       
       
    </body>
        
</html>

