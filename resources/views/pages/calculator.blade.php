@extends('layouts.app')
@section('content')


<section class="section" id="calculator-page">
  <div class="section-header reveal">
    <div class="section-label">Main Feature</div>
    <h2>Smart Zakat Calculator</h2>
    <p class="section-sub">Follow the guided steps to calculate your precise Zakat obligation for this year.</p>
  </div>
  <div class="calc-wrapper reveal">
    <div class="calc-steps-bar">
      <div class="calc-step-tab active" onclick="goToStep(1)">
        <span class="step-num">1</span>Gold & Silver
      </div>
      <div class="calc-step-tab" onclick="goToStep(2)">
        <span class="step-num">2</span>Cash & Savings
      </div>
      <div class="calc-step-tab" onclick="goToStep(3)">
        <span class="step-num">3</span>Investments
      </div>
      <div class="calc-step-tab" onclick="goToStep(4)">
        <span class="step-num">4</span>Liabilities
      </div>
      <div class="calc-step-tab" onclick="goToStep(5)">
        <span class="step-num">5</span>Result
      </div>
    </div>
    <div class="calc-body">

      <div class="calc-step active" id="step-1">
        <h3>🥇 Gold & Silver</h3>
        <div class="form-grid">
          <div class="form-group">
            <label>Gold Weight (grams)</label>
            <input type="number" id="goldWeight" placeholder="e.g. 50" min="0" oninput="calcZakat()">
          </div>
          <div class="form-group">
            <label>Gold Value (PKR)</label>
            <input type="number" id="goldValue" placeholder="e.g. 500000" min="0" oninput="calcZakat()">
          </div>
          <div class="form-group">
            <label>Silver Weight (grams)</label>
            <input type="number" id="silverWeight" placeholder="e.g. 200" min="0" oninput="calcZakat()">
          </div>
          <div class="form-group">
            <label>Silver Value (PKR)</label>
            <input type="number" id="silverValue" placeholder="e.g. 25000" min="0" oninput="calcZakat()">
          </div>
        </div>
        <div class="calc-nav">
          <span class="calc-progress">Step 1 of 4</span>
          <button class="btn-primary" onclick="goToStep(2)">Next →</button>
        </div>
      </div>

      <div class="calc-step" id="step-2">
        <h3>💰 Cash & Savings</h3>
        <div class="form-grid">
          <div class="form-group">
            <label>Cash in Hand (PKR)</label>
            <input type="number" id="cashHand" placeholder="e.g. 50000" min="0" oninput="calcZakat()">
          </div>
          <div class="form-group">
            <label>Bank Balance (PKR)</label>
            <input type="number" id="bankBalance" placeholder="e.g. 200000" min="0" oninput="calcZakat()">
          </div>
          <div class="form-group">
            <label>Foreign Currency (PKR)</label>
            <input type="number" id="foreignCurrency" placeholder="e.g. 0" min="0" oninput="calcZakat()">
          </div>
          <div class="form-group">
            <label>Other Savings (PKR)</label>
            <input type="number" id="savings" placeholder="e.g. 100000" min="0" oninput="calcZakat()">
          </div>
        </div>
        <div class="calc-nav">
          <button class="btn-secondary" onclick="goToStep(1)">← Back</button>
          <span class="calc-progress">Step 2 of 4</span>
          <button class="btn-primary" onclick="goToStep(3)">Next →</button>
        </div>
      </div>

      <div class="calc-step" id="step-3">
        <h3>📈 Investments</h3>
        <div class="form-grid">
          <div class="form-group">
            <label>Stocks Value (PKR)</label>
            <input type="number" id="stocks" placeholder="e.g. 0" min="0" oninput="calcZakat()">
          </div>
          <div class="form-group">
            <label>Mutual Funds (PKR)</label>
            <input type="number" id="mutualFunds" placeholder="e.g. 0" min="0" oninput="calcZakat()">
          </div>
          <div class="form-group">
            <label>Business Inventory (PKR)</label>
            <input type="number" id="businessInventory" placeholder="e.g. 0" min="0" oninput="calcZakat()">
          </div>
          <div class="form-group">
            <label>Other Investments (PKR)</label>
            <input type="number" id="otherInvestments" placeholder="e.g. 0" min="0" oninput="calcZakat()">
          </div>
        </div>
        <div class="calc-nav">
          <button class="btn-secondary" onclick="goToStep(2)">← Back</button>
          <span class="calc-progress">Step 3 of 4</span>
          <button class="btn-primary" onclick="goToStep(4)">Next →</button>
        </div>
      </div>

      <div class="calc-step" id="step-4">
        <h3>📉 Liabilities</h3>
        <div class="form-grid">
          <div class="form-group">
            <label>Loans (PKR)</label>
            <input type="number" id="loans" placeholder="e.g. 0" min="0" oninput="calcZakat()">
          </div>
          <div class="form-group">
            <label>Bills Due (PKR)</label>
            <input type="number" id="billsDue" placeholder="e.g. 0" min="0" oninput="calcZakat()">
          </div>
          <div class="form-group" style="grid-column:1/-1">
            <label>Other Debts (PKR)</label>
            <input type="number" id="otherDebts" placeholder="e.g. 0" min="0" oninput="calcZakat()">
          </div>
        </div>
        <div class="calc-nav">
          <button class="btn-secondary" onclick="goToStep(3)">← Back</button>
          <span class="calc-progress">Step 4 of 4</span>
          <button class="btn-primary" onclick="showResult()">Calculate Zakat ✦</button>
        </div>
      </div>

      <div class="calc-step" id="step-5">
        <h3>✦ Your Zakat Summary</h3>
        <div class="nisab-badge" id="nisabBadge">✅ Nisab Reached — Zakat is Obligatory</div>
        <div class="result-summary">
          <div class="result-item">
            <div class="r-label">Total Assets</div>
            <div class="r-value" id="totalAssets">PKR 0</div>
          </div>
          <div class="result-item">
            <div class="r-label">Total Liabilities</div>
            <div class="r-value" id="totalLiabilities">PKR 0</div>
          </div>
          <div class="result-item">
            <div class="r-label">Net Zakatable Wealth</div>
            <div class="r-value" id="netWealth">PKR 0</div>
          </div>
          <div class="result-item highlight">
            <div class="r-label">Zakat Due (2.5%)</div>
            <div class="r-value" id="zakatDue">PKR 0</div>
          </div>
        </div>
        <div class="result-actions">
          <button class="btn-primary" onclick="printResult()">🖨️ Print Report</button>
          <button class="btn-outline" onclick="downloadPDF()">⬇️ Download PDF</button>
          <button class="btn-reset" onclick="resetCalc()">↺ Reset</button>
        </div>
      </div>
    </div>
  </div>
</section>


@endsection

