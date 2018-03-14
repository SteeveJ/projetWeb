"use strict";

// Action après le chargement du dom
$(document).ready(function(){
    $('.quote').toggle();
    $('#quote_'+quote).toggle();
    $('.square_'+quote).addClass('bg_square');

    initquote();

    $('.carre').on('mousedown', function(){
        clearInterval(quote_interval);
        $('#quote_'+quote).toggle();
        $('.square_'+quote).removeClass('bg_square');
        quote = $(this).data('id');
        $('#quote_'+quote).toggle();
        $('.square_'+quote).addClass('bg_square');
        initquote();
    });

});