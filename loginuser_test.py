from playwright.sync_api import sync_playwright, TimeoutError
import time

def run(playwright):
    assertions_passed = 0
    start_time = time.time()

    browser = playwright.chromium.launch(headless=False)
    page = browser.new_page()

    page.goto("http://127.0.0.1:8000/login")

    page.fill('#identifier', 'hilmy@gmail.com')
    assertions_passed += 1  # input email berhasil

    page.fill('#password', 'salah')
    assertions_passed += 1  # input password berhasil

    page.click('button.btn.btn-warning.btn-sm')

    try:
        page.wait_for_url("http://127.0.0.1:8000/dashboard", timeout=10000)
        assertions_passed += 1
        print("Login Berhasil dan Masuk Dashboard")
        
        print(f"Test:  1 Passed ( {assertions_passed} Assertions )")
    except TimeoutError:
        print("Login Gagal atau Belum Masuk Dashboard")

        print(f"Test:  1 Failed ( {assertions_passed} Assertions Passed )")

    duration = time.time() - start_time
    print(f"Duration: {duration:.2f}s")

    browser.close()

with sync_playwright() as playwright:
    run(playwright)
