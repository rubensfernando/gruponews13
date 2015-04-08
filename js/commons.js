jQuery(function($) {
    $(document).ready(function() {
        $(".menu").tinyNav({
            active: 'current-menu-item', // String: Set the "active" class
            header: 'Menu', // String: Specify text for "header" and show header instead of the active item
            label: '' // String: Sets the <label> text for the <select> (if not set, no label will be added)
        });
        var e = $("#topslide .topslide-content").html();
        $("#topslide .closer").hide();
        $("#topslide").hide();
        setTimeout(function() {
            $("#topslide").slideDown("slow")
        }, 1500);
        $("#topslide .toggle").click(function() {
            if ($(this).hasClass("open")) {
                $("#topslide .topslide-content").html(e);
                $(this).removeClass("open");
                $(this).addClass("close");
                $(this).html("Fechar aviso");
                $("#topslide .topslide-content").slideDown("slow")
            } else {
                $(this).removeClass("close");
                $(this).addClass("open");
                $(this).html("Abrir aviso");
                $("#topslide .topslide-content").slideUp("slow", function() {
                    $("#topslide .topslide-content").html("")
                })
            }
            return !1
        });
        $("#topslide,.holder").click(function() {
            $("#topslide .toggle").click()
        });
        $("#topslide .closer").click(function() {
            $(this).hide();
            $("#topslide .opener").fadeIn(1e3);
            return !1
        })
    });

    function hideAddressBar() {
        if (!window.location.hash) {
            if (document.height < window.outerHeight) {
                document.body.style.height = (window.outerHeight + 50) + 'px';
            }

            setTimeout(function() {
                window.scrollTo(0, 1);
            }, 50);
        }
    }

    window.addEventListener("load", function() {
        if (!window.pageYOffset) {
            hideAddressBar();
        }
    });
    window.addEventListener("orientationchange", hideAddressBar);


});