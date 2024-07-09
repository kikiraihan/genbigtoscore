<?php

namespace Database\Seeders;

use App\Models\anggota;
use App\Models\Beasiswa;
use App\Models\Kepengurusan;
use App\Models\Unit;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class AnggotaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $a19=[11,12, 13];
        $a19takmenerimalalu=[11,12, 13,15];
        $a19lanjut=[11,12, 13,14];
        $a19p2lanjut=[12, 13,14, 15];
        $a20lanjut=[13,14, 15];
        $a20p2lanjut=[14, 15];
        $a21=[15];


        $import=[
            // wilayah
            ["Moh Zulkifli Katili", "531416066",1, $a19, 1, "Ketua Umum"],
            ["Revandi S. Pakaya", "412417018",1, $a19takmenerimalalu, 1, "Sekretaris Umum"],
            ["Siti Mursila Vebrina Mohamad", "1011417037",1, $a19takmenerimalalu, 1, "Bendahara Umum"],
            
            ["Arif Irianto Umar", "413417009", 1, [12,15], 2, "Anggota"],
            ["Komang Darma Widia", "921418157", 1, $a20lanjut, 2, "Kepala Departemen"],
            ["Nineng Noer Laila", "912418057", 1, $a20lanjut, 2, "Anggota"],
            ["Sri Amelia B. Monoarfa", "921418119", 1, $a20lanjut, 2, "Anggota"],
            ["Yulinar Bora", "601180004", 3, $a19p2lanjut, 2, "Anggota"],
            ["Al Iqbal Bin Salim", "000123", 1, $a19, 2, "Anggota"],
            ["Sianly Kindangen", "000124", 2, $a19lanjut, 2, "Anggota"],

            ["Ali Luqman Adam", "532417003",1, $a19takmenerimalalu, 3, "Kepala Departemen"],
            ["Chairunnisa Y. Tilolango", "413417027",1, $a19takmenerimalalu, 3, "Anggota"],
            ["Syafna Nafila Lamusu", "601180044",3,$a19p2lanjut, 3, "Anggota"],
            ["Verawati Mudja", "601180053",3,$a19p2lanjut, 3, "Anggota"],
            ["Reyn akuba", "000125", 2, $a19, 3, "Anggota"],
            ["Zulsaputra", "000126", 1, $a19, 3, "Anggota"],

            ["Salsabillah said", "331319013",1,$a20lanjut, 4, "Anggota"],
            ["Arya Daud", "601180023",3,$a19p2lanjut, 4, "Kepala Departemen"],
            ["Dian Manumbi", "000127", 2, $a19lanjut, 4, "Anggota"],
            ["Djulchindra", "000128", 2, $a19lanjut, 4, "Anggota"],
            ["Ikrar Affandi", "000129", 1, $a19, 4, "Anggota"],

            ["La Imudi", "531418049",1,$a20lanjut, 5, "Kepala Departemen"],
            ["Sania Rostama Suhadak", "311418039",1,$a20lanjut, 5, "Anggota"],
            ["Desi Dwilandi Biga", "174022012",2,$a19p2lanjut, 5, "Anggota"],
            ["Mohamad Ruslan Rahman", "182042022",2,$a20lanjut, 5, "Anggota"],
            ["Nur Hasannah A. Husain", "174022068",2,$a19takmenerimalalu, 5, "Anggota"],
            ["Sri Susanti Wajipalu", "103180030",3,$a19p2lanjut, 5, "Anggota"],
            ["Yusril Katili", "601180016",3,$a19p2lanjut, 5, "Anggota"],

            ["Sri Maryam Astuti Bobihu", "413417047",1,$a20lanjut, 6, "Anggota"],
            ["Febriyana Taki", "413417004",1,$a19p2lanjut, 6, "Anggota"],
            ["Febriyani Taki", "412417001",1,$a19p2lanjut, 6, "Anggota"],
            ["Rizal S. Baginda", "000130", 2, $a19lanjut, 6, "Kepala Departemen"],

            ["Magfirah Putri Shalidina", "931417128",1,$a19takmenerimalalu, 7, "Anggota"],
            ["Riskawati Malapo", "1011417046",1,$a19takmenerimalalu, 7, "Anggota"],
            ["Arief Budiman Dama", "291418036",1,$a20lanjut, 7, "Anggota"],
            ["Mukhlisa Tuli", "000131", 2, $a19lanjut, 7, "Kepala Departemen"],

            // UNG
            ["Naswa Adilia Alamri", "941417096",1, $a20lanjut, 8, "Ketua Komisariat"],
            ["Fitriyanti B. Tahir", "921418087",1, $a20lanjut, 8, "Sekretaris Komisariat"],
            ["Anatasya Lahay", "412418002",1, $a20lanjut, 8, "Bendahara Komisariat"],

            ["Aryo Syafrie Kasim", "291419035",1, $a21, 9, "Anggota"],
            ["David Ansari Lubis", "531417057",1, $a20lanjut, 9, "Kepala Divisi"],
            ["Dian Restyani", "341418003",1, $a21, 9, "Anggota"],
            ["Fitra Ariyanti Humonggio", "331319009",1, $a20lanjut, 9, "Anggota"],
            ["Hasni saipi", "331319010",1, $a20lanjut, 9, "Anggota"],
            ["Indi Nabila Panigoro", "291418078",1, $a21, 9, "Anggota"],
            ["Karin Mutmainnah Z. Laisa", "331318005",1, $a20p2lanjut, 9, "Anggota"],
            ["Marcilya Dwi Sukaryadi", "321417027",1, $a20lanjut, 9, "Anggota"],
            ["Moh. Arif W.S", "411417051",1, $a20lanjut, 9, "Anggota"],
            ["Muhammad Al-Haddad P. Iko", "413418048",1, $a20p2lanjut, 9, "Anggota"],
            ["Nadiya Yunus", "413418046",1, $a20lanjut, 9, "Anggota"],
            ["Putri Ayu Arifin Pola", "331318003",1, $a20lanjut, 9, "Anggota"],
            ["Siti Asriani Amuati", "321417010",1, $a20lanjut, 9, "Anggota"],
            ["Tamsil Rahama", "331319007",1, $a20lanjut, 9, "Anggota"],
            ["Tri Sandi Setiawan Nteya", "291419086",1, $a21, 9, "Anggota"],
            ["Shirly Alifia Podungge", "001",1, [13], 9, "Anggota"],
            ["Amalia Destiara Kautsarrany", "002",1, [13], 9, "Anggota"],

            ["Abd. Wahid Ibrahim", "291418057",1, $a21, 10, "Anggota"],
            ["Ahmad Haekal Bahar", "321417078",1, $a20lanjut, 10, "Kepala Divisi"],
            ["Amirrudin Paneo", "531419054",1, $a21, 10, "Anggota"],
            ["Fadli Wahyudi Paputungan", "532417027",1, $a20lanjut, 10, "Anggota"],
            ["Indah Wardati Lahiya", "532417002",1, $a20lanjut, 10, "Anggota"],
            ["Jihan Khoirun Nisa", "531419024",1, $a21, 10, "Anggota"],
            ["Mohamad Rinaldi Djakaria", "931418014",1, $a21, 10, "Anggota"],
            ["Nur Amalia Marukai", "413418023",1, $a20lanjut, 10, "Anggota"],
            ["Saskia Magfirah Burdah", "921418031",1, $a20p2lanjut, 10, "Anggota"],
            ["Sitti Ta'Mirullah A. Popalo", "921418070",1, $a21, 10, "Anggota"],
            ["Vina Ananda Sukma", "291417114",1, $a20p2lanjut, 10, "Anggota"],
            ["Cindy Wahyuningsih", "003",1, [13,14], 10, "Anggota"],
            ["Fauzan Basalama", "004",1, [13,14], 10, "Anggota"],
            ["Moh. Ichsanul Sya'Ban Mudassir", "005",1, [13], 10, "Anggota"],
            ["Muslim Wahyu Rifaldi Hulumudi", "006",1, [13,14], 10, "Anggota"],
            ["Ni Made Sagita Satmanadika", "007",1, [13,14], 10, "Anggota"],
            ["Nur Falaq", "008",1, [13,14], 10, "Anggota"],
            ["Sri Latifah Ahmad", "009",1, [13,14], 10, "Anggota"],
            
            ["Dandy Hook Daimalindu", "912417081",1, $a20lanjut, 11, "Anggota"],
            ["Diaz Ilham Bilondatu", "291419042",1, $a21, 11, "Anggota"],
            ["Febriyaningsi Radjak", "821319051",1, $a21, 11, "Anggota"],
            ["Fidya Felinda Ilahude", "321417009",1, $a20lanjut, 11, "Anggota"],
            ["Fitri Ramadani Laadjim", "911417001",1, $a20lanjut, 11, "Anggota"],
            ["Harwin Dj. Latada", "331318009",1, $a20lanjut, 11, "Anggota"],
            ["Kartika F. Pausther", "921417027",1, $a20lanjut, 11, "Kepala Divisi"],
            ["Lutfiah Husain", "821318048",1, $a21, 11, "Anggota"],
            ["M. Gusmaryanto Sumaga", "614418028",1, $a20p2lanjut, 11, "Anggota"],
            ["Maya Wulandari Iskandar", "921418035",1, $a20lanjut, 11, "Anggota"],
            ["Muhamad Yahya Muchtar", "821319062",1, $a21, 11, "Anggota"],
            ["Nurmelinda A. Popa", "921417026",1, $a20lanjut, 11, "Anggota"],
            ["Sitti Acha Wati", "921419091",1, $a21, 11, "Anggota"],
            ["Sri Roma Uli", "010",1, [13], 11, "Anggota"],
            ["Elviira Akuba", "011",1, [13,14], 11, "Anggota"],
            ["Aprilia Hasan", "012",1, [14], 11, "Anggota"],
            ["Fahni Rahmadani Dali", "013",1, [13], 11, "Anggota"],
            ["Moh. Panji Rahmat Saihi", "014",1, [14], 11, "Anggota"],
            
            ["Alif Dio Brilian Utama Putra", "941417002",1, $a20lanjut, 12, "Anggota"],
            ["Ari Kurniawan Putra", "921418111",1,  $a20lanjut, 12, "Anggota"],
            ["Defrianti Kadir", "411418048",1, $a21, 12, "Anggota"],
            ["Eka Safitri", "311418037",1, [13,15], 12, "Anggota"],
            ["Eka Yuniar Amalia Mege", "821319099",1, $a21, 12, "Anggota"],
            ["Mirzad Septian Panigoro", "411418002",1, $a21, 12, "Anggota"],
            ["Nabil Adiansyah Panja", "921418010",1, $a20lanjut, 12, "Kepala Divisi"],
            ["Nur Amalia Katili", "1011418101",1, $a20lanjut, 12, "Anggota"],
            ["Sindi Kristika Sari", "821319078",1, $a21, 12, "Anggota"],
            ["Tiara Oktavia Namira Daud", "1011419120",1, $a21, 12, "Anggota"],
            ["Tiara Posangi", "413418034",1, $a20lanjut, 12, "Anggota"],
            ["Vicka Vidyanita Dalantang", "821319095",1, $a21, 12, "Anggota"],
            ["Trifoca Veronika Br Surbakti", "015",1, [13,14], 12, "Anggota"],
            ["Andi Muhammad Nur Fitrah Syamsul", "016",1, [13,14], 12, "Anggota"],
            ["Afdal Bempah", "017",1, [14], 12, "Anggota"],
            ["Bella Putri Hunowu", "018",1, [14], 12, "Anggota"],
            ["Gita Noviyanti", "019",1, [13], 12, "Anggota"],
            ["Prasethyo Darmawan Sumba", "020",1, [13], 12, "Anggota"],
                        
            ["Alda Nevatri Bahagia Sigar", "921418186",1, $a21, 13, "Anggota"],
            ["Alian Ridho", "851419033",1, $a21, 13, "Anggota"],
            ["Alifia Satirah Sima", "331319006",1, [13,15], 13, "Anggota"],
            ["Alviansyah Samsu Mallawe", "821319065",1, $a21, 13, "Anggota"],
            ["Andhika Rezeky Gunawan Gani", "851419035",1, $a21, 13, "Anggota"],
            ["Andi Nurhikmah", "821319093",1, $a21, 13, "Anggota"],
            ["Cindrawati Djafar", "331319003",1, $a21, 13, "Anggota"],
            ["Fitria Nur Mayatasya Rifai", "821319010",1, $a21, 13, "Anggota"],
            ["Hairunnisa Katili", "413418001",1, $a20p2lanjut, 13, "Anggota"],
            ["Jihan Salsabila Rachman", "821319053",1, $a21, 13, "Anggota"],
            ["S. Zalfa Thufailah Al-habsyi", "331319004",1, $a20lanjut, 13, "Anggota"],
            ["Saskia Praditya", "841418038",1, $a20lanjut, 13, "Anggota"],
            ["Wira Adhitya Putra", "851419001",1, $a21, 13, "Anggota"],
            ["Siti Rohmawati", "021",1, [13,14], 13, "Anggota"],
            ["Tri Rachmad Irianto", "022",1, [14], 13, "Anggota"],
            ["Zulfiana Salzabila", "023",1, [13,14], 13, "Anggota"],
            ["Meriska N Rifai", "024",1, [13], 13, "Anggota"],
            ["Dwirahayu Rauf", "025",1, [13,14], 13, "Anggota"],
            ["Fritania Bonde", "026",1, [13,14], 13, "Kepala Divisi"],

            ["Adinda Paramitha Samsudin","921417009",1, $a20lanjut, 14, "Anggota"],
            ["Adinda Pratiwi Musa", "413418036",1, $a20lanjut, 14, "Anggota"],
            ["Al Rahmat Atuna", "941417076",1, $a20lanjut, 14, "Anggota"],
            ["Cindy Pramunianingsih Umar", "921417022",1, $a20lanjut, 14, "Anggota"],
            ["Fadilah Istiqomah Pammus", "413418027",1, $a20p2lanjut, 14, "Anggota"],
            ["Maharani", "921417068",1, $a20lanjut, 14, "Kepala Divisi"],
            ["Mawardi Hulinggi", "451418064",1, $a20lanjut, 14, "Anggota"],
            ["Milenya Arumasi", "921417152",1, $a20lanjut, 14, "Anggota"],
            ["Nur'Ain J. Hamzah", "451418069",1, $a20lanjut, 14, "Anggota"],
            ["Rivaldi Tahir", "921417146",1, $a20lanjut, 14, "Anggota"],
            ["Julyana Mega Cantika Napu", "331319012",1, $a21, 14, "Anggota"],
            ["Wafiq Aziza Nursafitri", "921418042",1, $a21, 14, "Anggota"],
            ["Asfariyani A Talango", "1401",1, [14], 14, "Anggota"],
            ["Awalia Emiro", "1422",1, [13,14], 14, "Anggota"],
            ["Danur Rahmatullah", "1421",1, [13,14], 14, "Anggota"],
            ["Rifaldi Ibrahim", "1423",1, [14], 14, "Anggota"],
            ["Rivaldi Massa", "1424",1, [13,14], 14, "Anggota"],



            //IAIN
            ["Tasya Dwias Amanda", "182042032",2, $a20lanjut, 15, "Ketua Komisariat"],
            ["Rehanun", "182042043",2, $a20lanjut, 15, "Sekretaris Komisariat"],
            ["Minarti Mansombo", "184022092",2, $a20lanjut, 15, "Bendahara Komisariat"],

            ["A. Rehan Fajrul Islam", "194022074",2, $a21, 16, "Anggota"],
            ["Akbar Rizki Datau", "171042021",2, $a20p2lanjut, 16, "Anggota"],
            ["Fatma Tunali", "173052007",2, $a20lanjut, 16, "Anggota"],
            ["Indriyanto J Hasan", "194022049",2, $a21, 16, "Anggota"],
            ["Marianti Husain", "193042011",2, $a21, 16, "Anggota"],
            ["Muslihah Zulhijah", "181032035",2, $a20lanjut, 16, "Kepala Divisi"],
            // ["Nikma A tahir", "1621",2, $a20p2lanjut, 16, "Anggota"],
            ["Nur Pratiwi Djafar", "1622",2, [13,14], 16, "Anggota"],
            ["Selmi Oka", "1623",2, [13], 16, "Anggota"],

            ["Arianto S Panambang", "173052015",2, $a20lanjut, 17, "Anggota"],
            ["Hamsil Hamdi", "184032010",2, $a20lanjut, 17, "Kepala Divisi"],
            ["Moh Sigit Suleman", "193052009",2, $a21, 17, "Anggota"],
            ["Mohamad Agung Tarape", "194042006",2, $a21, 17, "Anggota"],
            ["Rahmawaty Unusa", "184022074",2, $a20p2lanjut, 17, "Anggota"],
            ["Rivaldo Dullah", "192042015",2, $a21, 17, "Anggota"],
            ["Chantika Putri A", "17123",2, [14], 17, "Anggota"],
            ["Muh. Adenrizki Alimuddin", "17223",2, [13], 17, "Anggota"],
            

            ["Asrin A. Tomayahu", "182022014",2, $a21, 18, "Anggota"],
            ["Ayuandira M. Ano", "182022007",2, $a21, 18, "Anggota"],
            ["Della Anggraini Darise", "174012011",2, $a19p2lanjut, 18, "Kepala Divisi"],
            ["Nurain Musa", "194032029",2, $a21, 18, "Anggota"],
            ["Nurmala Dunggio", "182022047",2, $a20lanjut, 18, "Anggota"],
            ["Ramlah Adam", "184022026",2, $a20p2lanjut, 18, "Anggota"],
            ["Desy Rahmawati", "182022064",2, $a20lanjut, 18, "Anggota"],
            ["Karama Yarbo", "18123",2, [13,14], 18, "Anggota"],
            ["Nurwahyuni Bayahu", "181233",2, [14], 18, "Anggota"],
            ["Undria Agustin Gobel", "182223",2, [13], 18, "Anggota"],

            ["Andri Mohamad", "184022039",2, $a21, 19, "Anggota"],
            ["Asih Nuraini S Jua", "194022083",2, $a21, 19, "Anggota"],
            ["Cahyadi Mutiara", "192042040",2, $a21, 19, "Anggota"],
            ["Ertin", "184032017",2, $a20p2lanjut, 19, "Anggota"],
            ["Moh Kenji Tribuana Pukulo", "193052003",2, $a21, 19, "Anggota"],
            ["Nurain Jusuf", "184022052",2, $a20lanjut, 19, "Anggota"],
            ["Putri Permatasari Nohu", "184022009",2, $a20lanjut, 19, "Anggota"],
            ["Yuliananda Ja. Kuntuamas", "184032009",2, $a20lanjut, 19, "Kepala Divisi"],
            ["Nazlia Ali Alamri", "1921",2, [14], 19, "Anggota"],
            ["Wirdawati L. Unusa", "1923",2, [13], 19, "Anggota"],
            ["Zakiatul Fatana", "1922",2, $a19lanjut, 19, "Anggota"],

            ["Arham Bobihu", "181032027",2, $a21, 20, "Anggota"],
            ["Cindrianing Abdullah", "184042006",2, $a21, 20, "Anggota"],
            ["Lidyawati Mohamad", "184022057",2, $a20p2lanjut, 20, "Anggota"],
            ["Nabila Solaeman", "184032019",2, $a20lanjut, 20, "Kepala Divisi"],
            ["Nolva Isa", "192042004",2, $a21, 20, "Anggota"],
            ["Nurhayati Mohamad", "174022031",2, $a20lanjut, 20, "Anggota"],
            ["Chindy yusuf", "2021",2, [14], 20, "Anggota"],
            ["Sri Yulistianti Hamdi", "2022",2, [13], 20, "Anggota"],
            ["Widy Pratiwi Monantun", "2023",2, [13], 20, "Anggota"],

            ["Dwi Nadianti Datau", "184032001",2, $a20lanjut, 21, "Anggota"],
            ["Intan Sudarniati Sipatu", "184032022",2, $a20p2lanjut, 21, "Anggota"],
            ["Kartina", "174022061",2, $a20lanjut, 21, "Anggota"],
            ["Nikma A. Tahir", "184032020",2, $a20lanjut, 21, "Anggota"],
            ["Wahyuningsi Matolodula", "184032004",2, $a20p2lanjut, 21, "Anggota"],
            ["Widiyawati Katili", "174022007",2, $a20p2lanjut, 21, "Anggota"],
            ["Dewi Ratni Is. Lapaji", "194022090",2, $a21, 21, "Anggota"],
            ["Muthia Nur Kholifa", "181012063",2, [13,15], 21, "Kepala Divisi"],
            ["Nur Ainun", "184042021",2, $a21, 21, "Anggota"],
            ["Rindiyani Abdullah", "184042023",2, $a21, 21, "Anggota"],
            ["Zulkifli Dali", "191032070",2, $a21, 21, "Anggota"],
            ["Ulvairen Ismail", "2123",2, [13], 21, "Anggota"],


            // UG
            ["Rolly Ramdi Basri", "102180037",3, $a19p2lanjut, 22, "Ketua Komisariat"],
            ["Yeni Dyana Sari", "102180012",3, $a19p2lanjut, 22, "Sekretaris Komisariat"],
            ["Sri Wahyuni A.k Bangi", "102180032",3, $a19p2lanjut, 22, "Bendahara Komisariat"],

            ["Frizal H Djuma", "103180009",3, $a20lanjut, 23, "Anggota"],
            ["Indah Silviana taufik", "103180021",3, $a19p2lanjut, 23, "Anggota"],
            ["Isabella Herawati", "103180041",3, $a20lanjut, 23, "Anggota"],
            ["Mohamad Safar Ahmad", "102180027",3, $a19p2lanjut, 23, "Kepala Divisi"],
            ["Riyan R. Albakir", "102180010",3, $a19p2lanjut, 23, "Anggota"],
            ["Savitri Nurhasanah H. Nohu", "103180045",3, $a20lanjut, 23, "Anggota"],
            ["Siti Aminah", "103180022",3, $a19p2lanjut, 23, "Anggota"],
            ["Sri Yulanda Moito", "102180001",3, $a19p2lanjut, 23, "Anggota"],
            ["Arafik Pakaya", "103190018",3, $a21, 23, "Anggota"],

            ["Munira", "203170013",3, $a20lanjut, 24, "Anggota"],
            ["Nurain Abas", "102170048",3, $a19p2lanjut, 24, "Anggota"],
            ["Rahmat Uno", "103180044",3, $a20lanjut, 24, "Kepala Divisi"],
            ["Rilman Karim", "102180002",3, $a19p2lanjut, 24, "Anggota"],
            ["Wahyu praditya p. Labade", "102180007",3, $a19p2lanjut, 24, "Anggota"],
            ["Yulyana Duda", "102170036",3, $a19p2lanjut, 24, "Anggota"],
            ["Ririn Moo", "21253",3, [14], 24, "Anggota"],

            ["Afrianita Hariyanto", "102180016",3, $a20lanjut, 25, "Anggota"],
            ["Fitriawati Karim", "103180013",3, $a19p2lanjut, 25, "Anggota"],
            ["Nirma I. Latala", "103170024",3, $a20lanjut, 25, "Anggota"],
            ["Nur Fazrin Lamato", "101170002",3, $a19p2lanjut, 25, "Kepala Divisi"],
            ["Putri Desrianti Harun", "103170007",3, $a20lanjut, 25, "Anggota"],
            ["Yuniarti Abdullah", "21254",3, [14], 25, "Anggota"],            

            ["Ainun Anisya Amalia", "102170011",3, $a20lanjut, 26, "Anggota"],
            ["Claraswati Katili", "102170037",3, $a20lanjut, 26, "Kepala Divisi"],
            ["Fiqih Ashar Mohamad", "601180006",3, $a19p2lanjut, 26, "Anggota"],
            ["Ilham Fakhrudin Otuhu", "601180072",3, $a20lanjut, 26, "Anggota"],
            ["Mutia Zalzabila Putri G.Biya", "102170003",3, $a20lanjut, 26, "Anggota"],
            ["Nerwiyanti Putri B.Soga", "102170067",3, $a19p2lanjut, 26, "Anggota"],
            ["Faisal Hamsah", "102190048",3, $a21, 26, "Anggota"],
            ["L.M. Halik Ismail", "601180071",3, $a21, 26, "Anggota"],

            ["Halima H. Pobi", "103170026",3, $a20lanjut, 27, "Anggota"],
            ["Hamidah Kamali", "103170009",3, $a20lanjut, 27, "Anggota"],
            ["Nazma Nugrahwati Djiu", "102170028",3, $a19p2lanjut, 27, "Anggota"],
            ["Noviya S.Hasan", "601180005",3, $a19p2lanjut, 27, "Kepala Divisi"],
            ["Pratiwi Indarparwati Tomayahu", "601180031",3, $a20lanjut, 27, "Anggota"],
            ["Wulandari I. Hadji", "102180028",3, $a20lanjut, 27, "Anggota"],

            ["Ayu Lestari Kunuti", "102180019",3, $a19p2lanjut, 28, "Kepala Divisi"],
            ["Fadli Ahmad", "601180057",3, $a19p2lanjut, 28, "Anggota"],
            ["Jeinal Igrisa", "201180010",3, $a19p2lanjut, 28, "Anggota"],
            ["Moh.Rizki Hanapi Tomu", "601180017",3, $a19p2lanjut, 28, "Anggota"],
            ["Nur Faira Rullu", "103170033",3, $a20lanjut, 28, "Anggota"],
            ["Pratiwi Puspita Hasan", "102170004",3, $a19p2lanjut, 28, "Anggota"],
            ["Rahmin Kimun", "601180014",3, $a19p2lanjut, 28, "Anggota"],
            ["Aprilia Nanda Susanti", "21256",3, [13,14], 28, "Anggota"],

        ];

        $i=1;
        $beasiswa=Beasiswa::find(15);
        foreach ($import as $per) {
            $user=new User;
            $user->username  =$i;
            $user->email     ='anggota'.$i.'@gmail.com';
            $user->password  ='password';

            if($per[5]=="Ketua Umum")
            $user->assignRole('Korwil');
            elseif($per[5]=="Sekretaris Umum")
            $user->assignRole('Sekwil');
            elseif($per[5]=="Bendahara Umum")
            $user->assignRole('Benwil');
            elseif($per[5]=="Kepala Departemen" OR $per[5]=="Kepala Divisi")
            $user->assignRole('Kepala Unit');
            elseif($per[5]=="Ketua Komisariat")
            $user->assignRole('Kekom');
            elseif($per[5]=="Sekretaris Komisariat")
            $user->assignRole('Sekom');
            elseif($per[5]=="Bendahara Komisariat")
            $user->assignRole('Benkom');
            else
            $user->assignRole('Anggota');

            $user->save();
            $ang= new Anggota;
            $ang->id_user           =$user->id;
            $ang->nama              =$per[0];
            $ang->nim               =$per[1];
            $ang->id_universitas    =$per[2];
            // $ang->menerima_beasiswa =$per[3];
            $ang->save();
            
            //jika menerima beasiswa 2021/1
            if($per[3])
                foreach ($per[3] as $key => $value) 
                    $ang->beasiswas()->attach($value);

            // set Kepala Unit
            if($per[5]=="Kepala Departemen" OR 
                $per[5]=="Kepala Divisi" OR 
                $per[5]=="Ketua Umum" OR 
                $per[5]=="Ketua Komisariat")
            {
                $un=Unit::find($per[4]);
                // $un->id_ketua=$ang->id;
                $un->save();
            }

            $kep =new Kepengurusan;
            $kep->id_Anggota        =$ang->id;
            $kep->id_unit           =$per[4];
            // $kep->jabatan           =$per[5];

            $kep->save();
            $i++;
        }

        $this->demis([
            "Djulchindra",
        ]);


    }

    public function demis($nama)
    {
        $ang=anggota::with('kepengurusan');
        $now=Carbon::now();
        foreach ($nama as $key => $value) 
        {
            $ganti=$ang->where('nama',$value)->first();
            $ganti->kepengurusan->tanggal_demisioner=$now;
            $ganti->kepengurusan->save();
        }
    }
}
