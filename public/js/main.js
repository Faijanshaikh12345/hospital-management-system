/* ============================================================
   AdminPro Panel — Main JavaScript
   ============================================================ */

// ---- Sidebar Toggle ----
const sidebar      = document.getElementById('sidebar');
const mainWrapper  = document.getElementById('mainWrapper');
const toggleBtn    = document.getElementById('toggleBtn');
const sidebarClose = document.getElementById('sidebarClose');
const overlay      = document.getElementById('sidebarOverlay');

function isMobile() { return window.innerWidth <= 900; }

function openMobileSidebar() {
  sidebar.classList.add('mobile-open');
  overlay.classList.add('show');
}
function closeMobileSidebar() {
  sidebar.classList.remove('mobile-open');
  overlay.classList.remove('show');
}
function toggleDesktopSidebar() {
  sidebar.classList.toggle('collapsed');
  mainWrapper.classList.toggle('sidebar-collapsed');
}

if (toggleBtn) toggleBtn.addEventListener('click', () => {
  isMobile() ? openMobileSidebar() : toggleDesktopSidebar();
});
if (sidebarClose) sidebarClose.addEventListener('click', closeMobileSidebar);
if (overlay) overlay.addEventListener('click', closeMobileSidebar);
window.addEventListener('resize', () => { if (!isMobile()) closeMobileSidebar(); });

// ---- Submenu Toggle ----
document.querySelectorAll('.has-submenu').forEach(item => {
  item.addEventListener('click', () => {
    const submenuId = item.id.replace('Menu', 'Submenu');
    const submenu = document.getElementById(submenuId);
    if (submenu) {
      item.classList.toggle('open');
      submenu.classList.toggle('open');
    }
  });
});

// ---- Notification Dropdown ----
const notifToggle   = document.getElementById('notifToggle');
const notifDropdown = document.getElementById('notifDropdown');
const profileToggle = document.getElementById('profileToggle');
const profileDropdown = document.getElementById('profileDropdown');

function closeAll() {
  notifDropdown?.classList.remove('open');
  profileDropdown?.classList.remove('open');
}
if (notifToggle) notifToggle.addEventListener('click', (e) => {
  e.stopPropagation();
  const isOpen = notifDropdown.classList.contains('open');
  closeAll();
  if (!isOpen) notifDropdown.classList.add('open');
});
if (profileToggle) profileToggle.addEventListener('click', (e) => {
  e.stopPropagation();
  const isOpen = profileDropdown.classList.contains('open');
  closeAll();
  if (!isOpen) profileDropdown.classList.add('open');
});
document.addEventListener('click', closeAll);

// ---- Theme Toggle ----
const themeBtn = document.getElementById('themeToggle');
const savedTheme = localStorage.getItem('adminpro-theme');
if (savedTheme === 'dark') {
  document.body.classList.add('dark');
  if (themeBtn) themeBtn.querySelector('i').className = 'fas fa-sun';
}
if (themeBtn) themeBtn.addEventListener('click', () => {
  document.body.classList.toggle('dark');
  const isDark = document.body.classList.contains('dark');
  themeBtn.querySelector('i').className = isDark ? 'fas fa-sun' : 'fas fa-moon';
  localStorage.setItem('adminpro-theme', isDark ? 'dark' : 'light');
});

// ---- Chart Tab Buttons ----
document.querySelectorAll('.tab-btn').forEach(btn => {
  btn.addEventListener('click', () => {
    btn.closest('.card-header').querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');
    if (typeof updateRevenueChart === 'function') updateRevenueChart(btn.dataset.period);
  });
});

// ---- Charts (Dashboard) ----
function getChartColors() {
  const dark = document.body.classList.contains('dark');
  return {
    grid: dark ? 'rgba(255,255,255,0.06)' : 'rgba(0,0,0,0.06)',
    text: dark ? '#8b949e' : '#64748b',
  };
}

