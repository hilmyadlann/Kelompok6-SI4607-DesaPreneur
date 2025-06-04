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
    page.click('button.btn.btn-warning.btn-sm')

    try:
        page.wait_for_url("http://127.0.0.1:8000/dashboard", timeout=10000)
        assertions_passed += 1
        print("Login Berhasil dan Masuk Dashboard")
    except TimeoutError:
        duration = time.time() - start_time
        print("Login Gagal")
        print(f"Test: 1 Failed ({assertions_passed} Assertions Passed)")
        print(f"Duration: {duration:.2f}s")
        browser.close()
        return

    # Klik produk di halaman Our Product
    try:
        selector_produk = 'div.col-span-1:nth-child(1) > a:nth-child(1) > div:nth-child(1) > img:nth-child(1)'
        page.click(selector_produk)
        page.wait_for_url("http://127.0.0.1:8000/products/16", timeout=10000)
        assertions_passed += 1
        print("Berhasil masuk halaman detail produk")
    except Exception as e:
        duration = time.time() - start_time
        print(f"Gagal klik produk atau pindah ke detail produk: {e}")
        print(f"Test: 1 Failed ({assertions_passed} Assertions Passed)")
        print(f"Duration: {duration:.2f}s")
        browser.close()
        return

    # Klik Button Hubungi Penjual dengan selector salah agar gagal
    try:
        page.click('a.flex-salah:nth-child(1)')  # selector salah sengaja
        assertions_passed += 1
    except Exception as e:
        duration = time.time() - start_time
        print(f"Gagal klik Button Hubungi Penjual: {e}")
        print(f"Test: 1 Failed ({assertions_passed} Assertions Passed)")
        print(f"Duration: {duration:.2f}s")
        browser.close()
        return

    # (Langkah lain tidak dijalankan karena sudah gagal di atas)

with sync_playwright() as playwright:
    run(playwright)
