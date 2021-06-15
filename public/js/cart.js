// add product to cart

(function () {

    const cartBtn = document.querySelectorAll('.add-to-cart');

    cartBtn.forEach(function (btn) {
        btn.addEventListener('click', function (event) {
            // console.log(event.target);

            if (event.target.parentElement.classList.contains('add-to-cart')) {
                console.log(event.target.parentElement.parentElement.parentElement.parentElement.parentElement.previousElementSibling);
            }

        });
    });

})();
