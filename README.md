## Janji  
Saya **Mohammad Mudrik Mujayyin** dengan **NIM 2407142** mengerjakan Tugas Praktikum 10 pada Mata Kuliah **Desain dan Pemrograman Berorientasi Objek (DPBO)** untuk keberkahan-Nya. Maka saya **tidak melakukan kecurangan** seperti yang telah dispesifikasikan.  
*Aamiin.*

---

# Struktur Folder

## Struktur Folder

```plaintext
TP10DPBO2425C2/
├── db_motogp.sql
├── README.md
└── motogp_app/
    ├── config/
    │   └── database.php
    ├── assets/
    │   └── style.css
    ├── models/
    │   ├── Team.php
    │   ├── Rider.php
    │   ├── Sponsor.php
    │   └── Motor.php
    ├── view_models/
    │   ├── TeamViewModel.php
    │   ├── RiderViewModel.php
    │   ├── SponsorViewModel.php
    │   └── MotorViewModel.php
    ├── views/
    │   ├── includes/
    │   ├── teams/
    │   ├── riders/
    │   ├── sponsors/
    │   └── motors/
    └── index.php
```


---

# Desain Database

Tema: **MotoGP Garage Management**  
Relasi yang digunakan:

- Team → Rider (One-to-Many)  
- Team → Sponsor (One-to-Many)  
- Rider → Motor (One-to-Many)

---

## Tabel: `teams`

| Atribut    | Tipe Data | Keterangan |
|-----------|-----------|------------|
| id_team   | INT       | PK, Auto Increment |
| nama_team | VARCHAR   | Nama tim |
| manager   | VARCHAR   | Manager tim |
| markas    | VARCHAR   | Negara markas |

---

## Tabel: `riders`

| Atribut      | Tipe Data | Keterangan |
|--------------|-----------|------------|
| id_rider     | INT       | PK |
| id_team      | INT       | FK → teams |
| nama_rider   | VARCHAR   | Nama rider |
| nomor_start  | INT       | Nomor balap |
| negara_asal  | VARCHAR   | Asal negara |

---

## Tabel: `sponsors`

| Atribut       | Tipe Data | Keterangan |
|----------------|-----------|------------|
| id_sponsor     | INT       | PK |
| id_team        | INT       | FK → teams |
| nama_sponsor   | VARCHAR   | Nama sponsor |
| jenis_bidang   | VARCHAR   | Bidang industri |
| nilai_kontrak  | BIGINT    | Nilai kontrak USD |

---

## Tabel: `motors`

| Atribut       | Tipe Data | Keterangan |
|----------------|-----------|------------|
| id_motor       | INT       | PK |
| id_rider       | INT       | FK → riders |
| merk_mesin     | VARCHAR   | Merk mesin |
| kapasitas_cc   | INT       | CC mesin |
| top_speed_kmh  | INT       | Top speed |

---

# Fitur CRUD

## 1. Teams
- Create: Tambah tim baru  
- Read: List semua tim  
- Update: Ubah data tim  
- Delete: Hapus tim (cascade ke rider & sponsor)

## 2. Riders
- Create: Tambah rider + pilih tim  
- Read: Tampilkan rider + nama tim (JOIN)  
- Update: Edit data rider  
- Delete: Hapus rider  

## 3. Sponsors
- Create: Tambah sponsor  
- Read: List sponsor + tim & kontrak  
- Update: Edit nilai/jenis sponsor  
- Delete: Hapus sponsor  

## 4. Motors
- Create: Tambah motor untuk rider  
- Read: Motor + nama rider (JOIN)  
- Update: Upgrade spesifikasi  
- Delete: Hapus motor  

---

# Alur Program (MVVM)

## 1. View (views/)
- Menampilkan UI  
- Tidak ada query  

## 2. ViewModel (view_models/)
- Menerima input dari View  
- Memanggil Model  
- Mengirim data kembali ke View  
- Menyediakan data relasi (dropdown team/rider)

## 3. Model (models/)
- Menjalankan query SQL via PDO  
- Berisi operasi CRUD  
- JOIN antar tabel  

## 4. Routing (index.php)
- Dashboard  
- Navigasi ke modul  
- Entry point utama

---

# Dokumentasi


https://github.com/user-attachments/assets/cfe93c68-ecf1-4eee-b968-9c03b7cd0363


---
