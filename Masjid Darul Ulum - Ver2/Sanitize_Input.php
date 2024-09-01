<?php

function sanitizeInput($input) {
    return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
}

function validateNumericInput($input) {
    return ctype_digit($input);
}


?>