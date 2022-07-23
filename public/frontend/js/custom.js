var prevScrollpos = window.pageYOffset;
var myDiv = document.querySelector('body')
window.onscroll = function () {
  var currentScrollPos = window.pageYOffset;
  
  if (currentScrollPos > 50) {
    myDiv.classList.add("scrollDown");
  } else {
    myDiv.classList.remove("scrollDown");
  }
  
  if (prevScrollpos > currentScrollPos) {
    myDiv.classList.remove("scrollUp");
  } else {
    myDiv.classList.add("scrollUp");
  }

  if (currentScrollPos + window.innerHeight >= myDiv.scrollHeight) {
    myDiv.classList.remove("scrollUp");
  }

  prevScrollpos = currentScrollPos;

  var fixBottomElement = document.getElementById('fix-ft')
  var fixBottomAnchor = document.getElementById('fix-ft-anchor')
  

  
}

// var body = document.querySelector('body')
// body.onclick = function(e) {
//   var search_valuation = document.getElementById('search_valuation');
//   search_valuation.style.display = 'none';
// }

var mainMenu = document.getElementById('navbarToggler');
    mainMenu.onclick = function() {toggleActive()}
    function toggleActive() {
      mainMenu.classList.toggle("active");
      document.querySelector('header').classList.toggle("show");
    }
    
// var expandSearchBtn = document.getElementById('expand-search-btn');
    // expandSearchBtn.onclick = function() {toggleClassActive()}

// var closeSearchBtn = document.querySelector('#expand-search .btn-close')
//     closeSearchBtn.onclick = function() {toggleClassActive()}
//     function toggleClassActive() {
//       expandSearchBtn.classList.toggle("active");
//     }


function myFunctLink(element) {
  location.href = element.attributes.href.value;
}

