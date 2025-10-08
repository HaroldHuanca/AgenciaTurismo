describe('Paquetes Turísticos CRUD', () => {
    const baseUrl = Cypress.env('APP_URL') || 'http://localhost';
    
    beforeEach(() => {
        cy.visit('/login');
        cy.get('input[name="email"]').type('admin@agencia.com');
        cy.get('input[name="password"]').type('password123');
        cy.get('button[type="submit"]').click();
        cy.url().should('not.include', '/login');
    });

    it('visits paquetes index', () => {
        cy.visit('/paquetes');
        cy.contains('Paquetes Turísticos').should('exist');
    });

    it('creates a paquete', () => {
        cy.visit('/paquetes/create');
        cy.get('input[name="nombre"]').type('Tour Europa Express');
        cy.get('textarea[name="descripcion"]').type('Un increíble tour por las capitales europeas');
        cy.get('input[name="precio"]').type('1500.00');
        cy.get('input[name="duracion"]').type('10');
        cy.get('input[name="destino"]').type('París, Londres, Roma');
        cy.get('input[name="fecha_inicio"]').type('2024-06-01');
        cy.get('input[name="capacidad_maxima"]').type('15');
        cy.get('button[type="submit"]').click();
        cy.url().should('match', /\/paquetes\/\d+/);
        cy.contains('Tour Europa Express').should('exist');
    });

    it('edits a paquete', () => {
        cy.visit('/paquetes');
        cy.get('table tbody tr').first().within(() => {
            cy.get('a.btn-warning').click();
        });
        cy.get('input[name="nombre"]').clear().type('Aventura Tropical Updated');
        cy.get('input[name="precio"]').clear().type('1800.00');
        cy.get('button[type="submit"]').click();
        cy.url().should('include', '/paquetes/');
        cy.contains('Aventura Tropical Updated').should('exist');
        cy.get('.alert-success').should('contain', 'Paquete actualizado');
    });

    it('deletes a paquete', () => {
        cy.visit('/paquetes');
        cy.contains('tr', 'Tour Europa Express').within(() => {
            cy.get('button.btn-danger').click();
        });
        cy.get('.swal2-confirm').click();
        cy.get('.alert-success').should('contain', 'Paquete eliminado');
        cy.contains('Tour Europa Express').should('not.exist');
    });
});