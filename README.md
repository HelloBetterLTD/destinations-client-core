# Destinations Database Client

This package provides a foundational set of classes and interfaces for developers to build clients that can be used to connect the destinations database. 

The package is designed to be extended to use with any content management system. An example is the Silverstripe client built on top of this. https://github.com/SilverStripers/destinations-client-silverstripe

## Installing 

The module can be installed using composer. 

```
composer require destinations/destinations-client-core
```

## Setting up the 

If your API is secured using tokens you can set up those by using 

```
use DD\Client\Core\Client;

Client::set_key('YOUR_KEY_HERE');
```  

## Connecting to the API

There are predefined functions in the Client class which helps you query the database. 

### Get categories

```
use DD\Client\Core\Client;

$client = new Client('YOUR_KEY_HERE');
$categories = $client->getCategories();

foreach($categories as $category) {
	// $category['ID'];
}

```