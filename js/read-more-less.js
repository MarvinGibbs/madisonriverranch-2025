jQuery(function($) {
    $("#accordion a").click(function() {
        $("#read-more-less").text(function(_, text){
            return text== "Read Less" ? "Read More" : "Read Less";
        });
    });
});
