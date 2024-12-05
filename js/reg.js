document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector("form");
    form.addEventListener("submit", function (event) {
      event.preventDefault();
      const nameInput = document.querySelector('input[name="name"]');
      const emailInput = document.querySelector('input[name="email"]');
      const passInput = document.querySelector('input[name="pass"]');
      const cpassInput = document.querySelector('input[name="cpass"]');
      const name = nameInput.value;
      const email = emailInput.value;
      const pass = passInput.value;
      const cpass = cpassInput.value;
  
      const nameRegex = /^[^\d].*\d*$/;
      const passRegex = /^(?=.*[a-zA-Z])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{8,}$/;
  
      let errorMessages = [];
  
      if (!nameRegex.test(name)) {
        errorMessages.push("Username cannot start with numbers!");
      }
  
      if (!passRegex.test(pass)) {
        errorMessages.push(
          "Password must be longer than 8 characters and contain at least one letter and one special character!"
        );
      }
  
      if (pass !== cpass) {
        errorMessages.push("Confirm password not matched!");
      }
  
      if (errorMessages.length > 0) {
        displayMessages(errorMessages);
      } else {
        form.submit();
      }
    });
  
    function displayMessages(messages) {
      const messageContainer = document.querySelector(".message-container");
      messageContainer.innerHTML = "";
      messages.forEach((message) => {
        const div = document.createElement("div");
        div.classList.add("message");
        div.textContent = message;
        messageContainer.appendChild(div);
      });
    }
  });
  