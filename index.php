<?php
require_once __DIR__.'/router.php';

get('/', 'index.html');

get('/api/cards/$user', 'routes/cards');
post('/api/post', 'routes/post');
delete('/api/deleteCard', 'routes/delete');

post('/api/login', 'routes/login');
post('/api/signUp', 'routes/signUp');
post('/api/logout', 'routes/logout');
post('/api/checkUser', 'routes/checkUser');

any('/404', 'routes/404');

?>