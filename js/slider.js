$('.slider').slider(
    {
        indicators: false
}
);
$('.materialboxed').materialbox();
function slides_atras() {
    $('.slider').slider('prev');
}
function slides_adelante() {
    $('.slider').slider('next');
}
