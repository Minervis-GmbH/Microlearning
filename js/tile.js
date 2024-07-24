il.Util.addOnLoad(function(){
    $(document).ready(function () {
        let heights=[];
        let card_title = $(".card_title");
        card_title
            .each(function(index){
            heights.push($(this));
        });
        let largestTitle=Math.max(...heights);
        card_title.css("height", largestTitle);

    });
})


