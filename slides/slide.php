<?php
$id = $_GET['id'];
$md_file = sprintf('md/%04d.md', $id);

if (!file_exists($md_file)) {
    header("Location: ./index.html");
    exit;
}

$file = file_get_contents('./list.json', FILE_USE_INCLUDE_PATH);
$list = json_decode($file, true);
$key = array_search($id , array_column($list, 'id'));

$title = $list[$key]['title'];
$description = $list[$key]['description'];

?>

<!doctype html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <title><?php echo $title ?> | kaotil.com</title>
        <meta name="description" content="<?php echo $description ?>">
        <meta property="og:type" content="website"/>
        <meta property="og:title" content="<?php echo $title ?> | kaotil.com"/>
        <meta property="og:description" content="<?php echo $description ?>" />
        <meta property="og:image" content="http://kaotil.com/img/kaotil.com.png" />
        <meta property="og:url" content="http://kaotil.com/slides/<?php echo $id; ?>" />
        <meta property="og:site_name" content="kaotil.com"/>
        <meta content="summary" name="twitter:card" />
        <meta content="@kaotil" name="twitter:site" />

        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">

        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, minimal-ui">

        <link rel="stylesheet" href="reveal.js/css/reveal.css">
        <link rel="stylesheet" href="reveal.js/css/theme/black.css" id="theme">

        <!-- Code syntax highlighting -->
        <link rel="stylesheet" href="reveal.js/lib/css/zenburn.css">

        <script src="./scripts/common.js"></script>

        <!-- Printing and PDF exports -->
        <script>
            var link = document.createElement( 'link' );
            link.rel = 'stylesheet';
            link.type = 'text/css';
            link.href = window.location.search.match( /print-pdf/gi ) ? 'reveal.js/css/print/pdf.css' : 'reveal.js/css/print/paper.css';
            document.getElementsByTagName( 'head' )[0].appendChild( link );
        </script>

        <!--[if lt IE 9]>
        <script src="reveal.js/lib/js/html5shiv.js"></script>
        <![endif]-->

       <script>
          (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
          (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
          m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
          })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

          ga('create', 'UA-74440319-1', 'auto');
          ga('send', 'pageview');
       </script>

       <style>
          /* 引用部分だけを左寄せにする */
          .reveal .slides blockquote {
            text-align: left;
          }

          /* 表題を大文字にしない */
          .reveal h1,
          .reveal h2,
          .reveal h3,
          .reveal h4,
          .reveal h5,
          .reveal h6 {
            text-transform: none;
          }
        </style>
        <link rel="stylesheet" href="/slides/css/custom.css">
    </head>

    <body>

        <div class="reveal">

            <!-- Any section element inside of this container is displayed as a slide -->
            <div class="slides">
                <!-- マークダウン外部ファイル -->
                <section data-markdown="<?php echo $md_file; ?>"  
                     data-separator="^\n\n\n"  
                     data-separator-vertical="^\n\n"  
                     data-separator-notes="^Note:"  
                     data-charset="UTF-8">
                </section>
            </div>
        </div>

        <script src="reveal.js/lib/js/head.min.js"></script>
        <script src="reveal.js/js/reveal.js"></script>

        <script>

            // Full list of configuration options available at:
            // https://github.com/hakimel/reveal.js#configuration
            Reveal.initialize({
                controls: true,
                progress: true,
                history: true,
                center: true,
                width: 1000,
                slideNumber: 'c/t',

                transition: 'slide', // none/fade/slide/convex/concave/zoom

                // Optional reveal.js plugins
                dependencies: [
                    { src: 'reveal.js/lib/js/classList.js', condition: function() { return !document.body.classList; } },
                    { src: 'reveal.js/plugin/markdown/marked.js', condition: function() { return !!document.querySelector( '[data-markdown]' ); } },
                    { src: 'reveal.js/plugin/markdown/markdown.js', condition: function() { return !!document.querySelector( '[data-markdown]' ); } },
                    { src: 'reveal.js/plugin/highlight/highlight.js', async: true, callback: function() { hljs.initHighlightingOnLoad(); } },
                    { src: 'reveal.js/plugin/zoom-js/zoom.js', async: true },
                    { src: 'reveal.js/plugin/notes/notes.js', async: true }
                ]
            });

        </script>

    </body>
</html>

<script type="text/javascript">
<!--
  var env = 'stg';
  if (document.domain == 'kaotil.com') {
    env = 'prd';
  }
  var res = location.href.match(/^.*\D+\/slides\/(\d+)\D+$/);
  var num = Number(res[1]);
console.log('------------------');
//console.log(location.href);
//console.log(location.href.match(/^.*\D+\/slides\/(\d+)\D+$/));
console.log(num);

  var data = { 
    operation: 'query', 
    payload: { 
      TableName: 'slide_list',
      KeyConditionExpression: 'env = :env AND num = :num',
      ExpressionAttributeValues: {
        ':env': env,
        ':num': num
      },
      ScanIndexForward: 'false'
    }
  };

  requestAjax("https://api.kaotil.com/v1/slide", data, function(response){
    res = JSON.parse(response);
console.log(res);
  });
// -->
</script>



