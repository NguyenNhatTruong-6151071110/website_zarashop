const imgPosition = document.querySelectorAll(".aspect-ratio-169 img")
const imgContainer = document.querySelector('.aspect-ratio-169')
const dotItem = document.querySelectorAll(".dot")
let imgNumb = imgPosition.length
let index = 0
imgPosition.forEach(function(image, index){
    image.style.left = index * 100 + "%"
    dotItem[index].addEventListener("click",function(){
        slider(index)
    })
})
function imgSlide(){
    index++
    if(index >= imgNumb){index=0}
    slider(index)
}
function slider(index){
    imgContainer.style.left = "-" +index*100+ "%"
    const dotActive = document.querySelector(".active")
    dotActive.classList.remove("active")
    dotItem[index].classList.add("active")
}
setInterval(imgSlide, 5000)

// -------------- menu sliderbar category----------------
const itemsliderbar = document.querySelectorAll(".category-left-li")
itemsliderbar.forEach(function(menu,index){
    menu.addEventListener("click", function(){
        menu.classList.toggle("block")
    })

})
// ----------------active size--------------



// ----------------zoom image----------------
// document.addEventListener('DOMContentLoaded',function(){
//     var imageZoom = document.querySelector(".product-content-left-top-img");
//     var image = imageZoom.querySelector('.product-content-left-top-img img');

//     image.addEventListener('click', function(){
//         image.classList.toggle('zommed');
//     })
// })
// -----------------------product-------------------
const gioithieu = document.querySelector(".gioithieu")
const chitiet = document.querySelector(".chitiet")
const baoquan = document.querySelector(".baoquan")
if(gioithieu){
    gioithieu.addEventListener("click",function(){
        document.querySelector(".product-content-right-bottom-content-gioithieu").style.display = "block"
        document.querySelector(".product-content-right-bottom-content-chitiet").style.display = "none"
        document.querySelector(".product-content-right-bottom-content-baoquan").style.display = "none"
    })
}
if(chitiet){
    chitiet.addEventListener("click",function(){
        document.querySelector(".product-content-right-bottom-content-gioithieu").style.display = "none"
        document.querySelector(".product-content-right-bottom-content-chitiet").style.display = "block"
        document.querySelector(".product-content-right-bottom-content-baoquan").style.display = "none"
    })
}
if(baoquan){
    baoquan.addEventListener("click",function(){
        document.querySelector(".product-content-right-bottom-content-gioithieu").style.display = "none"
        document.querySelector(".product-content-right-bottom-content-chitiet").style.display = "none"
        document.querySelector(".product-content-right-bottom-content-baoquan").style.display = "block"
    })
}

const button = document.querySelector(".product-content-right-product-bottom-top")
if(button){
    button.addEventListener("click", function(){
        document.querySelector(".product-content-right-product-bottom-content-big").classList.toggle("activeB")

    })
}