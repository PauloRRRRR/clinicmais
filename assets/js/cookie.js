document.addEventListener("DOMContentLoaded", function() {
  // Verifica se o cookie já está definido
  if (checkCookie()) {       
      const privacyPolicy = document.getElementById('privacy-policy');
      if (privacyPolicy) {
          privacyPolicy.style.display = 'none'; // Esconde a política de privacidade se o cookie estiver definido
      }
  }

  // Adiciona um evento de clique ao botão de fechar, se existir
  const closeButton = document.getElementById('closePrivacy');
  if (closeButton) {
      closeButton.onclick = function() {
          setCookie("terms", '1', 1); // Define o cookie por 1 dia
          const privacyPolicy = document.getElementById('privacy-policy');
          if (privacyPolicy) {
              privacyPolicy.style.display = 'none'; // Esconde a política de privacidade ao fechar
          }
      };
  } else {
      console.warn('Elemento com ID "closePrivacy" não encontrado.');
  }
});

// Função para definir cookies
function setCookie(cname, cvalue, exdays) {
  const d = new Date();
  d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
  const expires = "expires=" + d.toUTCString();
  document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

// Função para obter cookies
function getCookie(cname) {
  const name = cname + "=";
  const ca = document.cookie.split(';');
  for (let i = 0; i < ca.length; i++) {
      let c = ca[i];
      while (c.charAt(0) === ' ') {
          c = c.substring(1);
      }
      if (c.indexOf(name) === 0) {
          return c.substring(name.length, c.length);
      }
  }
  return "";
}

// Função para verificar se o cookie está definido
function checkCookie() {
  const cookieTerms = getCookie("terms");
  return cookieTerms !== ""; // Retorna true se o cookie existir
}
