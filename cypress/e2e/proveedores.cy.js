describe('Página de Proveedores', () => {
  it('debería mostrar la lista de proveedores', () => {
    // Ajusta el puerto según donde corras Laravel (php artisan serve)
    cy.visit('http://agencia-turismo.test/ventas');

    // Verificar que el título existe
    cy.contains('Lista de Proveedores');

    // Verificar que la tabla existe
    cy.get('table').should('exist');

    // Verificar que la tabla tenga encabezados correctos
    cy.get('thead tr').within(() => {
      cy.contains('ID');
      cy.contains('Nombre');
      cy.contains('Tipo');
      cy.contains('Contacto');
      cy.contains('Comisión Agencia');
    });

    // Opcional: verificar que haya filas en el body
    cy.get('tbody tr').should('have.length.greaterThan', 0);
  });
});
