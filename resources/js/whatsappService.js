const { Client, LocalAuth, MessageMedia } = require('whatsapp-web.js');
const path = require('path');
const fs = require('fs');

class WhatsappService {
    constructor() {
        this.clients = new Map();
    }

    // Inicializar cliente con autenticación local
    initializeClient() {
        return new Promise((resolve, reject) => {
            try {
                const client = new Client({
                    authStrategy: new LocalAuth({
                        clientId: "crm-client",
                        dataPath: path.join(__dirname, '../sessions')
                    }),
                    puppeteer: {
                        headless: true,
                        args: ['--no-sandbox', '--disable-setuid-sandbox']
                    }
                });

                client.initialize();
                resolve(client);
            } catch (error) {
                reject(error);
            }
        });
    }

    // Formatear número de teléfono
    formatNumber(number) {
        // Remover caracteres especiales y espacios
        let cleaned = number.replace(/\D/g, '');
        
        // Si no tiene código de país, agregar código por defecto (México: 52)
        if (!cleaned.startsWith('52') && cleaned.length === 10) {
            cleaned = '52' + cleaned;
        }
        
        return cleaned + '@c.us';
    }

    // Validar número de WhatsApp
    async validateNumber(client, number) {
        try {
            const formattedNumber = this.formatNumber(number);
            const contact = await client.getContactById(formattedNumber);
            return contact ? formattedNumber : null;
        } catch (error) {
            return null;
        }
    }

    // Enviar mensaje individual
    async sendMessage(client, number, message, mediaPath = null) {
        try {
            const formattedNumber = await this.validateNumber(client, number);
            if (!formattedNumber) {
                throw new Error(`Número inválido: ${number}`);
            }

            let media = null;
            if (mediaPath) {
                media = MessageMedia.fromFilePath(mediaPath);
            }

            let result;
            if (media) {
                result = await client.sendMessage(formattedNumber, media, {
                    caption: message || ''
                });
            } else {
                result = await client.sendMessage(formattedNumber, message);
            }

            return {
                number: number,
                formattedNumber: formattedNumber,
                messageId: result.id._serialized,
                timestamp: new Date(),
                status: 'sent'
            };
        } catch (error) {
            return {
                number: number,
                error: error.message,
                timestamp: new Date(),
                status: 'failed'
            };
        }
    }

    // Enviar mensajes masivos con delay entre envíos
    async sendBulkMessages(client, contacts, message, mediaPath = null, delayMs = 2000) {
        const results = {
            successful: [],
            failed: []
        };

        for (const contact of contacts) {
            try {
                const result = await this.sendMessage(client, contact.number, message, mediaPath);
                
                if (result.status === 'sent') {
                    results.successful.push(result);
                } else {
                    results.failed.push(result);
                }

                // Delay entre mensajes para evitar bloqueos
                if (delayMs > 0) {
                    await new Promise(resolve => setTimeout(resolve, delayMs));
                }
            } catch (error) {
                results.failed.push({
                    number: contact.number,
                    error: error.message,
                    timestamp: new Date(),
                    status: 'failed'
                });
            }
        }

        return results;
    }

    // Subir archivo y obtener ruta
    uploadFile(file) {
        return new Promise((resolve, reject) => {
            const uploadDir = path.join(__dirname, '../uploads');
            
            if (!fs.existsSync(uploadDir)) {
                fs.mkdirSync(uploadDir, { recursive: true });
            }

            const fileName = `${Date.now()}-${file.name}`;
            const filePath = path.join(uploadDir, fileName);

            file.mv(filePath, (err) => {
                if (err) {
                    reject(err);
                } else {
                    resolve(filePath);
                }
            });
        });
    }

    // Obtener estadísticas de envíos
    getStats(results) {
        return {
            total: results.successful.length + results.failed.length,
            successful: results.successful.length,
            failed: results.failed.length,
            successRate: ((results.successful.length / (results.successful.length + results.failed.length)) * 100) || 0
        };
    }
}

module.exports = new WhatsappService();