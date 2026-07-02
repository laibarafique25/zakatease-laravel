@extends('layouts.app')
@section('content')


<section class="section-full" id="hadith-page">
  <div class="section">
    <div class="section-header reveal">
      <div class="section-label">Daily Wisdom</div>
      <h2>Ahadees & Teachings</h2>
      <p class="section-sub">Authentic narrations in Arabic, Urdu, and English to guide your daily life.</p>
    </div>
    <div class="hadith-filters reveal">
      <button class="filter-btn active" onclick="filterHadith(this,'all')">All Topics</button>
      <button class="filter-btn" onclick="filterHadith(this,'zakat')">Zakat</button>
      <button class="filter-btn" onclick="filterHadith(this,'charity')">Charity</button>
      <button class="filter-btn" onclick="filterHadith(this,'prayer')">Prayer</button>
      <button class="filter-btn" onclick="filterHadith(this,'patience')">Patience</button>
      <button class="filter-btn" onclick="filterHadith(this,'gratitude')">Gratitude</button>
    </div>
    <div class="hadith-grid">
      <div class="hadith-card reveal reveal-delay-1" data-topic="zakat">
        <div class="hadith-arabic">إِنَّ اللَّهَ فَرَضَ زَكَاةً فِي أَمْوَالِهِمْ</div>
        <div class="hadith-urdu">بیشک اللہ نے ان کے اموال میں زکوٰۃ فرض کی ہے</div>
        <div class="hadith-english">"Indeed, Allah has made obligatory upon them the Zakat to be taken from their wealthy and given back to their poor."</div>
        <div class="hadith-ref">
          <span class="ref-tag">Bukhari & Muslim</span>
          <button class="share-btn" title="Share">↗</button>
        </div>
      </div>
      <div class="hadith-card reveal reveal-delay-2" data-topic="charity">
        <div class="hadith-arabic">الصَّدَقَةُ تُطْفِئُ الْخَطِيئَةَ كَمَا يُطْفِئُ الْمَاءُ النَّارَ</div>
        <div class="hadith-urdu">صدقہ گناہ کو اس طرح بجھاتا ہے جیسے پانی آگ کو بجھاتا ہے</div>
        <div class="hadith-english">"Charity extinguishes sin just as water extinguishes fire."</div>
        <div class="hadith-ref">
          <span class="ref-tag">Tirmidhi</span>
          <button class="share-btn" title="Share">↗</button>
        </div>
      </div>
      <div class="hadith-card reveal reveal-delay-1" data-topic="prayer">
        <div class="hadith-arabic">الصَّلَاةُ عِمَادُ الدِّينِ</div>
        <div class="hadith-urdu">نماز دین کا ستون ہے</div>
        <div class="hadith-english">"Prayer is the pillar of religion. Whoever establishes it has established religion, and whoever abandons it has destroyed religion."</div>
        <div class="hadith-ref">
          <span class="ref-tag">Al-Bayhaqi</span>
          <button class="share-btn" title="Share">↗</button>
        </div>
      </div>
      <div class="hadith-card reveal reveal-delay-2" data-topic="gratitude">
        <div class="hadith-arabic">مَنْ لَمْ يَشْكُرِ النَّاسَ لَمْ يَشْكُرِ اللَّهَ</div>
        <div class="hadith-urdu">جو لوگوں کا شکر نہیں کرتا وہ اللہ کا بھی شکر نہیں کرتا</div>
        <div class="hadith-english">"He who does not thank people does not thank Allah."</div>
        <div class="hadith-ref">
          <span class="ref-tag">Abu Dawud</span>
          <button class="share-btn" title="Share">↗</button>
        </div>
      </div>
    </div>
  </div>
</section>


@endsection
