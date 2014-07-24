<?php
require __DIR__ . '/../vendor/autoload.php';

use Pinpoint\Validator\Validator;

$name = 'Pinpoint Software';
$street1 = '141 Whitewater Street';
$street2 = 'Suite B';
$city = 'Whitewater';
$state = 'WI';
$zip = '53190';
$timezone = 'America/Chicago';

$validator = new Validator();

$validator->field('name', 'Name', $name);
$validator->field('street1', 'Street 1', $street1);
$validator->field('street2', 'Street 2', $street2);
$validator->field('city', 'City', $city);
$validator->field('state', 'State', $state);
$validator->field('zip', 'Zip', $zip);
$validator->field('timezone', 'Timezone', $timezone);

$validator->sanitize('name', 'string');
$validator->sanitize('street1', 'string');
$validator->sanitize('street2', 'string');
$validator->sanitize('city', 'string');
$validator->sanitize('state', 'string');
$validator->sanitize('zip', 'numeric');
$validator->sanitize('timezone', 'string');

$validator->checkIf('name', 'is not blank')
    ->setMessage('Name is a required field');
$validator->checkIf('timezone', 'in array', \DateTimeZone::listIdentifiers())
    ->setMessage('Invalid Timezone value');

if ($validator->isValid()) {
    print_r($validator->getValues());
} else {
    print_r($validator->getErrors());
}

$validator->field('name', 'Name', '   ');
$validator->field('timezone', 'Timezone', 'Bogus');

if ($validator->isValid()) {
    print_r($validator->getValues());
} else {
    print_r($validator->getErrors());
}
