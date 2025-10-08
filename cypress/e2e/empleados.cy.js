describe('Empleados CRUD', () => {
    const baseUrl = Cypress.env('APP_URL') || 'http://localhost';
    
    beforeEach(() => {
        cy.visit('/login');
        cy.get('input[name="email"]').type('admin@agencia.com');
        cy.get('input[name="password"]').type('password123');
        cy.get('button[type="submit"]').click();
        cy.url().should('not.include', '/login');
    });

    it('visits empleados index', () => {
        cy.visit('/empleados');
        cy.contains('Empleados').should('exist');
    });

    it('creates a empleado', () => {
        cy.visit('/empleados/create');
        cy.get('input[name="nombre"]').type('María González');
        cy.get('select[name="rol"]').select('Agente de Viajes');
        cy.get('input[name="email"]').type('maria.gonzalez@agencia.com');
        cy.get('input[name="comision"]').type('10.5');
        cy.get('button[type="submit"]').click();
        cy.url().should('match', /\/empleados\/\d+/);
        cy.contains('María González').should('exist');
    });

    it('edits a empleado', () => {
        cy.visit('/empleados');
        cy.get('table tbody tr').first().within(() => {
            cy.get('a.btn-warning').click();
        });
        cy.get('input[name="nombre"]').clear().type('Laura Martínez Updated');
        cy.get('select[name="rol"]').select('Gerente');
        cy.get('button[type="submit"]').click();
        cy.url().should('include', '/empleados/');
        cy.contains('Laura Martínez Updated').should('exist');
        cy.get('.alert-success').should('contain', 'Empleado actualizado');
    });

    it('deletes a empleado', () => {
        cy.visit('/empleados');
        cy.contains('tr', 'María González').within(() => {
            cy.get('button.btn-danger').click();
        });
        cy.get('.swal2-confirm').click();
        cy.get('.alert-success').should('contain', 'Empleado eliminado');
        cy.contains('María González').should('not.exist');
    });
});