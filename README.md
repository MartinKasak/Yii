# Yii
https://www.yiiframework.com/

Projekti koduseks kasutamiseks peab kodus laadima alla PHP, composer'i ja mySQL serveri.

Projekti puuduvate failide jaoks tuleb teha projekti kaustas:
>composer install

Samuti tuleb muuta config/db.php sisu vastavalt enda andmebaasile.

Andmebaasi koostamis funktsioonid leiab sql.txt kaustast.

Pärast andmebaasi ühendust jooksutada käsk:
>php yii migrate --migrationPath=@vendor/yii2mod/yii2-comments/migrations

Projekti käivitamiseks:
>yii serve
