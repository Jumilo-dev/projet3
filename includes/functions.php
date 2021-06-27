<?php
function verify_html($value){
    return htmlspecialchars(strip_tags($value));
}
?>