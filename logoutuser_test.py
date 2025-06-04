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
    
    # Klik ikon dropdown profile dan tunggu dropdown muncul
    try:
        page.click('#profileDropdown svg.h-5')
        # Tunggu tombol logout muncul dan visible
        page.wait_for_selector('form[action="http://127.0.0.1:8000/logout"] button[type="submit"]', state='visible', timeout=5000)
        assertions_passed += 1
    except Exception as e:
        duration = time.time() - start_time
        print(f"Gagal klik ikon dropdown profile atau menunggu dropdown: {e}")
        print(f"Test: 1 Failed ({assertions_passed} Assertions Passed)")
        print(f"Duration: {duration:.2f}s")
        browser.close()
        return
    
    # Klik tombol logout setelah visible
    try:
        page.click('form[action="http://127.0.0.1:8000/logout"] button[type="submit"]')
        page.wait_for_url("http://127.0.0.1:8000/", timeout=10000)
        assertions_passed += 1
        print("Logout Berhasil dan Kembali ke Halaman Login")
    except Exception as e:
        duration = time.time() - start_time
        print(f"Gagal klik tombol logout atau pindah halaman login: {e}")
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
