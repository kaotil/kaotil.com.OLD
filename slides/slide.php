<?php
$id = $_GET['id'];
$md_file = sprintf('md/%s.md', $id);

if (!file_exists($md_file)) {
    header("Location: ./index.php");
    exit;
}

$file = file_get_contents('./list.json', FILE_USE_INCLUDE_PATH);
$list = json_decode($file, true);
$key = array_search($id , array_column($list, 'id'));

$title = $list[$key]['title'];

?>

<!doctype html>
<html lang="en">

    <head>
        <meta charset="utf-8">

        <title><?php echo $title ?> | kaotil.com</title>

        <meta name="description" content="勉強会用スライド">
        <meta name="author" content="kaotil">

        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">

        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, minimal-ui">

        <link rel="stylesheet" href="reveal.js/css/reveal.css">
        <link rel="stylesheet" href="reveal.js/css/theme/black.css" id="theme">

        <!-- Code syntax highlighting -->
        <link rel="stylesheet" href="reveal.js/lib/css/zenburn.css">

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
                history: false,
                center: true,
                width: 1000,

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
