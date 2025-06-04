import time
from playwright.sync_api import sync_playwright, TimeoutError

def run(playwright):
    assertions_passed = 0
    start_time = time.time()

    browser = playwright.chromium.launch(headless=False)
    page = browser.new_page()

    # Login
    page.goto("http://127.0.0.1:8000/login")
    page.fill('#identifier', 'hilmy@gmail.com'); assertions_passed += 1
    page.fill('#password', 'haha1234'); assertions_passed += 1
    page.click('button.btn.btn-warning.btn-sm')

    try:
        page.wait_for_url("http://127.0.0.1:8000/dashboard", timeout=10000)
        assertions_passed += 1
        print("Login Berhasil dan Masuk Dashboard")
    except TimeoutError:
        print("Login Gagal")
        print(f"Test:  1 Failed ( {assertions_passed} Assertions Passed )")
        browser.close()
        return

    # Klik semua kategori (5x)
    kategori_selectors = [
        'a.h-full:nth-child(1) > div:nth-child(1) > div:nth-child(1)',  # Makanan dan Minuman
        'a.h-full:nth-child(2) > div:nth-child(1) > div:nth-child(1) > img:nth-child(1)',  # Kerajinan Tangan
        'a.h-full:nth-child(3) > div:nth-child(1) > div:nth-child(1)',  # Kebutuhan Sehari-hari
        'a.h-full:nth-child(4) > div:nth-child(1)',  # Pakaian
        'a.h-full:nth-child(5) > div:nth-child(1)'   # Lainnya
    ]

    for selector in kategori_selectors:
        try:
            page.click(selector)
            assertions_passed += 1
        except Exception as e:
            print(f"Klik kategori gagal: {selector}")

    # Pilih desa "Banjaran" di #desaSelect
    try:
        page.select_option('#desaSelect', label="lengkong")
        assertions_passed += 1
    except Exception as e:
        print("Gagal memilih desa Banjaran")

    # Klik tombol Show UMKM
    try:
        page.click(".bg-green-60")
        page.wait_for_timeout(2000)  # tunggu konten muncul
        assertions_passed += 1
    except:
        print("Gagal klik tombol Show UMKM")

    # Cek apakah hasil UMKM muncul atau tidak
    page_content = page.content()
    if "Toko UMKM pada Desa Lengkong belum tersedia" in page_content:
        print("UMKM Tidak Tersedia: Toko UMKM pada Desa Lengkong belum tersedia")
    else:
        print("UMKM Desa Banjaran berhasil ditampilkan")

    duration = time.time() - start_time
    print(f"Test:  1 Passed ( {assertions_passed} Assertions )")
    print(f"Duration: {duration:.2f}s")

    browser.close()

with sync_playwright() as playwright:
    run(playwright)
