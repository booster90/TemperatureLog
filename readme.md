ver. 1.0.2
--------------------------------------------------------------------------------
* blad z godzina 24 poprawione


ver. 1.0.1
--------------------------------------------------------------------------------
* dodana obsługa czujnika nr 3

to do:
* obsluga wielu czujnikow(niech sprawdza w bazie)
* blad z godzina 24
* ..

ver. 1.0
--------------------------------------------------------------------------------
* dodałem obsługe kolejnego czujnika
* poprawiona wersja mobilna

to do:
* obsluga wielu czujnikow(niech sprawdza w bazie)
* blad z godzina 24
* ..
--------------------------------------------------------------------------------
POMIAR TEMPERATURY WEB.

Aplikacja prezentujaca wyniki pomiarów z czujników ds1820 podłączonych do
platformy raspberry. Czujnik podłączony jest poprzed I2C (GPIO raspberry), 
cyklicznie uruchamiany skrypt w cronie skanuje dostępne czujniki i w razie potrzeby 
tworzy dla każdego czujnika nową tabelę(o nazwie sensor_x) w bazie danych SQLite
i zapisuje w niej wyniki pomiaru.

Dane te pobiera aplikacja(skrypt PHP) umieszczona na serwerze. Skrypt wyświetla 
dane na wykresie(biblioteka charts.js) po dwa wykresy(czujniki) dla jedego dnia.

Wyniki są prezentowane do 3 dni w tył.

Urządzenia i części:

    raspberry pi2
    ds1820
    rezystory 4,7 kOhma
    płytka uniwersalna 

Technologie:
    System raspian, serwer nginx,
    PHP
    SQLite
    biblioteka chart.js
    

--------------------------------------------------------------------------------
http://krystianm.pl/