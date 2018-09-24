### How to test
* clone repo
* run 
```$bash
bash docker.sh
```

### How to connect
```$bash
docker exec -ti app-container bash
```

### How to send accepted prizes 
* from container run
```$bash
php artisan queue:work
```
* from second window run
```$bash
php artisan prizes:sent
```

### How to run tests
* from container run
```$bash
./vendor/bin/phpunit
```