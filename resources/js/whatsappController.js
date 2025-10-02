const whatsappService = require('./whatsappService');

class WhatsappController {
    constructor() {
        this.client = null;
        this.qrCode = null;
        this.isAuthenticated = false;
    }

    // Inicializar cliente de WhatsApp
    async initializeClient(req, res) {
        try {
            this.client = await whatsappService.initializeClient();
            
            this.client.on('qr', (qr) => {
                this.qrCode = qr;
                console.log('QR recibido:', qr);
            });

            this.client.on('ready', () => {
                this.isAuthenticated = true;
                console.log('Cliente de WhatsApp listo');
            });

            this.client.on('authenticated', (session) => {
                this.isAuthenticated = true;
                console.log('Autenticado correctamente');
            });

            this.client.on('auth_failure', (msg) => {
                this.isAuthenticated = false;
                console.error('Error de autenticación:', msg);
            });

            res.json({ success: true, message: 'Cliente inicializado' });
        } catch (error) {
            res.status(500).json({ success: false, error: error.message });
        }
    }

    // Obtener QR para autenticación
    getQRCode(req, res) {
        if (this.qrCode) {
            res.json({ success: true, qrCode: this.qrCode });
        } else {
            res.json({ success: false, message: 'QR no disponible aún' });
        }
    }

    // Verificar estado de autenticación
    getAuthStatus(req, res) {
        res.json({ 
            authenticated: this.isAuthenticated,
            ready: this.client ? true : false
        });
    }

    // Enviar mensaje individual
    async sendMessage(req, res) {
        try {
            const { number, message, media = null } = req.body;
            
            if (!this.isAuthenticated || !this.client) {
                return res.status(400).json({ 
                    success: false, 
                    error: 'Cliente de WhatsApp no autenticado' 
                });
            }

            const result = await whatsappService.sendMessage(
                this.client, 
                number, 
                message, 
                media
            );

            res.json({ success: true, result });
        } catch (error) {
            res.status(500).json({ success: false, error: error.message });
        }
    }

    // Enviar mensajes masivos
    async sendBulkMessages(req, res) {
        try {
            const { contacts, message, media = null } = req.body;
            
            if (!this.isAuthenticated || !this.client) {
                return res.status(400).json({ 
                    success: false, 
                    error: 'Cliente de WhatsApp no autenticado' 
                });
            }

            const results = await whatsappService.sendBulkMessages(
                this.client,
                contacts,
                message,
                media
            );

            res.json({ 
                success: true, 
                sent: results.successful.length,
                failed: results.failed.length,
                results 
            });
        } catch (error) {
            res.status(500).json({ success: false, error: error.message });
        }
    }

    // Cerrar sesión
    async logout(req, res) {
        try {
            if (this.client) {
                await this.client.logout();
                await this.client.destroy();
                this.client = null;
                this.isAuthenticated = false;
                this.qrCode = null;
            }
            res.json({ success: true, message: 'Sesión cerrada correctamente' });
        } catch (error) {
            res.status(500).json({ success: false, error: error.message });
        }
    }
}

module.exports = new WhatsappController();