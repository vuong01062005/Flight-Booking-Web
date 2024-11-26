function openItem(a) {
    var b = document.querySelector('.' + a)
    if (b.style.display === 'flex') {
        b.style.display = 'none'
    } else {
        b.style.display = 'flex'
    }
}

document.getElementById('departure_time').addEventListener('change', calculateDuration)
document.getElementById('arrival_time').addEventListener('change', calculateDuration)
function calculateDuration() {
    var a = document.getElementById('departure_time').value
    var b = document.getElementById('arrival_time').value
    
    if (a && b) {
        var [ah, am] = a.split(':')
        var [bh, bm] = b.split(':')
        if (parseInt(bm) - parseInt(am) < 0) {
            var hours = parseInt(bh) - parseInt(ah) - 1
            var minutes = parseInt(bm) - parseInt(am) + 60
            document.getElementById('time').value = hours + 'h ' + minutes + 'm'
        } else if (parseInt(bm) - parseInt(am) >= 0 && parseInt(bm) - parseInt(am) >= 0) {
            var hours = parseInt(bh) - parseInt(ah)
            var minutes = parseInt(bm) - parseInt(am)
            document.getElementById('time').value = hours + 'h ' + minutes + 'm'
        } else {
            document.getElementById('time').value = '0'
        }
    }
}

document.getElementById('airline').addEventListener('change', function () {
    var a = document.querySelector('.content-airlineBamboo')
    var b = document.querySelector('.content-airlineVietJet')
    var c = document.querySelector('.content-airlineVietnam')
    var d = document.querySelector('.content-airlineVietravel')
    if (document.getElementById('airline').value === 'Bamboo Airways') {
        a.style.display = 'flex'
        b.style.display = 'none'
        c.style.display = 'none'
        d.style.display = 'none'
    } else if (document.getElementById('airline').value === 'VietJet Air') {
        b.style.display = 'flex'
        a.style.display = 'none'
        c.style.display = 'none'
        d.style.display = 'none'
    } else if (document.getElementById('airline').value === 'Vietnam Airlines') {
        c.style.display = 'flex'
        a.style.display = 'none'
        b.style.display = 'none'
        d.style.display = 'none'
    } else if (document.getElementById('airline').value === 'Vietravel Airlines') {
        d.style.display = 'flex'
        a.style.display = 'none'
        b.style.display = 'none'
        c.style.display = 'none'
    }
})
document.querySelectorAll('input[name="aircraft"]').forEach((radio) => {
    radio.addEventListener('change', function () {
        var a321 = document.querySelector('.content-airlineA321')
        var a320 = document.querySelector('.content-airlineA320')
        var Boeing737 = document.querySelector('.content-airlineBoeing737')
        var Boeing787 = document.querySelector('.content-airlineBoeing787')
        var A350 = document.querySelector('.content-airlineA350')
        var A330 = document.querySelector('.content-airlineA330')
        var business = document.querySelector('.main_content-ticketType-business')
        var prenium = document.querySelector('.main_content-ticketType-prenium')
        var economy = document.querySelector('.main_content-ticketType-economy')

        if (this.value === 'A321') {
            a321.style.display = 'flex'
            a320.style.display = 'none'
            Boeing737.style.display = 'none'
            Boeing787.style.display = 'none'
            A350.style.display = 'none'
            A330.style.display = 'none'

            business.style.display = 'block'
            prenium.style.display = 'none'
            economy.style.display = 'block'
        } else if (this.value === 'A320') {
            a320.style.display = 'flex'
            a321.style.display = 'none'
            Boeing737.style.display = 'none'
            Boeing787.style.display = 'none'
            A350.style.display = 'none'
            A330.style.display = 'none'

            business.style.display = 'block'
            prenium.style.display = 'none'
            economy.style.display = 'block'
        } else if (this.value === 'Boeing737') {
            Boeing737.style.display = 'flex'
            a320.style.display = 'none'
            a321.style.display = 'none'
            Boeing787.style.display = 'none'
            A350.style.display = 'none'
            A330.style.display = 'none'

            business.style.display = 'none'
            prenium.style.display = 'none'
            economy.style.display = 'block'
        } else if (this.value === 'Boeing787') {
            Boeing787.style.display = 'flex'
            a320.style.display = 'none'
            a321.style.display = 'none'
            Boeing737.style.display = 'none'
            A350.style.display = 'none'
            A330.style.display = 'none'

            business.style.display = 'block'
            prenium.style.display = 'block'
            economy.style.display = 'block'
        } else if (this.value === 'A350') {
            A350.style.display = 'flex'
            a320.style.display = 'none'
            a321.style.display = 'none'
            Boeing737.style.display = 'none'
            Boeing787.style.display = 'none'
            A330.style.display = 'none'

            business.style.display = 'block'
            prenium.style.display = 'block'
            economy.style.display = 'block'
        } else if (this.value === 'A330') {
            A330.style.display = 'flex'
            a320.style.display = 'none'
            a321.style.display = 'none'
            Boeing737.style.display = 'none'
            Boeing787.style.display = 'none'
            A350.style.display = 'none'

            business.style.display = 'block'
            prenium.style.display = 'block'
            economy.style.display = 'none'
        }
    })
})

