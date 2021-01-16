$(document).ready(function (){
    $(".hidden_images").each(function(){
        let id= $(this).attr("id");
        let imagenes = $("#"+ id).val().split(",");
        let imagen="<img src='/uploads/" + imagenes[0] +
             "' alt='imagen' width='300' height='300'>";
        $("#divImages_" + id).append(imagen);
    });

   showSlides(n);
});



var slideIndex = 0;
showSlides(slideIndex);

// Next/previous controls
function plusSlides(n) {
  showSlides(slideIndex += n);
}

// Thumbnail image controls
function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("dot");
  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " active";
}