<?php
//$type = $_GET['type'];
$path = '/' . $_GET['path'];
$type = substr($path, strrpos($path, '.') + 1) == 'txt' ? 'plaintext' : substr($path, strrpos($path, '.') + 1);
$file = file_get_contents($_SERVER['DOCUMENT_ROOT'] . $path);
if (strpos(mime_content_type($_SERVER['DOCUMENT_ROOT'] . $path), 'text') === false && strpos(mime_content_type($_SERVER['DOCUMENT_ROOT'] . $path), 'json') === false) {
    header('Location: ' . $path);
    // echo '<script>location.replace("'.$path.'")</script>
    // <a style="font-size:5em;color:currentColor;" href="'.$path.'">Pokaż plik</a>';
} else {
    echo '<html>
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="theme-color" content="#1e1e1e" />
        <meta name="keywords" content="html,css,js,php,programming,coding,code,scripting,script,linux,windows,app,application,web,developer,programmer,manjaro,unix,unixporn,it,informatyka,programowanie,kodowanie,skrypty,kod,program,aplikacja" />
        <meta property="og:image" content="https://sokoloowski.pl/favicon.png" />
        
        <title>Podgląd kodu - ' . substr($path, strrpos($path, '/') + 1) . '</title>

        <link rel="stylesheet" href="https://sokoloowski.pl/cdn/highlightjs/css/vscode-default.css">
        <link href="https://fonts.googleapis.com/css?family=Fira+Code&display=swap" rel="stylesheet">
    
        <link rel="shortcut icon" href="/favicon.png" type="image/png" />
        <link rel="icon" href="/favicon.png" />
        <link rel="apple-touch-icon" href="/favicon.png" />
        <link rel="apple-touch-startup-image" href="/favicon.png" />

        <script src="https://sokoloowski.pl/cdn/highlightjs/js/highlight.min.js"></script>
        <script>hljs.initHighlightingOnLoad();</script>
        <style>
            html,body {margin:0;padding:10px;background:#1e1e1e;color:white;}
            code {overflow:unset!important;white-space:pre-wrap;}
        </style>
    </head>
    <body>
        <pre><code class="' . $type . '">' . rtrim(preg_replace('/\t/', '    ', htmlspecialchars($file))) . '</code></pre>
    </body>
</html>';
}
