function randomWord() {
    var words = ["moon","home","mega","blue","send","frog","book","hair","late",
        "club","bold","lion","sand","pong","army","baby","baby","bank","bird","bomb","book",
        "boss","bowl","cave","desk","drum","dung","ears","eyes","film","fire","foot","fork",
        "game","gate","girl","hose","junk","maze","meat","milk","mist","nail","navy","ring",
        "rock","roof","room","rope","salt","ship","shop","star","worm","zone","cloud",
        "water","chair","cords","final","uncle","tight","hydro","evily","gamer","juice",
        "table","media","world","magic","crust","toast","adult","album","apple",
        "bible","bible","brain","chair","chief","child","clock","clown","comet","cycle",
        "dress","drill","drink","earth","fruit","horse","knife","mouth","onion","pants",
        "plane","radar","rifle","robot","shoes","slave","snail","solid","spice","spoon",
        "sword","table","teeth","tiger","torch","train","water","woman","money","zebra",
        "pencil","school","hammer","window","banana","softly","bottle","tomato","prison",
        "loudly","guitar","soccer","racket","flying","smooth","purple","hunter","forest",
        "banana","bottle","bridge","button","carpet","carrot","chisel","church","church",
        "circle","circus","circus","coffee","eraser","family","finger","flower","fungus",
        "garden","gloves","grapes","guitar","hammer","insect","liquid","magnet","meteor",
        "needle","pebble","pepper","pillow","planet","pocket","potato","prison","record",
        "rocket","saddle","school","shower","sphere","spiral","square","toilet","tongue",
        "tunnel","vacuum","weapon","window","sausage","blubber","network","walking","musical",
        "penguin","teacher","website","awesome","attatch","zooming","falling","moniter",
        "captain","bonding","shaving","desktop","flipper","monster","comment","element",
        "airport","balloon","bathtub","compass","crystal","diamond","feather","freeway",
        "highway","kitchen","library","monster","perfume","printer","pyramid","rainbow",
        "stomach","torpedo","vampire","vulture"];

    return words[Math.floor(Math.random() * words.length)];
}

function hangman() {
    var word = randomWord();
    var length = word.length;
    var initial = function () {
        var result = '';
        for(var i=0; i<length; i++){
            result += '_ ';
        }
        return result;
    };
    var change = function (n, x) {
        var result = '';
        for(var i=0; i<2*n; i++){
            result += current.charAt(i);
        }
        result += x + ' ';
        for(var j=2*n+2; j<2*length; j++){
            result += current.charAt(j);
        }
        return result;
    };
    var check = function(value){
        for(var i = 0; i < length; i++){
            if(word.charAt(i) === value){
                return true;
            }
        }
        return false;
    };
    var checkDone = function () {
        for(var i = 0; i < length; i++){
            if(word.charAt(i) !== current.charAt(2*i)){
                return false;
            }
        }
        return true;
    };
    var current =initial();
    var stop = false;

    var wrong = 0;

    var output = "<form id='game'><p><input type=\"hidden\" id=\"word\"></p><p id=\"img\"></p>";
    output += "<p id='current'></p>";
    output += "<p><label for=''>Letter:</label><input type='text' id='text'></p><p><input type='submit' id='guess' value='Guess!'> <input type='submit' id='new' value='New Game'></p></form><p id='warning'></p>"
    document.getElementById("play-area").innerHTML = output;


    var display = function (x, warning) {
        document.getElementById('img').innerHTML = "<img src='assets/hm"+ x +".png' width='125' height='300' alt='hangman'>";
        document.getElementById('current').innerHTML = current;
        document.getElementById('warning').innerHTML = warning;
        document.getElementById('word').value = word;

        var guessBtn = document.getElementById('guess');
        var newBtn = document.getElementById('new');

        guessBtn.onclick = function (event) {
            event.preventDefault();
            var value = document.getElementById('text').value;
            if((value === ' ' || value === '') && !stop){
                display(wrong, 'You must enter a letter!');
                document.getElementById('text').value = '';
            }
            else if(check(value) && !stop) {
                for(var i = 0; i < length; i++){
                    if(value === word.charAt(i)){
                        current = change(i,value);
                        if(checkDone()) {
                            display(wrong, 'You Win!');
                            stop = true;
                            document.getElementById('text').value = '';
                        }
                        if(!stop) {
                            display(wrong, '');
                            document.getElementById('text').value = '';
                        }
                    }
                }
            }
            else{
                if(wrong < 5 && !stop) {
                    wrong++;
                    display(wrong, '');
                    document.getElementById('text').value = '';
                }
                else if(!stop){
                    for(var i = 0; i < length; i++){
                        current = change(i,word.charAt(i));
                        document.getElementById('text').value = '';
                    }
                    display(wrong + 1, 'You guessed poorly!')
                    stop = true;
                    document.getElementById('text').value = '';
                }
            }
        };
        newBtn.onclick = function (event) {
            event.preventDefault();
            word = randomWord();
            length = word.length;
            current =initial();
            stop = false;
            wrong = 0;
            console.log(word);
            display(wrong, '');
            document.getElementById('text').value = '';
        };
    };

    display(0,'');

    console.log(word);
}