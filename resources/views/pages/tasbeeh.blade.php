@extends('layouts.app')
@section('content')


<section class="section" id="tasbeeh-page">
  <div class="section-header reveal">
    <div class="section-label">Daily Remembrance</div>
    <h2>Digital Tasbeeh</h2>
    <p class="section-sub">Keep track of your dhikr with our elegant digital counter.</p>
  </div>
  <div class="tasbeeh-wrapper reveal">
    <div class="tasbeeh-targets">
      <button class="target-btn" onclick="setTarget(33,this)">33</button>
      <button class="target-btn active" onclick="setTarget(99,this)">99</button>
      <button class="target-btn" onclick="setTarget(100,this)">100</button>
      <button class="target-btn" onclick="setTarget(0,this)">∞</button>
    </div>
    <div class="tasbeeh-counter" id="tasbeehCounter" onclick="incrementTasbeeh()">
      <div class="tasbeeh-ring" id="tasbeehRing"></div>
      <div class="tasbeeh-count" id="tasbeehCount">0</div>
      <div class="tasbeeh-sub" id="tasbeehSub">Tap to count</div>
    </div>
    <div class="tasbeeh-controls">
      <button class="ctrl-btn" id="soundBtn" onclick="toggleSound()">🔇 Sound Off</button>
      <button class="ctrl-btn" onclick="resetTasbeeh()">↺ Reset</button>
    </div>
    <div class="dhikr-btns">
      <button class="dhikr-btn" onclick="setDhikr('سُبْحَانَ اللَّه','SubhanAllah')"><span class="dhikr-arabic">سُبْحَانَ اللَّه</span>SubhanAllah</button>
      <button class="dhikr-btn" onclick="setDhikr('الْحَمْدُ لِلَّه','Alhamdulillah')"><span class="dhikr-arabic">الْحَمْدُ لِلَّه</span>Alhamdulillah</button>
      <button class="dhikr-btn" onclick="setDhikr('اللَّهُ أَكْبَر','Allahu Akbar')"><span class="dhikr-arabic">اللَّهُ أَكْبَر</span>Allahu Akbar</button>
      <button class="dhikr-btn" onclick="setDhikr('أَسْتَغْفِرُ اللَّه','Astaghfirullah')"><span class="dhikr-arabic">أَسْتَغْفِرُ اللَّه</span>Astaghfirullah</button>
      <button class="dhikr-btn" onclick="setDhikr('لَا إِلَٰهَ إِلَّا اللَّه','La ilaha illallah')"><span class="dhikr-arabic">لَا إِلَٰهَ إِلَّا اللَّه</span>La ilaha illallah</button>
      <button class="dhikr-btn" onclick="setDhikr('بِسْمِ اللَّه','Bismillah')"><span class="dhikr-arabic">بِسْمِ اللَّه</span>Bismillah</button>
    </div>
  </div>
</section>


@endsection

