import time
from playwright.sync_api import sync_playwright, TimeoutError

def run(playwright):
    assertions_passed = 0
    start_time = time.time()

    browser = playwright.chromium.launch(headless=False)
    page = browser.new_page()

    # Buka halaman login admin
    page.goto("http://127.0.0.1:8000/login")
    page.fill('#identifier', 'admin@123.su')
    assertions_passed += 1
    page.fill('#password', 'superadmin')
    assertions_passed += 1
    try:
        with page.expect_navigation(url="http://127.0.0.1:8000/admin", timeout=1000):
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

    duration = time.time() - start_time
    print(f"Test: 1 Passed ({assertions_passed} Assertions)")
    print(f"Duration: {duration:.2f}s")

    browser.close()

with sync_playwright() as playwright:
    run(playwright)
