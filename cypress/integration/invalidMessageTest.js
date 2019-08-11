describe('Message field shows error when no message', function() {
  it('Verify error and its text content', function(){
    cy.visit("localhost:3000");

    cy.get("#name input").click().type("Adam E2E");
    cy.get("#phone input").click().type("1234567890");
    cy.get("#email input").click().type("test@test.com");


    cy.get("#primary-form-btn").click()
      .then(() => {
        cy.get('.has-error .field-message')
          .should('have.text', 'Required fields cannot be empty. Please re-submit the form after fixing required fields.');

        cy.get('#name input').should('have.value', "Adam E2E");
        cy.get('#phone input').should('have.value', "1234567890");
      })

  });

  it('Verify field values stay on submit', function(){

        cy.get('.has-error .field-message')
          .should('have.text', 'Required fields cannot be empty. Please re-submit the form after fixing required fields.');

        cy.get('#name input').should('have.value', "Adam E2E");
        cy.get('#phone input').should('have.value', "1234567890");


  });
});