// Sparklines
function makeSparkline(id, data, color) {
  const ctx = document.getElementById(id);
  if (!ctx) return;
  new Chart(ctx, {
    type: 'line',
    data: {
      labels: data.map((_, i) => i),
      datasets: [{ data, borderColor: color, borderWidth: 2, pointRadius: 0, fill: false, tension: 0.4 }]
    },
    options: {
      responsive: false,
      plugins: { legend: { display: false }, tooltip: { enabled: false } },
      scales: { x: { display: false }, y: { display: false } },
      animation: false
    }
  });
}
makeSparkline('spark1', [10,18,14,22,19,28,24,32,30,38], '#6366f1');
makeSparkline('spark2', [22,18,26,24,30,28,34,32,38,42], '#22c55e');
makeSparkline('spark3', [30,26,28,22,20,18,22,20,16,18], '#f59e0b');
makeSparkline('spark4', [12,14,16,15,18,20,19,22,21,24], '#ef4444');

// Revenue Chart
const revenueData = {
  weekly:  { labels: ['Mon','Tue','Wed','Thu','Fri','Sat','Sun'],   income: [12,19,8,22,16,28,24],  expense: [8,12,6,15,10,18,14] },
  monthly: { labels: ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'], income: [65,72,58,81,76,95,88,102,91,110,98,120], expense: [42,50,38,55,48,62,55,70,60,75,65,80] },
  yearly:  { labels: ['2020','2021','2022','2023','2024','2025'],   income: [480,560,620,700,820,940], expense: [320,380,400,460,540,610] }
};
let revenueChart = null;
function buildRevenueChart(period = 'weekly') {
  const ctx = document.getElementById('revenueChart');
  if (!ctx) return;
  const c = getChartColors();
  const d = revenueData[period];
  if (revenueChart) revenueChart.destroy();
  revenueChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: d.labels,
      datasets: [
        {
          label: 'Revenue',
          data: d.income,
          backgroundColor: 'rgba(99,102,241,0.85)',
          borderRadius: 6,
          borderSkipped: false,
        },
        {
          label: 'Expenses',
          data: d.expense,
          backgroundColor: 'rgba(239,68,68,0.6)',
          borderRadius: 6,
          borderSkipped: false,
        }
      ]
    },
    options: {
      responsive: true,
      maintainAspectRatio: true,
      plugins: {
        legend: { labels: { color: c.text, usePointStyle: true, pointStyle: 'circle', padding: 20 } },
        tooltip: { backgroundColor: '#1e293b', titleColor: '#fff', bodyColor: '#94a3b8', cornerRadius: 8, padding: 10 }
      },
      scales: {
        x: { grid: { color: c.grid }, ticks: { color: c.text } },
        y: { grid: { color: c.grid }, ticks: { color: c.text } }
      }
    }
  });
}
function updateRevenueChart(period) { buildRevenueChart(period); }
buildRevenueChart();

// Traffic Donut Chart
(function buildTrafficChart() {
  const ctx = document.getElementById('trafficChart');
  if (!ctx) return;
  new Chart(ctx, {
    type: 'doughnut',
    data: {
      labels: ['Organic','Direct','Referral','Social'],
      datasets: [{
        data: [42,28,18,12],
        backgroundColor: ['#6366f1','#22c55e','#f59e0b','#ef4444'],
        borderWidth: 0,
        hoverOffset: 6
      }]
    },
    options: {
      responsive: true,
      cutout: '72%',
      plugins: {
        legend: { display: false },
        tooltip: { backgroundColor: '#1e293b', titleColor: '#fff', bodyColor: '#94a3b8', cornerRadius: 8, padding: 10 }
      }
    }
  });
})();

// ---- Table Search (pages) ----
const tableSearch = document.getElementById('tableSearch');
if (tableSearch) {
  tableSearch.addEventListener('input', function () {
    const query = this.value.toLowerCase();
    document.querySelectorAll('.data-table tbody tr').forEach(row => {
      row.style.display = row.textContent.toLowerCase().includes(query) ? '' : 'none';
    });
  });
}
