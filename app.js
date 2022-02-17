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
    // dung vong for cho het icon mau trang roi sau moi 3s cho mau den
}
let index= 0
changeColorIcon()

// show btn when click input
function showBtn() {

    const input= $('.body__comment--input')
    
    input.addEventListener('click', e => {
        $('.body__comment--btn').classList.add('showBtn')
    })

    btn()
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
        value= e.target.value.trim('')
        // when enter on input
        if(e.keyCode === 13 && !datas2.includes(value) && value !== '') {

    
            datas2.unshift(value)
            commentUser()
            input.value = ''
        }

        // when click btn on input
    })
}
push()

    // push to array when click btn
function btn() {
    let value
    const btn= $('.body__comment--btn')

    btn.addEventListener('click', e => {

        value= $('.body__comment--input').value.trim('')

        if(!datas2.includes(value) && value !== '') {

            datas2.unshift(value)
            commentUser()
            $('.body__comment--input').value = ''
        }
    })
}

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

    const nameRegister= document.querySelector('span.user-Name')
    const name= document.querySelector('#register__name')

    if(name.value !== '') {

        nameRegister.innerText= name.value
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

    let value
    const content= $('.user-content')
    
    content.style.border= '1px solid #666'
    content.style.padding= '1rem 2rem'
    content.setAttribute('contentEditable', 'true')
    content.setAttribute('autofocus', 'true')
    
    content.addEventListener('keyup', e => {
        value= content.innerText.trim('')

        if(e.keyCode === 13 && !datas2.includes(value) ) {
            datas2[id] = value
            commentUser()
        }
        
    })
}

// Login
;(function() {
    const name= $('#name')
    const password= $('#password')
    const form= $('#login__btn')
    const showLogin= $('.wrapper__register')
    const hideLogins= $$('.container__login, .login > i')
    const container= $('.container__login')
    const user= $('.info__user')

    // show form login
    function showFormLogin() {
        
        showLogin.addEventListener('click', handleFormLogin)
    }
    showFormLogin()
        // handleFormLogin
    function handleFormLogin() {

        container.classList.add('show')
    }

    // hide form login
    function hideFormLogin() {

        hideLogins.forEach(hideLogin => {
            hideLogin.addEventListener('click', handleHideFormLogin)
        })
    }
    hideFormLogin()
        // handleHideFormLogin
    function handleHideFormLogin() {
        
        container.classList.remove('show')
    }

    // stop propagation
    $('.login').addEventListener('click',e => {
        e.stopPropagation()
    })

    
    // show error
    function showError(input, message) {
        
        input.classList.add('error')
        const wrapInput= input.parentElement
        const Error= wrapInput.querySelector('small')
        Error.innerText= message
    }

    // show success
    function showSuccess(input) {
        input.classList.add('success')
        input.classList.remove('error')

        const wrapInput= input.parentElement
        const Error= wrapInput.querySelector('small')
        Error.innerText= ''
        return true
    }

    // CLICK BUTTON: 6 < UserName < 20  ký tự
    function checkLengthUser(input, min, max) {
        let ischeckLengthUser= true

        input.value= input.value.trim()

        
        if( !(input.value === 'quan.tm.735@aptechlearning.edu.vn')) {
            showError(input, `UserName do not match`)
        } else {
            ischeckLengthUser= false
        }
        // showSuccess(input)
        return ischeckLengthUser 
    }

    // Check Password
    function checkPassword(input) {
        let ischeckPassword = true

        input.value= input.value.trim()
        if( !(input.value === 'Trinhminhquan123')) {

            showError(input, `Password do not match`)
        } else {
            ischeckPassword = false
        }
        return ischeckPassword
    }

    // CLICK BUTTON:input nào còn trống sẽ showError()
    function checkEmptyError(inputs) {
        let isEmptyError= true

        inputs.forEach(input => {
            
            input.value= input.value.trim()
            if(!input.value) {
                isEmptyError= false
                showError(input, 'khong duoc de trong')
            } else {
                if(showSuccess(input)) {

                    let isCheckLengthUser= checkLengthUser(name, 6, 20)
                    let isCheckPassword= checkPassword(password)

                    if(isCheckPassword || isCheckLengthUser) {
                        console.log('khong lam gi ca')
                    } else {
                        handleHideFormLogin()
                        user.classList.add('show')
                    }
                }
            }
        })
        return isEmptyError
    }

    // click button
    form.addEventListener('click', (e) => {
        e.preventDefault()

        checkEmptyError([name, password])
    })
})()

