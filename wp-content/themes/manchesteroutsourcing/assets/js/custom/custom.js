/* Unslider */
!function($){return $?($.Unslider=function(t,n){var e=this;return e._="unslider",e.defaults={autoplay:!1,delay:3e3,speed:750,easing:"swing",keys:{prev:37,next:39},nav:!0,arrows:{prev:'<a class="'+e._+'-arrow prev">â†</a>',next:'<a class="'+e._+'-arrow next">â†’</a>'},animation:"horizontal",selectors:{container:"ul:first",slides:"li"},animateHeight:!1,activeClass:e._+"-active",swipe:!0},e.$context=t,e.options={},e.$parent=null,e.$container=null,e.$slides=null,e.$nav=null,e.$arrows=[],e.total=0,e.current=0,e.prefix=e._+"-",e.eventSuffix="."+e.prefix+~~(2e3*Math.random()),e.interval=null,e.init=function(t){return e.options=$.extend({},e.defaults,t),e.$container=e.$context.find(e.options.selectors.container).addClass(e.prefix+"wrap"),e.$slides=e.$container.children(e.options.selectors.slides),e.setup(),["nav","arrows","keys","infinite"].forEach(function(t){e.options[t]&&e["init"+$._ucfirst(t)]()}),void 0!==typeof jQuery.event.special.swipe&&e.options.swipe&&e.initSwipe(),e.options.autoplay&&e.start(),e.calculateSlides(),e.$context.trigger(e._+".ready"),e.animate(e.options.index||e.current,"init")},e.setup=function(){e.$context.addClass(e.prefix+e.options.animation).wrap('<div class="'+e._+'" />'),e.$parent=e.$context.parent("."+e._);var t=e.$context.css("position");"static"===t&&e.$context.css("position","relative"),e.$context.css("overflow","hidden")},e.calculateSlides=function(){if(e.total=e.$slides.length,"fade"!==e.options.animation){var t="width";"vertical"===e.options.animation&&(t="height"),e.$container.css(t,100*e.total+"%").addClass(e.prefix+"carousel"),e.$slides.css(t,100/e.total+"%")}},e.start=function(){return e.interval=setTimeout(function(){e.next()},e.options.delay),e},e.stop=function(){return clearTimeout(e.interval),e},e.initNav=function(){var t=$('<nav class="'+e.prefix+'nav"><ol /></nav>');e.$slides.each(function(n){var i=this.getAttribute("data-nav")||n+1;$.isFunction(e.options.nav)&&(i=e.options.nav.call(e.$slides.eq(n),n,i)),t.children("ol").append('<li data-slide="'+n+'">'+i+"</li>")}),e.$nav=t.insertAfter(e.$context),e.$nav.find("li").on("click"+e.eventSuffix,function(){var t=$(this).addClass(e.options.activeClass);t.siblings().removeClass(e.options.activeClass),e.animate(t.attr("data-slide"))})},e.initArrows=function(){e.options.arrows===!0&&(e.options.arrows=e.defaults.arrows),$.each(e.options.arrows,function(t,n){e.$arrows.push($(n).insertAfter(e.$context).on("click"+e.eventSuffix,e[t]))})},e.initKeys=function(){e.options.keys===!0&&(e.options.keys=e.defaults.keys),$(document).on("keyup"+e.eventSuffix,function(t){$.each(e.options.keys,function(n,i){t.which===i&&$.isFunction(e[n])&&e[n].call(e)})})},e.initSwipe=function(){var t=e.$slides.width();e.$container.on({swipeleft:e.next,swiperight:e.prev,movestart:function(t){return t.distX>t.distY&&t.distX<-t.distY||t.distX<t.distY&&t.distX>-t.distY?!!t.preventDefault():void e.$container.css("position","relative")}}),"fade"!==e.options.animation&&e.$container.on({move:function(n){e.$container.css("left",-(100*e.current)+100*n.distX/t+"%")},moveend:function(n){return Math.abs(n.distX)/t<$.event.special.swipe.settings.threshold?e._move(e.$container,{left:-(100*e.current)+"%"},!1,200):void 0}})},e.initInfinite=function(){var t=["first","last"];t.forEach(function(n,i){e.$slides.push.apply(e.$slides,e.$slides.filter(':not(".'+e._+'-clone")')[n]().clone().addClass(e._+"-clone")["insert"+(0===i?"After":"Before")](e.$slides[t[~~!i]]()))})},e.destroyArrows=function(){e.$arrows.forEach(function(t){t.remove()})},e.destroySwipe=function(){e.$container.off("movestart move moveend")},e.destroyKeys=function(){$(document).off("keyup"+e.eventSuffix)},e.setIndex=function(t){return 0>t&&(t=e.total-1),e.current=Math.min(Math.max(0,t),e.total-1),e.options.nav&&e.$nav.find('[data-slide="'+e.current+'"]')._toggleActive(e.options.activeClass),e.$slides.eq(e.current)._toggleActive(e.options.activeClass),e},e.animate=function(t,n){if("first"===t&&(t=0),"last"===t&&(t=e.total),isNaN(t))return e;e.options.autoplay&&e.stop().start(),e.setIndex(t),e.$context.trigger(e._+".change",[t,e.$slides.eq(t)]);var i="animate"+$._ucfirst(e.options.animation);return $.isFunction(e[i])&&e[i](e.current,n),e},e.next=function(){var t=e.current+1;return t>=e.total&&(t=0),e.animate(t,"next")},e.prev=function(){return e.animate(e.current-1,"prev")},e.animateHorizontal=function(t){var n="left";return"rtl"===e.$context.attr("dir")&&(n="right"),e.options.infinite&&e.$container.css("margin-"+n,"-100%"),e.slide(n,t)},e.animateVertical=function(t){return e.options.animateHeight=!0,e.options.infinite&&e.$container.css("margin-top",-e.$slides.outerHeight()),e.slide("top",t)},e.slide=function(t,n){if(e.options.animateHeight&&e._move(e.$context,{height:e.$slides.eq(n).outerHeight()},!1),e.options.infinite){var i;n===e.total-1&&(i=e.total-3,n=-1),n===e.total-2&&(i=0,n=e.total-2),"number"==typeof i&&(e.setIndex(i),e.$context.on(e._+".moved",function(){e.current===i&&e.$container.css(t,-(100*i)+"%").off(e._+".moved")}))}var o={};return o[t]=-(100*n)+"%",e._move(e.$container,o)},e.animateFade=function(t){var n=e.$slides.eq(t).addClass(e.options.activeClass);e._move(n.siblings().removeClass(e.options.activeClass),{opacity:0}),e._move(n,{opacity:1},!1)},e._move=function(t,n,i,o){return i!==!1&&(i=function(){e.$context.trigger(e._+".moved")}),t._move(n,o||e.options.speed,e.options.easing,i)},e.init(n)},$.fn._toggleActive=function(t){return this.addClass(t).siblings().removeClass(t)},$._ucfirst=function(t){return(t+"").toLowerCase().replace(/^./,function(t){return t.toUpperCase()})},$.fn._move=function(){var t="animate";return this.stop(!0,!0),$.fn.velocity&&(t="velocity"),$.fn[t].apply(this,arguments)},void($.fn.unslider=function(t){return this.each(function(){var n=$(this);if("string"==typeof t&&n.data("unslider")){t=t.split(":");var e=t[0],i=n.data("unslider")[e];if(t[1]){var o=t[1].split(",");return $.isFunction(i)&&i.apply(n,o)}return $.isFunction(i)&&i(),this}return n.data("unslider",new $.Unslider(n,t))})})):console.warn("Unslider needs jQuery")}(window.jQuery);

