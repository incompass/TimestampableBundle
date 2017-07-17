[![Build Status](https://travis-ci.org/incompass/TimestampTraitBundle.svg?branch=master)](https://travis-ci.org/incompass/TimestampTraitBundle)
[![Total Downloads](https://poser.pugx.org/incompass/timestampable-bundle/downloads.svg)](https://packagist.org/packages/incompass/timestampable-bundle)
[![Latest Stable Version](https://poser.pugx.org/incompass/timestampable-bundle/v/stable.svg)](https://packagist.org/packages/incompass/timestampable-bundle)

TimestampTraitBundle
===================

This bundle allows you to simply add ```use TimestampTrait``` 
to a doctrine entity class to have it automatically add 
created_at and updated_at fields and to have them updated on
insert and update.

Installation
------------

### Composer
```
composer require incompass-timestampablebundle
```

Usage
-----

Add the TimestampTrait trait to your doctrine entities.

```
use TimestampTrait
```

Update your database schema
```
php bin/console doctrine:schema:update --force
```

All entities will now be saved with created_at and updated_at fields populated.

Contributors
------------

Joe Mizzi (casechek/incompass)
