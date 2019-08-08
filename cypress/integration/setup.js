describe("Successful submission", function(){
  it("loads site correctly", function(){
    cy.visit("localhost:3000");
  });

  it("finds the form", function(){
    cy.get("#contact-form");
  });

  it("finds and enters name", function(){
    cy.get("#name input").click().type("Adam E2E");
  });

  it("finds and enters phone", function(){
    cy.get("#phone input").click().type("1234567890");
  });

  it("finds and enters email", function(){
    cy.get("#email input").click().type("test@test.com");
  });

  it("finds and enters message", function(){
    let d = new Date();
    cy.get("#message textarea").click().type(d + "  E2E Test");
  });

  it("finds and clicks submit", function(){
    cy.get("#primary-form-btn").click();
  });

});