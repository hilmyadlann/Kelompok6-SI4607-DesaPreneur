import time
from playwright.sync_api import sync_playwright, TimeoutError

def run(playwright):
    assertions_passed = 0
    start_time = time.time()

    browser = playwright.chromium.launch(headless=False)
    page = browser.new_page()

    # Login Admin
    page.goto("http://127.0.0.1:8000/login")
    page.fill('#identifier', 'admin@123.su')
    assertions_passed += 1
    page.fill('#password', 'superuser')
    assertions_passed += 1
    try:
        with page.expect_navigation(url="http://127.0.0.1:8000/admin", timeout=10000):
            page.click('button.btn.btn-warning.btn-sm')
        assertions_passed += 1
        print("Login Admin Berhasil dan Masuk Dashboard Admin")
    except TimeoutError:
        duration = time.time() - start_time
        print("Login Admin Gagal")
        print(f"Test: 1 Failed ({assertions_passed} Assertions Passed)")
        print(f"Duration: {duration:.2f}s")
        browser.close()
        return

    # Klik Tambah Kecamatan dan Desa
    try:
        with page.expect_navigation(url="http://127.0.0.1:8000/admin/form-umk", timeout=10000):
            page.click('a.flex.items-center.px-4.py-2.rounded.mb-2.bg-green-600')
        assertions_passed += 1
        print("Berhasil klik 'Tambah Kecamatan dan Desa' dan masuk halaman form")
    except TimeoutError:
        duration = time.time() - start_time
        print("Gagal klik 'Tambah Kecamatan dan Desa' atau pindah halaman")
        print(f"Test: 1 Failed ({assertions_passed} Assertions Passed)")
        print(f"Duration: {duration:.2f}s")
        browser.close()
        return

    # Mengisi Nama Kecamatan dan Nama Desa
    try:
        page.fill('#nama_kecamatan', 'Bandung Wetan')
        assertions_passed += 1
        page.fill('#nama_desa', 'Sukajadi')
        assertions_passed += 1
        print("Berhasil mengisi nama kecamatan dan nama desa")
    except Exception as e:
        duration = time.time() - start_time
        print(f"Gagal mengisi form kecamatan dan desa: {e}")
        print(f"Test: 1 Failed ({assertions_passed} Assertions Passed)")
        print(f"Duration: {duration:.2f}s")
        browser.close()
        return

    # Klik tombol Tambah Kecamatan dan Desa
    try:
        page.click('button.items-center:nth-child(1)')
        page.wait_for_load_state('networkidle', timeout=10000)
        assertions_passed += 1
        print("Berhasil klik tombol 'Tambah kecamatan dan desa'")
    except Exception as e:
        duration = time.time() - start_time
        print(f"Gagal klik tombol 'Tambah kecamatan dan desa': {e}")
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
