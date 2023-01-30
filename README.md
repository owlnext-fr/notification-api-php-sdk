# notification-api-php-sdk

Owlnext's notification API software development kit !

```php
use Owlnext\NotificationAPI\API;

$api = new API("", "", Environment::INTEGRATION);

foreach ($api->contacts->all() as $contact) {
    // $contact->id;
}

$newConctact = $api->contacts->create([
    'firstname' => 'foo',
    'lastname' => 'bar',
    'email' => 'foobar@mail'
]);

$api->contacts->delete($newConctact->id);


$path = $api->getRouter()->generate("/attaments/{id}", ['id' => 12]);
// $path: /attachments/12

$path = $api->getRouter()->generateByName('attachment_details', ['id' => 12]);
// $path: /attachments/12

```