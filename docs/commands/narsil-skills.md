# Narsil Skills

Check and fix Narsil Base PHP files from the `narsil-app` DDEV container.

## Check

Check PHP files with the Narsil Skills check pipeline:

```sh
ddev exec -d /var/www/html vendor/narsil/skills/scripts/php/check /var/www/narsil-base
```

## Fix

Apply the Narsil Skills fix pipeline and format PHP files:

```sh
ddev exec -d /var/www/html vendor/narsil/skills/scripts/php/fix /var/www/narsil-base
```
