# Instrucciones de instalación y ejecución (Vite + Backend)

Guía rápida para que otro equipo/compañero pueda instalar y ejecutar este proyecto en Windows (PowerShell).

**Ubicación del proyecto:** `f:\adso\Trabajo` (ejemplo)

**Resumen:**
- Frontend: Vite (dev server en `5173` por defecto).
- Backend: Node/Express (carpeta `login 3`, escucha en `3000` por defecto).

---

## Requisitos previos
- Node.js (recomendado LTS — Node 18+). Descargar: https://nodejs.org/
- Git (opcional, si se va a clonar). Descargar: https://git-scm.com/
- MySQL si vas a usar la base de datos del backend (si no, la maqueta funciona sin backend).

## 1) Clonar o copiar el repositorio

Con Git (PowerShell):
```powershell
# clonar
git clone <REPO_URL>
cd Traductor
```

O copiar la carpeta del proyecto al equipo del compañero y abrir PowerShell en esa carpeta.

## 2) Instalar dependencias (frontend)
Desde la raíz del proyecto (donde está `package.json`):
```powershell
# instalar dependencias reproducibles
npm ci
# si no tienes package-lock.json
npm install
```

## 3) Instalar dependencias del backend (opcional)
Si usarás el backend que está en la carpeta `login 3`:
```powershell
cd "login 3"
npm ci
# o
npm install
```

Revisa el `package.json` dentro de `login 3` para confirmar scripts (`start` o `dev`).

## 4) Configurar la base de datos (si aplica)
- El backend (`login 3/app.js`) probablemente usa MySQL y credenciales en el código o variables.
- Revisa `app.js` y crea la base de datos `login` o ajusta los datos de conexión.
- Si el proyecto usa `.env`, crea un archivo `.env` en `login 3` con las variables necesarias.

Ejemplo rápido de variables (si se usan):
```
DB_HOST=localhost
DB_USER=root
DB_PASS=tu_password
DB_NAME=login
PORT=3000
```

## 5) Arrancar el backend (en una terminal separada)
```powershell
# desde f:\adso\Trabajo\login 3
node app.js
# o si hay script
npm start
```

Comprueba en la salida que el servidor escucha en el puerto esperado (ej. `3000`).

## 6) Arrancar Vite (frontend) — en otra terminal
Desde la raíz del proyecto:
```powershell
cd f:\adso\Trabajo
npm run dev
```

Si quieres que Vite sea accesible desde otros PCs en la LAN (útil para pruebas remotas):
```powershell
npm run dev -- --host
# o modificar package.json: "dev": "vite --host"
```

## 7) Acceso desde otro PC y Firewall
- Si tu compañero necesita acceder desde otra máquina, permite el puerto `5173` (Vite) y `3000` (backend) en el Firewall de Windows.

## 8) CORS
- El backend suele tener CORS configurado para `http://localhost:5173`. Si sirves desde otra IP/host, añade ese origen o usa `origin: '*'` temporalmente para pruebas.

## 9) Build y servir (producción)
```powershell
npm run build
# luego servir la carpeta dist (por ejemplo con 'serve')
npx serve -s dist
# o instalar serve global
npm i -g serve
serve -s dist
```

## Resolución de problemas comunes
- `npm run dev` falla con Exit Code 1:
  - Ejecuta `npm ci` o `npm install` y revisa errores de instalación.
  - Verifica la versión de Node: `node -v` (usar Node 18+ ayuda).
  - Revisa el log de salida completo y pégalo si necesitas ayuda.
- Backend no responde:
  - Asegúrate de que `node app.js` esté corriendo y que la DB esté accesible.
  - Revisa credenciales en `login 3/app.js` o variables de entorno.
- Errores de CORS:
  - Ajusta el origen permitido en el backend o arranca Vite con el mismo host/origen.

## Comandos de comprobación rápidos
```powershell
# verificar node/npm
node -v
npm -v
# comprobar que node_modules existe
ls node_modules
# ver scripts
cat package.json
```

## Opcional: script de ayuda (PowerShell)
Si quieres, puedo añadir un script `setup.ps1` que automatice `npm ci` e intente arrancar frontend/backend (en ventanas separadas). ¿Quieres que lo genere? 

---

Si el compañero tiene algún error concreto (salida completa de `npm run dev` o logs del backend), pégalos aquí y te ayudo a resolverlo.

*** Fin de la guía ***

*** Nota: archivo generado automáticamente por el entorno de desarrollo del proyecto. ***
