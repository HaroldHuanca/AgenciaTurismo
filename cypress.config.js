const { defineConfig } = require('cypress')

module.exports = defineConfig({
  e2e: {
    // Default to the local virtual host used in XAMPP
    baseUrl: process.env.APP_URL || 'http://turismo.test',
    supportFile: false,
    specPattern: 'cypress/e2e/**/*.cy.js'
  }
})
