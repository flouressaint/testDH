## How to use
Run  
```
git clone https://github.com/flouressaint/testDH.git 
cd testDH/
cp -a .env.example .env
composer install
./vendor/bin/sail up -d
./vendor/bin/sail artisan migrate
./vendor/bin/sail artisan db:seed
```

import Postman collection file
**./testDH.postman_collection.json**



