<?php
    $weather = "";
    $error = false;
    if($_GET["city"]){
        
       $url_contents =  file_get_contents('http://api.openweathermap.org/data/2.5/weather?q='.str_replace(" ","",$_GET["city"]).',uk&appid=f53bf160c6d78a9ba2f925465f1035a8');
        
       $weather_array = json_decode($url_contents,true);
     
       //print_r($weather_array);
       if($weather_array['cod'] == 200){
           $weather = "The weather in ".$_GET['city']." is currently '".$weather_array['weather'][0]['description']."'.";
    
            $temperature = intval($weather_array['main']['temp'] - 273);

            $weather .= "The temperature is ".$temperature."&deg;C . ";

            $wind_speed = $weather_array['wind']['speed'];

            $weather .= "and the Wind speed is ".$wind_speed." m/s.";
           
            $error = false;
       } 
        else{
            $error = true;
        }
       
}

    
    
?>

<!DOCTYPE html>

<html lang="en">
    
  <head>
    <title>Weather Forecast</title>
      
    <meta charset="utf-8">
      
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/css/bootstrap.min.css" integrity="sha384-y3tfxAZXuh4HwSYylfB+J125MxIs6mR5FOHamPBG064zB+AFeWH94NdvaCBm8qnd" crossorigin="anonymous">
      
    <style type="text/css">
            
        html{
            
            background: url(bg.jpg) no-repeat center center fixed;
            background-size: cover;
            
        }
        body{
            background: none;
            
        }
        .container{
            text-align: center;
            font-family: cursive;
            margin-top: 170px;
            color: deepskyblue;
            width: 450px;
        }
        input{
            margin: 10px 0px;
        }
        #weather{
            margin-top: 15px;
            
        }
      
      
    </style>
  </head>
    
  <body>
     
    <div class="container">
        <h1>Whats the Weather?</h1>  
        <form>
  <div class="form-group">
    <label for="exampleInputEmail1">Enter a city name</label>
    <input type="text" class="form-control" id="city" name="city"  placeholder="Eg. London" value="<?php 
                                                                                                   echo $_GET['city'] ; ?>">
  </div>
            
  <button type="submit" class="btn btn-primary">Submit</button>     
        </form>
        <div id="weather">
                <?php
                    if($weather){
                        echo '<div class="alert alert-success" role="alert"><strong>'.$weather.'</strong></div>' ;   
                
                    }
                    else if($error){
                        echo '<div class="alert alert-danger" role="alert"><strong>The entered city not found !</strong></div>' ;
                    }
                ?>
                    
        </div>
    </div>
      
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
      
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/js/bootstrap.min.js" integrity="sha384-vZ2WRJMwsjRMW/8U7i6PWi6AlO1L79snBrmgiDpgIWJ82z8eA5lenwvxbMV1PAh7" crossorigin="anonymous"></script>
      <script>
      
      
      </script>
      
  </body>
    
</html>