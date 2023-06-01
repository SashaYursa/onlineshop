(function ($) {
  "use strict"

  // Mobile Nav toggle
  $('.menu-toggle > a').on('click', function (e) {
    e.preventDefault();
    $('#responsive-nav').toggleClass('active');
  })

  // Fix cart dropdown from closing
  $('.cart-dropdown').on('click', function (e) {
    e.stopPropagation();
  });


  /////////////////////////////////////////


  // Products Slick
  $('.products-slick').each(function () {
    var $this = $(this),
      $nav = $this.attr('data-nav');

    $this.slick({
      slidesToShow: 4,
      slidesToScroll: 1,
      autoplay: true,
      infinite: true,
      speed: 300,
      dots: false,
      arrows: true,
      appendArrows: $nav ? $nav : false,
      responsive: [{
        breakpoint: 991,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 1,
        }
      },
      {
        breakpoint: 480,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
        }
      },
      ]
    });
  });

  // Products Widget Slick
  $('.products-widget-slick').each(function () {
    var $this = $(this),
      $nav = $this.attr('data-nav');

    $this.slick({
      infinite: true,
      autoplay: true,
      speed: 300,
      dots: false,
      arrows: true,
      appendArrows: $nav ? $nav : false,
    });
  });

  /////////////////////////////////////////

  // Product Main img Slick
  $('#product-main-img').slick({
    infinite: true,
    speed: 300,
    dots: false,
    arrows: true,
    fade: true,
    asNavFor: '#product-imgs',
  });

  // Product imgs Slick
  $('#product-imgs').slick({
    slidesToShow: 3,
    slidesToScroll: 1,
    arrows: true,
    centerMode: true,
    focusOnSelect: true,
    centerPadding: 0,
    vertical: true,
    asNavFor: '#product-main-img',
    responsive: [{
      breakpoint: 991,
      settings: {
        vertical: false,
        arrows: false,
        dots: true,
      }
    },
    ]
  });

  // Product img zoom
  var zoomMainProduct = document.getElementById('product-main-img');
  if (zoomMainProduct) {
    $('#product-main-img .product-preview').zoom();
  }



  /////////////////////////////////////////
  var priceInputMax = document.getElementById('price-max'),
    priceInputMin = document.getElementById('price-min');
  // Input number
  $('.input-number').each(function () {
    var $this = $(this),
      $input = $this.find('input[type="number"]'),
      up = $this.find('.qty-up'),
      down = $this.find('.qty-down');

    down.on('click', function () {
      var value = parseInt($input.val()) - 1;
      value = value < 1 ? 1 : value;
      $input.val(value);
      $input.change();
      updatePriceSlider($this, value);
      outElements(priceInputMin.value, priceInputMax.value);
    })

    up.on('click', function () {
      var value = parseInt($input.val()) + 1;
      $input.val(value);
      $input.change();
      updatePriceSlider($this, value);
      outElements(priceInputMin.value, priceInputMax.value);

    })
  });

  function outElements(priceMin, priceMax) {
    let activeCat = document.querySelector('.active');
    let productItem = document.getElementById('get_product');
    productItem.innerHTML = '';
    let cid = activeCat.getAttribute('cid');
    if (activeCat.classList.contains('categoryhome')) {
      productItem.innerHTML = '';
      $.ajax({
        url: "action.php",
        method: "POST",
        data: { get_seleted_Category: 1, cat_id: cid, maxPrice: priceMax, minPrice: priceMin },
        success: function (data) {
          $("#get_product").html(data);
          if ($("body").width() < 480) {
            $("body").scrollTop(683);
          }
        }
      })
    }
    else {
      document.getElementById('get_product').innerHTML = '';
      $.ajax({
        url: "action.php",
        method: "POST",
        data: { maxPrice: priceMax, minPrice: priceMin },
        success: function (data) {
          $("#get_product").html(data);
          if ($("body").width() < 480) {
            $("body").scrollTop(683);
          }
        }
      })
    }
    return;
  }


  priceInputMax.addEventListener('change', e => {
    e.preventDefault();
    $("#get_product").html("<h3>Loading...</h3>");
    outElements(priceInputMin.value, priceInputMax.value);
  });
  priceInputMin.addEventListener('change', e => {
    e.preventDefault();
    $("#get_product").html("<h3>Loading...</h3>");
    outElements(priceInputMin.value, priceInputMax.value);
  });

  function updatePriceSlider(elem, value) {
    if (elem.hasClass('price-min')) {
    } else if (elem.hasClass('price-max')) {
    }
  }
})(jQuery);
