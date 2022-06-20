# proje2
1. Sayfaya ilk girildiğinde student tablosundaki kayıtlar SELECT ile aşağıdaki şekilde listelenecektir. Bu 
HTML TABLE'daki yeni, sil, güncelle linklerine tıklayarak yeni öğrenci kaydı INSERT ile, silinecek kayıt 
DELETE ile ve yeni kayıt değerleri verilen kayıtlar UPDATE ile vritabanında güncellenecektir.

1. Yeni linkine tıklanınca (A) boş bir HTML FORM gösterilecek, (B) yeni öğrencinin adı, soyadı, 
doğum yeri ve tarihi kullanıcı tarafından girilip OLUŞTUR form butonuna tıklanacak ve (C)
yeni kayıt veritabanına INSERT edilecek (D) öğrenci HTML tablosu sayfasına geri 
dönülecektir.

2. Sil linkine tıklanınca (A) sid'si URL adres satırından op=sil&sid=7 gibi verilecek 7 numaralı
öğrenci DELETE ile veritabanından silinecek ve (B) öğrenci HTML tablosu sayfası 
görüntülenecektir.

3. Güncelle linkine tıklanınca (A) sid'si URL adres satırında ?op=guncele&sid=5 gibi verilecek 5 
numaralı öğrencinin kaydı "SELECT… WHERE sid=5" gibi bir komutla getirilecek ve HTML 
FORMunun içine doldurularak HTML formu gösterilecek, (B) öğrencinin yeni adı, soyadı, 
doğum yeri ve tarihi kullanıcı tarafından girilip GÜNCELLE form butonuna tıklanacak ve (C)
yeni değerler veritabanında UPDATE edilecek (D) öğrenci HTML tablosu sayfasına geri 
dönülecektir.

2. Şekilde verildiği gibi sütün başlıklarına tıklanarak kayıtlar azalan ve artan sırada sıralanacak ve her 
sayfada 5 kayıt olmak üzere sayfalama yapılacaktır. Sayfalama için tablonun altında ilk sayfa linki, 
sonraki sayfa linki, önceki 3 sayfanın linkleri, şimdiki sayfanın numarası, sonraki 3 sayfanın linkleri, 
sonraki sayfa linki, ve son sayfa linkleri bulunacaktır.


