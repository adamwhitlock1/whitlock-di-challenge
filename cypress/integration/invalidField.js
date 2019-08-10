describe('Test an alert and the text displaying', function() {
  it('Verify alert and its text content', function(){
    cy.visit("localhost:3000");

    cy.get("#name input").click().type("Adam E2E");
    cy.get("#phone input").click().type("1234567890");
    cy.get("#email input").click().type("test@test.com");

    const stub = cy.stub();
    let alerted = false;
    cy.on('window:alert', msg => alerted = msg);
    cy.get("#primary-form-btn").click()
      .then(() => {
        expect(alerted).to.be(true);
      })

  });

  // it("finds and enters message", function(){
  //   let d = new Date();
  //   cy.get("#message textarea").click().type(d + "  E2E Test");
  // });


});