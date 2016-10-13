$(document).ready(function() {
	"use strict";

	// Declare variables
	let output, 
        login, 
        logout,
        status,
        clearAll,
        resetClass;


    // Clear all input and output
    clearAll = function() {
        $("input[type=text]").val("");
        $("#output").hide();
    };

    // Reset class on output div
    resetClass = function() {
        if ($("#output").hasClass('bg-success')) {
            $("#output").removeClass('bg-success');
        }
        if ($("#output").hasClass('bg-danger')) {
            $("#output").removeClass('bg-danger');
        }
    };

	// Login function
	login = function() {

		$.ajax({
			type: 'post',
			url: 'php/login.php?do=login',
			data: $("#form").serialize(),
			dataType: 'json',

			success: function(data) {

                clearAll();
                resetClass();

				// Add class to output div
				if (data.result === "success") {
					$("#output").addClass('bg-success');
				} else {
					$("#output").addClass('bg-danger');
				}
                // Output message
				$("#output").html(data.output).fadeIn();
				console.log('Login result: ' + data.output);
			},

			error: function(jqXHR, textStatus, errorThrown) {
				$("#output").html("Login error...");
				console.log("Login error: " + textStatus + ", " + errorThrown);
			}
		});
	};

    // Logout function
    logout = function() {

        $.ajax({
            type: 'get',
            url: 'php/login.php?do=logout',
            dataType: 'json',

            success: function(data) {

                clearAll();
                resetClass();

                $('#output').html(data.output).fadeIn();
                console.log('Logout result: ' + data.output);
            },

            error: function(jqXHR, textStatus, errorThrown) {
                $('#output').html('Logout error...');
                console.log('Logout failed. ' + textStatus + ', ' + errorThrown);
            }
        });
    };

    // Status function
    status = function() {

        $.ajax({
            type: 'get',
            url: 'php/login.php?do=status',
            dataType: 'json',

            success: function(data) {

                clearAll();
                resetClass();
                
                $('#output').html(data.output).fadeIn();
                console.log('Status result: ' + data.output);
            },

            error: function(jqXHR, textStatus, errorThrown) {
                $('#output').html('Logout error...');
                console.log('Logout failed. ' + textStatus + ', ' + errorThrown);
            }
        });
    };


	/*
	 *
	 * Event listeners for login
	 *
	 */
	$( "#login" ).click(function() {
		login();
		event.preventDefault();
	});

	$( "#form" ).on("keypress", function() {
		if (event.which === 13) {
			login();
			event.preventDefault();
		}
	});


    /*
     *
     * Event listener for logout
     *
     */
	$("#logout").click(function() {
        logout();
		event.preventDefault();
	});


    /*
     *
     * Event listener for status
     *
     */
    $("#status").click(function() {
        status();
        event.preventDefault();
    });
});