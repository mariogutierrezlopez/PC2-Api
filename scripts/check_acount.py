import sys
from selenium import webdriver
from selenium.webdriver.common.by import By

def check_account_exists(email, password):
    login_url = 'https://mister.mundodeportivo.com/new-onboarding/auth/email'  # Cambia esto a la URL correcta
    driver = webdriver.Chrome()  # Usa el controlador correcto para tu navegador

    driver.get(login_url)

    # Espera a que el botón de aceptar cookies aparezca y haz clic en él
    driver.implicitly_wait(10)  # Espera hasta 10 segundos para que la página cargue
    try:
        accept_cookies_button = driver.find_element(By.ID, 'didomi-notice-agree-button')
        accept_cookies_button.click()
    except:
        print("Botón de aceptar cookies no encontrado o no necesario.")

    # Encuentra los campos de entrada y el botón de inicio de sesión
    email_field = driver.find_element(By.ID, 'email')
    password_field = driver.find_element(By.XPATH, '//input[@placeholder="Contraseña"]')
    submit_button = driver.find_element(By.XPATH, '//button[@type="submit" and contains(@class, "btn--capsule") and contains(@class, "btn--primary")]')

    # Rellena el formulario y envía
    email_field.send_keys(email)
    password_field.send_keys(password)
    submit_button.click()

    # Espera a que la página cargue y verifica si el inicio de sesión fue exitoso
    driver.implicitly_wait(10)  # Espera hasta 10 segundos para que la página cargue

    # Verifica si la URL ha cambiado
    if driver.current_url != login_url:  # Si la URL es diferente, el inicio de sesión fue exitoso
        driver.quit()
        print("Cuenta existe: True")
    else:
        driver.quit()
        print("Cuenta existe: False")

if __name__ == '__main__':
    email = sys.argv[1]
    password = sys.argv[2]
    check_account_exists(email, password)
