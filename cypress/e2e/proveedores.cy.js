describe('Proveedores CRUD', () => {
    const baseUrl = Cypress.env('APP_URL') || 'http://localhost';
    
    beforeEach(() => {
        cy.visit('/login');
        cy.get('input[name="email"]').type('admin@agencia.com');
        cy.get('input[name="password"]').type('password123');
        cy.get('button[type="submit"]').click();
        cy.url().should('not.include', '/login');
    });

    it('visits proveedores index', () => {
        cy.visit('/proveedores');
        cy.contains('Proveedores').should('exist');
    });

    it('creates a proveedor', () => {
        cy.visit('/proveedores/create');
        cy.get('input[name="nombre"]').type('Hotel Paradise');
        cy.get('select[name="tipo"]').select('Hotel');
        cy.get('input[name="contacto"]').type('Carlos Mendoza');
        cy.get('input[name="comision_agencia"]').type('15.5');
        cy.get('button[type="submit"]').click();
        cy.url().should('match', /\/proveedores\/\d+/);
        cy.contains('Hotel Paradise').should('exist');
    });

    it('edits a proveedor', () => {
        cy.visit('/proveedores');
        cy.get('table tbody tr').first().within(() => {
            cy.get('a.btn-warning').click();
        });
        cy.get('input[name="nombre"]').clear().type('Grand Hotel Updated');
        cy.get('input[name="comision_agencia"]').clear().type('20');
        cy.get('button[type="submit"]').click();
        cy.url().should('include', '/proveedores/');
        cy.contains('Grand Hotel Updated').should('exist');
        cy.get('.alert-success').should('contain', 'Proveedor actualizado');
    });

    it('deletes a proveedor', () => {
        cy.visit('/proveedores');
        cy.contains('tr', 'Hotel Paradise').within(() => {
            cy.get('button.btn-danger').click();
        });
        cy.get('.swal2-confirm').click();
        cy.get('.alert-success').should('contain', 'Proveedor eliminado');
        cy.contains('Hotel Paradise').should('not.exist');
    });
});