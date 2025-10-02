const express = require('express');
const router = express.Router();
const whatsappController = require('./whatsappController');
const upload = require('express-fileupload');

// Middleware para subida de archivos
router.use(upload({
    createParentPath: true,
    limits: { fileSize: 10 * 1024 * 1024 } // 10MB límite
}));

// Rutas de WhatsApp
router.post('/initialize', whatsappController.initializeClient);
router.get('/qr', whatsappController.getQRCode);
router.get('/status', whatsappController.getAuthStatus);
router.post('/send', whatsappController.sendMessage);
router.post('/send-bulk', whatsappController.sendBulkMessages);
router.post('/logout', whatsappController.logout);

module.exports = router;