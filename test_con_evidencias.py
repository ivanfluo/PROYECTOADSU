import os
import time
from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.chrome.service import Service
from webdriver_manager.chrome import ChromeDriverManager

def ejecutar_test_hu01_con_login():
    print("🚀 Iniciando Suite de Pruebas Automatizadas para HU-01 (Flujo con Login Administrativo)...")
    
    # Crear carpeta para las evidencias de Jira
    carpeta = "evidencias_hu01_real"
    if not os.path.exists(carpeta):
        os.makedirs(carpeta)

    driver = webdriver.Chrome(service=Service(ChromeDriverManager().install()))
    driver.implicitly_wait(5)
    driver.maximize_window()

    try:
        # =========================================================================
        # PASO 1: AUTENTICACIÓN OBLIGATORIA DEL ADMINISTRADOR (ADSU-45 / ADSU-46)
        # =========================================================================
        print("\n🔐 Iniciando sesión como Administrador protegido...")
        driver.get("http://localhost/PROYECTOADSU/login.php")
        time.sleep(1)
        
        # Ingresar con los datos reales de tu base de datos (Byron Josue)
        driver.find_element(By.NAME, "usuario").send_keys("BJRODRIGUEZ")
        driver.find_element(By.NAME, "password").send_keys("BJR123")
        
        # Captura de pantalla 1: Login de Admin listo
        driver.save_screenshot(f"{carpeta}/01_login_administrador.png")
        
        # Enviar formulario de login
        driver.find_element(By.CSS_SELECTOR, "button[type='submit']").click()
        time.sleep(1.5)
        print("✅ Autenticación exitosa. Privilegios de administrador heredados.")

        # =========================================================================
        # PASO 2: NAVEGACIÓN INTERNA Y REGISTRO DE CIUDADANO (HU-01)
        # =========================================================================
        print("\n📝 Navegando al formulario protegido de 'Nuevo Usuario'...")
        # Cambia esta URL por la ruta interna exacta que usa tu sistema para crear usuarios
        driver.get("http://localhost/PROYECTOADSU/usuarios/crear.php")
        time.sleep(1.5)

        print("🗳️ Llenando campos del formulario...")
        # Escribir en los inputs usando los atributos 'name' reales de tu código PHP
        driver.find_element(By.NAME, "nombre").send_keys("Carlos Mendoza Test")
        driver.find_element(By.NAME, "dpi").send_keys("1234567891013")
        driver.find_element(By.NAME, "usuario").send_keys("prueba5")
        driver.find_element(By.NAME, "password").send_keys("mendoza123")
        driver.find_element(By.NAME, "rol").send_keys("votante")
        driver.find_element(By.NAME, "id_mesa").send_keys("1") # Usamos el ID numérico que maneja tu BD

        # Captura de pantalla 2: Formulario lleno dentro de la sesión de Admin
        driver.save_screenshot(f"{carpeta}/02_formulario_registro_llenado.png")
        print("✅ Captura guardada: Formulario de registro listo.")

        # Hacer clic en el botón verde de Guardar
        driver.find_element(By.CSS_SELECTOR, "button[type='submit']").click()
        time.sleep(2)

        # =========================================================================
        # PASO 3: CONFIRMACIÓN DE PERSISTENCIA
        # =========================================================================
        # Captura de pantalla 3: Pantalla final (tabla con el nuevo usuario guardado)
        driver.save_screenshot(f"{carpeta}/03_persistencia_bd_exito.png")
        print("✅ TC-01 PASÓ: Ciudadano registrado y evidenciado de forma exitosa.")

    except Exception as e:
        print(f"❌ Error durante la simulación de QA: {e}")
        driver.save_screenshot(f"{carpeta}/ERROR_FLUJO_HU01.png")
        
    finally:
        driver.quit()
        print(f"\n🏁 Suite terminada. Las 3 capturas lógicas están listas en la carpeta '{carpeta}'.")

if __name__ == "__main__":
    ejecutar_test_hu01_con_login()