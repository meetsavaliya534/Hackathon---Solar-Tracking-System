<!DOCTYPE html>
<html>
<head>

    <title>
            <?php if($_SESSION['login_user_type'] == 1 || $_SESSION['login_user_type'] == 2)
                     echo "Hello $name";
                  else
                     echo "Dashboard";
            ?>
            || Sunray Solar systems
        </title>



    <link rel="icon" href="img/favicon.png" type="image/x-icon" />
    <link rel="stylesheet" type="text/css" href="css/meter.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
    <link href="https://fonts.googleapis.com/css?family=Cookie" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet"/>
    <link href="css/home-app.css" rel="stylesheet" /> 

    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous" >
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script>
    //to set svg dimensions throughout the app
    var univSvgWidth;
    var univSvgHeight;
    </script>


    <script src="js/java.min.js"></script>
    <script src="js/content.js"></script>
    <link href="css/style.css" rel="stylesheet"/>
    <script src="js/control.js"></script>
    <script src="https://kit.fontawesome.com/43d2e8cd0a.js" crossorigin="anonymous"></script>

</head>
</html>
