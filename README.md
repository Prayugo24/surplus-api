<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

# Pengenalan
Ini adalah API CRUD (Create, Read, Update, Delete) yang memungkinkan pengguna untuk mengelola Produk Kategori dan gambar yang terkait. API ini dibangun menggunakan Laravel dan menggunakan Mysql sebagai database.

## Persyaratan
- PHP (versi minimal 7.4)
- Composer
- Database server MySQL (versi 5.7)


## Memulai

### instalasi
- Salin repositori ini menggunakan ``git clone <repo_url>``
- Buka direktori proyek dan jalankan ``composer install`` untuk menginstal dependensi.
- Buatlah database baru 

### Konfigurasi
- Salin file .env.example ke .env dan konfigurasi koneksi database ke env, contoh xample seperti di bawah
```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=surplus_project
DB_USERNAME=root
DB_PASSWORD=qwerty12345
```

- Generate kunci aplikasi Laravel.
```bash
php artisan key:generate
```
![Image 1](https://lh3.googleusercontent.com/_-CVxxlZSDGIFKFkUOf4iL8Ci8l47C1baiyfw9H88dWWoSXdDnUPwuGva8dwvXARjO4=w2400)

- Jalankan migrasi untuk membuat tabel-tabel database.
```bash
php artisan migrate
```

### Menjalankan server
- Untuk memulai server, jalankan perintah berikut:
```bash 
php artisan serve
```
- Screenshot

![Image 3](https://lh5.googleusercontent.com/DwnorEkJZTsBUyZNvf3EkdTw6DiLZwLUAlt7_4R2HqXZv4_xE24CDOAK8GJmtu0TTC8=w2400)

## Endpoint API

### Post Collection
```bash
https://api.postman.com/collections/2703503-768d9878-7634-4716-b241-3c91558912c2?access_key=PMAT-01GW85C7E1WEZXS4PEH4K1NKNC
```

- ### Membuat Category
```bash
POST http://127.0.0.1:8000/api/v1/categories
```
- form-data request:
```bash
    name: text
    enable: boolean
```

- Screenshot

![Image 4](https://lh5.googleusercontent.com/73pxcNyxLbwIhkqg4LVgdn3nD96mkn-BCCg58B8X0Tpwi_WR2O4VRvv-nnZvGKBQlx4=w2400)


- ### update category
```bash
POST http://127.0.0.1:8000/api/v1/categories/{id}
```
- form-data request:
```bash
    name: text
    enable: boolean
```

- Screenshot

![Image 5](https://lh5.googleusercontent.com/3iizhUl_J7yoN8Vt8CIGLSiZhrfYU7YejzmzkHkwved5SgbC4b2P_kiq7pSxwgdvjsM=w2400)


- ### Delete Category
```bash
DELETE http://127.0.0.1:8000/api/v1/categories/{id}
```

- Screenshot

![Image 5](https://lh6.googleusercontent.com/ZvE7JTvqXG0r2Ijn6w81jPvL8xtKyzvXUjPU05jiFk498zz_-niFPbSiJJzuulZLDmY=w2400)


- ### Mendapatkan semua category
```bash
GET http://127.0.0.1:8000/api/v1/categories/?start_index=0&record_count=10&name={text}&enable={boolean}
```
- Parameter query:
-- enable (opsional): Menyaring category berdasarkan status 
-- name (opsional): Menyaring category berdasarkan name
-- start_index: Parameter ini menentukan indeks awal data yang ingin ditampilkan. Jadi, jika kita ingin menampilkan data mulai dari indeks ke-0, maka nilainya harus diatur menjadi 0.
-- record_count: Parameter ini menentukan jumlah data maksimum yang ingin ditampilkan. Jadi, jika kita ingin menampilkan maksimal 10 data, maka nilainya harus diatur menjadi 10.

- Screenshot

![Image 6](https://lh6.googleusercontent.com/6RJRurMWiur8AdXxUL3aRJsrgF3TkClHETi6BKsZKpfPItOQ580PXjVaKvhNvJzakAI=w2400)


- ###  Mendapatkan Category berdasarkan ID
```bash
GET http://127.0.0.1:8000/api/v1/categories/{id}
```

- Screenshot

![Image 8](https://lh4.googleusercontent.com/YYAGqFl4LTLCwVMx1bFj2jm8G0FOabTUgt9JHPAU4alwRF94yXrOGDBYMW9gtIdaRaQ=w2400)


- ### Membuat product baru
```bash
POST http://127.0.0.1:8000/api/v1/products
```
- form-data request:
```bash
    name: Text
    description: Text
    enable: boolean
    enable_image: boolean
    category_id: (array integer xample)  1,2,3
    file: file
```

- Screenshot

![Image 9](https://lh5.googleusercontent.com/1lwuttizMXSJ8YrPlPKNwNfQWRz72z_Bi77UdDb6Xzg7hK8g_XEgyCl0dRHyIDm0Lkk=w2400)


- ### Memperbarui product
```bash
POST http://127.0.0.1:8000/api/v1/products/{id}
```
- form-data request:
```bash
    name: Text
    description: Text
    enable: boolean
    enable_image: boolean
    category_id: (array integer xample)  1,2,3
    file: file
```

- Screenshot

![Image 10](https://lh5.googleusercontent.com/f9RcPPi8wzomv5bLbNnQUmDHhnFr86MCDimBzMCwZG_ik8PtDd8ih2NB1fyTrnLo9xY=w2400)

- ### Menghapus product
```bash
DELETE http://127.0.0.1:8000/api/v1/products/{id}
```

- Screenshot

![Image 11](https://lh4.googleusercontent.com/ln1pvwZXkoBcDbPvNCE3jubFCqRsG5YCcag1lPwL8LR_op5XkWpRGpUcDj5TJ9LHWmU=w2400)

- ###  Mendapatkan product berdasarkan ID
```bash
GET http://127.0.0.1:8000/api/v1/products/{id}
```

- Screenshot

![Image 12](https://lh5.googleusercontent.com/vJ_rY3pEwtfRxiiwYiPwAsWfIZ5i3XEy14TBK_RuxLMv9OHZofGZiheI1oeKQQHxdVk=w2400)

- ### Mendapatkan semua product
```bash
GET http://127.0.0.1:8000/api/v1/products?name=test&start_index=0&record_count=10&enable=false
```
- Parameter query:
-- enable (opsional): Menyaring product berdasarkan status 
-- name (opsional): Menyaring product berdasarkan name
-- start_index: Parameter ini menentukan indeks awal data yang ingin ditampilkan. Jadi, jika kita ingin menampilkan data mulai dari indeks ke-0, maka nilainya harus diatur menjadi 0.
-- record_count: Parameter ini menentukan jumlah data maksimum yang ingin ditampilkan. Jadi, jika kita ingin menampilkan maksimal 10 data, maka nilainya harus diatur menjadi 10.


- Screenshot

![Image 13](https://lh3.googleusercontent.com/H6oD2vuiBJAD6twpSqtGE0nG6eLmjIzukqR31Uu1WGE5-GVYHlB8vp7vMbYJQzNN3-0=w2400)


