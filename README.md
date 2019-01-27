# Segédanyag Portál

### Mi kell hozzá

  - HTTP szerver (Apache vagy nginx)
  - PHP7.2
  - Composer
  - MySQL
  - Magic

### Telepítés composerrel

```sh
$ cd segedanyag-portal
$ composer install
$ bin/console doctrine:migrations:migrate
$ bin/console ckeditor:install
$ bin/console assets:install --symlink
```

### Telepítési tudnivalók
  - OAuth kliens létrehozása: https://auth.sch.bme.hu/, átirányítási cím: https://honlap.cime/connect/sch/check
  - Környezetre jellemző beállítások az .env fájlban:
    - APP_ENV futási környezet
    - DATABASE_URL=mysql://mysql_felhasználó:mysql_jelszó@adatbázis.szerver:3306/adatbázis_név
    - SCH_CLIENT_ID és SCH_CLIENT_SECRET az auth.sch fejlesztői konzolon beregisztrált kliens adatai
  - Fontos, hogy az oldal automatikusan biztonságos kapcsolatra próbál váltani, úgyhogy https-en lehessen elérni
  - Admin felület: https://honlap.cime/admin
    - első bejelentkezés után phpmyadminban (vagy más adatbázis kezelőben) adjunk magunknak Admin jogot a User táblában, hogy be tudjunk lépni
    - A főoldal/kapcsolat oldal tartalmait hozzuk létre az ezeken az oldalakon pirossal megjelenő identifierrel
    - ContentType táblában hozzunk létre típusokat (videotorium, könyv, jegyzet)
         - InternalType=1: Videó típusú segédanyag (feltöltött File tartalmat mutatja)
         - InternalType=2: Letölthető tartalom (pl. pdf) (feltöltött File tartalmat mutatja)
         
