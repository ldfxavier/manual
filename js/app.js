// Debounce do Lodash
debounce = function(func, wait, immediate) {
  var timeout;
  return function() {
    var context = this,
      args = arguments;
    var later = function() {
      timeout = null;
      if (!immediate) func.apply(context, args);
    };
    var callNow = immediate && !timeout;
    clearTimeout(timeout);
    timeout = setTimeout(later, wait);
    if (callNow) func.apply(context, args);
  };
};

$('#nav a[href^="#"]').on("click", function(e) {
  e.preventDefault();
  var id = $(this).attr("href"),
    targetOffset = $(id).offset().top;

  $("html, body").animate(
    {
      scrollTop: targetOffset - 100
    },
    500
  );
});

(function() {
  let target = $(".anime-left");
  let targetRight = $(".anime-right");
  let targetBottom = $(".anime-bottom");
  let animationClass = "anime-start",
    windowHeight = $(window).height(),
    offset = windowHeight - windowHeight / 12;

  function animeLeft() {
    var documentTop = $(document).scrollTop();

    target.each(function() {
      var itemTop = $(this).offset().top;
      if (documentTop > itemTop - offset) {
        $(this).addClass(animationClass);
      } else {
        $(this).removeClass(animationClass);
      }
    });
  }

  function animeScrollRight() {
    var documentTop = $(document).scrollTop();

    targetRight.each(function() {
      var itemTop = $(this).offset().top;
      if (documentTop > itemTop - offset) {
        $(this).addClass(animationClass);
      } else {
        $(this).removeClass(animationClass);
      }
    });
  }

  function animeScrollBottom() {
    var documentTop = $(document).scrollTop();

    targetBottom.each(function() {
      var itemTop = $(this).offset().top;
      if (documentTop > itemTop - offset) {
        $(this).addClass(animationClass);
      } else {
        $(this).removeClass(animationClass);
      }
    });
  }

  animeLeft();
  animeScrollRight();
  animeScrollBottom();

  $(document).scroll(
    debounce(function() {
      animeLeft();
      animeScrollRight();
      animeScrollBottom();
    }, 1)
  );
})();

$(function() {
  $.banner({
    id: "#banner",
    imagem: "figure",
    controle: "#controle",
    prev: null,
    next: null,
    barra: "#barra",
    rotacao: true,
    mobile: false,
    transicao: 0.5,
    tempo: 8
  });

  $.galeria({
    id: "#bloco_galeria",
    href: null,
    botao: "article"
  });

  $(".enviar_mensagem").click(function() {
    let form = $(this).closest("form");
    let link = $(form).attr("action");
    let nome = $("input[name=nome]", form).val();
    let telefone = $("input[name=telefone]", form).val();
    let texto = $("textarea[name=texto]", form).val();
    let botao = $(this);

    if (botao.html() == "Enviar") {
      botao.html("Aguarde");
      $.post(
        link,
        {
          nome,
          texto,
          telefone
        },
        function(resposta) {
          botao.html("Enviar");
          if (resposta.erro == true) {
            $.alerta({
              titulo: resposta.titulo,
              texto: resposta.texto
            });
          } else {
            $("input[name=nome]", form).val("");
            $("input[name=telefone]", form).val("");
            $("textarea[name=texto]", form).val("");

            $.alerta({
              titulo: "Mensagem enviada!",
              texto: "Mensagem enviada com sucesso!"
            });
          }
        },
        "json"
      );
    }

    return false;
  });
});

function classToggle() {
  let navs = document.querySelectorAll(".Navbar__Items");

  navs.forEach(nav => nav.classList.add("Navbar__ToggleShow"));
}
function classHide() {
  let navs = document.querySelectorAll(".Navbar__Items");

  navs.forEach(nav => nav.classList.remove("Navbar__ToggleShow"));
}
document
  .querySelector(".Navbar__Link-toggle")
  .addEventListener("click", classToggle);

$(".Navbar__Items .sombra").on("click", function(e) {
  classHide();
});

let items = document.querySelectorAll(".timeline li");

function pegaViewport(item) {
  let rect = item.getBoundingClientRect();

  const windowHeight =
    window.innerHeight || document.documentElement.clientHeight;
  const windowWidth = window.innerWidth || document.documentElement.clientWidth;

  const vertInView = rect.top <= windowHeight && rect.top + rect.height >= 20;
  const horInView = rect.left <= windowWidth && rect.left + rect.width >= 20;

  return vertInView && horInView;
}

function animaCallback() {
  for (let i = 0; i < items.length; i++) {
    if (pegaViewport(items[i])) {
      items[i].className = "in-view";
    }
  }
}

window.addEventListener("scroll", animaCallback);
window.addEventListener("load", animaCallback);
window.addEventListener("resize", animaCallback);

if (screen.width <= 900) {
  $(".card_galeria").removeClass("4u");
  $(".card_noticia").removeClass("6u");
}
