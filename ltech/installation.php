<?php
require 'vendor/autoload.php';
$client = new MongoDB\Client;
$ltech_db = $client->ltech_db;
$ltech_db->dropCollection('cities');
$ltech_db->createCollection('cities');