function getPrices() {
    return {
        colors: [30000, 40000, 35000],
        zoomx: {
            x10: 20000,
            x15: 35000,
            x25: 45000
        },
        functions: {
            thermalImager: 15000,
            interface: 30000
        }
    };
}

function updatePrice() {
    let s = document.getElementsByName("color");
    let select = s[0];
    let price = 0;
    let prices = getPrices();
    let priceIndex = parseInt(select.value) - 1;
    if (priceIndex >= 0) {
        price = prices.colors[priceIndex];
    }

    let radioDiv = document.getElementById("zoom");
    radioDiv.style.display = (
        select.value === "2"
        ? "block"
        : "none"
    );

    if (select.value === "2") {
        let zoom = document.getElementsByName("zoomx");
        zoom.forEach(function (radio) {
            if (radio.checked) {
                let zoomX = prices.zoomx[radio.value];
                price += zoomX;
            }
        });
    }

    let checkDiv = document.getElementById("functions");
    checkDiv.style.display = (
        select.value === "3"
        ? "block"
        : "none"
    );

    if (select.value === "3") {
        let functions = document.querySelectorAll("#functions input");
        functions.forEach(function (checkbox) {
            if (checkbox.checked) {
                let propPrice = prices.functions[checkbox.name];
                price += propPrice;
            }
        });
    }
    let kolvo = document.getElementById("kolvo");

    let prodPrice = document.getElementById("prodPrice");
    prodPrice.innerHTML = "Текущая стоимость: " + kolvo.value * price + " руб.";
}

window.addEventListener("DOMContentLoaded", function () {

    updatePrice();
    let radioDiv = document.getElementById("zoom");
    radioDiv.style.display = "none";

    let s = document.getElementsByName("color");
    let select = s[0];
    select.addEventListener("change", function () {
        updatePrice();
    });

    let zoom = document.getElementsByName("zoomx");
    zoom.forEach(function (radio) {
        radio.addEventListener("change", function () {
            updatePrice();
        });
    });

    let functions = document.querySelectorAll("#functions input");
    functions.forEach(function (checkbox) {
        checkbox.addEventListener("change", function () {
            updatePrice();
        });
    });
    let kolvo = document.getElementById("kolvo");
    kolvo.addEventListener("input", function () {
        updatePrice();
    });

});

$(document).ready(function () {
    $(".gallery").slick({
        dots: true,
        infinite: true,
        slidesToShow: 2,
        slidesToScroll: 2,
        arrows: false,
        mobileFirst: true,
        responsive: [
            {
                breakpoint: 1080,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 2,
                    arrows: true
                }
            }
        ]
    });
});
