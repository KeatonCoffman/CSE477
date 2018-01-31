/*! DO NOT EDIT project3 2017-06-29 */
/**
 * Created by keatoncoffman on 6/29/17.
 */
function Cells(sel,json_sol) {

    console.log(sel);

    var that = this;

    var table = $(sel + " table");


    $(sel + " td.cell button").click(function(event) {
        event.preventDefault();


        button = $(this).parent();
        loc = this.value.split(',');
        r = loc[0];
        c = loc[1];


        if(button.attr("class") == "cell sea"){
            button.attr("class","cell dot");
            $(this).html("&#9679;");
        }
        else if(button.attr("class") == "cell dot"){
            button.attr("class","cell none");
            $(this).html("&nbsp;");
        }
        else if(button.attr("class") == "cell none"){
            button.attr("class","cell sea");
        }
        var rows = table.find("tr");
        var flag = false;
        var correctCount = 0;
        var totalCount = rows.length * rows.length;
        //console.log("HERE IT IS: ",totalCount);
        for(var r=0; r<rows.length; r++) {
            // Get a row
            var row = $(rows.get(r));

            var cells = row.find('td');
            for(var t=0; t<cells.length; t++){


                var cell = cells.get(t);
                var answer = json_sol['game'][r][t];
                //console.log("Class" ,$(cell).attr('class'));
                if($(cell).attr('class') === undefined)
                {
                    correctCount++;
                }
                else if(($(cell).attr('class') === 'cell none' && answer === 0) || (($(cell).attr('class') === 'cell sea' && answer === -2)) || ($(cell).attr('class') === 'cell dot' && answer === -1))
                {
                    correctCount++;

                }
                //console.log("correct: ", correctCount);
            }
        }


        if(correctCount === totalCount ){
            var rows = table.find("tr");

            for(var r=0; r<rows.length; r++) {
                //console.log("first for loop");
                // Get a row
                var row = $(rows.get(r));

                var cells = row.find('td');

                for(var t=0; t<cells.length; t++){
                    //console.log("second for loop");

                    var cell = cells.get(t);

                    var answer = json_sol['game'][r][t];


                    button = $(cell).children('button');
                    console.log(json_sol['game'][r][t]);

                    if(answer === 0){
                        $(cell).attr("class","cell none");
                        button.html("&nbsp;");
                    }
                    if(answer === -1){
                        $(cell).attr("class","cell dot");
                        button.html("&#9679;");
                    }
                    if(answer === -2){
                        $(cell).attr("class","cell sea")
                    }
                }
            }
            $(".solved").show();
            $(".checksolveclear").hide();

        }


    });

    $(sel + " button.clear").click(function(event) {
        event.preventDefault();
        //console.log("CLEAR WAS PRESSED");
        var rows = table.find("tr");

        for(var r=0; r<rows.length; r++) {
            // Get a row
            var row = rows.find('td');

            for(var t=0; t<row.length; t++){

                var cell = row.get(t);
                //console.log($(cell).attr("class"));



                if($(cell).attr("class") == "cell sea"){
                    $(cell).attr("class","cell none");
                }
                if($(cell).attr("class") == "cell dot"){
                    $(cell).attr("class","cell none");
                    var button = $(cell).children('button');
                    button.css("background-color", "white");
                    button.html("&nbsp;");
                }

                if($(cell).attr("class") == "cell bad"){
                    $(cell).attr("class","cell none");
                    var button = $(cell).children('button');
                    button.html("&nbsp;");
                }


            }
        }

    });



    $(".solve").click(function(event) {
        event.preventDefault();
        console.log("SOLVE CLICKED");
        $(".checksolveclear").attr("style","display:none");
        $(".yesno").show();
    });



    $(".yes").click(function(event) {
        event.preventDefault();

        console.log("yes was pressed");
        var rows = table.find("tr");

        for(var r=0; r<rows.length; r++) {
            console.log("first for loop");
            // Get a row
            var row = $(rows.get(r));

            var cells = row.find('td');

            for(var t=0; t<cells.length; t++){
                console.log("second for loop");

                var cell = cells.get(t);

                var answer = json_sol['game'][r][t];


                button = $(cell).children('button');
                console.log(json_sol['game'][r][t]);

                if(answer === 0){
                    $(cell).attr("class","cell none");
                    button.html("&nbsp;");
                }
                if(answer === -1){
                    $(cell).attr("class","cell dot");
                    button.html("&#9679;");
                }
                if(answer === -2){
                    $(cell).attr("class","cell sea")
                }
            }
        }
        $(".solved").show();
        $(".yesno").hide();

    });


    $(".no").click(function(event) {
        event.preventDefault();
        $(".yesno").hide();
        $(".checksolveclear").show();
    });


    // Check
    $(".check").click(function(event) {
        event.preventDefault();
        //$(".checksolveclear").attr("style","display:none");
        //$(".yesno2").show();
        event.preventDefault();
        console.log("check solution");
        var rows = table.find("tr");

        for(var r=0; r<rows.length; r++) {
            console.log("first for loop");
            // Get a row
            var row = $(rows.get(r));

            var cells = row.find('td');

            for(var t=0; t<cells.length; t++){
                console.log("second for loop");

                var cell = cells.get(t);

                var answer = json_sol['game'][r][t];

                //var actual_Class = $(cell).attr("class");


                button = $(cell).children('button');
                console.log(json_sol['game'][r][t]);


                if(answer === -1 && $(cell).attr("class") === 'cell sea'){
                    $(cell).attr("class","cell bad");
                    //$(cell).css("background-color", "red");
                    //button.html("&nbsp;");
                }

                if(answer === -2 && $(cell).attr("class") === 'cell dot'){
                    $(cell).attr("class","cell bad");
                }



            }
        }

    });


    $(".no2").click(function(event) {
        event.preventDefault();
        $(".yesno2").hide();
        $(".checksolveclear").show();
    });

}







