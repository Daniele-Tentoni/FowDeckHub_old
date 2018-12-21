<?php
/*This Source Code Form is subject to the terms of the Mozilla Public
  License, v. 2.0. If a copy of the MPL was not distributed with this
  file, You can obtain one at http://mozilla.org/MPL/2.0/.*/
$TGBot->settings(['disable_web_page_preview' => false,
'parse_mode'                                 => 'HTML', //can be markdown
'PostgreSQL'                                 => false,
'MySQL'                                      => true,
'adminMySQL'                                 => true, //Use MySQL for global post etc
'adminPostGreSQL'                            => false, //Use PostGreSQL for global post etc
'table_name'                                 => 'EasyTGBot',
'admins'                                     => [
    138856314,
],
]);
// $TGBot->PostgreDBCredentials('localhost', 'USERNAME', 'PASSWORD', 'DATABASE');
$TGBot->MySQLDBCredentials('localhost', 'root', '', 'my_fowdeckhub');
