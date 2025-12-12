<?php 
// fct pour éviter la reecriture de empty(...)
function input_valid($value) {
    return !empty(trim($value));
}

?>