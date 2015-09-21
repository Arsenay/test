

function change_window_size(){
    var window_width = $(window).width();
    console.log(window_width);
    if(window_width<=500){
        $('.unit').attr('column','1');
    }
    else if(window_width>500 && window_width<=800){
        $('.unit').attr('column','2');
    }
    else if(window_width>800 && window_width<=1000){
        $('.unit').attr('column','3');
    }
    else if(window_width>1000 && window_width<=1300){
        $('.unit').attr('column','4');
    }
    else if(window_width>1300 && window_width<=1600){
        $('.unit').attr('column','5');
    }
    else if(window_width>1600){
        $('.unit').attr('column','6');
    }
}

$(document).ready(function(){
    change_window_size();
});

$(window).resize(function(){
    change_window_size();
});

function move_elem(elem){
    var num = $(elem).text();
    var x = $(elem).attr('x');
    var y = $(elem).attr('y');
    var x_e = $('.empty').attr('x');
    var y_e = $('.empty').attr('y');
    if(x==x_e && Math.abs(y-y_e)==1 || Math.abs(x-x_e)==1 && y==y_e){
        $('.empty').text(num);
        $('.empty').removeClass('empty');
        $(elem).text('');
        $(elem).addClass('empty');
    }
}

function play(elem){
    move_elem(elem);
    check_win();
}

function check_win(){
    var condition = true;
    var num = 0;
    $('.elem_n').each(function(n,elem){
        if(n>14){return;}
        //console.log(n,parseInt(num,10), parseInt($(elem).text(),10),parseInt(num,10) > parseInt($(elem).text(),10));
        if(parseInt(num,10) > parseInt($(elem).text(),10) || $(elem).text()==''){
            //console.log(n,parseInt(num,10), parseInt($(elem).text(),10));
            condition = false;
        }
        num = $(elem).text();
    });
    if(condition){
        alert('Перемога!');
    }
}

function rotate(){
    for(var i=0; i<500; i++){
        var rand_num = selfRandom(1,4);
        //console.log(rand_num);
        var x_e = parseInt($('.empty').attr('x'),10);
        var y_e = parseInt($('.empty').attr('y'),10);
        
        if(rand_num==1){
            console.log('RIGHT');
            x_e = x_e+1;
        }
        else if(rand_num==2){
            console.log('LEFT');
            x_e = x_e-1;
        }
        else if(rand_num==3){
            console.log('DOWN');
            y_e = y_e+1;
        }
        else{
            console.log('UP');
            y_e = y_e-1;
        }
        move_elem($('.elem_n[x='+x_e+'][y='+y_e+']'));
    }


    function selfRandom(min, max)
    {
      return Math.floor(Math.random() * (max - min + 1)) + min;
    }
}