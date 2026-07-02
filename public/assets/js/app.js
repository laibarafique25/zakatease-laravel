// PRELOADER + ANIMATIONS
if(typeof document !== 'undefined'){document.documentElement.classList.add('js');}
let preloaderInitialized=false;
function showAllReveal(){
  document.querySelectorAll('.reveal').forEach(el=>el.classList.add('visible'));
}

function initPreloader(){
  if(preloaderInitialized) return;
  preloaderInitialized=true;

  function finalize(){
    const p=document.getElementById('preloader');
    if(!p) return;
    p.classList.add('hide');
    p.style.pointerEvents='none';
    setTimeout(()=>{try{p.remove()}catch(e){}},800);
    if(window.AOS) AOS.init({duration:800,once:true});
    showAllReveal();
  }

  const isFirstVisit = !sessionStorage.getItem('siteVisited');

  if(isFirstVisit && window.gsap){
    sessionStorage.setItem('siteVisited', 'true');
    gsap.set('#navbar',{y:-30,opacity:0});
    const tl=gsap.timeline();
    tl.to('.preload-text',{opacity:1,duration:1.5,letterSpacing:35,ease:'power2.out'})
      .to('#preloaderCircle',{y:'-60vh',duration:1.1,ease:'power3.inOut'},'+=0.2')
      .to('#preloaderLogo',{opacity:1,scale:1,duration:0.8,ease:'back.out(1.4)'},'-=0.6')
      .to('#navbar',{y:0,opacity:1,duration:0.6,ease:'power2.out'},'-=0.4')
      .to('#preloader',{opacity:0,duration:0.6,onComplete:finalize},'+=0.3');
  } else {
    if (isFirstVisit) sessionStorage.setItem('siteVisited', 'true');
    setTimeout(finalize, 400);
  }
}

window.addEventListener('load',initPreloader);
document.addEventListener('DOMContentLoaded',()=>{
  if(window.AOS&&!window.gsap)AOS.init({duration:800,once:true});
  if(!preloaderInitialized){setTimeout(initPreloader,2200)}
});
setTimeout(()=>{if(!preloaderInitialized){initPreloader(); showAllReveal()}},4500);

// THEME
function toggleTheme(){
  const d=document.documentElement;
  const isDark=d.getAttribute('data-theme')==='dark';
  const newTheme = isDark ? 'light' : 'dark';
  d.setAttribute('data-theme', newTheme);
  localStorage.setItem('theme', newTheme);
  const toggleBtn = document.querySelector('.theme-toggle');
  if(toggleBtn) toggleBtn.textContent = newTheme === 'dark' ? '☀️' : '🌙';
}

document.addEventListener('DOMContentLoaded', () => {
  const currentTheme = document.documentElement.getAttribute('data-theme');
  const toggleBtn = document.querySelector('.theme-toggle');
  if(toggleBtn && currentTheme === 'dark') {
    toggleBtn.textContent = '☀️';
  }
});
// LANG
function toggleLang(){
  const btn=document.querySelector('.lang-btn');
  const isUrdu=btn.textContent.includes('EN');
  btn.textContent=isUrdu?'EN | اردو':'اردو | EN';
}
// MENU
function toggleMenu(){
  const m=document.getElementById('mobileMenu');
  m.classList.toggle('open');
}
function closeMenu(){
  document.getElementById('mobileMenu').classList.remove('open');
}
// NAVBAR SCROLL
window.addEventListener('scroll',()=>{
  const nb=document.getElementById('navbar');
  nb.style.boxShadow=window.scrollY>20?'0 2px 20px rgba(69,108,93,0.12)':'none';
});

// CALCULATOR
let calcData={};
function goToStep(n){
  document.querySelectorAll('.calc-step').forEach(s=>s.classList.remove('active'));
  document.querySelectorAll('.calc-step-tab').forEach(t=>t.classList.remove('active'));
  document.getElementById('step-'+n).classList.add('active');
  document.querySelectorAll('.calc-step-tab')[n-1].classList.add('active');
  for(let i=0;i<n-1;i++) document.querySelectorAll('.calc-step-tab')[i].classList.add('done');
}
function v(id){return parseFloat(document.getElementById(id)?.value)||0}
function calcZakat(){
  calcData.goldValue=v('goldValue');
  calcData.silverValue=v('silverValue');
  calcData.cashHand=v('cashHand');
  calcData.bankBalance=v('bankBalance');
  calcData.foreignCurrency=v('foreignCurrency');
  calcData.savings=v('savings');
  calcData.stocks=v('stocks');
  calcData.mutualFunds=v('mutualFunds');
  calcData.businessInventory=v('businessInventory');
  calcData.otherInvestments=v('otherInvestments');
  calcData.loans=v('loans');
  calcData.billsDue=v('billsDue');
  calcData.otherDebts=v('otherDebts');
}
function showResult(){
  calcZakat();
  const assets=calcData.goldValue+calcData.silverValue+calcData.cashHand+calcData.bankBalance+calcData.foreignCurrency+calcData.savings+calcData.stocks+calcData.mutualFunds+calcData.businessInventory+calcData.otherInvestments;
  const liabilities=calcData.loans+calcData.billsDue+calcData.otherDebts;
  const net=Math.max(0,assets-liabilities);
  const nisab=90000;
  const zakat=net>=nisab?net*0.025:0;
  const fmt=n=>'PKR '+n.toLocaleString('en-PK',{maximumFractionDigits:0});
  document.getElementById('totalAssets').textContent=fmt(assets);
  document.getElementById('totalLiabilities').textContent=fmt(liabilities);
  document.getElementById('netWealth').textContent=fmt(net);
  document.getElementById('zakatDue').textContent=fmt(zakat);
  const badge=document.getElementById('nisabBadge');
  if(net>=nisab){badge.textContent='✅ Nisab Reached — Zakat is Obligatory';badge.style.background='rgba(76,175,80,0.1)';badge.style.color='#2E7D32'}
  else{badge.textContent='⚠️ Below Nisab — Zakat Not Obligatory';badge.style.background='rgba(255,165,0,0.1)';badge.style.color='#E65100'}
  goToStep(5);
}
function resetCalc(){
  document.querySelectorAll('.calc-step input').forEach(i=>i.value='');
  calcData={};
  goToStep(1);
}
function printResult(){window.print()}
function downloadPDF(){alert('PDF download would be generated here in the full app.')}

