var contact_firstName = document.getElementById('contact_firstName')
var contact_lastName = document.getElementById('contact_lastName')
var contact_phone = document.querySelector('.contact_info-content-phone input')
var contact_email = document.querySelector('.contact_info-content-email input')

document.addEventListener('change', function () {
    document.querySelector('.contact_info-content1-header h4').innerHTML = contact_firstName.value + ' ' + contact_lastName.value
    document.querySelector('.contact_info-content1-phone label').innerHTML = contact_phone.value
    document.querySelector('.contact_info-content1-email label').innerHTML = contact_email.value
})

function saveContact() {
    document.querySelector('.contact_info-content1').style.display = 'block'
    document.querySelector('.contact_info-content').style.display = 'none'

    document.querySelector('.contact_info-content1-header h4').innerHTML = contact_firstName.value + ' ' + contact_lastName.value
    document.querySelector('.contact_info-content1-phone label').innerHTML = contact_phone.value
    document.querySelector('.contact_info-content1-email label').innerHTML = contact_email.value
}

function openItem(a, b) {
    document.querySelector(a).style.display = 'block'
    document.querySelector(b).style.display = 'none'
}

function saveCustomer(a) {
    document.querySelector('.customer_info-content2.' + a).style.display = 'block'
    document.querySelector('.customer_info-content.' + a).style.display = 'none'

    document.querySelector('.customer_info-content2-header.' + a + ' h4').innerHTML = document.querySelector('.title_' + a).value + ' ' + document.querySelector('.firstName_' + a).value + ' ' + document.querySelector('.lastName_' + a).value
    document.querySelector('.customer_info-content2-main1' + a + ' label').innerHTML = document.querySelector('.day_' + a).value + '-' + document.querySelector('.month_' + a).value + '-' + document.querySelector('.year_' + a).value
    document.querySelector('.customer_info-content2-main2' + a + ' label').innerHTML = document.querySelector('.nation_' + a).value

    document.querySelector('.chairDetail_content-main-left' + a + ' article span').innerHTML = document.querySelector('.title_' + a).value + ' ' + document.querySelector('.firstName_' + a).value + ' ' + document.querySelector('.lastName_' + a).value

    if (document.querySelector('.chairDetail_content-main-left' + a + 'Return article span')) {
        document.querySelector('.chairDetail_content-main-left' + a + 'Return article span').innerHTML = document.querySelector('.title_' + a).value + ' ' + document.querySelector('.firstName_' + a).value + ' ' + document.querySelector('.lastName_' + a).value
    }
}

function selectedChair(a) {
    var selected = document.querySelector('.selected_chair')

    if (a) {
        selected.classList.remove('selected_chair')
    }

    a.classList.add('selected_chair')
}

function selectedChair2(a) {
    var selected = document.querySelector('.selected_chair2')

    if (a) {
        selected.classList.remove('selected_chair2')
    }

    a.classList.add('selected_chair2')
}

function chooseChair(a) {
    document.querySelector('.selected_chair label').innerHTML = a;
    document.querySelector('.selected_chair input').value = a

    var newChairContent = document.querySelector('.selected_chair article p').innerHTML;

    var previouslySelected = document.querySelector('.square.selected_chairNumber' + newChairContent);
    if (previouslySelected) {
        previouslySelected.classList.remove('selected_chairNumber' + newChairContent);
        previouslySelected.innerHTML = '';
    }

    var newChairElement = document.querySelector('.' + a);
    newChairElement.classList.add('selected_chairNumber' + newChairContent);
    newChairElement.innerHTML = newChairContent; 
}

function chooseChair2(a) {
    document.querySelector('.selected_chair2 label').innerHTML = a;
    document.querySelector('.selected_chair2 input').value = a

    var newChairContent = document.querySelector('.selected_chair2 article p').innerHTML;

    var previouslySelected = document.querySelector('.square.selected_chairNumber2' + newChairContent);
    if (previouslySelected) {
        previouslySelected.classList.remove('selected_chairNumber2' + newChairContent);
        previouslySelected.innerHTML = '';
    }

    var newChairElement = document.querySelector('.' + a + 'Return');
    newChairElement.classList.add('selected_chairNumber2' + newChairContent);
    newChairElement.innerHTML = newChairContent; 
}

function openselectedChair() {
    document.querySelector('.choose_chairDetail').style.display = 'block'
    document.body.style.overflow = 'hidden'
    window.scrollTo(0, 0)
}

function closeSelectedChair() {
    document.querySelector('.choose_chairDetail').style.display = 'none'
    document.body.style.overflow = 'visible'
}

function doneSelectedChair(a) {
    document.querySelector('.choose_chairDetail').style.display = 'none'
    document.body.style.overflow = 'visible'

    document.querySelector('.' + a + ' input').value = document.querySelector('.' + a + ' label').innerHTML
}

function openbuttonChair() {
    document.querySelector('.choose_chair').style.display = 'block'
    document.querySelector('.customer_info-btn').style.display = 'none'
    document.querySelector('.header_step label:first-child').style.backgroundColor = '#687176'
    document.querySelector('.header_step label:nth-of-type(2)').style.backgroundColor = '#02753d'
}


function checkChooseChair(countAdult, countChild, countInfant, event) {
    var flag = true;

    for (let i = 0; i < countAdult; i++) {
        if (document.querySelector('.chairDetail_content-main-leftAdult' + i + ' label').innerHTML === 'Không chọn') {
            flag = false;
        }
    }

    for (let i = 0; i < countChild; i++) {
        if (document.querySelector('.chairDetail_content-main-leftChild' + i + ' label').innerHTML === 'Không chọn') {
            flag = false;
        }
    }

    for (let i = 0; i < countInfant; i++) {
        if (document.querySelector('.chairDetail_content-main-leftInfant' + i + ' label').innerHTML === 'Không chọn') {
            flag = false;
        }
    }

    if (!flag) {
        alert('Vui lòng chọn ghế.');
        event.preventDefault();
    } else {
        document.getElementById('form_info').submit()
    }
}

function openChairMyFlight(el, a, b, c, d, e) {
    el.style.color = 'var(--color_1)'
    el.style.borderBottom = '2px solid var(--color_1)'
    document.querySelector('.chairDetail_content-main-right-myFlight p:' + a).style.color = '#000'
    document.querySelector('.chairDetail_content-main-right-myFlight p:' + a).style.borderBottom = '2px solid #fff'

    document.querySelector('.chairDetail_content-main-right-chairDep').style.display = b
    document.querySelector('.chairDetail_content-main-right-chairReturn').style.display = c

    document.querySelector('.chairDetail-content-infoAddress').style.display = d
    document.querySelector('.chairDetail-content-infoAddressReturn').style.display = e

    document.querySelector('.chairDetail-content-infoAirline').style.display = d
    document.querySelector('.chairDetail-content-infoAirlineReturn').style.display = e

    document.querySelector('.chairDetail_content-main-left').style.display = b
    document.querySelector('.chairDetail_content-main-leftReturn').style.display = c
}