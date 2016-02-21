<?php
$file = file_get_contents('./list.json', FILE_USE_INCLUDE_PATH);
$list = json_decode($file, true);

foreach ($list as $key => $val) {
    echo "{$val['id']}: <a href='{$val['id']}'>{$val['title']}</a><br>";
}
?>

