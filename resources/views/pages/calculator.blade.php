@extends('layouts.app')
@section('content')

<div class="page-header" style="padding-top:120px; padding-bottom:60px; color:var(--dark); text-align:center;">
    <div class="container">
        <h1 style="font-family:'Playfair Display', serif; font-size:3rem; margin-bottom:1rem;">Smart Zakat Calculator</h1>
        <p style="font-size:1.1rem; opacity:0.9; max-width:600px; margin:0 auto;">Follow the guided steps to calculate your precise Zakat obligation for this year.</p>
    </div>
</div>

<section class="section" id="calculator-page" style="padding-top:2rem; padding-bottom:6rem; background:var(--bg);">
  <div class="container">
      
    <!-- Live Market Rates Card -->
    <div style="background:var(--bg-card); border:1px solid var(--border); border-radius:16px; padding:24px; margin-bottom:40px; box-shadow:0 10px 30px rgba(0,0,0,0.05);">
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px; flex-wrap:wrap; gap:10px;">
            <h3 style="margin:0; font-family:'Playfair Display', serif; font-size:1.5rem; color:var(--dark);">Live Market Rates</h3>
            <div style="display:flex; align-items:center; gap:8px;">
                <span style="display:inline-block; width:8px; height:8px; background:var(--emerald); border-radius:50%; animation:pulse 2s infinite;"></span>
                <span style="font-size:0.85rem; color:var(--text-light); font-weight:600; text-transform:uppercase;">Live</span>
                <span style="font-size:0.8rem; color:var(--text-light); margin-left:8px;">Last Updated: {{ \Carbon\Carbon::parse($goldRate->updated_at)->format('M d, Y h:i A') }}</span>
            </div>
        </div>
        
        <div style="display:flex; gap:20px; overflow-x:auto; padding-bottom:10px; scrollbar-width:thin;">
            <div style="min-width:160px; background:var(--bg); border:1px solid var(--border); padding:16px; border-radius:12px; text-align:center;">
                <div style="font-size:1.5rem; margin-bottom:8px;">🟡</div>
                <div style="font-weight:600; color:var(--dark); margin-bottom:4px;">Gold</div>
                <div style="font-size:0.9rem; color:var(--emerald); font-weight:700;">{{ number_format($goldRate->price) }} PKR / {{ ucfirst($goldRate->unit) }}</div>
            </div>
            
            <div style="min-width:160px; background:var(--bg); border:1px solid var(--border); padding:16px; border-radius:12px; text-align:center;">
                <div style="font-size:1.5rem; margin-bottom:8px;">⚪</div>
                <div style="font-weight:600; color:var(--dark); margin-bottom:4px;">Silver</div>
                <div style="font-size:0.9rem; color:var(--emerald); font-weight:700;">{{ number_format($silverRate->price) }} PKR / {{ ucfirst($silverRate->unit) }}</div>
            </div>
            
            @foreach($exchangeRates as $rate)
            <div style="min-width:140px; background:var(--bg); border:1px solid var(--border); padding:16px; border-radius:12px; text-align:center;">
                <div style="font-weight:600; color:var(--dark); margin-bottom:8px;">{{ $rate->currency_code }}</div>
                <div style="font-size:0.85rem; color:var(--text-light); margin-bottom:4px;">1 {{ $rate->currency_code }} =</div>
                <div style="font-size:0.95rem; color:var(--emerald); font-weight:700;">{{ number_format($rate->rate_to_pkr, 2) }} PKR</div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Calculator Body -->
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

        <!-- Step 1 -->
        <div class="calc-step active" id="step-1">
            <h3>🥇 Gold & Silver</h3>
            <p style="color:var(--text-light); font-size:0.9rem; margin-bottom:20px;">Enter the weight in tola. Value is calculated automatically based on live rates.</p>
            <div class="form-grid">
            <div class="form-group">
                <label>Gold Weight (Tola)</label>
                <input type="number" id="goldWeight" placeholder="e.g. 5" min="0" oninput="calcZakat()">
                <div style="font-size:0.8rem; color:var(--emerald); margin-top:6px; font-weight:600;" id="goldValueDisplay">Value: PKR 0</div>
            </div>
            <div class="form-group">
                <label>Silver Weight (Tola)</label>
                <input type="number" id="silverWeight" placeholder="e.g. 20" min="0" oninput="calcZakat()">
                <div style="font-size:0.8rem; color:var(--emerald); margin-top:6px; font-weight:600;" id="silverValueDisplay">Value: PKR 0</div>
            </div>
            </div>
            <div class="calc-nav">
            <span class="calc-progress">Step 1 of 4</span>
            <button class="btn-primary" onclick="goToStep(2)">Next →</button>
            </div>
        </div>

        <!-- Step 2 -->
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
                <label>Foreign Currency Amount</label>
                <div style="display:flex; gap:10px;">
                    <select id="foreignCurrencyCode" style="padding:10px; border-radius:8px; border:1px solid var(--border); background:var(--bg); width:100px;" onchange="calcZakat()">
                        @foreach($exchangeRates as $rate)
                            <option value="{{ $rate->rate_to_pkr }}">{{ $rate->currency_code }}</option>
                        @endforeach
                    </select>
                    <input type="number" id="foreignCurrencyAmount" placeholder="e.g. 1000" min="0" style="flex:1;" oninput="calcZakat()">
                </div>
                <div style="font-size:0.8rem; color:var(--emerald); margin-top:6px; font-weight:600;" id="fcValueDisplay">Value: PKR 0</div>
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

        <!-- Step 3 -->
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

        <!-- Step 4 -->
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

        <!-- Step 5: Result -->
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
  </div>
