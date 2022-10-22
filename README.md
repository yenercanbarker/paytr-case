## PayTR Test Case

Yenercan Barker tarafından oluşturulan PayTR Test Case projesidir.

Bana iletilen dökümantasyondaki "İsterler" ve "Bonuslar" içeriğindeki bütün maddeler eksiksiz bir şekilde eklenmiştir.

Kullanılan Teknolojiler :

1- PHP
2- Laravel
3- Auth işlemleri için Laravel Passport
4- API işlemleri için Postman
5- MySQL

Postman Dökümantasyonu: https://documenter.getpostman.com/view/13932063/2s84DrR2xB

## Kurulum

1- Git clone komutunu kullanarak veya .zip dosyasını indirerek kaynak kodları bir klasöre çıkartın.
2- .env.example dosyasını kopyalayarak .env dosyası oluşturun.
3- MySQL üzerinden bir veri tabanı oluşturun.
4- .env dosyasında veri tabanı konfigürasyon ayarlarını yapın.
5- composer install komutunu çalıştırın.
6- php artisan key:generate komutunu çalıştırın.
7- php artisan migrate --seed komutunu çalıştırın.
8- php artisan passport:install --uuids komutunu çalıştırın. Terminalde soru çıkarsa "yes" cevabı verin.
9- Passport tarafından gelen 2. Client Id ve 2. Client Secret değerlerini .env dosyasında PASSPORT\_\* bölümüne ekleyin.
10- php artisan optimize:clear komutunu çalıştırın.
11- php artisan serve ile projeyi çalışır hale getirebilirsiniz.

Bütün API rotalarına ve çıktılarına Postman üzerinden ulaşabilirsiniz.

## Kayıt Olma & Giriş Yapma & Yetkilendirme

API rotalarına istek atabilmek için Bearer Token'e ihtiyaç duyulmaktadır.

Ürün, Kategori ve Vitrin işlemlerini yalnızca Admin rolüne sahip olan kullanıcılara açtım.
Sepet, Favorilere Ekleme rolden bağımsız her kullanıcı için erişilebilir durumdadır.

Bütün işlemleri tek seferde test etmek için "Register Admin" bölümünden Admin rolüne sahip kullanıcı oluşturabilirsiniz.
Admin rolü ile bütün rotalara istek atabilirsiniz.

Kullanıcı oluşturmak için "Register User" rotasını kullanabilirsiniz.
User rolü ile sadece Sepet, Favorilere Ekleme işlemlerini yapabilirsiniz.

Register işleminden sonra HTTP Status Code 200 olarak cevap aldıysanız;
Login tarafına oluşturduğunuz kullanıcı verileri ile istek atabilirsiniz. Laravel Passport tarafından oluşturulan token size geri dönecektir.
Token'i kopyalayıp Postman "PayTR Case" > "Authorization" > Type "Bearer Token" > Token bölümüne yapıştırın.
Bundan sonra rotalara istek atabilirsiniz.

## Proje Yapısı

SOLID & KISS ve DRY prensiplerine uygun bir proje geliştirmeye çalıştım.
Kullandığım yapı şu şekilde :

Controller : İstekleri karşılar ve yönlendirme yapar.
Request : Form validasyon işlemleri burada yapılır.
Service : Mantıksal işlemleri yapar.
Repository : Bütün veri tabanı işlemleri burada yapılır.
Interface : Repository olarak kullanıyorum. (İleride olası bir veri tabanı değişikliği kolayca gerçekleştirilebilir.)

Dependency Injection çözümünü Constructor içeriğinde bind işlemi yaparak gerçekleştirdim.
RepositoryInterfaceProvider oluşturdum, Repository ve Interface bind işlemlerini bu dosya içerisinde gerçekleştirdim.

