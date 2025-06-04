import time
from playwright.sync_api import sync_playwright, TimeoutError

def run(playwright):
    assertions_passed = 0
    start_time = time.time()

    browser = playwright.chromium.launch(headless=False)
    page = browser.new_page()

    # Login dengan data benar
    page.goto("http://127.0.0.1:8000/login")
    page.fill('#identifier', 'hilmy@gmail.com')
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

    # Gagal pilih desa (label desa tidak ada)
    try:
        page.select_option('#desaSelect', label="DesaTidakAda")  # label yang tidak ada
        assertions_passed += 1
    except Exception as e:
        duration = time.time() - start_time
        print(f"Gagal memilih desa: {e}")
        print(f"Test:  1 Failed ( {assertions_passed} Assertions Passed )")
        print(f"Duration: {duration:.2f}s")
        browser.close()
        return

    # Gagal klik tombol Show UMKM (selector salah)
    try:
        page.click('.btn-tombol-salah', timeout=5000)
        page.wait_for_timeout(3000)
        assertions_passed += 1
    except Exception as e:
        duration = time.time() - start_time
        print(f"Gagal klik tombol Show UMKM: {e}")
        print(f"Test:  1 Failed ( {assertions_passed} Assertions Passed )")
        print(f"Duration: {duration:.2f}s")
        browser.close()
        return

    # Kalau sampai sini berarti tidak gagal (tidak akan terjadi karena sengaja pakai yang salah)
    duration = time.time() - start_time
    print(f"Test:  1 Passed ( {assertions_passed} Assertions )")
    print(f"Duration: {duration:.2f}s")

    browser.close()

with sync_playwright() as playwright:
    run(playwright)
