Sdocument = document.getElementsByClassName("blob js-post-images-container")[0]

big_blank_space = Sdocument.getElementsByClassName('base-wrapper-image')
console.log(big_blank_space);

ad = Sdocument.getElementsByClassName('desvio-container')
console.log(ad);

imgs = Sdocument.querySelectorAll('img')
console.log(imgs)

for (i = 0; i < ad.length; i++) {
    ad[i].innerHTML = ''
}

for (let i = 0; i < big_blank_space.length; i++) {
    big_blank_space[i].style.paddingTop = ""
    
}

for (let i = 0; i < imgs.length; i++) {
    if (imgs[i].src === "") {
        imgs[i].src = imgs[i].dataset.sfSrc
    }
}

console.log(Sdocument);

links = document.getElementsByClassName('article-links')

links[0].remove()

paragraphs = document.getElementsByTagName('p')

for (i = 0; i < paragraphs.length; i++) {
    if (paragraphs[i].innerHTML.includes("En Xataka |")) {
        paragraphs[i].remove()
    }
}

script = document.getElementById('script-estructurator');

script.remove()