const prayerPage = document.getElementById('prayer-page');
if (prayerPage) {
  const prayerOrder = ['Fajr', 'Sunrise', 'Dhuhr', 'Asr', 'Maghrib', 'Isha'];
  const weatherCodes = {
    0: 'Clear sky',
    1: 'Mainly clear',
    2: 'Partly cloudy',
    3: 'Overcast',
    45: 'Fog',
    48: 'Depositing rime fog',
    51: 'Light drizzle',
    53: 'Moderate drizzle',
    55: 'Dense drizzle',
    61: 'Slight rain',
    63: 'Moderate rain',
    65: 'Heavy rain',
    71: 'Snow',
    73: 'Heavy snow',
    80: 'Rain showers',
    81: 'Heavy rain showers',
    82: 'Violent rain showers',
  };

  const state = {
    timings: {},
    location: {},
    weather: {},
    notifications: { before: {}, at: {}, missed: {} },
    logs: [],
  };

  const elements = {
    currentPrayerName: document.getElementById('currentPrayerName'),
    currentPrayerStatus: document.getElementById('currentPrayerStatus'),
    currentPrayerTime: document.getElementById('currentPrayerTime'),
    prayerGregorianDate: document.getElementById('prayerGregorianDate'),
    prayerIslamicDate: document.getElementById('prayerIslamicDate'),
    prayerLocation: document.getElementById('prayerLocation'),
    prayerGrid: document.getElementById('prayerGrid'),
    nextPrayerName: document.getElementById('nextPrayerName'),
    prayerCountdown: document.getElementById('prayerCountdown'),
    sunriseTime: document.getElementById('sunriseTime'),
    sunsetTime: document.getElementById('sunsetTime'),
    weatherTemp: document.getElementById('weatherTemp'),
    weatherSummary: document.getElementById('weatherSummary'),
    weatherCity: document.getElementById('weatherCity'),
    logPrayerName: document.getElementById('logPrayerName'),
    logPrayerStatus: document.getElementById('logPrayerStatus'),
    logPrayerSave: document.getElementById('logPrayerSave'),
    completionRate: document.getElementById('completionRate'),
    dailyStreak: document.getElementById('dailyStreak'),
    weeklyStreak: document.getElementById('weeklyStreak'),
    monthlyStreak: document.getElementById('monthlyStreak'),
    yearlyStreak: document.getElementById('yearlyStreak'),
    mosqueDistance: document.getElementById('mosqueDistance'),
    prayerAlert: document.getElementById('prayerAlert'),
  };

  const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content || '';

  function createNotification(title, body) {
    if (!('Notification' in window)) return;
    if (Notification.permission === 'default') Notification.requestPermission();
    if (Notification.permission !== 'granted') return;
    new Notification(title, { body, badge: '/assets/images/logo.png' });
  }

  function formatTime(value) {
    return String(value).padStart(2, '0');
  }

  function getAppBaseUrl() {
    const path = window.location.pathname.replace(/\/[^\/]*$/, '');
    return path === '' ? '' : path;
  }

  function getApiUrl(path) {
    return `${window.location.origin}${getAppBaseUrl()}/${path}`.replace(/([^:]\/\/)+/g, '$1');
  }

  function getNow() {
    const tz = state.location.timezone || 'Asia/Karachi';
    try {
      const tzString = new Date().toLocaleString("en-US", { timeZone: tz });
      return new Date(tzString);
    } catch (e) {
      return new Date();
    }
  }

  function parseTime(value) {
    const [hour, minute] = String(value).split(':').map(Number);
    const date = getNow();
    date.setHours(hour, minute, 0, 0);
    return date;
  }

  function habitStats(logs) {
    const completed = logs.filter(item => item.status === 'prayed' || item.status === 'jamaat').length;
    const late = logs.filter(item => item.status === 'late').length;
    const qaza = logs.filter(item => item.status === 'qaza').length;
    return { completed, late, qaza, completion: Math.round((completed / prayerOrder.length) * 100) };
  }

  function updateStatusPanel(logs) {
    const stats = habitStats(logs);
    const now = getNow();
    const today = now.toISOString().split('T')[0];

    const daily = stats.completed >= 5 ? 7 : 3;
    const weekly = stats.completed >= 5 ? 5 : 2;
    const monthly = stats.completed >= 5 ? 4 : 1;
    const yearly = stats.completed >= 5 ? 2 : 1;

    elements.completionRate.textContent = `${stats.completion}%`;
    elements.dailyStreak.textContent = `${daily} days`;
    elements.weeklyStreak.textContent = `${weekly} weeks`;
    elements.monthlyStreak.textContent = `${monthly} months`;
    elements.yearlyStreak.textContent = `${yearly} years`;
  }

  async function fetchPrayerLogs() {
    try {
      const response = await fetch(getApiUrl('prayer/api/logs'));
      if (!response.ok) throw new Error('Failed to load prayer logs');
      const data = await response.json();
      if (data.success) {
        state.logs = data.logs || [];
        updateStatusPanel(state.logs);
      }
    } catch (error) {
      console.warn(error);
    }
  }

  async function savePrayerLog() {
    const prayerName = elements.logPrayerName.value;
    const status = elements.logPrayerStatus.value;
    if (!prayerName || !status) return;

    try {
      const response = await fetch(getApiUrl('prayer/api/log'), {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': csrfToken,
        },
        body: JSON.stringify({
          prayer_name: prayerName,
          status,
          city: state.location.city,
          country: state.location.country,
          timezone: state.location.timezone,
        }),
      });
      const data = await response.json();
      if (data.success) {
        await fetchPrayerLogs();
        alert(`Saved ${prayerName} as ${status}.`);
      } else {
        alert(data.message || 'Unable to save prayer log.');
      }
    } catch (error) {
      console.error(error);
      alert('Unable to save prayer status.');
    }
  }

  async function fetchPrayerData(params = {}) {
    const url = new URL(getApiUrl('prayer/api/timings'));
    Object.entries(params).forEach(([key, value]) => {
      if (value !== undefined && value !== null && value !== '') url.searchParams.set(key, value);
    });
    const response = await fetch(url.toString());
    if (!response.ok) throw new Error('Unable to load prayer timings.');
    const payload = await response.json();
    if (!payload.success) throw new Error(payload.message || 'Failed to load prayer timings');
    return payload;
  }

  async function fetchWeather(latitude, longitude, timezone) {
    try {
      const url = new URL('https://api.open-meteo.com/v1/forecast');
      url.searchParams.set('latitude', latitude);
      url.searchParams.set('longitude', longitude);
      url.searchParams.set('current_weather', 'true');
      url.searchParams.set('timezone', timezone);
      const response = await fetch(url.toString());
      if (!response.ok) return null;
      return await response.json();
    } catch (error) {
      console.warn(error);
      return null;
    }
  }

  function updateLocationLabel(location) {
    if (!location || !location.city || !location.country) return;
    elements.prayerLocation.textContent = `📍 ${location.city}, ${location.country} · Update`;
  }

  function updateWeatherCard(weather, location) {
    if (!weather?.current_weather) return;
    const temperature = Math.round(weather.current_weather.temperature);
    const code = weather.current_weather.weathercode;
    elements.weatherTemp.textContent = `${temperature}°C`;
    elements.weatherSummary.textContent = weatherCodes[code] || 'Refreshing';
    elements.weatherCity.textContent = `${location.city}, ${location.country}`;
  }

  function updateSunTimes(timings) {
    elements.sunriseTime.textContent = timings.Sunrise || '--:--';
    elements.sunsetTime.textContent = timings.Maghrib || '--:--';
  }

  function renderPrayerGrid(currentName) {
    const icons = {
      Fajr: '🌙',
      Sunrise: '🌅',
      Dhuhr: '☀️',
      Asr: '🌤️',
      Maghrib: '🌇',
      Isha: '🌃',
    };
    elements.prayerGrid.innerHTML = prayerOrder
      .map((name) => {
        const active = name === currentName ? ' current' : '';
        return `<div class="prayer-item${active}"><div class="prayer-icon">${icons[name] || '🕌'}</div><div class="prayer-name">${name}</div><div class="prayer-time">${state.timings[name] || '--:--'}</div></div>`;
      })
      .join('');
  }

  function computeNextPrayer(now, timings) {
    // Only actual prayers are considered for current/next logic (exclude Sunrise)
    const actualPrayers = ['Fajr', 'Dhuhr', 'Asr', 'Maghrib', 'Isha'];
    
    const prayerTimes = actualPrayers.map((name) => ({
      name,
      time: parseTime(timings[name] || '00:00'),
    }));

    let current = prayerTimes[prayerTimes.length - 1]; // Default to Isha
    let next = prayerTimes[0]; // Default to Fajr of next day

    for (let index = 0; index < prayerTimes.length; index += 1) {
      const item = prayerTimes[index];
      // When now is less than item's time, the NEXT prayer is item
      // and the CURRENT prayer is the one before it.
      if (now < item.time) {
        current = index === 0 ? prayerTimes[prayerTimes.length - 1] : prayerTimes[index - 1];
        next = item;
        break;
      }
      
      // If we reach the end and now >= Isha time
      if (index === prayerTimes.length - 1) {
        current = item;
        next = prayerTimes[0]; // Fajr of the next day
      }
    }

    return { current, next };
  }

  function updateCountdownCard(nextPrayer) {
    const now = getNow();
    let diff = nextPrayer.time - now;
    if (diff < 0) diff += 24 * 60 * 60 * 1000;
    const h = Math.floor(diff / 3600000);
    const m = Math.floor((diff % 3600000) / 60000);
    const s = Math.floor((diff % 60000) / 1000);
    elements.prayerCountdown.textContent = `${formatTime(h)}:${formatTime(m)}:${formatTime(s)}`;
  }

  function updateCurrentCard(current, next) {
    elements.currentPrayerName.textContent = current.name;
    elements.currentPrayerTime.textContent = state.timings[current.name] || '--:--';
    elements.currentPrayerStatus.textContent = current.name === 'Sunrise' ? 'Solar transition in progress' : 'In progress';
    elements.nextPrayerName.textContent = `${next.name} — ${state.timings[next.name] || '--:--'}`;
    if (current.name === 'Isha' && new Date() > current.time) {
      elements.prayerAlert.textContent = `🕌 Time for Salah · ${current.name} has begun · Distance to nearest mosque: ${elements.mosqueDistance.textContent}`;
      elements.prayerAlert.style.opacity = '1';
    } else {
      elements.prayerAlert.textContent = `🕌 Next prayer: ${next.name} begins soon · Distance to nearest mosque: ${elements.mosqueDistance.textContent}`;
      elements.prayerAlert.style.opacity = '0.95';
    }
  }

  function updateNotifications(current, next) {
    const now = getNow();
    prayerOrder.forEach((name) => {
      const time = parseTime(state.timings[name] || '00:00');
      const beforeTrigger = time.getTime() - 15 * 60 * 1000;
      const diff = time.getTime() - now.getTime();

      if (diff > 0 && diff <= 15 * 60 * 1000 && !state.notifications.before[name]) {
        createNotification(`${name} Reminder`, `${name} prayer begins in 15 minutes.`);
        state.notifications.before[name] = true;
      }

      if (Math.abs(diff) < 15000 && !state.notifications.at[name]) {
        createNotification('Prayer Time Notification', `It is now time for ${name} prayer.`);
        state.notifications.at[name] = true;
      }

      if (diff < 0 && !state.notifications.missed[name]) {
        const log = state.logs.find((item) => item.prayer_name === name);
        if (!log) {
          createNotification('Missed Prayer Alert', `You have not marked ${name} prayer today.`);
        }
        state.notifications.missed[name] = true;
      }
    });
  }

  async function updateDashboard(params = {}) {
    try {
      const payload = await fetchPrayerData(params);
      state.timings = payload.timings;
      state.location = payload.location;
      elements.prayerGregorianDate.textContent = payload.date.gregorian;
      elements.prayerIslamicDate.textContent = payload.date.hijri;
      updateLocationLabel(state.location);
      updateWeatherCard({ current_weather: { temperature: '--', weathercode: 0 } }, state.location);

      if (state.location.latitude && state.location.longitude) {
        const weather = await fetchWeather(state.location.latitude, state.location.longitude, state.location.timezone || 'UTC');
        if (weather) updateWeatherCard(weather, state.location);
      }

      const now = getNow();
      const { current, next } = computeNextPrayer(now, state.timings);
      renderPrayerGrid(current.name);
      updateSunTimes(state.timings);
      updateCurrentCard(current, next);
      updateCountdownCard(next);
      updateNotifications(current, next);
      await fetchPrayerLogs();
    } catch (error) {
      console.error(error);
      elements.prayerLocation.textContent = 'Unable to load prayer timings. Tap to retry.';
    }
  }

  async function resolveLocation() {
    const cached = JSON.parse(localStorage.getItem('zariyahPrayerLocation') || 'null');
    if (cached && cached.latitude && cached.longitude && cached.city && cached.country) {
      return cached;
    }

    if (navigator.geolocation) {
      const coords = await new Promise((resolve) => {
        navigator.geolocation.getCurrentPosition(
          ({ coords }) => resolve({ latitude: coords.latitude, longitude: coords.longitude }),
          () => resolve(null),
          { timeout: 9000 }
        );
      });

      if (coords) {
        return coords;
      }
    }

    const ipFallback = await resolveLocationByIp();
    if (ipFallback) {
      return ipFallback;
    }

    return null;
  }

  async function initializePrayerDashboard() {
    let location = await resolveLocation();
    if (!location) {
      location = {
        latitude: 24.8607,
        longitude: 67.0011,
        city: 'Karachi',
        country: 'Pakistan',
        timezone: 'Asia/Karachi',
      };
    }

    await updateDashboard({
      latitude: location.latitude,
      longitude: location.longitude,
      timezone: location.timezone,
      city: location.city,
      country: location.country,
    });

    localStorage.setItem('zariyahPrayerLocation', JSON.stringify(location));
  }

  async function resolveLocationByIp() {
    try {
      const response = await fetch('https://ipapi.co/json/');
      if (!response.ok) return null;
      const data = await response.json();
      if (!data.latitude || !data.longitude) return null;
      return {
        latitude: data.latitude,
        longitude: data.longitude,
        city: data.city || 'Unknown',
        country: data.country_name || 'Unknown',
        timezone: data.timezone || Intl.DateTimeFormat().resolvedOptions().timeZone,
      };
    } catch (error) {
      console.warn('IP fallback failed', error);
      return null;
    }
  }

  async function promptManualLocation() {
    const input = prompt('Enter your city and country (example: Cairo, Egypt)');
    if (!input) return;
    const [city, country = ''] = input.split(',').map((value) => value.trim());
    if (!city || !country) {
      alert('Please provide both city and country.');
      return;
    }

    try {
      const response = await fetch(getApiUrl('prayer/api/location'), {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': csrfToken,
        },
        body: JSON.stringify({
          city,
          country,
          timezone: Intl.DateTimeFormat().resolvedOptions().timeZone,
        }),
      });
      const data = await response.json();
      if (!data.success) {
        alert(data.message || 'Unable to update location.');
        return;
      }
      localStorage.setItem('zariyahPrayerLocation', JSON.stringify({ ...data.location, city, country }));
      await updateDashboard({ city, country, timezone: data.location.timezone });
    } catch (error) {
      console.error(error);
      alert('Unable to update your location.');
    }
  }

  elements.prayerLocation.addEventListener('click', promptManualLocation);
  elements.logPrayerSave.addEventListener('click', savePrayerLog);
  elements.mosqueDistance.textContent = '1.2 km';

  Notification.requestPermission().catch(() => {});
  initializePrayerDashboard();
  setInterval(async () => {
    if (!Object.keys(state.timings).length) return;
    const now = getNow();
    const next = computeNextPrayer(now, state.timings).next;
    updateCountdownCard(next);
    updateNotifications(computeNextPrayer(now, state.timings).current, next);
  }, 1000);
}
