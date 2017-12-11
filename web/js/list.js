$(document).ready(function(){

    var host = window.location.host;

    function initialLoader(host) {

        $(".productListBlockProducts").empty();
        $.ajax({
            url: 'http://' + host + '/list/list_getlist',
            method : 'GET'

        }).done(function($e) {
            if ($e === 'false') { window.location.href = "/404"; }

            for (var i = 0, len = $e.cats.length; i < len; i++) {
                $(".filterToShow").append($('<option>', {
                    value: $e.cats[i].id,
                    text: $e.cats[i].name
                }));
            }
            for (var i = 0, len = $e.prods.length; i < len; i++) {

                $prods = '<div class="productListBlockProducts_product" xid="' + $e.prods[i].id + '">' + $e.prods[i].name + '</div>';
                $(".productListBlockProducts").append($prods);
            }
        })
        .fail(function() {
            window.location.href = "/404";
        });
    }

    function filterByCategory(host) {
        $("#filterToShowAvailable").change(function(){
            var value = $(this).val();
            $.ajax({
                url: 'http://' + host + '/list/list_filterlist',
                method : 'GET',
                data: {
                    catId: value
                }

            }).done(function($e) {
                if ($e === 'false') { window.location.href = "/404"; }

                $(".productListBlockProducts").empty();
                for (var i = 0, len = $e.prods.length; i < len; i++) {
                    $prods = '<div class="productListBlockProducts_product" xid="' + $e.prods[i].id + '">' + $e.prods[i].name + '</div>';
                    $(".productListBlockProducts").append($prods);
                }
            })
            .fail(function() {
                window.location.href = "/404";
            });
        })
    }

    function addProductToBasket(host) {
        $("body").delegate(".productListBlockProducts_product", 'click', function() {
            var value = $(this).attr("xid");

            $.ajax({
                url: 'http://' + host + '/list/list_addProductToBasket',
                method : 'GET',
                data: {
                    prodId: value
                }

            }).done(function($e) {
                if ($e === 'false') { window.location.href = "/404"; }

                $prod = '<div class="productBasketBlockProducts_product" xid="' + $e.prod[0].id + '">' + $e.prod[0].name +
                    '</div><div class="inlineBlock productBasketBlockProducts_delete" xid="' + $e.prod[0].id + '">X</div>';
                $(".productBasketBlockProducts").append($prod);
            })
            .fail(function() {
                window.location.href = "/404";
            });
        });
    }

    function deleteProductFromBasket(host) {
        $("body").delegate(".productBasketBlockProducts_delete", 'click', function() {
            var value = $(this).attr("xid");
console.log(value);
            $.ajax({
                url: 'http://' + host + '/list/list_deleteProductFromBasket',
                method : 'GET',
                data: {
                    prodId: value
                }

            }).done(function($e) {
                if ($e === 'false') { window.location.href = "/404"; }


            })
                .fail(function() {
                    window.location.href = "/404";
                });
        });
    }

    initialLoader(host);
    filterByCategory(host);
    addProductToBasket(host);
    deleteProductFromBasket(host);

});