# PayTR Test Case

Yenercan Barker tarafından oluşturulan **PayTR Test Case** projesidir.
Bana iletilen dökümantasyondaki "**İsterler**" ve "**Bonuslar**" içeriğindeki bütün maddeler, eksiksiz bir şekilde eklenmiştir.

**Kurulum**, **Kayıt** ve **Token Oluşturma** ve **Proje Yapısı** aşağıda detaylı bir şekilde açıklanmıştır.

**Kullanılan Teknolojiler:**
- PHP 8
- Laravel 9.19
- Passport 11.2
- Postman
- MySQL

API verileri [Postman Dökümantasyonu](https://documenter.getpostman.com/view/13932063/2s84DrR2xB)'nda bulunmaktadır. Her bir API için detaylı açıklamalar ve örnek dönen değerler bulunmaktadır.

## Kurulum

1. **Git clone** komutunu kullanarak veya **.zip** dosyasını indirerek kaynak kodları bir klasöre çıkartın.
2. **.env.example** dosyasını kopyalayarak **.env** dosyası oluşturun.
3. **MySQL** üzerinden bir **veri tabanı** oluşturun.
4. **.env** dosyasında **veri tabanı konfigürasyon ayarları**nı yapın.
5. **composer install** komutunu çalıştırın.
6. **php artisan key:generate** komutunu çalıştırın.
7. **php artisan migrate --seed** komutunu çalıştırın.
8. **php artisan passport:install --uuids** komutunu çalıştırın. Terminalde soru çıkarsa "**yes**" cevabı verin.
9. Passport tarafından gelen **2. Client Id** ve **2. Client Secret** değerlerini .env dosyasında **PASSPORT_CLIENT_ID** ve **PASSPORT_CLIENT_SECRET** bölümüne ekleyin.
10. **php artisan optimize:clear** komutunu çalıştırın.
11. **php artisan serve** ile projeyi çalışır hale getirebilirsiniz.
12. **Serve** ile açılan **server url**'ini **Postman'de** **Environments** içerisinde **Config** içerisinde **project_url** variable'ının **CURRENT_VALUE** bölümüne ekleyin.

API rotalarına istek atabilmek için Bearer Token'e ihtiyacınız bulunmaktadır. O yüzden kurulum işlemini tamamladıktan sonra, "Kayıt Olma & Giriş Yapma & Yetkilendirme" bölümündeki adımları uygulayın.

## Kayıt Olma & Giriş Yapma & Yetkilendirme

The file explorer is accessible using the button in left corner of the navigation bar. You can create a new file by clicking the **New file** button in the file explorer. You can also create folders by clicking the **New folder** button.

API rotalarına istek atabilmek için **Bearer Token**'e ihtiyaç  duyulmaktadır.

**Ürün**,  **Kategori** ve **Vitrin** işlemlerini yalnızca **Admin** rolüne sahip olan kullanıcılar gerçekleştirebilir (Admin Panel simülasyonu gibi düşünebilirsiniz).  **Sepet**,  **Favorilere Ekleme** ve **Vitrini Görüntüleme** rolden bağımsız **her kullanıcı** için erişilebilir durumdadır.

Bütün işlemleri tek seferde test etmek için **Auth** > "**Register Admin**" bölümünden **Admin** rolüne sahip **kullanıcı oluşturabilirsiniz**.  Admin rolü  ile bütün rotalara istek atabilirsiniz.

Kullanıcı oluşturmak için "**Register User**" rotasını kullanabilirsiniz.  User rolü ile sadece **Sepet**, **Favorilere Ekleme**  ve "**Vitrini Görüntüleme**" işlemlerini yapabilirsiniz.

**Register** işleminden sonra HTTP **Status Code 200** olarak cevap aldıysanız :

- **Login** tarafına **oluşturduğunuz kullanıcı verileri** ile istek atabilirsiniz. **Laravel Passport** tarafından oluşturulan **token** size geri dönecektir.
- **Token'i** kopyalayıp **Postman** içinde "**Yenercan Barker - PayTR Case**" > "**Authorization**" > **Type** >  "**Bearer Token**" > **Token** bölümüne yapıştırın.
- Bundan sonra rotalara istek atabilirsiniz.

## Proje Yapısı

**SOLID** & **KISS** ve **DRY** prensiplerine uygun bir proje geliştirmeye çalıştım.

Kullandığım yapı şu şekilde :

**Middleware** : Klasik Middleware yapısı, Admin işlemleri için ekstra bir middleware oluşturdum.
**Controller** : İstekleri karşılar ve yönlendirme yapar.  
**Request** : Form validasyon işlemleri burada yapılır.  
**Service** : Mantıksal işlemleri yapar.  
**Repository** : Bütün veri tabanı işlemleri burada yapılır.  
**Interface** : Repository olarak kullanıyorum. (İleride olası bir veri tabanı değişikliği kolayca gerçekleştirilebilir.)

**Provider**: Repository ve Interface'leri birbirlerine bağlamak için **RepositoryInterfaceProvider** oluşturdum. Laravel'in app bind yapısını kullandım.

**Facade**: Sepet içeriğinde tutar içeriklerini hesaplaması için PriceCalculator Facade'ını oluşturdum.

**Dependency Injection** çözümünü **Constructor** içeriğinde **bind** işlemi yaparak gerçekleştirdim. 

## İletişim

Kurulum sırasında veya projeyi kullanım sırasında bir sorun ile karşılaştıysanız ve/veya proje hakkında sormak istediğiniz bir şey varsa
bana [LinkedIn](https://www.linkedin.com/in/yenercanbarker/) veya **yenercanbarker@gmail.com** mail adresi üzerinden ulaşabilirsiniz.

