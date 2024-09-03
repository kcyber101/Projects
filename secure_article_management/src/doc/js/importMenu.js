// importMenu.js

function importMenu() {
    const xhr = new XMLHttpRequest();
    xhr.open('GET', '/doc/menuContainer.html', true);
    xhr.onreadystatechange = function() {
      if (xhr.readyState === 4 && xhr.status === 200) {
        document.getElementById('menuContainer').innerHTML = xhr.responseText;
        if (getCookie('role') === 'author') {
          document.getElementById('table-data-user').style.display = 'none';
          document.getElementById('table-data-category').style.display = 'none';
        }else if (getCookie('role') === 'editor') {
          document.getElementById('table-data-user').style.display = 'none';
        } 
        else {
          // alert('COOK ĐY');
      }
      }
    };
    xhr.send();
  }
  
  // Call the function to import the menu when the window loads
  window.onload = importMenu;
  

  function getCookie(cname) {
    let name = cname + "=";
    let ca = document.cookie.split(';');
    for(let i = 0; i < ca.length; i++) {
      let c = ca[i];
      while (c.charAt(0) == ' ') {
        c = c.substring(1);
      }
      if (c.indexOf(name) == 0) {
        return c.substring(name.length, c.length);
      }
    }
    return "";
  }