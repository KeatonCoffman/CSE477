/*! DO NOT EDIT ajaxnoir 2017-06-28 */
/**
 * Created by keatoncoffman on 6/27/17.
 */
function Login(sel) {


    var form = $(sel);
    form.submit(function(event) {
        event.preventDefault();

        console.log("Submitted");

        $.ajax({
            url: "post/login.php",
            data: form.serialize(),
            method: "POST",
            success: function(data) {
                var json = parse_json(data);
                if(json.ok) {
                    // Login was successful
                    window.location.assign("./");


                } else {
                    // Login failed, a message is in json.message
                    $(sel + " .message").html("<p>" + json.message + "</p>");

                }
            },
            error: function(xhr, status, error) {
                // An error!
                $(sel + " .message").html("<p>Error: " + error + "</p>");
            }
        });

    });





}
/**
 * Created by keatoncoffman on 6/28/17.
 */
function MovieInfo(sel, title, year) {
    console.log("MovieInfo: " + title + "/" + year);


    var this_movie = $(sel);

    var that = this;

    $.ajax({
        url: "https://api.themoviedb.org/3/search/movie",
        data: {api_key: "db62a3c333da11376d4113727bae6842", query: title, year:year},
        method: "GET",
        dataType: "text",
        success: function(data) {
            var json = parse_json(data);

            if(json.total_results == 0) {
                // Successfully updated
                $(".paper").html("<p>No information available</p>");

            } else {
                // Update failed
                that.printInfo(sel,json.results[0]);
                //that.message("<p>Update failed</p>");
                //console.log(json.results[0]);

            }

        },

        error: function(xhr, status, error) {
            // Error
            $(".paper").html("<p>Unable to connect to database</p>");
        }
    });
}


MovieInfo.prototype.printInfo = function(sel,this_movie){
    console.log(this_movie);

    var html = "<ul><li id='info'><a href='#'><img src='images/info.png'></a><div class='show'>";
    html += "<h1>Title: " + this_movie['title'] + "</h1>";
    html += "<p>Release Date: " + this_movie['release_date'] + "</p>";
    html += "<p>Vote Average: " + this_movie['vote_average'] + "</p>";
    html += "<p>Vote Count: " + this_movie['vote_count'] + "</p>";
    html += "</div></li>";
    html += "<li id='plot'><a href='#'><img src='images/plot.png'></a><div>";
    html += "<p>" + this_movie['overview'] + "</p>";
    html += "</div></li>";
    html += "<li id='poster'><a href='#'><img src='images/poster.png'></a>";
    html += "<div><p class='poster'><img id='poster' src=''></p>";
    html += "</div></li></ul>";

    $(sel).html(html);
    $("img#poster").attr('src', 'http://image.tmdb.org/t/p/w500/' + this_movie['poster_path']);
    $( document ).ready(function() {
        $( "li#info > a" ).click(function() {
            $("ul > li > a > img").css("opacity", 0.3);
            $("li#plot > div").fadeOut(1000);
            $("li#poster > div").fadeOut(1000);
            $("li#info > div").fadeIn(1000);
        });
        $( "li#poster > a" ).click(function() {
            $("ul > li > a > img").css("opacity", 0.3);
            $("li#info > div").fadeOut(1000);
            $("li#plot > div").fadeOut(1000);
            $("li#poster > div").fadeIn(1000);
        });
        $( "li#plot > a" ).click(function() {
            $("ul > li > a > img").css("opacity", 0.3);
            $("li#info > div").fadeOut(1000);
            $("li#poster > div").fadeOut(1000);
            $("li#plot > div").fadeIn(1000);
        });
    });


};
/**
 * Created by keatoncoffman on 6/27/17.
 */
function parse_json(json) {
    try {
        var data = $.parseJSON(json);
    } catch(err) {
        throw "JSON parse error: " + json;
    }

    return data;
}
/**
 * Created by keatoncoffman on 6/27/17.
 */
function Stars(sel) {

    console.log(sel);

    var table = $(sel + " table");  // The table tag

    // Loop over the table rows
    var rows = table.find("tr");    // All of the table rows
    for(var r=1; r<rows.length; r++) {
        // Get a row
        var row = $(rows.get(r));

        // Determine the row ID
        var id = row.find('input[name="id"]').val();

        // Find and loop over the stars, installing a listener for each
        var stars = row.find("img");
        for(var s=0; s<stars.length; s++) {
            var star = $(stars.get(s));

            // We are at a star
            this.installListener(sel, row, star, id, s+1);
        }

    }

}



Stars.prototype.installListener = function(sel, row, star, id, rating) {
    var that = this;

    star.click(function() {

        console.log("Click on " + id + " rating: " + rating);

        $.ajax({
            url: "post/stars.php",
            data: {id: id, rating: rating},
            method: "POST",
            success: function (data) {
                var json = parse_json(data);
                if (json.ok) {
                    // Successfully updated
                    that.update(row, rating);
                    that.message("<p>Successfully updated</p>");
                    that.updateTable(json.table);
                    new Stars(sel);

                } else {
                    // Update failed
                    that.message("<p>Update failed</p>");

                }
            },
            error: function (xhr, status, error) {
                // Error
                that.message("<p>Error: " + error + "</p>");
            }
        });

    });

};



Stars.prototype.update = function(row, rating) {

    // Loop over the stars, setting the correct image
    var stars = row.find("img");
    for(var s=0; s<stars.length; s++) {
        var star = $(stars.get(s));

        if(s < rating) {
            star.attr("src", "images/star-green.png")
        } else {
            star.attr("src", "images/star-gray.png");
        }
    }

    var num = row.find("span.num");
    num.text("" + rating + "/10");
};




Stars.prototype.message = function(message) {
    console.log("message envoked");
    $(" .messages").html(message).show().delay(2000).fadeIn(1000).fadeOut(1000);
};

Stars.prototype.updateTable = function(table) {
    $('table').html(table);
};


