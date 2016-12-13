<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Go Fish - Idle items online renting app</title>
    <meta name="description" content="Go Fish, a online idle items renting app."/>
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0">
  </head>
  <body>
    <script src="/Flat-UI-master/dist/js/vendor/jquery.min.js"></script>` 
    <script type="text/javascript">
      $(window).on("redirect", redirect);
      function redirect(e) {
        var width = $(window).width();
        if (width > 768) {
          window.location.href = "/Flat-UI-master/index_pc.html"
        }
        else{
          window.location.href = "/Flat-UI-master/index.html"
        }
      }
      $(document).ready(redirect());
    </script>
  </body>
</html>
