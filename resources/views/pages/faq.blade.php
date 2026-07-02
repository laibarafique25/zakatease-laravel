@extends('layouts.app')
@section('content')


<section class="section-full" id="faq-page">
  <div class="section">
    <div class="section-header reveal">
      <div class="section-label">Knowledge Center</div>
      <h2>Zakat FAQ</h2>
      <p class="section-sub">Common questions about Zakat answered with clarity and precision.</p>
    </div>
    <div class="faq-list">
      <div class="faq-item reveal">
        <div class="faq-q" onclick="toggleFaq(this)">
          <h4>What is Zakat and who is it obligatory upon?</h4>
          <div class="faq-arrow">▼</div>
        </div>
        <div class="faq-a"><p>Zakat is the third pillar of Islam — a mandatory charitable contribution. It is obligatory upon every Muslim who possesses wealth above the Nisab threshold for a full lunar year. It applies to gold, silver, cash, trade goods, and certain other assets.</p></div>
      </div>
      <div class="faq-item reveal reveal-delay-1">
        <div class="faq-q" onclick="toggleFaq(this)">
          <h4>What is Nisab and what is the current threshold?</h4>
          <div class="faq-arrow">▼</div>
        </div>
        <div class="faq-a"><p>Nisab is the minimum amount of wealth a Muslim must possess before Zakat becomes obligatory. It equals the value of 87.48g of gold or 612.36g of silver. The lower of the two values (typically silver) is used as the threshold. In 2026 PKR terms, this is approximately PKR 85,000–95,000.</p></div>
      </div>
      <div class="faq-item reveal reveal-delay-2">
        <div class="faq-q" onclick="toggleFaq(this)">
          <h4>How much Zakat is due and how is it calculated?</h4>
          <div class="faq-arrow">▼</div>
        </div>
        <div class="faq-a"><p>Zakat is 2.5% of your total zakatable wealth (assets minus liabilities) if it exceeds the Nisab for a full Islamic lunar year (Hawl). Use our calculator above to compute your exact obligation in minutes.</p></div>
      </div>
      <div class="faq-item reveal reveal-delay-1">
        <div class="faq-q" onclick="toggleFaq(this)">
          <h4>Who can receive Zakat?</h4>
          <div class="faq-arrow">▼</div>
        </div>
        <div class="faq-a"><p>The Quran (9:60) specifies eight categories: the poor (Fuqara), the needy (Masakin), Zakat administrators, those whose hearts are to be reconciled, those in bondage, debtors, in the cause of Allah (Fi Sabilillah), and stranded travelers.</p></div>
      </div>
      <div class="faq-item reveal reveal-delay-2">
        <div class="faq-q" onclick="toggleFaq(this)">
          <h4>Is Zakat due on investments and business assets?</h4>
          <div class="faq-arrow">▼</div>
        </div>
        <div class="faq-a"><p>Yes. Business inventory is zakatable at market value. Stocks are zakatable on their zakatable portion (liquid assets of the company). Mutual funds follow the same principle. Fixed assets like machinery used in production are generally not zakatable.</p></div>
      </div>
    </div>
  </div>
</section>


@endsection

