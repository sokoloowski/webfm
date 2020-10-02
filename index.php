<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="theme-color" content="#232627" />
    <title>File lister</title>

    <link rel="shortcut icon" href="<?php echo str_replace($_GET['path'], '', $_SERVER['REQUEST_URI']) ?>favicon.png" type="image/png" />
    <link rel="icon" href="<?php echo str_replace($_GET['path'], '', $_SERVER['REQUEST_URI']) ?>favicon.png" />
    <link rel="apple-touch-icon" href="<?php echo str_replace($_GET['path'], '', $_SERVER['REQUEST_URI']) ?>favicon.png" />
    <link rel="apple-touch-startup-image" href="<?php echo str_replace($_GET['path'], '', $_SERVER['REQUEST_URI']) ?>favicon.png" />

    <link rel="stylesheet" href="<?php echo str_replace($_GET['path'], '', $_SERVER['REQUEST_URI']) ?>webfm-style.css" />
</head>

<body>
    <nav>
        <a href="/"><?php echo shell_exec('hostname'); ?> (<?php echo $_SERVER['SERVER_ADDR']; ?>)</a>
    </nav>
    <main>
        <article>
            <?php

            #region config
            $forbidden = [
                __DIR__ . '/index.php',
                __DIR__ . '/code.php',
                __DIR__ . '/.htaccess',
                __DIR__ . '/webfm-style.css',
                __DIR__ . '/favicon.png',
            ];
            #endregion

            $path = $_GET['path'];
            $fullpath = __DIR__ . '/' . $path;
            $files = scandir($fullpath);
            echo '<p>' . $fullpath . '</p>';
            if ($path) {
                // if $path is not empty, show "..", else you're in main dir
                echo '<p class="ls dir"><a href="..">[Otwórz]</a>..</p>';
            }

            // List directories first
            foreach ($files as $file) {
                if (is_dir($fullpath . $file) && $file != '.' && $file != '..')
                    echo '<p class="ls dir">
    <a href="' . $file . '/">[Otwórz]</a>
    ' . $file . '
</p>';
            }

            // Then, list all other files
            foreach ($files as $file) {
                if (!is_dir($fullpath . $file) && $file != '.' && $file != '..' && !in_array($fullpath . $file, $forbidden)) {
                    echo '<p class="ls file">
    <a href="' . $file . '">[Otwórz]</a>';
                    if (
                        strpos(
                            mime_content_type($fullpath . $file),
                            'text'
                        ) !== false ||
                        strpos(
                            mime_content_type($fullpath . $file),
                            'json'
                        ) !== false
                    ) {
                        // Show button to preview code if file is text or json
                        echo ' <a href="/code.php?path=' . $path . $file . '">[Kod]</a>';
                    } else {
                        echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                    }
                    echo " $file</p>";
                }
            }
            ?>
        </article>
    </main>
    <footer>
        <?php
        echo date('Y');
        ?>&nbsp;|&nbsp;<a href="https://sokoloowski.pl" target="_blank">Sokol👀wski</a>&nbsp;|&nbsp;Powered by <a href="https://github.com/sokoloowski/webfm" target="_blank">🌐 WebFM</a>&nbsp;|&nbsp;<a href="#">Do góry ^</a>
    </footer>
</body>

</html>