<!DOCTYPE html>
<html lang="en">


<head>
    <title>RMC School No 16</title>
    <!-- META TAGS -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Education master is one of the best educational html template, it's suitable for all education websites like university,college,school,online education,tution center,distance education,computer education">
    <meta name="keyword" content="education html template, university template, college template, school template, online education template, tution center template"> -->
    <!-- FAV ICON(BROWSER TAB ICON) -->
    <link href="<?php echo getConfig('siteUrl').'/images/fav.ico'?>" rel="stylesheet" type="image/x-icon">
    <!-- GOOGLE FONT -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700%7CJosefin+Sans:600,700" rel="stylesheet">
    <!-- FONTAWESOME ICONS -->
    <link href="<?php echo getConfig('siteUrl').'/css/font-awesome.min.css'?>" rel="stylesheet" type="text/css">
    <!-- ALL CSS FILES -->
    <link href="<?php echo getConfig('siteUrl').'/css/materialize.css'?>" rel="stylesheet" type="text/css">
    <link href="<?php echo getConfig('siteUrl').'/css/bootstrap.css'?>" rel="stylesheet" type="text/css">
    <link href="<?php echo getConfig('siteUrl').'/css/style.css'?>" rel="stylesheet" type="text/css">
    <link href="<?php echo getConfig('siteUrl').'/css/style-mob.css'?>" rel="stylesheet" type="text/css">

</head>

<body>

   <section>
   <div class="ad-log-main">
    <div class="ad-log-in">
        <div class="ad-log-in-logo">
            <img src="<?php echo getConfig('siteUrl').'/images/user/school-logo.jpeg'?>" alt="Logo" class="img-fluid" style="max-height: 90px;">
        </div>
        <div class="ad-log-in-con">
            <div class="log-in-pop-right">
                <h4>Login Here</h4>
                <form class="s12" role="form" method="POST" action="<?php echo getConfig('siteUrl').'/users/login' ?>">
                    <div>
                        <div class="input-field s12" style="margin-bottom: 20px;">
                            <input type="text" data-ng-model="name" class="validate" required="" name="username" style="height: 50px; font-size: 18px; width: 300px;">
                            <label class="">User name</label>
                        </div>
                    </div>
                    <div>
                        <div class="input-field s12" style="margin-bottom: 20px;">
                            <input type="password" class="validate" required="" name="password" style="height: 50px; font-size: 18px; width: 300px;">
                            <label>Password</label>
                        </div>
                    </div>
                    <div>
                        <div class="input-field s4">
                            <button type="submit" name="submit" id="loginBtn" class="btn btn-primary block full-width m-b"><?php echo __("Login")?></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

   </section>

    <!--Import jQuery before materialize.js-->
    
    <script src="<?php echo getConfig('siteUrl').'/js/main.min.js'?>"></script>
    <script src="<?php echo getConfig('siteUrl').'/js/bootstrap.min.js'?>"></script>
    <script src="<?php echo getConfig('siteUrl').'/js/materialize.min.js'?>"></script>
    <script src="<?php echo getConfig('siteUrl').'/js/custom.js'?>"></script>
</body>

</html>