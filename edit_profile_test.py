import time
from playwright.sync_api import sync_playwright, TimeoutError

def run(playwright):
    assertions_passed = 0
    start_time = time.time()

    browser = playwright.chromium.launch(headless=False)
    page = browser.new_page()

    # Login
    page.goto("http://127.0.0.1:8000/login")
    page.fill('#identifier', 'testing1@gmail.com')
    assertions_passed += 1
    page.fill('#password', 'testing123')
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

    # Klik menu profile
    try:
        page.click("http://127.0.0.1:8000/user/profile")
        page.wait_for_url("http://127.0.0.1:8000/user/profile", timeout=2000)
        assertions_passed += 1
        print("Berhasil masuk halaman detail profile")
    except Exception as e:
        duration = time.time() - start_time
        print(f"Gagal klik menu profile atau pindah halaman: {e}")
        print(f"Test: 1 Failed ({assertions_passed} Assertions Passed)")
        print(f"Duration: {duration:.2f}s")
        browser.close()
        return

    # Isi Profile Information
    try:
        page.fill('#name', 'Testing User Updated')
        assertions_passed += 1
        page.fill('#email', 'testing1updated@gmail.com')
        assertions_passed += 1
        page.click('.py-10 > div:nth-child(1) > div:nth-child(2) > form:nth-child(1) > div:nth-child(2) > button:nth-child(2)')
        assertions_passed += 1
    except Exception as e:
        duration = time.time() - start_time
        print(f"Gagal isi atau submit Profile Information: {e}")
        print(f"Test: 1 Failed ({assertions_passed} Assertions Passed)")
        print(f"Duration: {duration:.2f}s")
        browser.close()
        return

    # Isi Update Password
    try:
        page.fill('#current_password', 'testing123')
        assertions_passed += 1
        page.fill('#password', 'testing1234')
        assertions_passed += 1
        page.fill('#password_confirmation', 'testing1234')
        assertions_passed += 1
        page.click('div.mt-10:nth-child(3) > div:nth-child(1) > div:nth-child(2) > form:nth-child(1) > div:nth-child(2) > button:nth-child(2)')
        assertions_passed += 1
    except Exception as e:
        duration = time.time() - start_time
        print(f"Gagal isi atau submit Update Password: {e}")
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
