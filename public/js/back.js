var animateInFAB = function ( btn ) {
    var varBtn = $(btn);
    if( !$(varBtn).hasClass('active') )
        $(varBtn).addClass('active');
    $("div.fixed-action-btn ul li a.btn-floating").each(function () {
        if( !$(this).hasClass('easeIn') )
            $(this).addClass('easeIn');
    });
};

var animateOutFAB = function ( btn ) {
    var varBtn = $(btn);
    $("div.fixed-action-btn ul li a.btn-floating").each(function () {
        if( $(this).hasClass('easeIn') )
            $(this).removeClass('easeIn');
    });
    var interval = setInterval(function(){
        if( $(varBtn).hasClass('active') );
            $(varBtn).removeClass('active');
        clearInterval(interval);
    }, 420);
    
};