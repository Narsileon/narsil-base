# PHPUnit

Run the Base test suite from DDEV.

## Run all tests

Run the Base test suite:

```sh
ddev exec -d /var/www/narsil-base composer test
```

## Run the login tests

[LoginTest.php](../../tests/Feature/LoginTest.php) covers successful and rejected credentials.

```sh
ddev exec -d /var/www/narsil-base composer test -- --filter=LoginTest
```
