// importMenu.js

function importMenu() {
    const xhr = new XMLHttpRequest();
    xhr.open('GET', '/doc/menuContainer.html', true);
    xhr.onreadystatechange = function() {
      if (xhr.readyState === 4 && xhr.status === 200) {
        document.getElementById('menuContainer').innerHTML = xhr.responseText;
      }
    };
    xhr.send();
  }
  
  // Call the function to import the menu when the window loads
  window.onload = importMenu;
  