import time
from playwright.sync_api import sync_playwright, TimeoutError

def run(playwright):
    assertions_passed = 0
    start_time = time.time()

    browser = playwright.chromium.launch(headless=False)
    page = browser.new_page()

    # Login
    page.goto("http://127.0.0.1:8000/login")
    page.fill('#identifier', 'aldo@gmail.com')
    assertions_passed += 1
    page.fill('#password', 'haha1234')
    assertions_passed += 1
    page.click('button.btn.btn-warning.btn-sm')

    try:
        page.wait_for_url("http://127.0.0.1:8000/dashboard", timeout=10000)
        assertions_passed += 1
        print("Login Berhasil dan Masuk Dashboard")
    except TimeoutError:
        duration = time.time() - start_time
        print("Login Gagal")
        print(f"Test:  1 Failed ( {assertions_passed} Assertions Passed )")
        print(f"Duration: {duration:.2f}s")
        browser.close()
        return

    # Klik link Buka Toko
    try:
        page.click('a.text-sm')
        page.wait_for_url("http://127.0.0.1:8000/umkm/create", timeout=10000)
        assertions_passed += 1
    except Exception as e:
        duration = time.time() - start_time
        print(f"Gagal klik Buka Toko atau pindah halaman: {e}")
        print(f"Test:  1 Failed ( {assertions_passed} Assertions Passed )")
        print(f"Duration: {duration:.2f}s")
        browser.close()
        return

    # Isi form Register UMKM
    try:
        page.fill('#nama', 'UMKM Makanan Enak')
        assertions_passed += 1
        page.fill('#deskripsi', 'Deskripsi UMKM makanan enak dan lezat')
        assertions_passed += 1

        # Pilih kategori UMKM
        page.select_option('#kategori', label="Makanan dan Minuman")
        assertions_passed += 1

        page.fill('#link_whatsapp', 'https://wa.me/628123456789')
        assertions_passed += 1
        page.fill('#link_marketplace', 'https://shopee.co.id/umkm-enak')
        assertions_passed += 1
        page.fill('#alamat', 'Jl. Raya No.123, Bandung')
        assertions_passed += 1

        page.select_option('#kecamatan', label="Cimaung")
        assertions_passed += 1
        page.select_option('#desa', label="Cimaung")
        assertions_passed += 1

        page.fill('#link_google_maps', 'https://goo.gl/maps/examplelink')
        assertions_passed += 1
    except Exception as e:
        duration = time.time() - start_time
        print(f"Gagal mengisi form UMKM: {e}")
        print(f"Test:  1 Failed ( {assertions_passed} Assertions Passed )")
        print(f"Duration: {duration:.2f}s")
        browser.close()
        return

    # Klik tombol Daftar UMKM
    try:
        page.click('#buttondaftar')
        # Tunggu redirect ke dashboard sebagai tanda submit berhasil
        page.wait_for_url("http://127.0.0.1:8000/dashboard", timeout=10000)
        assertions_passed += 1
    except Exception as e:
        duration = time.time() - start_time
        print(f"Gagal submit form UMKM atau pindah halaman: {e}")
        print(f"Test:  1 Failed ( {assertions_passed} Assertions Passed )")
        print(f"Duration: {duration:.2f}s")
        browser.close()
        return

    duration = time.time() - start_time
    print("Register UMKM Berhasil")
    print(f"Test:  1 Passed ( {assertions_passed} Assertions )")
    print(f"Duration: {duration:.2f}s")

    browser.close()

with sync_playwright() as playwright:
    run(playwright)
