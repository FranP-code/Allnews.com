//todo - Informacion sobre tn

title = document.getElementsByClassName('article__title bold')[0]
console.log(title);

sub_title = document.getElementsByClassName('article__dropline soft')[0]
console.log(sub_title)

article = document.getElementsByClassName('article__body')[0]

trash = [
    document.getElementsByClassName('flex justify_space_between align_items_center padding_bottom-sm')[0],

    document.getElementsByClassName('time__container')[0]
]
console.log(trash);

ads = document.getElementsByClassName('interstitial--link')
console.log(ads)


//todo - Purificacion de la informacion

for (let i = 0; i < trash.length; i++) {
    trash[i].innerHTML = ''    
}

for (let i = 0; i < ads.length; i++) {
    ads[i].innerHTML = '';
    
}

//todo - Añadir sub-titulo al articulo y eliminar el original

newParagraph = document.createElement('p')

newParagraph.innerText = sub_title.innerText

article.prepend(newParagraph)

sub_title.remove()

console.log(newParagraph);

//todo - Eliminar el titulo

title.remove()

//todo - Eliminar el script

script = document.getElementById('script-estructurator');

script.remove()