var bepns=bepns||function(n,t){function nt(){if(u=n("id_rh"),r=n("bepfo"),!r){var i=n("id_rwl");i&&(r=t("div"),r.id="bepfo",r.className=o,i.parentNode&&i.parentNode.insertBefore(r,i.nextSibling))}it();sj_be(u,s,w,!1);sj_evt.bind(p,et);sj_evt.bind("onP1",tt,1);sj_evt.bind("id:refreshed",rt,1)}function tt(){var n=0,t=setInterval(function(){u&&u.offsetWidth>0&&u.offsetHeight>0?(clearInterval(t),sj_evt.fire("bepready",b)):n==10&&clearInterval(t);n++},200)}function it(){ft(u,g)}function rt(){ut(_ge("idd_rwds"),_ge("idd_rwdstrial"))}function ut(n,t){n&&t&&(t.href=n.href,n.h?t.h=n.h:n.getAttribute&&n.getAttribute("h")&&t.setAttribute("h",n.getAttribute("h")))}function ft(n,t){n&&(n.href=t)}function et(n){n[1]!==y&&e()}function c(n,t){if(n&&n.className){var i=" "+n.className+" ";return i.indexOf(" "+t+" ")!==-1}return!1}function a(n,t){n&&!c(n,t)&&(n.className+=" "+t)}function v(n,t){if(c(n,t)){var i=new RegExp("(\\s|^)"+t+"(\\s|$)","g");n.className=n.className.replace(i," ")}}function w(n){r&&(c(r,o)?ht(n):e(n))}function ot(){u&&sj_ue(u,s,w,!1)}function b(n){typeof _H!="undefined"&&(n&&n>0?st():k())}function st(){a(u,"rigleamon")}function k(){v(u,"rigleamon")}function ht(n){if(sj_evt.fire("focusChange","bep"),r){r.firstChild||(i=t("iframe"),i.id="bepfm",i.frameBorder="no",i.scrolling="no",i.height=0,sj_be(i,d,at,!1),r.appendChild(i),f=t("div"),f.id="bepfl",f.innerText=f.textContent="Loading...",r.appendChild(f),lt(f));var w=_w.location.search.substr(1),nt=/(^|&)rewardstesthooks=1(&|$)/i.exec(w),b=/(?:^|&)rewardsbag=([^&]*)(?:&|$)/i.exec(w),c=new Date,k=c.getDate(),g=c.getMonth()+1,tt=(g<10?"0":"")+g+"/"+(k<10?"0":"")+k+"/"+c.getFullYear();i.src="/rewardsapp/bepflyoutpage?style=modular&date="+tt+(nt&&b?"&atlahostname=localhost&bag="+b[1]:"");v(r,o)}a(u,"openfo");sj_sp(n);sj_evt.fire(p,y);sj_be(_d,s,e,!0);sj_be(_d,h,l,!0)}function e(n){c(r,o)||a(r,o);v(u,"openfo");typeof _H!="undefined"&&k();sj_ue(_d,s,e,!0);sj_ue(_d,h,l,!0);i&&i.contentWindow&&sj_ue(i.contentWindow.document,h,l,!0);n&&sj_sp(n)}function ct(n){n&&(n.style.display="none")}function lt(n){n&&(n.style.display="block")}function at(){ct(f);i.height=Math.min(i.contentWindow.document.body.scrollHeight,569);i&&i.contentWindow&&sj_be(i.contentWindow.document,h,l,!0)}var y="bepfo",p="onPopTR",u,r,f,i,s="click",h="keyup",d="load",o="b_hide",g="javascript:void(0)",l=function(n){var f=n.which||n.keyCode,r=sj_et(n),t;if(f==27){e(n);u.focus();return}if(f==9&&r&&i){if(t=r.nodeName,t=="BODY"||t=="HTML"||t=="#document")return;i.contentWindow.document.body.contains(r)||e(n)}};return nt(),{sg:b,ubc:ot}}(_ge,sj_ce)