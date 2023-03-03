<?php
require_once __DIR__.'/router.php';
require_once "routes/auth.php";
require_once "routes/crud.php";

get('/', 'index.html');

get('/api/cards/$user', $getCards);
post('/api/post', $newCard);
delete('/api/deleteCard', $deleteCard);

post('/api/login', $login);
post('/api/signUp', $signUp);
post('/api/logout', $logout);
post('/api/checkUser', $checkUser);

any('/404', 'routes/404');

?>