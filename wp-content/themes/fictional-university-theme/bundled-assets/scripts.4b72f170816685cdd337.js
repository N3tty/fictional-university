!function(e){function t(t){for(var r,a,o=t[0],l=t[1],c=t[2],u=0,d=[];u<o.length;u++)a=o[u],Object.prototype.hasOwnProperty.call(n,a)&&n[a]&&d.push(n[a][0]),n[a]=0;for(r in l)Object.prototype.hasOwnProperty.call(l,r)&&(e[r]=l[r]);for(h&&h(t);d.length;)d.shift()();return i.push.apply(i,c||[]),s()}function s(){for(var e,t=0;t<i.length;t++){for(var s=i[t],r=!0,o=1;o<s.length;o++){var l=s[o];0!==n[l]&&(r=!1)}r&&(i.splice(t--,1),e=a(a.s=s[0]))}return e}var r={},n={0:0},i=[];function a(t){if(r[t])return r[t].exports;var s=r[t]={i:t,l:!1,exports:{}};return e[t].call(s.exports,s,s.exports,a),s.l=!0,s.exports}a.m=e,a.c=r,a.d=function(e,t,s){a.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:s})},a.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},a.t=function(e,t){if(1&t&&(e=a(e)),8&t)return e;if(4&t&&"object"==typeof e&&e&&e.__esModule)return e;var s=Object.create(null);if(a.r(s),Object.defineProperty(s,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var r in e)a.d(s,r,function(t){return e[t]}.bind(null,r));return s},a.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return a.d(t,"a",t),t},a.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},a.p="/wp-content/themes/fictional-university-theme/bundled-assets/";var o=window.webpackJsonp=window.webpackJsonp||[],l=o.push.bind(o);o.push=t,o=o.slice();for(var c=0;c<o.length;c++)t(o[c]);var h=l;i.push([2,1]),s()}([,function(e,t,s){},function(e,t,s){"use strict";s.r(t);s(1);var r=class{constructor(){this.menu=document.querySelector(".site-header__menu"),this.openButton=document.querySelector(".site-header__menu-trigger"),this.events()}events(){this.openButton.addEventListener("click",()=>this.openMenu())}openMenu(){this.openButton.classList.toggle("fa-bars"),this.openButton.classList.toggle("fa-window-close"),this.menu.classList.toggle("site-header__menu--active")}},n=s(0);var i=class{constructor(){if(document.querySelector(".hero-slider")){const e=document.querySelectorAll(".hero-slider__slide").length;let t="";for(let s=0;s<e;s++)t+=`<button class="slider__bullet glide__bullet" data-glide-dir="=${s}"></button>`;document.querySelector(".glide__bullets").insertAdjacentHTML("beforeend",t),new n.a(".hero-slider",{type:"carousel",perView:1,autoplay:3e3}).mount()}}};var a=class{constructor(){document.querySelectorAll(".acf-map").forEach(e=>{this.new_map(e)})}new_map(e){var t=e.querySelectorAll(".marker"),s={zoom:16,center:new google.maps.LatLng(0,0),mapTypeId:google.maps.MapTypeId.ROADMAP},r=new google.maps.Map(e,s);r.markers=[];var n=this;t.forEach((function(e){n.add_marker(e,r)})),this.center_map(r)}add_marker(e,t){var s=new google.maps.LatLng(e.getAttribute("data-lat"),e.getAttribute("data-lng")),r=new google.maps.Marker({position:s,map:t});if(t.markers.push(r),e.innerHTML){var n=new google.maps.InfoWindow({content:e.innerHTML});google.maps.event.addListener(r,"click",(function(){n.open(t,r)}))}}center_map(e){var t=new google.maps.LatLngBounds;e.markers.forEach((function(e){var s=new google.maps.LatLng(e.position.lat(),e.position.lng());t.extend(s)})),1==e.markers.length?(e.setCenter(t.getCenter()),e.setZoom(16)):e.fitBounds(t)}},o=s(3),l=s.n(o);var c=class{constructor(){this.addSearchHTML(),this.resultsDiv=l()("#search-overlay__results"),this.openButton=l()(".js-search-trigger"),this.closeButton=l()(".search-overlay__close"),this.searchOverlay=l()(".search-overlay"),this.searchField=l()("#search-term"),this.events(),this.isOverlayOpen=!1,this.isSpinnerVisible=!1,this.previousValue,this.typingTimer}events(){this.openButton.on("click",this.openOverlay.bind(this)),this.closeButton.on("click",this.closeOverlay.bind(this)),l()(document).on("keydown",this.keyPressDispatcher.bind(this)),this.searchField.on("keyup",this.typingLogic.bind(this))}typingLogic(){this.searchField.val!=this.previousValue&&(clearTimeout(this.typingTimer),this.searchField.val()?(this.isSpinnerVisible||(this.resultsDiv.html('<div class="spinner-loader"></div>'),this.isSpinnerVisible=!0),this.typingTimer=setTimeout(this.getResults.bind(this),750)):(this.resultsDiv.html(""),this.isSpinnerVisible=!1)),this.previousValue=this.searchField.val()}getResults(){l.a.when(l.a.getJSON(universityData.root_url+"/wp-json/wp/v2/postsdd?search="+this.searchField.val()),l.a.getJSON(universityData.root_url+"/wp-json/wp/v2/pages?search="+this.searchField.val())).then((e,t)=>{var s=e[0].concat(t[0]);this.resultsDiv.html(`\n<h2 class="search-overlay__section-title">General Information</h2>\n${s.length?'<ul class="link-list minlist">':"<p>No reslts found.</p>"}\n\n${s.map(e=>`<li><a href="${e.link}">${e.title.rendered}</a></li>`).join("")}\n${s.length?"</ul>":""}\n        `),this.isSpinnerVisible=!1},()=>{this.resultsDiv.html("<p>Unexpected error; please try again</p>")})}keyPressDispatcher(e){83==e.keyCode&&!this.isOverlayOpen&&"inut, textarea".is(":focus")&&this.openOverlay(),27==e.keyCode&&this.isOverlayOpen&&this.closeOverlay()}openOverlay(){this.searchOverlay.addClass("search-overlay--active"),l()("body").addClass("body-no-scroll"),this.searchField.val(""),setTimeout(()=>this.searchField.focus(),301),this.isOverlayOpen=!0}closeOverlay(){this.searchOverlay.removeClass("search-overlay--active"),l()("body").removeClass("body-no-scroll"),this.isOverlayOpen=!1}addSearchHTML(){l()("body").append('\n      <div class="search-overlay">\n      <div class="seach-overlay__top">\n      <div class="container">\n        <i class="fa fa-search search-overlay__icon" aria-hidden="true"></i>\n      <i class="fa fa-window-close search-overlay__close" aria-hidden="true"></i>\n          <input type="text" autocomplete="off" class="search-term" placeholder="What are you looking for?" id="search-term">\n      </div>\n\n      </div>\n      <div class="container">\n      <div id="search-overlay__results"></div>\n      </div>\n      </div>\n      ')}};new r,new i;new a,new c}]);