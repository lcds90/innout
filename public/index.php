<?php 

require_once(dirname(__FILE__, 2) . '/src/config/config.php');
require_once(dirname(__FILE__, 2) . '/src/models/User.php');

//echo User::getSelect(['id' => 1], 'name, email');
//echo User::getSelect(['name' => 'Chaves', 'email' => 'chaves@cod3r.com.br']);

print_r(User::get(['id' => 2], 'name, email'));
echo '<hr>';
print_r(User::get());
echo '<hr>';
print_r(User::get([], 'name'));
echo '<hr>';

foreach(User::get([], 'name') as $user){
    echo $user->name;
    echo '<br>';
}