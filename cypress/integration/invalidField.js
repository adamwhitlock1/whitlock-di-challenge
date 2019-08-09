describe('Test an alert and the text displaying', function() {
  it('Verify alert and its text content', function(){
    cy.visit("localhost:3000");

    const stub = cy.stub();
    cy.on ('window:alert', stub);
    cy
      .get('button').contains('Click me!').click()
      .then(() => {
        expect(stub.getCall(0)).to.be.calledWith('I am an alert box!');
      })

  })

})