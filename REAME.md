# PhpSync driver based on Redis (predis/predis library)

## Under development

### Usage

```php
// See predis/predis docs for initializing a Client
$lockDriver = new \PhpSync\Drivers\Predis\PredisLockSyncDriver($client);
$lock = \PhpSync\Generic\Lock::getInstance("first_lock", $lockDriver);
// ...
```
You can additionally supply an optional namespace for Locks and Integers so that they do not mess with
another keys in Redis.