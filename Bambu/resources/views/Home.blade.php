<!DOCTYPE html>
<html lang="en">
  <head>

    <meta charset="utf-8">
    <title>Go Fish - Idle items online renting app</title>
    <meta name="description" content="Bambu, your idle items renting app."/>
    <meta name="viewport" content="width=100%,, initial-scale=1.0, maximum-scale=1.0">

    <!-- Loading Bootstrap -->
    <link href="../../Flat-UI-master/dist/css/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Loading Flat UI -->
    <link href="../../Flat-UI-master/dist/dist/css/flat-ui.css" rel="stylesheet">
    <link href="../../Flat-UI-master/dist/docs/assets/css/demo.css" rel="stylesheet">

    <link rel="shortcut icon" href="../../Flat-UI-master/img/favicon.ico">
  </head>
  <body>
    <script src="../../Flat-UI-master/dist/js/vendor/jquery.min.js"></script>` 
    <script type="text/javascript">
      $(window).on("redir ect", redirect);
      function redirect(e) {
        var width = $(window).width();
        if (width > 768) {
          window.location.href = "../../Flat-UI-master/index_pc.html"
        }
        else{
          window.location.href = "../../Flat-UI-master/index.html"
        }
      }
      $(document).ready(redirect());
    </script>
  </body>
</html>
