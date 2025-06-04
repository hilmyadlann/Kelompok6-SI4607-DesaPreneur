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
        duration = time.time() - start_time
        print("Login Gagal")
        print(f"Test:  1 Failed ( {assertions_passed} Assertions Passed )")
        print(f"Duration: {duration:.2f}s")
        browser.close()
        return

    # Selector kategori produk
    kategori_selectors = [
        'a.h-full:nth-child(1) > div:nth-child(1) > div:nth-child(1)',               # Makanan dan Minuman
        'a.h-full:nth-child(2) > div:nth-child(1) > div:nth-child(1) > img:nth-child(1)',  # Kerajinan Tangan
        'a.h-full:nth-child(3) > div:nth-child(1) > div:nth-child(1)',               # Kebutuhan Sehari-hari
        'a.h-full:nth-child(4) > div:nth-child(1)',                                  # Pakaian
        'a.h-full:nth-child(5) > div:nth-child(1)'                                   # Lainnya
    ]

    # Klik semua kategori satu per satu
    try:
        for selector in kategori_selectors:
            page.click(selector, timeout=5000)
            assertions_passed += 1
            # Bisa ditambahkan tunggu konten kategori muncul jika perlu
            time.sleep(1)  # jeda singkat agar proses klik tidak terlalu cepat
    except Exception as e:
        duration = time.time() - start_time
        print(f"Gagal klik kategori: {e}")
        print(f"Test:  1 Failed ( {assertions_passed} Assertions Passed )")
        print(f"Duration: {duration:.2f}s")
        browser.close()
        return

    duration = time.time() - start_time

    print(f"Berhasil Mengklik Semua Kategori Produk")
    print(f"Test:  1 Passed ( {assertions_passed} Assertions )")
    print(f"Duration: {duration:.2f}s")

    browser.close()

with sync_playwright() as playwright:
    run(playwright)
