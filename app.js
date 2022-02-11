const $$= document.querySelectorAll.bind(document)
const $= document.querySelector.bind(document)

// start
;(function() {

    active()
    changeImage()
    setInterval(changeColorIcon, 3000)
    showBtn()

    // Modal
    showModal()
    hideModal()

    // Gallery
    closeGallery()
    indexImage()
    increaseDecrease()
}) ()

// Active

function active() {

    const headerNavProduct=
        $$('.header__nav--product')
    
    headerNavProduct.forEach((product, i) => {
        product.addEventListener('click', e => {

            $('.header__nav--product.active').classList.remove('active')
            product.classList.add('active')
        })
    })
}

// show Modal
function showModal() {
    const bar= $('.header__main--brand > i')
    bar.addEventListener('click', e => {

        $('.modal').classList.add('show')
    })
}

// hide Modal
function hideModal() {

    const close= $('.modal__nav i')
    close.addEventListener('click', e => {
        $('.modal').classList.remove('show')
    })
}

// change background image

function changeImage() {

    const image= $('.header__background')
    const linkImg=
        [
            "url('./img/bg_header/apple.jpg')",
            "url('./img/bg_header/store.jpg')",
            "url('./img/bg_header/computer.jpg')"
        ]
    
    let i= 0
    
    image.style.backgroundImage= linkImg[i]

    setInterval(() => {
    // change image 
        ++i
        image.style.backgroundImage= linkImg[i]
        
        if(i >= linkImg.length) {
            i= 0
        }

        image.style.backgroundImage= linkImg[i]
    }, 3000)
}

// change color icon each 3000s
function changeColorIcon() {

    const icons= $$('.header__background--modal i')
    for(let i = 0; i < icons.length; ++i) {
        icons[i].style.background= '#fff'
    }

    ++index
    
    if(index > icons.length) // return
        index= 1
    icons[index - 1].style.background= 'var(--primary-color)'
}
let index= 0
changeColorIcon()

// show btn when click input
function showBtn() {

    const input= $('.body__comment--input')
    input.addEventListener('click', e => {
        $('.body__comment--btn').classList.add('showBtn')
    })
}

// list comment else user
const datas= [
    {
        user: 'Ha Phuong',
        comment: 'Shop ơi ship về Nam Định mất mấy ngày ạ'
    },
    {
        user: 'Viet Loi',
        comment: 'Còn hàng ko shop'
    },
    {
        user: 'Thanh Quỳnh',
        comment: 'Shop ship về địa chỉ này cho em nhé'
    },
    {
        user: 'Nguyen Hanh',
        comment: 'Tu van em nhe shop'
    },
    {
        user: 'Ai Nhan',
        comment: 'em nhận được hàng rồi nhé shop, cảm ơn ạ'
    }
]

;(function () {

    const html= datas.map((data, i) => {
        return `
        <div class="body__comment--wrapList">
                            
            <span class="list-avata">
                <i class='bx bx-user'></i>
            </span>
            <span class="list-userName">
                ${data.user}
            </span>

            <div class="list-content">
                ${data.comment}
            </div>
        </div>
        `
    }).join('')

    // render
    $('.body__comment--list').innerHTML= html
}) ()

// list comment user
const datas2= []

    // push to array when Enter
function push() {
    let value
    const input= $('.body__comment--input')

    input.addEventListener('keyup', e => {
        if(e.keyCode === 13) {

            value= e.target.value.trim('')
    
            datas2.unshift(value)
            commentUser()
            input.value = ''
        }
    })
}
push()

    // push to array when click btn
function btn() {
    let value
    const btn= $('.body__comment--btn')

    btn.addEventListener('click', e => {

        value= $('.body__comment--input').value.trim('')
        datas2.push(value)
        commentUser()
        $('.body__comment--input').value = ''
    })
}
btn()

    // render
function commentUser() {

    $('.body__comment--user').innerHTML= ''

    for(let i= 0; i < datas2.length; ++i) {
        
        $('.body__comment--user').innerHTML += `
        
        <div class=" body__comment--wrapUser">
            <div class="row ">

                <div class="col l-10">
                
                    <span class="user-avata">
                        <i class='bx bx-user'></i>
                    </span>
                    <span class="user-Name">
                        Quan Trinh
                    </span>
                    <div class="user-content">
                        ${datas2[i]}
                    </div>
                </div>

                <div class="col l-1 body__comment--icon">
                    <i onclick="getValueComment(${i})" class='bx bx-pencil'></i>
                </div>
                <div class="col l-1 body__comment--icon">
                    <i onclick="deleteCommentUser(${i})" class="far fa-trash-alt"></i>
                </div>
            <div>
        <div>
        `
    }

    
}

// delete comment user when click track
function deleteCommentUser(id) {

    const nodeDelete= $('.body__comment--icon .far')
    datas2.splice(0, 1)
    commentUser()
}

// edit comment user when click pencil
function getValueComment(id) {

    const content= $('.user-content')
    
    content.style.border= '1px solid #666'
    content.setAttribute('contentEditable', 'true')
    content.setAttribute('autofocus', 'true')
    console.log([content])      
    
    content.addEventListener('keyup', e => {

        if(e.keyCode === 13) {
            datas2[id] = content.innerText
            commentUser()
        }
    })
}
// Gallery

    // close Gallery 
function closeGallery() {

    // close Gallery when click icon vs gallery
    
    const nodeCloses= $$('.gallery__product > i, .gallery')

    nodeCloses.forEach(nodeClose => {
        nodeClose.addEventListener('click', e => {

            $('.gallery').classList.remove('show')
        })
    })

    // su kien noi bot
    $('.gallery__product').addEventListener('click', e => {
        e.stopPropagation()
    })
    
}

// index
let id= 0
function indexImage() {

    const imageProducts= $$('.body__hot--product img, .body__flash .col img')

    imageProducts.forEach((imageProduct, i) => {
        imageProduct.addEventListener('click', e => {

            showGallery()

            id = i
            showExacllyImage()
        })
    })
}

    // show gallery when click image
function showGallery() {

    $('.gallery').classList.add('show')
}

    // show exaclly image 
function showExacllyImage() {

    const img= $('.gallery__product--img img')
    img.src= $$('.body__hot--product img, .body__flash .col img')[id].src
}

    // increase vs decrease
function increaseDecrease() {

    let number= 1

    // increase
    function increase() {

        const plus= $('.info__qual--increase i')

        plus.addEventListener('click', e => {
            ++number
            $('.info__qual--number').innerText= number
            total()

        })
    }
    increase()

    // decrease
    function decrease() {
        const subtract= $('.info__qual--decrease i')

        subtract.addEventListener('click', e => {
            --number

            if(number < 0) {
                number = 0
                total()

            }
            $('.info__qual--number').innerText= number
            total()
        })
    }
    decrease()

    function total() {

        $('.info__total--number').innerText=
        parseFloat($('.info__price--number').innerText) * number
    }
}

