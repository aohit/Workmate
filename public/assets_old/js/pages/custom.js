// $('#menu-toggle').on('click', function() {
 
//     if ($(window).width() <= 991) {

//         $('#left-side-menu').toggleClass('open d-none');
//     }
// });

// $(window).resize(function() {
//     $('#menu-toggle').off('click').on('click', function() {
//         if ($(window).width() <= 991) {
//             $('#left-side-menu').toggleClass('open d-none');
//         }
//     });
// });


    $(document).ready(function() {
        // Hide #left-side-menu by default if the screen width is 991px or less
        if ($(window).width() <= 991) {
            $('#left-side-menu').css('display', 'none');
        }

        // Bind click event to the #menu-toggle element
        $('#menu-toggle').on('click', function() {
            // Check if the screen width is 991px or less
            if ($(window).width() <= 991) {
                // Toggle the left-side menu
                $('#left-side-menu').toggleClass('open').css('display', function(_, val) {
                    return val === 'none' ? 'block' : 'none';
                });
            }
        });

        // Handle window resize to re-apply the logic if needed
        $(window).resize(function() {
            // Unbind the click event first to avoid multiple bindings
            $('#menu-toggle').off('click').on('click', function() {
                if ($(window).width() <= 991) {
                    $('#left-side-menu').toggleClass('open').css('display', function(_, val) {
                        return val === 'none' ? 'block' : 'none';
                    });
                }
            });

            // Hide #left-side-menu by default if resized to 991px or less
            if ($(window).width() <= 991) {
                $('#left-side-menu').css('display', 'none');
            } else {
                $('#left-side-menu').css('display', 'block'); // Show it for larger screens
            }
        });
    });


// function btn_second(elementID) { 
// 	var myElement = document.getElementById(elementID); 
// 	if (myElement) myElement.style.display = "none"; 
// 	btn_second.style.display = "block"; 
// 	first_bar.style.display = "none"; 
// } 

// function btn_second(elementID) { 
// 	var myElement = document.getElementById(elementID); 
// 	if (myElement) myElement.style.display = "block"; 
// 	btn_second.style.display = "none"; 
// 	first_bar.style.display = "block"; 
// }

    // Call the function when the page loads
    // toggleMenu();

    // $('#menu-toggle').on('click', function() {
    //     if ($(window).width() <= 991) {
    //         $('#left-side-menu').toggleClass('open').toggle(); // Toggle visibility and 'open' class
    //     }
    // });

    // $(window).resize(function() {
    //     toggleMenu(); // Handle window resize event
    // });

