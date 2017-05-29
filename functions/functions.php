<?php

// sanitizer functions
function escape($string) {
    return htmlentities($string, ENT_QUOTES, 'UTF-8');
}