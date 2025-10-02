class WhatsAppClient {
    constructor() {
        this.baseUrl = '/api/whatsapp';
        this.qrCodeElement = document.getElementById('qrCode');
        this.statusElement = document.getElementById('status');
        this.initializeButton = document.getElementById('initializeBtn');
        this.logoutButton = document.getElementById('logoutBtn');
        
        this.bindEvents();
        this.checkStatus();
    }

    bindEvents() {
        if (this.initializeButton) {
            this.initializeButton.addEventListener('click', () => this.initialize());
        }
        
        if (this.logoutButton) {
            this.logoutButton.addEventListener('click', () => this.logout());
        }

        // Verificar estado cada 5 segundos
        setInterval(() => this.checkStatus(), 5000);
    }

    async initialize() {
        try {
            this.showLoading('Inicializando cliente de WhatsApp...');
            
            const response = await fetch(`${this.baseUrl}/initialize`, {
                method: 'POST'
            });
            
            const data = await response.json();
            
            if (data.success) {
                this.startQRPolling();
            } else {
                this.showError('Error al inicializar: ' + data.error);
            }
        } catch (error) {
            this.showError('Error de conexión: ' + error.message);
        }
    }

    async startQRPolling() {
        const qrInterval = setInterval(async () => {
            try {
                const response = await fetch(`${this.baseUrl}/qr`);
                const data = await response.json();
                
                if (data.success && data.qrCode) {
                    this.displayQRCode(data.qrCode);
                    this.showMessage('Escanea el código QR con WhatsApp');
                }
                
                // Verificar si ya está autenticado
                const status = await this.checkStatus();
                if (status.authenticated) {
                    clearInterval(qrInterval);
                    this.showSuccess('¡Autenticado correctamente!');
                }
            } catch (error) {
                console.error('Error polling QR:', error);
            }
        }, 2000);
    }

    displayQRCode(qrCode) {
        if (this.qrCodeElement) {
            this.qrCodeElement.innerHTML = '';
            const qr = new QRCode(this.qrCodeElement, {
                text: qrCode,
                width: 200,
                height: 200
            });
        }
    }

    async checkStatus() {
        try {
            const response = await fetch(`${this.baseUrl}/status`);
            const status = await response.json();
            
            this.updateStatusDisplay(status);
            return status;
        } catch (error) {
            console.error('Error checking status:', error);
            return { authenticated: false, ready: false };
        }
    }

    updateStatusDisplay(status) {
        if (this.statusElement) {
            if (status.authenticated) {
                this.statusElement.innerHTML = '<span class="badge badge-success">Conectado</span>';
            } else if (status.ready) {
                this.statusElement.innerHTML = '<span class="badge badge-warning">Esperando QR</span>';
            } else {
                this.statusElement.innerHTML = '<span class="badge badge-danger">Desconectado</span>';
            }
        }
    }

    async sendBulkMessage(contacts, message, file = null) {
        try {
            const formData = new FormData();
            formData.append('contacts', JSON.stringify(contacts));
            formData.append('message', message);
            
            if (file) {
                formData.append('media', file);
            }

            const response = await fetch(`${this.baseUrl}/send-bulk`, {
                method: 'POST',
                body: formData
            });

            return await response.json();
        } catch (error) {
            return { success: false, error: error.message };
        }
    }

    async logout() {
        try {
            const response = await fetch(`${this.baseUrl}/logout`, {
                method: 'POST'
            });
            
            const data = await response.json();
            
            if (data.success) {
                this.showSuccess('Sesión cerrada correctamente');
                this.qrCodeElement.innerHTML = '';
                this.updateStatusDisplay({ authenticated: false, ready: false });
            }
        } catch (error) {
            this.showError('Error al cerrar sesión: ' + error.message);
        }
    }

    // Helper methods para mostrar mensajes
    showLoading(message) {
        // Implementar según tu sistema de notificaciones
        console.log('Loading:', message);
    }

    showSuccess(message) {
        // Implementar según tu sistema de notificaciones
        console.log('Success:', message);
    }

    showError(message) {
        // Implementar según tu sistema de notificaciones
        console.error('Error:', message);
    }

    showMessage(message) {
        // Implementar según tu sistema de notificaciones
        console.log('Message:', message);
    }
}

// Inicializar cuando el DOM esté listo
document.addEventListener('DOMContentLoaded', function() {
    window.whatsappClient = new WhatsAppClient();
});