<?php
require 'ClassAutoLoad.php';
$mailCnt = [
    'name_from' => 'MyTaskApp',
    'mail_from' => 'ombati.einstein@strathmore.edu',
    'name_to' => $username,
    'mail_to' => $email,
    'subject' => 'Welcome to MyTaskApp Task App!',
    'body' => 'Hello  '.$username.', You requested an account on MyTaskApp which has been successfully created.'
];

$ObjSendMail->Send_Mail($conf, $mailCnt);