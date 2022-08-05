import './loadmore.js';

jQuery(function($) {
    $(document).ready(function(){
        $("#toggle-menu").click(() => {
            $("#off-canvas-outter").animate({width: "100%"}, {duration: 500});
        });

        $("#top-header").click(function() {
            $("#alert").slideToggle(300);
            $("#top-header span").toggleClass("open");
        });

        $("#off-canvas-outside").click(closeMenu);
        $("#close-menu").click(closeMenu);

        function closeMenu() {
            $("#off-canvas-outter").animate({width: "0px"}, {duration: 500});
        }
		
		$(".search-button").click((e) => {
			e.preventDefault();
            $("#full-site-search").fadeIn(500);
			$('#full-site-search form input[type="text"]').focus();
        });
		
		$("#close-search-button").click(() => {
            $("#full-site-search").fadeOut(500);
        });

        $(".question").click(function() {
            let question = $(this);
            $("#answer" + question.attr("data-answer")).slideToggle(300);
            question.children("h5").toggleClass("opened");
        });

        // Equal Height Cards

        let card1 = $(".cards .wp-block-column").eq(0);
        let card2 = $(".cards .wp-block-column").eq(1);
        let card3 = $(".cards .wp-block-column").eq(2);

        if (card1.height() > card2.height()) {
            if (card1.height() > card3.height()) {
                card2.height(card1.height() + "px");
                card3.height(card1.height() + "px");
            } else {
                card1.height(card3.height() + "px");
                card2.height(card3.height() + "px");
            }
        } else {
            if (card2.height() > card3.height()) {
                card1.height(card2.height() + "px");
                card3.height(card2.height() + "px");
            } else {
                card1.height(card3.height() + "px");
                card2.height(card3.height() + "px");
            }
        }
    });
});