var img1 = './imagens/img.png';
var img2 = './imagens/img1.jpg'
var img3 = './imagens/img3.jpg';

const images = [img1, img2, img3];
const img = document.querySelectorAll('#img');

function changeImage() {
    let random = Math.floor(Math.random() * images.length);
    img[0].src = images[random];
}
setInterval(changeImage, 3000);

changeImage();

