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
    with page.expect_navigation(url="http://127.0.0.1:8000/admin", timeout=10000):
        page.click('button.btn.btn-warning.btn-sm')
    assertions_passed += 1
    print("Login Admin Berhasil dan Masuk Dashboard Admin")

    # Klik tombol Logout, klik konfirmasi "Ya", lalu tunggu redirect login
    try:
        page.click('button.flex.items-center.w-full.text-left.px-4.py-2.rounded.hover\\:bg-green-600')
        page.wait_for_selector('button.bg-red-600', timeout=5000)
        page.click('button.bg-red-600')
        page.wait_for_url("http://127.0.0.1:8000/", timeout=1000)
        assertions_passed += 1
        print("Logout Admin Berhasil dan Kembali ke Halaman Login")
    except Exception as e:
        duration = time.time() - start_time
        print(f"Gagal klik tombol logout, konfirmasi, atau kembali ke halaman login: {e}")
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