$(document).ready(function() {

$(function() {
  $('a[href*="#"]:not([href="#"])').click(function() {
    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
      var target = $(this.hash);
      target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
      if (target.length) {
        $('html, body').animate({
          scrollTop: target.offset().top
        }, 1000);
        return false;
      }
    }
  });
});

$(".nav__search").click(function() {
	$('.nav__searchbar').addClass('is__active');
	$('.input--search').focus();
});

$("a.nav__searchclose").click(function() {
	$('.nav__searchbar').removeClass('is__active');
	$('.input--search').blur();
});

$(function(){
	$('.testimonials').unslider({
		keys: false,
		nav: true,
		arrows: {
		prev: '<a class="unslider-arrow prev"><i class="fa fa-3x fa-angle-left"></i></a>',
		next: '<a class="unslider-arrow next"><i class="fa fa-3x fa-angle-right"></i></a>'
		}
	});
});

$('.form--validation').each(function() {

$.validator.addMethod("phoneValidation", 
  function(value, element) {

  var elementID = $(element).val();
  elementResult = $(element);
  PhoneNumberValidation_Interactive_Validate_v2_10Begin(elementID);
  return $(element).hasClass("success");
}, "This phone number is invalid. Please try again.");

$.validator.addMethod("emailValidation", 
  function(value, element) {

  var emailID = $(element).val();
  elementResultEmail = $(element);
  EmailValidation_Interactive_Validate_v2_00(emailID);
  return $(element).hasClass("success");
}, "This email address is invalid. Please try again.");

var validCharactersRegex = /^[a-z][- a-z ]*[- ][- a-z ]*[ a-z ]$/i;
function name__valid(value) {
    return validCharactersRegex.test(value);
}

$.validator.addMethod("custom__name", function(value, element) {
    return name__valid(value);
}, 'Please give your full name.');

var form = $(this);
var formMessages = $(this).find('#form-messages');

$(this).validate({
  errorClass: "result fail",
  validClass: "result success",
  rules: {
    'full-name': {
      required: true,
      custom__name: true,
    },
    email: {
      required: true,
      emailValidation: true,
    },
    'company': {
      required: true,
    },
    phone: {
      required: true,
      phoneValidation: true,
    },
    'optIn': {
      required: true,
    }
  },
  messages: {
    password: {
      required: "This field is required",
    },
    'optIn': {
      required: "",
    } 
  },
  highlight: function(element) {
      $(element).removeClass('success').addClass('fail');
      $(element).parent().removeClass('success').addClass('fail');
      $(element).parent().find('label').removeClass('success').addClass('fail');
  },
  unhighlight: function(element) {
      $(element).removeClass('fail').addClass('success');
      $(element).parent().addClass('success').removeClass('fail');
      $(element).parent().find('label').removeClass('fail').addClass('success');
  },
  errorPlacement: function(error, element) {
      if( element.is(":checkbox") ) {
        error.hide();
      } else { 
        error.insertAfter(element);
      }
  },
  submitHandler: function(form, response, data) {
      $.ajax({
        type: 'POST',
        url: $(form).attr('action'),
        data: $(form).serialize(),
      })
      .done(function(response) {
        function addThanks () { 
          url = 'thank-you';
          history.pushState(null,null, url);
        }
        addThanks();
        $(formMessages).removeClass('error');
        $(formMessages).addClass('success');

        $(formMessages).text(response);
        $('#name, #email, #phone, #company').val('');
      })
      .fail(function(data) {
        $(formMessages).removeClass('success');
        $(formMessages).addClass('error');

        // Set the message text.
        if (data.responseText !== '') {
          $(formMessages).text(data.responseText);
        } else {
          $(formMessages).text('Oops! An error occured and your message could not be sent.');
        }         
      });
  },
});

});

function PhoneNumberValidation_Interactive_Validate_v2_10Begin(elementID) {

    var elementPhone = elementID;
    var script = document.createElement("script"),
        head = document.getElementsByTagName("head")[0],
        url = "https://services.postcodeanywhere.co.uk/PhoneNumberValidation/Interactive/Validate/v2.10/json3.ws?";

    url += "&Key=" + encodeURIComponent('WP74-ZE29-WJ54-PK69');
    url += "&Phone=" + encodeURIComponent(elementPhone);
    url += "&Country=" + encodeURIComponent('GB');
    url += "&callback=PhoneNumberValidation_Interactive_Validate_v2_10End";

    script.src = url;
    script.onload = script.onreadystatechange = function () {
        if (!this.readyState || this.readyState === "loaded" || this.readyState === "complete") {
            script.onload = script.onreadystatechange = null;
            if (head && script.parentNode)
                head.removeChild(script);
        }
    };
    head.insertBefore(script, head.firstChild);
}

function EmailValidation_Interactive_Validate_v2_00(emailID) {
    var elementEmail = emailID;
    $.getJSON("http://services.postcodeanywhere.co.uk/EmailValidation/Interactive/Validate/v2.00/json3.ws?callback=?",
    {
        Key: 'WP74-ZE29-WJ54-PK69',
        Email: elementEmail,
        Timeout: 500
    },
    function (data) {
        // Test for an error
        if (data.Items.length == 1 && typeof(data.Items[0].Error) != "undefined") {
            // Show the error message
            alert(data.Items[0].Description);
        }
        else {
            // Check if there were any items found
            if (data.Items.length == 0)
                alert("Sorry, there were no results");
            else {
                var data = data.Items[0];
                var message = data.ResponseMessage;
                switch (data.ResponseCode.toLowerCase()) {
                  case "invalid":
                  elementResultEmail.removeClass('success').addClass('fail');
                  elementResultEmail.next().removeClass('success').addClass('fail');
                break;
                  case "valid":
                  elementResultEmail.removeClass('fail').addClass('success');
                  elementResultEmail.next().removeClass('fail').addClass('success');
                  elementResultEmail.next().empty();
                  elementResultEmail.parent().removeClass('fail').addClass('success');
                break;
                }
            }
        }
    });
}

});


function PhoneNumberValidation_Interactive_Validate_v2_10End(response) {

    if (response.Items.length == 1 && typeof(response.Items[0].Error) != "undefined") {
    }
    else {
        if (response.Items.length === 0)
            alert("Sorry, there were no results");
        else {
          var data = response.Items[0];
          switch (data.IsValid) {
          case "No":
          elementResult.removeClass('success').addClass('fail');
          elementResult.next().removeClass('success').addClass('fail');
          break;
          case "Yes":
          elementResult.removeClass('fail').addClass('success');
          elementResult.next().removeClass('fail').addClass('success');
          elementResult.next().empty();
          elementResult.parent().removeClass('fail').addClass('success');
          break;
          }
        }
    }
}