</section>

<script>
    const liveGoldRate = {{ $goldRate->price }};
    const liveSilverRate = {{ $silverRate->price }};
    const nisabThreshold = liveSilverRate * 52.5; // Silver nisab

    function calcZakat() {
        const gw = parseFloat(document.getElementById('goldWeight').value) || 0;
        const sw = parseFloat(document.getElementById('silverWeight').value) || 0;
        
        const gv = gw * liveGoldRate;
        const sv = sw * liveSilverRate;
        
        document.getElementById('goldValueDisplay').innerText = `Value: PKR ${gv.toLocaleString()}`;
        document.getElementById('silverValueDisplay').innerText = `Value: PKR ${sv.toLocaleString()}`;

        const fca = parseFloat(document.getElementById('foreignCurrencyAmount').value) || 0;
        const fcr = parseFloat(document.getElementById('foreignCurrencyCode').value) || 1;
        const fcTotal = fca * fcr;
        document.getElementById('fcValueDisplay').innerText = `Value: PKR ${fcTotal.toLocaleString(undefined, {minimumFractionDigits:2, maximumFractionDigits:2})}`;

        const ch = parseFloat(document.getElementById('cashHand').value) || 0;
        const bb = parseFloat(document.getElementById('bankBalance').value) || 0;
        const sav = parseFloat(document.getElementById('savings').value) || 0;
        
        const stk = parseFloat(document.getElementById('stocks').value) || 0;
        const mf = parseFloat(document.getElementById('mutualFunds').value) || 0;
        const bi = parseFloat(document.getElementById('businessInventory').value) || 0;
        const oi = parseFloat(document.getElementById('otherInvestments').value) || 0;
        
        const lns = parseFloat(document.getElementById('loans').value) || 0;
        const bd = parseFloat(document.getElementById('billsDue').value) || 0;
        const od = parseFloat(document.getElementById('otherDebts').value) || 0;

        const totalAssets = gv + sv + ch + bb + fcTotal + sav + stk + mf + bi + oi;
        const totalLiabilities = lns + bd + od;
        const netWealth = totalAssets - totalLiabilities;
        
        return { totalAssets, totalLiabilities, netWealth };
    }

    function showResult() {
        goToStep(5);
        const { totalAssets, totalLiabilities, netWealth } = calcZakat();
        
        document.getElementById('totalAssets').innerText = `PKR ${totalAssets.toLocaleString(undefined, {maximumFractionDigits:0})}`;
        document.getElementById('totalLiabilities').innerText = `PKR ${totalLiabilities.toLocaleString(undefined, {maximumFractionDigits:0})}`;
        
        if (netWealth >= nisabThreshold) {
            document.getElementById('netWealth').innerText = `PKR ${netWealth.toLocaleString(undefined, {maximumFractionDigits:0})}`;
            document.getElementById('zakatDue').innerText = `PKR ${(netWealth * 0.025).toLocaleString(undefined, {maximumFractionDigits:0})}`;
            document.getElementById('nisabBadge').innerText = "✅ Nisab Reached — Zakat is Obligatory";
            document.getElementById('nisabBadge').style.background = "rgba(16,185,129,0.1)";
            document.getElementById('nisabBadge').style.color = "var(--emerald)";
        } else {
            const finalWealth = Math.max(0, netWealth);
            document.getElementById('netWealth').innerText = `PKR ${finalWealth.toLocaleString(undefined, {maximumFractionDigits:0})}`;
            document.getElementById('zakatDue').innerText = "PKR 0";
            document.getElementById('nisabBadge').innerText = "❌ Nisab Not Reached — Zakat Not Obligatory";
            document.getElementById('nisabBadge').style.background = "rgba(239,68,68,0.1)";
            document.getElementById('nisabBadge').style.color = "#ef4444";
        }
    }

    function goToStep(step) {
        document.querySelectorAll('.calc-step-tab').forEach(t => t.classList.remove('active'));
        document.querySelectorAll('.calc-step').forEach(c => c.classList.remove('active'));
        document.querySelectorAll('.calc-step-tab')[step-1].classList.add('active');
        document.getElementById('step-'+step).classList.add('active');
    }

    function resetCalc() {
        document.querySelectorAll('input').forEach(i => i.value = '');
        document.getElementById('goldValueDisplay').innerText = `Value: PKR 0`;
        document.getElementById('silverValueDisplay').innerText = `Value: PKR 0`;
        document.getElementById('fcValueDisplay').innerText = `Value: PKR 0`;
        goToStep(1);
    }
    
    function printResult() {
        window.print();
    }
    
    function downloadPDF() {
        alert("Generating PDF... (Demo functionality)");
    }
</script>

<style>
@keyframes pulse {
    0% { transform: scale(1); opacity: 1; }
    50% { transform: scale(1.5); opacity: 0.5; }
    100% { transform: scale(1); opacity: 1; }
}
</style>

@endsection