// Register
;(function() {
const name= document.getElementById('register__name')
const email= document.getElementById('register__email')
const password1= document.getElementById('register__password1')
const confirmPassword= document.getElementById('register__password2')
const form= document.querySelector('#register')

// 
const showLogin= $('.wrapper__login')
const hideLogins= $$('.container__register, .register > i')
const container= $('.container__register')
const user= $('.info__user')



// show error
function showError(input, message) {
    input.classList.add('error')
    const wrapInput= input.parentElement
    const Error= wrapInput.querySelector('small')
    Error.innerText= message
}

// show success
function showSuccess(input) {
    input.classList.add('success')
    input.classList.remove('error')
    
    const wrapInput= input.parentElement
    const Error= wrapInput.querySelector('small')
    Error.innerText= ''
    return true

}

// show form login
function showFormLogin() {
        
    showLogin.addEventListener('click', handleFormLogin)
}
showFormLogin()
    // handleFormLogin
function handleFormLogin() {

    container.classList.add('show')
}

// hide form login
function hideFormLogin() {

    hideLogins.forEach(hideLogin => {
        hideLogin.addEventListener('click', handleHideFormLogin)
    })
}
hideFormLogin()
    // handleHideFormLogin
function handleHideFormLogin() {
    
    container.classList.remove('show')
}

// stop propagation
$('.register').addEventListener('click',e => {
    e.stopPropagation()
})


// CLICK BUTTON:input nào còn trống sẽ showError()
function checkEmptyError(inputs) {

    inputs.forEach(input => {

        input.value= input.value.trim()

        if(!input.value) {
            showError(input, 'khong duoc de trong')
        } else {
            if(showSuccess(input)) {
                let isCheckEmail= checkEmail(email)
                let isCheckLengthUser= checkLengthUser(name, 6, 20)
                let isMathPassword= mathPassword(password1, confirmPassword)

                if(isCheckEmail || isCheckLengthUser || isMathPassword) {
                    console.log('khong lam gi ca')
                } else {
                   
                    handleHideFormLogin()
                    user.classList.add('show')
                    user.innerText= name.value
                    console.log(user.innerText)
                }
            }
        }
    })
}
// CLICK BUTTON: email ko hợp lệ sẽ showError()
function checkEmail(input) {
    const regexEmail=
    /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
    input.value= input.value.trim()

    let isEmail= !regexEmail.test(input.value)
    if(regexEmail.test(input.value)) {
        showSuccess(input)
    } else {
        showError(input, 'email không hợp lệ ')
    }
    return isEmail
}

// CLICK BUTTON: 6 < UserName < 20  ký tự
function checkLengthUser(input, min, max) {
    
    input.value= input.value.trim()
    if(input.value.length < min) {
        showError(input, `UserName phải lớn hơn ${min} ký tự`)
        return true 
    }
    if(input.value.length > max) {
        showError(input, `UserName phải nhỏ hơn ${max} ký tự`)
        return true 
    }
    // showSuccess(input)
    return false 
}

// CLICK BUTTON: match password
function mathPassword(input1, input2) {
    if(input1.value !== input2.value) {
        showError(input2, 'Password do not match')
        return true
    } else {

        showSuccess(input2)
        return false
    }
}


// click button
form.addEventListener('click', (e) => {
    e.preventDefault()

    checkEmptyError([name, email, password1, confirmPassword])  
})

})()


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

// Name uset

