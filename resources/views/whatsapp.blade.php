<!DOCTYPE html>
<html>
<head>
    <title>WhatsApp Mass Messaging</title>
    <script src="https://cdn.jsdelivr.net/npm/qrcode@1.5.0/build/qrcode.min.js"></script>
    <style>
        .status-badge { padding: 5px 10px; border-radius: 4px; color: white; }
        .success { background: #28a745; }
        .warning { background: #ffc107; color: black; }
        .danger { background: #dc3545; }
    </style>
</head>
<body>
    <div class="container">
        <h2>WhatsApp Mass Messaging</h2>
        
        <!-- Panel de estado -->
        <div class="status-panel">
            <h4>Estado de Conexión</h4>
            <p>Status: <span id="status" class="status-badge danger">Desconectado</span></p>
            <button id="initializeBtn" class="btn btn-primary">Inicializar WhatsApp</button>
            <button id="logoutBtn" class="btn btn-secondary">Cerrar Sesión</button>
        </div>

        <!-- QR Code -->
        <div id="qrSection" style="display: none;">
            <h4>Escanear Código QR</h4>
            <div id="qrCode"></div>
        </div>

        <!-- Formulario de envío masivo -->
        <div class="messaging-panel">
            <h4>Envío Masivo</h4>
            <form id="bulkMessageForm">
                <div class="form-group">
                    <label>Contactos (números separados por coma):</label>
                    <textarea id="contacts" class="form-control" rows="3" 
                              placeholder="5551234567, 5557654321, ..."></textarea>
                </div>
                
                <div class="form-group">
                    <label>Mensaje:</label>
                    <textarea id="message" class="form-control" rows="4" 
                              placeholder="Escribe tu mensaje aquí..."></textarea>
                </div>
                
                <div class="form-group">
                    <label>Archivo adjunto (opcional):</label>
                    <input type="file" id="mediaFile" class="form-control" 
                           accept=".pdf,.jpg,.jpeg,.png,.gif">
                </div>
                
                <button type="submit" class="btn btn-success">Enviar Mensajes Masivos</button>
            </form>
        </div>

        <!-- Resultados -->
        <div id="results" style="display: none;">
            <h4>Resultados del Envío</h4>
            <div id="resultsContent"></div>
        </div>
    </div>

    <script src="/js/whatsapp-client.js"></script>
</body>
</html>