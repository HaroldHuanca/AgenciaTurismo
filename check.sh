#!/bin/bash
# ───────────────────────────────────────────────
# Verificador de permisos y configuración Laravel + XAMPP
# Autor: HaroldUser (versión asistida por ChatGPT 😎)
# ───────────────────────────────────────────────

# Ruta del proyecto
PROYECTO="/home/HaroldUser/Documentos/Pruebas_y_Calidad/AgenciaTurismo"
VHOST_FILE="/opt/lampp/etc/extra/httpd-vhosts.conf"
HTTPD_FILE="/opt/lampp/etc/httpd.conf"
ERROR_LOG="/opt/lampp/logs/error_log"

echo "🔍 Verificando configuración de Laravel en: $PROYECTO"
echo "──────────────────────────────────────────────"

# 1. Comprobar existencia del proyecto
if [ ! -d "$PROYECTO" ]; then
    echo "❌ El directorio $PROYECTO no existe."
    exit 1
else
    echo "✅ Proyecto encontrado."
fi

# 2. Comprobar carpeta public/
if [ ! -d "$PROYECTO/public" ]; then
    echo "❌ Falta la carpeta 'public/'."
else
    echo "✅ Carpeta 'public/' encontrada."
fi

# 3. Verificar .htaccess
if [ ! -f "$PROYECTO/public/.htaccess" ]; then
    echo "⚠️ No se encontró el archivo .htaccess en 'public/'."
else
    echo "✅ Archivo .htaccess presente."
fi

# 4. Revisar permisos
echo "──────────────────────────────────────────────"
echo "📁 Verificando permisos..."

find "$PROYECTO" -type d -perm 755 > /dev/null 2>&1
if [ $? -eq 0 ]; then
    echo "✅ Permisos de directorios correctos (755)."
else
    echo "⚠️ Algunos directorios no tienen permisos 755."
fi

find "$PROYECTO" -type f -perm 644 > /dev/null 2>&1
if [ $? -eq 0 ]; then
    echo "✅ Permisos de archivos correctos (644)."
else
    echo "⚠️ Algunos archivos no tienen permisos 644."
fi

for dir in storage bootstrap/cache; do
    if [ -d "$PROYECTO/$dir" ]; then
        if [ "$(stat -c '%a' "$PROYECTO/$dir")" -lt 775 ]; then
            echo "⚠️ Permisos insuficientes en $dir (deben ser 775)."
        else
            echo "✅ Permisos correctos en $dir."
        fi
    else
        echo "⚠️ Falta la carpeta $dir."
    fi
done

# 5. Revisar mod_rewrite en Apache
echo "──────────────────────────────────────────────"
echo "🧩 Verificando configuración de Apache..."

if grep -q "LoadModule rewrite_module" "$HTTPD_FILE"; then
    echo "✅ Módulo mod_rewrite habilitado."
else
    echo "❌ mod_rewrite NO habilitado en $HTTPD_FILE."
fi

# 6. Revisar VirtualHost
if grep -q "$PROYECTO/public" "$VHOST_FILE"; then
    echo "✅ VirtualHost apunta al directorio correcto."
else
    echo "⚠️ VirtualHost no apunta a $PROYECTO/public."
fi

if grep -q "Require all granted" "$VHOST_FILE"; then
    echo "✅ 'Require all granted' presente en VirtualHost."
else
    echo "❌ Falta 'Require all granted' en VirtualHost."
fi

# 7. Revisar entrada en /etc/hosts
if grep -q "turismo.test" /etc/hosts; then
    echo "✅ Dominio 'turismo.test' registrado en /etc/hosts."
else
    echo "❌ No existe entrada para 'turismo.test' en /etc/hosts."
fi

# 8. Revisar último error en log de Apache
echo "──────────────────────────────────────────────"
echo "📜 Últimas líneas del log de Apache:"
sudo tail -n 10 "$ERROR_LOG"

echo "──────────────────────────────────────────────"
echo "✅ Verificación completada."
echo "Si ves algún ❌ o ⚠️, corrige lo indicado y reinicia Apache con:"
echo "   sudo /opt/lampp/lampp restart"
echo "──────────────────────────────────────────────"

