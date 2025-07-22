# INSTALLATIONSGUIDE

1. Klona projektet
```
git clone https://github.com/dggruppen/Dokumentationssystem.git
cd Dokumentationssystem
```

2. Installera beroenden
```
composer install
npm install && npm run build
```

3. Kopiera .env
```
cp .env.example .env
php artisan key:generate
```

4. Kör migreringar
```
php artisan migrate
```

5. Starta utvecklingsserver
```
php artisan serve
```
