import time
from playwright.sync_api import sync_playwright, TimeoutError

def run(playwright):
    assertions_passed = 0
    start_time = time.time()

    browser = playwright.chromium.launch(headless=False)
    page = browser.new_page()

    # Login
    page.goto("http://127.0.0.1:8000/login")
    page.fill('#identifier', 'hilmy@gmail.com')
    assertions_passed += 1
    page.fill('#password', 'haha1234')
    assertions_passed += 1
    with page.expect_navigation(url="http://127.0.0.1:8000/dashboard", timeout=10000):
        page.click('button.btn.btn-warning.btn-sm')
    assertions_passed += 1
    print("Login Berhasil dan Masuk Dashboard")

    # Klik "atur toko" lalu back
    try:
        with page.expect_navigation(timeout=10000):
            page.click('a.text-sm.font-semibold.leading-6.text-white.flex.items-center.space-x-2')
        assertions_passed += 1
        print("Berhasil klik 'atur toko' dan masuk halaman toko")
        page.go_back()
        page.wait_for_load_state("load", timeout=10000)
    except Exception as e:
        duration = time.time() - start_time
        print(f"Gagal klik 'atur toko' atau kembali page sebelumnya: {e}")
        print(f"Test: 1 Failed ({assertions_passed} Assertions Passed)")
        print(f"Duration: {duration:.2f}s")
        browser.close()
        return

    # Klik "profil umkm saya" lalu back
    try:
        with page.expect_navigation(timeout=10000):
            page.click('a.btn:nth-child(4)')
        assertions_passed += 1
        print("Berhasil klik 'profil umkm saya' dan masuk halaman profil UMKM")
        page.go_back()
        page.wait_for_load_state("load", timeout=10000)
    except Exception as e:
        duration = time.time() - start_time
        print(f"Gagal klik 'profil umkm saya' atau kembali page sebelumnya: {e}")
        print(f"Test: 1 Failed ({assertions_passed} Assertions Passed)")
        print(f"Duration: {duration:.2f}s")
        browser.close()
        return

    # Klik "Upload Produk" lalu back
    try:
        with page.expect_navigation(timeout=10000):
            page.click('a.btn-success:nth-child(2)')
        assertions_passed += 1
        print("Berhasil klik 'Upload Produk' dan masuk halaman upload")
        page.go_back()
        page.wait_for_load_state("load", timeout=10000)
    except Exception as e:
        duration = time.time() - start_time
        print(f"Gagal klik 'Upload Produk' atau kembali page sebelumnya: {e}")
        print(f"Test: 1 Failed ({assertions_passed} Assertions Passed)")
        print(f"Duration: {duration:.2f}s")
        browser.close()
        return

    # Klik "Lihat Detail Produk" lalu back, selector sudah di-escape
    try:
        with page.expect_navigation(timeout=10000):
            page.click('a.btn.btn-primary.btn-sm.bg-blue-500.hover\\:bg-blue-700.text-white.font-bold.py\\-2.px\\-4.rounded')
        assertions_passed += 1
        print("Berhasil klik 'Lihat Detail Produk' dan masuk halaman detail produk")
        page.go_back()
        page.wait_for_load_state("load", timeout=10000)
    except Exception as e:
        duration = time.time() - start_time
        print(f"Gagal klik 'Lihat Detail Produk' atau kembali page sebelumnya: {e}")
        print(f"Test: 1 Failed ({assertions_passed} Assertions Passed)")
        print(f"Duration: {duration:.2f}s")
        browser.close()
        return

    duration = time.time() - start_time
    print(f"Test: 1 Passed ({assertions_passed} Assertions)")
    print(f"Duration: {duration:.2f}s")

    browser.close()

with sync_playwright() as playwright:
    run(playwright)
