<?php
function connexion()
{
    return new PDO('mysql:dbname=artbox;host=localhost', 'root', '');
}