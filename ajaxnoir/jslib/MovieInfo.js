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