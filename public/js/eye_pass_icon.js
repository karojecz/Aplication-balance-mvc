        $(document).ready(function() {

            /**
             * Validate the form
             */
            $('#formSignup').validate({
                rules: {
                    name: 'required',
                    email: {
                        required: true,
                        email: true,
                        remote: '/account/validate-email'
                    },
                    password: {
                        required: true,
                        minlength: 6,
                        validPassword: true
                    }
                },
                messages: {
                    email: {
                        remote: 'email already taken'
                    }
                }
            });


            /**
              * Show password toggle button
              */
			  /*
            $('#inputPassword').hideShowPassword({
                show: false,
                innerToggle: 'focus'
				
            });
			*/
			        const togglePassword = document.querySelector("#togglePassword");
        const password = document.querySelector("#inputPassword");

        togglePassword.addEventListener("click", function () {
            // toggle the type attribute
            const type = password.getAttribute("type") === "password" ? "text" : "password";
            password.setAttribute("type", type);
            
            // toggle the icon
            this.classList.toggle("bi-eye");
        });
		        const form = document.querySelector("form");
        form.addEventListener('submit', function (e) {
            e.preventDefault();
        });

        });