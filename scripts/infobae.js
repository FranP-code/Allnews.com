//todo - Informacion de infobae

title = document.getElementsByClassName('article-headline')[0];
console.log(title);

sub_title = document.getElementsByClassName('article-subheadline')[0];
console.log(sub_title);

content = document.getElementsByClassName('nd-body-article')[0];
console.log(content);

trash = [document.getElementsByClassName('infogram-embed')[0]];
console.log(trash);

paragraphs = document.querySelectorAll('.paragraph, .visual__image');
console.log(paragraphs);

infobae = document.getElementsByTagName('article')[0];


//todo - Estructura del sitio web cliente

all = document.getElementsByClassName('all')[0];
console.log(all);

//todo - Purificacion de la informacion

for (let i = 0; i < paragraphs.length; i++) {
    if (paragraphs[i].innerHTML == "<b>SEGUIR LEYENDO:</b>" || paragraphs[i].innerHTML == "<b>SEGUIR LEYENDO</b>" || paragraphs[i].innerHTML == "<br>") {
        console.log("AAAAA");
        trash.push(paragraphs[i])

    }
    
}

title.innerHTML = ''

for (let i = 0; i < trash.length; i++) {
    if (trash[i] !== undefined){
        trash[i].innerHTML = ''
        trash[i].remove();
    }
}

//todo - Copiar e insertar informacion en el sitio web cliente

//! TITULO
all.appendChild(title);

frist_p = document.createElement("P")
frist_p.innerText = sub_title.innerText

//! PARRAFOS
paragraphsFragment = document.createDocumentFragment();

paragraphsFragment.appendChild(frist_p)

for (let i = 0; i < paragraphs.length; i++) {

    if (paragraphs[i].className == "visual__image ") {
        console.log("AAAA");

        paragraphs[i].children[0].style.height = "auto"
        paragraphs[i].children[0].style.width = "100%"
    }

    console.log(paragraphs[i]);
    paragraphsFragment.appendChild(paragraphs[i])
    
}

article = document.createElement('article')

article.appendChild(paragraphsFragment)

all.appendChild(article)

//todo - Eliminar informacion de infobae

infobae.remove()

//todo - Eliminar el script

script = document.getElementById('script-estructurator');

script.remove()