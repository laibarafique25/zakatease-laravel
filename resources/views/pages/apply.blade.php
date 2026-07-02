@extends('layouts.app')
@section('content')


<section class="section" id="apply-page">
  <div class="section-header reveal">
    <div class="section-label">Assistance</div>
    <h2>Apply For Help</h2>
    <p class="section-sub">Submit your request so ZARIYAH can support your family with urgent aid.</p>
  </div>
  <div class="section-inner reveal" style="max-width:760px;margin:0 auto;background:var(--card-bg);border:1px solid var(--border);border-radius:24px;padding:2rem;box-shadow:var(--shadow)">
    <div style="display:grid;gap:1rem">
      <div>
        <h3>Who can apply?</h3>
        <p>Families and individuals in financial hardship, medical emergency, education need, or disaster recovery may apply.</p>
      </div>
      <div>
        <h3>What documents are required?</h3>
        <p>Submit basic contact details, proof of need, family size, and a brief explanation of your situation.</p>
      </div>
      <div>
        <h3>How it works</h3>
        <ol style="padding-left:1.2rem;line-height:1.7;color:var(--text-light)">
          <li>Fill the request form</li>
          <li>Verification by the support team</li>
          <li>Receive assistance updates via email and phone</li>
        </ol>
      </div>
    </div>
    <div style="margin-top:2rem;display:flex;flex-wrap:wrap;gap:1rem">
      <a href="contact.php" class="btn-primary">Contact Support</a>
      <a href="faq.php" class="btn-secondary">Need help?</a>
    </div>
  </div>
</section>


@endsection

