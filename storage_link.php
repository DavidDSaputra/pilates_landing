<?php
// Script to create storage symlink on cPanel
// Upload this to: public_html/pilates/storage_link.php
// Run by visiting: https://joulwinn.com/pilates/storage_link.php

$target = '/home/solisinv/pilates_core/storage/app/public';
$shortcut = '/home/solisinv/public_html/pilates/storage';

echo "<h1>Storage Link Creator</h1>";
echo "Trying to link:<br>";
echo "<b>Origin:</b> $target<br>";
echo "<b>Destination:</b> $shortcut<br><br>";

if (!file_exists($target)) {
    echo "<span style='color:red'>ERROR: Target folder does not exist!</span><br>";
    echo "Please check if 'pilates_core' is really in /home/solisinv/<br>";
    exit;
}

if (file_exists($shortcut)) {
    echo "<span style='color:orange'>WARNING: Destination already exists.</span><br>";
    if (is_link($shortcut)) {
        echo "It is already a symlink. Deleting and re-creating...<br>";
        unlink($shortcut);
    } elseif (is_dir($shortcut)) {
        echo "<span style='color:red'>ERROR: Destination is a REAL FOLDER, not a symlink.</span><br>";
        echo "Please delete the 'storage' folder in public_html/pilates manually using cPanel File Manager, then refresh this page.";
        exit;
    }
}

if (symlink($target, $shortcut)) {
    echo "<span style='color:green'>SUCCESS: Symlink created!</span><br>";
    echo "Images should work now.";
} else {
    echo "<span style='color:red'>FAILED to create symlink.</span><br>";
    echo "Check permissions or contact hosting support.";
}
?>