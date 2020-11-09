<?php
/**
 * Created by PhpStorm.
 * User: monir
 * Date: 6/15/2019
 * Time: 2:40 AM
 */
session_start();

unset($_SESSION['session_id']);
unset($_SESSION['session_type']);
unset($_SESSION['last_used_invoice']);

mi_redirect(MI_BASE_URL.'login.php');