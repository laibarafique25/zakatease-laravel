<?php
$files = glob('resources/views/pages/*.blade.php');
foreach ($files as $file) {
    $content = file_get_contents($file);
    $content = str_replace('background:linear-gradient(to right, var(--emerald-dark), var(--emerald)); color:white;', 'color:var(--dark);', $content);
    file_put_contents($file, $content);
}
echo "Done.";
