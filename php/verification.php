<?php
function valid ($info): string
{
    $info = trim($info);
    $info = stripcslashes($info);
    return htmlspecialchars($info);

}
?>