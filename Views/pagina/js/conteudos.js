


$(function () {
    var curSlide = 0;
    var maxSlide = $('.slider').length -1;
    console.log(maxSlide)
    var delay = 3
    initSlider();
    changeSlider();

    function initSlider(){
        $('.slider').hide()
        $('.slider').eq(0).show()
    }

    function changeSlider(){
        setInterval(function(){
            $('.slider').eq(curSlide).fadeOut();
            curSlide++;
            if(curSlide > maxSlide)
                curSlide = 0
                $('.slider').eq(curSlide).fadeIn();
        },delay * 1000)
    }

})

$(document).ready(function(){

    $('#link').on('change', function () {
         var url = $(this).val(); 
         if (url) { 
             window.open(url, '_blank');
          }
          return false;
        });
});

const botao = document.getElementById('adicionar')
var addItemId = 0;
botao.addEventListener('click', function(){
    //addItemId++;
    // const imagem = document.getElementById('imagem1').currentSrc;
    // const divConteudo = document.getElementById('produto-carrinho')
    // var selectedItem = document.createElement('div')
    // selectedItem.classList.add('cardImg')
    // selectedItem.setAttribute('id',addItemId)
    // divConteudo.appendChild(selectedItem)
    //     console.log(imagem)
    

    addItemId += 1
    var item = document.getElementById('item2')
     var selectedItem = document.createElement('div')
     selectedItem.classList.add('cardImg')
     selectedItem.setAttribute('id',addItemId)
     var img = document.createElement('img')
     img.setAttribute('src',item.children[0].currentSrc)
     var title = document.createElement('div');
     title.innerText = item.children[1].innerText
     var label = document.createElement('span')
     var select = document.createElement('div')
     label.innerText = item.children[2].children[0].innerText
     select.innerText = item.children[2].children[1].value
     label.append(select)
     var cartItems = document.getElementById('produto-carrinho')
     selectedItem.append(img)
     selectedItem.append(title)
     selectedItem.append(label)
     cartItems.append(selectedItem)
})


// function addToCart(item){
   
    
   
//     img.setAttribute('src',item.children[0].currentSrc)
//     var title = document.createElement('div');
//     title.innerText = item.children[1].innerText
//     var label = document.createElement('span')
//     var select = document.createElement('div')
//     label.innerText =item.children[2].children[0].innerText
//     select.innerText = item.children[2].children[1].value
//     label.append(select)
//     var cartItems = document.getElementById('title')
//     selectedItem.append(img)
//     selectedItem.append(title)
//     selectedItem.append(label)
//     cartItems.append(selectedItem)
// }