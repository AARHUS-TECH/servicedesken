            $("#studiekort-login-btn").click(function() {
                $("#splash").fadeOut(400, function() {
                    $("#studiekort-login").fadeIn(400);
                });
            });

            $("#bruger-login-btn").click(function() {
                $("#splash").fadeOut(400, function() {
                    $("#bruger-login").fadeIn(400);
                });
            });

            $("#tilbage-studie-btn").click(function() {
                $("#studiekort-login").fadeOut(400, function() {
                    $("#splash").fadeIn(400);
                });
            });

            $("#tilbage-bruger-btn").click(function() {
                $("#bruger-login").fadeOut(400, function() {
                    $("#splash").fadeIn(400);
                });
            });

            function validateFormStudiekort() {
                var studiekort  = document.forms["studiekort-login-form"]["studiekort"];

                if(studiekort.value == '') {
                    $("#studiekort-login").addClass("has-error");
                    return false;
                } else {
                    $("#studiekort-login").removeClass("has-error");
                    return true;
                }
            }

            function validateFormBruger() {
                var brugernavn  = document.forms["bruger-login-form"]["brugernavn"];
                var adgangskode = document.forms["bruger-login-form"]["adgangskode"];

                if(brugernavn.value == '' && adgangskode.value == '') {
                    $("#brugernavn-form-group").addClass("has-error");
                    $("#adgangskode-form-group").addClass("has-error");
                    return false;
                } else if(brugernavn.value == '') {
                    $("#adgangskode-form-group").removeClass("has-error");
                    $("#brugernavn-form-group").addClass("has-error");
                    return false;
                } else if(adgangskode.value == '') {
                    $("#brugernavn-form-group").removeClass("has-error")
                    $("#adgangskode-form-group").addClass("has-error");
                    return false;
                } else {
                    $("#brugernavn-form-group").removeClass("has-error");
                    $("#adgangskode-form-group").removeClass("has-error");
                    return true;
                }
            }