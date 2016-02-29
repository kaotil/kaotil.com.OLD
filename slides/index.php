<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="勉強会用スライド">
    <meta content="勉強会, スライド" name="keywords">
    <meta property="og:type" content="article"/>
    <meta property="og:title" content="Slides | kaotil.com"/>
    <meta property="og:description" content="勉強会用スライド" />
    <meta property="og:image" content="http://kaotil.com/img/kaotil.com.png" />
    <meta property="og:url" content="http://kaotil.com/slides/" />
    <meta property="og:site_name" content="kaotil.com"/>
    <meta content="summary" name="twitter:card" />
    <meta content="@kaotil" name="twitter:site" />
    <link rel="icon" href="/img/favicon.ico">
    <title>Slides | kaotil.com</title>

    <!-- Bootstrap core CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="../css/blog.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>


  <body>

    <div class="blog-masthead">
      <div class="container">
        <nav class="blog-nav">
          <a class="blog-nav-item" href="/">Home</a>
          <a class="blog-nav-item active" href="/slides">Slides</a>
          <a class="blog-nav-item" href="/mycat">Mycat</a>
          <a class="blog-nav-item" href="/contact">Contact</a>
        </nav>
      </div>
    </div>

    <div class="container">

        <div class="blog-header">
            <h1 class="blog-title">Slides list</h1>
            <p class="lead blog-description">勉強会用スライド</p>
        </div>

<?php
$file = file_get_contents('./list.json', FILE_USE_INCLUDE_PATH);
$list = json_decode($file, true);
?>

<table class="table table-hover">
<?php foreach ($list as $key => $val): ?>
  <tr>
  <td><?php echo $val['id'] ?></td>
  <td><a href='<?php echo $val['id'] ?>'><?php echo $val['title'] ?></a></td>
  </tr>
<?php endforeach ?>
</table>

    </div><!-- /.container -->

    <footer class="blog-footer">
      <p>© 2016 kaotil, Inc.</p>
      <p>
        <a href="#">Back to top</a>
      </p>
    </footer>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0-beta1/jquery.min.js"><\/script>')</script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-74440319-1', 'auto');
        ga('send', 'pageview');
    </script>
  </body>
</html>

