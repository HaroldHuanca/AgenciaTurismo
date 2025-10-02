const express = require('express');
const cors = require('cors');
const path = require('path');
const whatsappRoutes = require('./whatsappRoutes');

const app = express();
app.use(cors());
app.use(express.json());

// Agregar las rutas de WhatsApp
app.use('/api/whatsapp', whatsappRoutes);

// Servir archivos estáticos de la integración de WhatsApp
app.use('/whatsapp', express.static(path.join(__dirname, 'public')));

const PORT = process.env.PORT || 3001;
app.listen(PORT, () => {
    console.log(`Servidor Node.js corriendo en el puerto ${PORT}`);
});