@extends('layouts.app')
@section('content')

<section class="section-full" id="prayer-page">
  <div class="section">
    <div class="section-header reveal">
      <div class="section-label">Daily Schedule</div>
      <h2>Prayer Times</h2>
      <p class="section-sub">Accurate Salah timings with location detection, live countdowns, and Premium Prayer Intelligence.</p>
    </div>

    <div class="prayer-dashboard reveal">
      <div class="prayer-header">
        <div class="prayer-date">
          <h3 id="prayerGregorianDate">Thursday, June 04, 2026</h3>
          <p id="prayerIslamicDate">13 Dhul Hijjah 1447 AH</p>
        </div>
        <div class="prayer-location" id="prayerLocation">📍 Karachi, Pakistan · Update</div>
      </div>

      <div class="prayer-intro-grid">
        <div class="prayer-hero-card glass-card">
          <div class="hero-tag">Premium Salah Assistant</div>
          <div class="hero-meta">
            <div class="hero-meta-item">
              <span>Current Prayer</span>
              <strong id="currentPrayerName">Asr</strong>
            </div>
            <div class="hero-meta-item">
              <span>Prayer Window</span>
              <strong id="currentPrayerTime">15:48</strong>
            </div>
            <div class="hero-meta-item">
              <span>Prayer Status</span>
              <strong id="currentPrayerStatus">In progress</strong>
            </div>
            <div class="hero-meta-item">
              <span>Nearest Mosque</span>
              <strong id="mosqueDistance">1.2 km</strong>
            </div>
          </div>

          <div class="hero-alert" id="prayerAlert">🕌 Next prayer: Maghrib begins soon · Distance to nearest mosque: 1.2 km</div>
        </div>

        <div class="weather-card glass-card">
          <div class="weather-panel">
            <div>
              <div class="weather-label">Weather</div>
              <h3 id="weatherTemp">--°C</h3>
              <p id="weatherSummary">Updating…</p>
            </div>
            <div class="weather-location" id="weatherCity">Karachi, Pakistan</div>
          </div>

          <div class="sun-grid">
            <div>
              <span>Sunrise</span>
              <strong id="sunriseTime">--:--</strong>
            </div>
            <div>
              <span>Sunset</span>
              <strong id="sunsetTime">--:--</strong>
            </div>
          </div>
        </div>
      </div>

      <div class="prayer-grid" id="prayerGrid">
        <div class="prayer-item"><div class="prayer-icon">🌙</div><div class="prayer-name">Fajr</div><div class="prayer-time">--:--</div></div>
        <div class="prayer-item"><div class="prayer-icon">🌅</div><div class="prayer-name">Sunrise</div><div class="prayer-time">--:--</div></div>
        <div class="prayer-item"><div class="prayer-icon">☀️</div><div class="prayer-name">Dhuhr</div><div class="prayer-time">--:--</div></div>
        <div class="prayer-item"><div class="prayer-icon">🌤️</div><div class="prayer-name">Asr</div><div class="prayer-time">--:--</div></div>
        <div class="prayer-item"><div class="prayer-icon">🌇</div><div class="prayer-name">Maghrib</div><div class="prayer-time">--:--</div></div>
        <div class="prayer-item"><div class="prayer-icon">🌃</div><div class="prayer-name">Isha</div><div class="prayer-time">--:--</div></div>
      </div>

      <div class="next-prayer-bar">
        <div>
          <div class="next-label">Next Prayer</div>
          <div class="next-name" id="nextPrayerName">Maghrib — --:--</div>
        </div>
        <div class="countdown" id="prayerCountdown">00:00:00</div>
      </div>

      <div class="prayer-status-panel">
        <div class="status-card glass-card">
          <div class="card-header">
            <div>
              <h3>Prayer Status Tracking</h3>
              <p>Mark your Salah status for today and build a reliable streak.</p>
            </div>
            <span class="status-badge">Quick update</span>
          </div>

          <div class="status-controls">
            <div class="status-field">
              <label for="logPrayerName">Prayer</label>
              <select id="logPrayerName">
                <option value="Fajr">Fajr</option>
                <option value="Sunrise">Sunrise</option>
                <option value="Dhuhr">Dhuhr</option>
                <option value="Asr">Asr</option>
                <option value="Maghrib">Maghrib</option>
                <option value="Isha">Isha</option>
              </select>
            </div>
            <div class="status-field">
              <label for="logPrayerStatus">Status</label>
              <select id="logPrayerStatus">
                <option value="prayed">Prayed</option>
                <option value="jamaat">Jamaat</option>
                <option value="late">Late</option>
                <option value="qaza">Qaza</option>
              </select>
            </div>
          </div>

          <div class="status-actions">
            <button class="btn-primary" id="logPrayerSave">Save Prayer Status</button>
          </div>
          <p class="status-note">Choose the prayer and status, then save to update your streak and completion summary instantly.</p>
        </div>

        <div class="streak-card glass-card">
          <div class="card-header">
            <div>
              <h3>Prayer Momentum</h3>
              <p>Track your daily completion and streak progress in a clean, engaging view.</p>
            </div>
            <span class="progress-pill">Active</span>
          </div>

          <div class="streak-score">
            <div class="streak-score-circle"><strong id="completionRate">0%</strong></div>
            <div class="streak-score-copy">
              <p>Today’s prayer completion</p>
              <strong class="streak-main-value">Stay consistent</strong>
            </div>
          </div>

          <div class="streak-metrics">
            <div class="streak-item">
              <span>Daily Streak</span>
              <strong id="dailyStreak">0 days</strong>
            </div>
            <div class="streak-item">
              <span>Weekly Streak</span>
              <strong id="weeklyStreak">0 weeks</strong>
            </div>
            <div class="streak-item">
              <span>Monthly Streak</span>
              <strong id="monthlyStreak">0 months</strong>
            </div>
            <div class="streak-item">
              <span>Yearly Streak</span>
              <strong id="yearlyStreak">0 years</strong>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script src="{{ asset('assets/js/prayer.js') }}"></script>

@endsection

