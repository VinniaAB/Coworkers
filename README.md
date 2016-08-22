# Coworkers

Add the following to your composer.json

Under "repositories"
```
 {
      "type": "package",
      "package": {
        "name": "vinniaab/vinnia-coworkers",
        "version": "dev-master",
        "type": "wordpress-plugin",
        "source": {
          "type": "git",
          "url": "git@github.com:VinniaAB/Coworkers.git",
          "reference": "master"
        },
        "require": {
          "composer/installers": "~1.0"
        }
      }
    }
```

and then under "require"
```
"vinniaab/vinnia-coworkers": "dev-master"
```