// HADITH FILTER
function filterHadith(btn,topic){
  document.querySelectorAll('.filter-btn').forEach(b=>b.classList.remove('active'));
  btn.classList.add('active');
  document.querySelectorAll('.hadith-card').forEach(c=>{
    c.style.display=(topic==='all'||c.dataset.topic===topic)?'':'none';
  });
}

// FAQ
function toggleFaq(el){
  const item=el.closest('.faq-item');
  const wasOpen=item.classList.contains('open');
  document.querySelectorAll('.faq-item').forEach(i=>i.classList.remove('open'));
  if(!wasOpen) item.classList.add('open');
}

// TASBEEH
let count=0,target=99,soundOn=false,currentDhikr='SubhanAllah';
function incrementTasbeeh(){
  count++;
  const pct=target>0?Math.min(count/target*100,100):0;
  document.getElementById('tasbeehCount').textContent=count;
  document.getElementById('tasbeehSub').textContent=currentDhikr+(target>0?' / '+target:'');
  document.getElementById('tasbeehRing').style.setProperty('--pct',pct+'%');
  if(soundOn){const a=new AudioContext();const o=a.createOscillator();const g=a.createGain();o.connect(g);g.connect(a.destination);o.frequency.value=880;g.gain.setValueAtTime(0.1,a.currentTime);g.gain.exponentialRampToValueAtTime(0.001,a.currentTime+0.15);o.start();o.stop(a.currentTime+0.15)}
  if(target>0&&count>=target){setTimeout(()=>alert('MashaAllah! You completed '+target+' '+currentDhikr),100)}
}
function resetTasbeeh(){count=0;document.getElementById('tasbeehCount').textContent='0';document.getElementById('tasbeehSub').textContent='Tap to count';document.getElementById('tasbeehRing').style.setProperty('--pct','0%')}
function setTarget(t,btn){target=t;document.querySelectorAll('.target-btn').forEach(b=>b.classList.remove('active'));btn.classList.add('active');resetTasbeeh()}
function toggleSound(){soundOn=!soundOn;const btn=document.getElementById('soundBtn');btn.textContent=soundOn?'🔊 Sound On':'🔇 Sound Off';btn.classList.toggle('active',soundOn)}
function setDhikr(arabic,name){currentDhikr=name;document.getElementById('tasbeehSub').textContent=name+(target>0?' / '+target:'');resetTasbeeh()}

// REVEAL ON SCROLL
const observer=new IntersectionObserver(entries=>{
  entries.forEach(e=>{if(e.isIntersecting)e.target.classList.add('visible')});
},{threshold:0.12});
document.querySelectorAll('.reveal').forEach(el=>observer.observe(el));

// NAV ACTIVE LINK
const sections=document.querySelectorAll('section[id], div[id]');
window.addEventListener('scroll',()=>{
  let current='';
  sections.forEach(s=>{if(window.scrollY>=s.offsetTop-100)current=s.id});
  document.querySelectorAll('.nav-links a').forEach(a=>{
    a.classList.toggle('active',a.getAttribute('href')==='#'+current);
  });
});

// COUNTERS & TIMELINE ANIMATIONS
function initCounters(){
  const nodes=document.querySelectorAll('.impact-num, .dash-num');
  if(!nodes.length) return;
  const io=new IntersectionObserver((entries,obs)=>{
    entries.forEach(entry=>{
      if(!entry.isIntersecting) return;
      const el=entry.target;
      if(el.dataset._countDone) return;
      const raw=el.dataset.target||el.dataset.count||el.getAttribute('data-count');
      const target=parseInt((raw||'0').toString().replace(/[^0-9]/g,''),10)||0;
      const duration=1200;
      const start=performance.now();
      function step(ts){
        const prog=Math.min((ts-start)/duration,1);
        const val=Math.floor(prog*target);
        if(el.classList.contains('dash-num')){
          // format as PKR
          el.textContent='PKR '+val.toLocaleString('en-PK');
        } else {
          el.textContent=val.toLocaleString();
        }
        if(prog<1) requestAnimationFrame(step); else el.dataset._countDone=1;
      }
      requestAnimationFrame(step);
      obs.unobserve(el);
    });
  },{threshold:0.3});
  nodes.forEach(n=>io.observe(n));
}

document.addEventListener('DOMContentLoaded',()=>{
  initCounters();
  // GSAP timeline for how-it-works steps
  if(window.gsap && window.ScrollTrigger){
    gsap.utils.toArray('.timeline-step').forEach((el,i)=>{
      gsap.from(el,{y:40,opacity:0,duration:0.8,delay:i*0.12,scrollTrigger:{trigger:el,start:'top 80%'}});
    });
  }
});
