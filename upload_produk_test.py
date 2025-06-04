import time
from playwright.sync_api import sync_playwright, TimeoutError

def run(playwright):
    assertions_passed = 0
    start_time = time.time()

    browser = playwright.chromium.launch(headless=False)
    page = browser.new_page()

    # Tangani dialog JS alert jika ada
    def handle_dialog(dialog):
        print(f"Dialog muncul: {dialog.message}")
        dialog.accept()
    page.on("dialog", handle_dialog)

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
        print(f"Test:  1 Failed ({assertions_passed} Assertions Passed)")
        print(f"Duration: {duration:.2f}s")
        browser.close()
        return

    # Klik buka toko
    try:
        page.click('a.text-sm')
        page.wait_for_load_state('load', timeout=10000)
        current_url = page.url
        print(f"Setelah klik Buka Toko, pindah ke URL: {current_url}")
        assertions_passed += 1
    except Exception as e:
        duration = time.time() - start_time
        print(f"Gagal klik Buka Toko atau pindah halaman: {e}")
        print(f"Test:  1 Failed ({assertions_passed} Assertions Passed)")
        print(f"Duration: {duration:.2f}s")
        browser.close()
        return

    # Akses halaman toko 8
    try:
        page.goto("http://127.0.0.1:8000/toko/8")
        assertions_passed += 1
    except Exception as e:
        duration = time.time() - start_time
        print(f"Gagal akses halaman toko: {e}")
        print(f"Test:  1 Failed ({assertions_passed} Assertions Passed)")
        print(f"Duration: {duration:.2f}s")
        browser.close()
        return

    # Klik button Upload Produk
    try:
        page.click('a.btn:nth-child(2)')
        page.wait_for_url("http://127.0.0.1:8000/products-tes/upload", timeout=10000)
        assertions_passed += 1
    except Exception as e:
        duration = time.time() - start_time
        print(f"Gagal klik Upload Produk atau pindah halaman: {e}")
        print(f"Test:  1 Failed ({assertions_passed} Assertions Passed)")
        print(f"Duration: {duration:.2f}s")
        browser.close()
        return

    # Isi form Upload Produk tapi pakai selector gambar salah supaya gagal
    try:
        page.fill('div.form-control:nth-child(2) > input:nth-child(2)', 'Produk Pakaian Keren')
        assertions_passed += 1
        page.fill('.textarea', 'Deskripsi produk pakaian keren dan trendy')
        assertions_passed += 1
        page.fill('input[name="price"]', '150000')
        assertions_passed += 1
        page.select_option('select.select.select-bordered', label='Pakaian')
        assertions_passed += 1
        page.fill('input[name="marketplace_link"]', 'https://shopee.co.id/umkm-enak')
        assertions_passed += 1

        # Upload gambar dengan selector salah supaya gagal
        page.wait_for_selector('.file-input-salah', state='visible', timeout=5000)  # selector salah
        file_path = r"C:\Users\PULSE15\Downloads\Screenshot 2025-05-26 114919.png"
        page.set_input_files('.file-input-salah', file_path)
        assertions_passed += 1

    except Exception as e:
        duration = time.time() - start_time
        print(f"Gagal isi form Upload Produk: {e}")
        print(f"Test:  1 Failed ({assertions_passed} Assertions Passed)")
        print(f"Duration: {duration:.2f}s")
        browser.close()
        return

    # Klik button Upload Produk dengan selector salah supaya gagal
    try:
        page.click('button.bg-green-500-salah')  # selector salah
        assertions_passed += 1

        page.wait_for_url("http://127.0.0.1:8000/products-tes/upload", timeout=10000)
        assertions_passed += 1

        print("Produk Berhasil Di Upload")
    except Exception as e:
        duration = time.time() - start_time
        print(f"Gagal submit Upload Produk: {e}")
        print(f"Test:  1 Failed ({assertions_passed} Assertions Passed)")
        print(f"Duration: {duration:.2f}s")
        browser.close()
        return

    duration = time.time() - start_time
    print(f"Test:  1 Passed ({assertions_passed} Assertions)")
    print(f"Duration: {duration:.2f}s")

    browser.close()

with sync_playwright() as playwright:
    run(playwright)