$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#flight_code').on('input', function () {
        var flightCode = $(this).val();

        if (flightCode.trim() === '') {
            $('#error-flight_code').text('');
            $('.main_content-error.code').hide();
            return;
        }

        $.ajax({
            type: 'POST',
            url: '/check-flight-code',
            data: {
                flight_code: flightCode,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                $('#error-flight_code').text(response.message);
                $('.main_content-error.code').css('display', 'flex');

                if (response.status === 200) {
                    $('#error-flight_code').css('color', 'green');
                } else {
                    $('#error-flight_code').css('color', 'red');
                }
            },
            error: function (xhr, status, error) {
                var response = xhr.responseJSON;
                if (response && response.message) {
                    $('#error-flight_code').text(response.message);
                    $('#error-flight_code').css('color', 'red');
                } else {
                    $('#error-flight_code').text('Có lỗi xảy ra, vui lòng thử lại.');
                    $('#error-flight_code').css('color', 'red');
                }
            }
        });
    });

    $('#departure_city, #arrival_city').on('change', function () {
        var departureCity = $('#departure_city').val();
        var arrivalCity = $('#arrival_city').val();
        var errorAddress = $('#error-address');

        if (departureCity && arrivalCity) {
            if (departureCity === arrivalCity) {
                errorAddress.text('Điểm đi và điểm đến không được trùng nhau')
                errorAddress.css('color', 'red');
                $('.main_content-error.address').css('display', 'flex');
            } else {
                errorAddress.text('Địa điểm hợp lệ')
                errorAddress.css('color', 'green');
                $('.main_content-error.address').css('display', 'flex');
            }
        } else {
            errorAddress.text()
            $('.main_content-error.address').css('display', 'none');
        }
    })
})

document.addEventListener('DOMContentLoaded', function () {
    var today = new Date().toISOString().split('T')[0];
    document.getElementById('departure_date').value = today;
})

const draggable = document.getElementById('draggable');
draggable.style.left = '100px';
draggable.style.top = '50px';
let isDragging = false;
let offsetX, offsetY;
draggable.addEventListener('mousedown', (e) => {
    isDragging = true;

    offsetX = e.clientX - draggable.offsetLeft;
    offsetY = e.clientY - draggable.offsetTop;

    draggable.style.cursor = 'grabbing';
});
document.addEventListener('mousemove', (e) => {
    if (isDragging) {
        const x = e.clientX - offsetX;
        const y = e.clientY - offsetY;

        draggable.style.left = `${x}px`;
        draggable.style.top = `${y}px`;
    }
});
document.addEventListener('mouseup', () => {
    isDragging = false;
    draggable.style.cursor = 'grab';
});
