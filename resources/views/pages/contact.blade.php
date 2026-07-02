@extends('layouts.app')
@section('content')


<section class="section" id="contact-page">
  <div class="section-header reveal">
    <div class="section-label">Reach Out</div>
    <h2>Contact ZARIYAH Support</h2>
    <p class="section-sub">Have questions or need assistance? Our team is ready to help you with zakat, donations, and account support.</p>
  </div>
  <div class="contact-grid reveal" style="display:grid;grid-template-columns:repeat(auto-fit,minmax(260px,1fr));gap:1.5rem">
    <div class="contact-card">
      <h3>Customer Support</h3>
      <p>For product assistance, feature requests, and general inquiries.</p>
      <p><strong>Email:</strong> support@zariyah.com</p>
      <p><strong>Phone:</strong> +92 300 123 4567</p>
    </div>
    <div class="contact-card">
      <h3>Zakat Guidance</h3>
      <p>Need help calculating your Zakat or understanding Nisab?</p>
      <p><strong>Email:</strong> zakat@zariyah.com</p>
      <p><strong>Phone:</strong> +92 321 765 4321</p>
    </div>
    <div class="contact-card">
      <h3>Office Location</h3>
      <p>Visit our Islamabad office for in-person consultations and zakat distribution support.</p>
      <p><strong>Address:</strong> Street 12, Blue Area, Islamabad</p>
      <p><strong>Hours:</strong> Mon–Sat, 9am–6pm</p>
    </div>
  </div>
</section>


@endsection

