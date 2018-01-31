function Simon(sel) {


    this.form = $(sel);
    this.curr_state = "initial";
    this.game_sequence = [];
    this.current = 0;
    this.button_press = [];
    this.button_colors = ['Red', 'Green', 'Blue', 'Yellow'];

    for(var i = 0; i < this.form.find("input").length; i ++) {
        this.setButton($(this.form.find("input").get(i)));
    }

    this.play();
}

Simon.prototype.setButton = function(button) {
    var that = this;


    button.mousedown(function(event) {
        button.css("background-color", this.value);
    });
    button.mouseup(function(event) {
        button.css("background-color", "lightgrey");
    });
    button.click(function(event) {
        var col = this.value;
        var button = this;
        that.buttonPress(col);

        if(that.curr_state === "fail"){

            document.getElementById('Buzzer').currentTime = 0;
            document.getElementById('Buzzer').play();
            window.setTimeout(function() {
                that.failstate(button);
            }, 1000);
        }
        else if(that.curr_state === "play"){
            that.playstate(this);
            console.log(that.game_sequence);
            window.setTimeout(function() {
                that.button_press = [];
                that.play();
            }, 1000);
        }
        else {
            that.enterstate(this);
        }
    });

};

Simon.prototype.play = function() {
    this.curr_state = "play";    // State is now playing
    this.current = 0;       // Starting with the first one
    this.game_sequence.push(Math.floor(Math.random() * 4));
    this.playCurrent();

};

Simon.prototype.playCurrent = function() {
    var that = this;
    if(this.current < this.game_sequence.length) {

        var now = this.game_sequence[this.current];
        document.getElementById(that.button_colors[now]).currentTime = 0;
        document.getElementById(that.button_colors[now]).play();
        this.buttonOn(now);
        this.current++;

        window.setTimeout(function() {
            that.playCurrent();
        }, 1000);
    } else {
        this.buttonOn(-1);
        this.curr_state = "enter";
    }
};

Simon.prototype.buttonOn = function(active) {
    var that = this;
    if(active !== -1) {
        $('input').css("background-color", "lightgrey");
        $(that.form.find("input").get(active)).css("background-color", that.button_colors[active]);
    }
    else{
        $('input').css("background-color", "lightgrey");
    }
};

Simon.prototype.buttonPress = function(button) {
    if(this.button_press.length < this.game_sequence.length){
        this.button_press[this.button_press.length] = this.button_colors.indexOf(button);
        for(var i = 0; i < this.button_press.length;  i++) {
            if (this.button_press[i] !== this.game_sequence[i]) {
                this.curr_state = "fail";
                return;
            }
            else{
                this.curr_state = 'enter';
            }
        }
        if(this.button_press.length === this.game_sequence.length){
            this.curr_state = "play";
        }
    }
};

Simon.prototype.failstate = function () {
    this.game_sequence = [];
    this.button_press = [];
    this.play();
};
Simon.prototype.playstate = function (btn) {
    document.getElementById(btn.value).currentTime = 0;
    document.getElementById(btn.value).play();
};
Simon.prototype.enterstate = function (btn) {
    document.getElementById(btn.value).currentTime = 0;
    document.getElementById(btn.value).play();
};