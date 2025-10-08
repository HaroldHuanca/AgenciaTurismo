describe('Clientes CRUD', () => {
    const baseUrl = Cypress.env('APP_URL') || 'http://localhost';
    beforeEach(() => {
        // login using seeded admin user
        cy.visit('/login');
        cy.get('input[name="email"]').type('admin@agencia.com');
        cy.get('input[name="password"]').type('password123');
        cy.get('button[type="submit"]').click();
        // ensure we're authenticated and redirected
        cy.url().should('not.include', '/login');
    });

    it('visits clientes index', () => {
        cy.visit('/clientes');
        cy.contains('Clientes').should('exist');
    });

    it('creates a cliente', () => {
        cy.visit('/clientes/create');
        cy.get('input[name="nombre"]').type('Rosa');
        cy.get('input[name="apellido"]').type('Gomez');
        cy.get('input[name="email"]').type('rosa.gomez@example.test');
        cy.get('button[type="submit"]').click();
        cy.url().should('match', /\/clientes\/\d+/);
        cy.contains('Rosa').should('exist');
    });

    it('edits a cliente', () => {
        // Navegar a la lista de clientes primero
        cy.visit('/clientes');

        // Hacer click en el botón de edición del primer cliente
        cy.get('table tbody tr').first().within(() => {
            cy.get('a.btn-warning').click(); // Botón amarillo de edición
        });

        // O también puedes usar el title del tooltip
        // cy.get('a[title="Editar"]').first().click();

        cy.get('input[name="nombre"]').clear().type('Juanito');
        cy.get('input[name="apellido"]').clear().type('Pérez');
        cy.get('button[type="submit"]').click();

        cy.url().should('include', '/clientes/');
        cy.contains('Juanito Pérez').should('exist');
        cy.get('.alert-success').should('contain', 'Cliente actualizado');
    });
    it('deletes a cliente', () => {
        // Ahora eliminar este cliente específico
    cy.visit('/clientes');
    
    // Encontrar la fila que contiene "Rosa Gomez" y eliminarlo
    cy.contains('tr', 'Rosa Gomez').within(() => {
        cy.get('button.btn-danger').click();
    });
    
    // Confirmar en SweetAlert2
    cy.get('.swal2-confirm').click();
    
    // Verificar resultados
    cy.get('.alert-success').should('contain', 'Cliente eliminado');
    cy.contains('Rosa Gomez').should('not.exist');
    });
});
