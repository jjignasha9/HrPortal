<?php 
 include "include/header.php";
// include "include/conn.php";
  include "include/sidebar.php"; 
  
  $curr_date = date("m");
  $curr_dates = date("Y-m-d");
 
?>
  <!-- Content Wrapper. Contains page content -->
    <!-- Content Heclass="content-wrapper"ader (Page header) -->
    <!-- Main content -->
    
    <section class="content-wrapper macos-offset" style="min-height:Auto !important;background-image: url(images/iso1.jpg);width:100%;max-height:auto;height:auto;background-position: center;background-repeat: no-repeat; background-size:100% 100%;">
      <!-- Small boxes (Stat box) -->
      <section class="content">
        <!-- Clock, Calendar, Weather - Left Vertical Column -->
        <div class="row" style="margin-bottom: 20px;">
          <div class="left-widget-column" style="display:flex; flex-direction:column; align-items:flex-start; gap:12px; width: 200px; margin-left:20px;">
            <div class="left-widget-actions" style="margin: 0 0 6px 0;">
              <button type="button" id="reset-widgets" class="btn btn-default" style="padding:4px 8px; font-size:12px; border-radius:8px; position:fixed; display:none; z-index:10000;">Reset Widgets</button>
            </div>
          <!-- Dashboard Clock Widget -->
          <div id="clock-widget" class="col-xs-4 draggable-widget" style="width: 200px; padding: 0px; margin: 0;">
            <div class="box box-solid" style="background: #fff; border: 1px solid #e0e0e0; border-radius: 8px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); margin: 0 auto; width: 100%;">
             
              <div class="box-body" style="padding: 12px; text-align: center;">
                <div style="width: 160px; height: 160px; margin: 0 auto; position: relative;">
                  <canvas id="macClockCanvas" width="160" height="160" style="display:block; margin: 0 auto; border-radius: 50%;"></canvas>
                </div>
                <script>
(function() {
  // Store latest Celsius temperature for subtitle updates
  if (typeof window.__weatherTempC === 'undefined') {
    window.__weatherTempC = null;
  }

  // Simple analog clock animation - Matches dashboard design
  function initClock() {
    var canvas = document.getElementById('macClockCanvas');
    if (!canvas) {
      // Retry if canvas not ready yet
      if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initClock);
      } else {
        setTimeout(initClock, 100);
      }
      return;
    }

    var ctx = canvas.getContext('2d');
    var r = canvas.width / 2; 
    ctx.translate(r, r);
    r = r * 0.90; // inner radius
    
    function drawFace(){
      // Draw main clock face with white border
      ctx.beginPath();
      ctx.arc(0, 0, r, 0, Math.PI*2);
      ctx.fillStyle = '#ffffff';
      ctx.fill();
      
      // Add outer gray border
      ctx.lineWidth = 1;
      ctx.strokeStyle = '#e0e0e0';
      ctx.stroke();
      
      // Add white border (thicker)
      ctx.beginPath();
      ctx.arc(0, 0, r - 1, 0, Math.PI*2); // Slightly smaller radius for inner white border
      ctx.lineWidth = 10;
      ctx.strokeStyle = '#ffffff';
      ctx.stroke();
      
      // Add subtle inner shadow
      ctx.beginPath();
      ctx.arc(0, 0, r - 9, 0, Math.PI*2); // Adjusted radius to account for borders
      ctx.stroke();
      ctx.beginPath(); 
      ctx.arc(0, 0, r*0.04, 0, Math.PI*2); 
      ctx.fillStyle = '#222'; 
      ctx.fill();
    }
    
    function drawTicks(){
      // Draw tick marks - make them more subtle
      for(var i=0; i<60; i++){
        var len = i%5===0 ? r*0.08 : r*0.03; // Shorter ticks
        ctx.save();
        ctx.rotate(i*Math.PI/30);
        ctx.beginPath();
        ctx.moveTo(0, -r);
        ctx.lineTo(0, -r+len);
        ctx.lineWidth = i%5===0 ? 2 : 1; // Thinner lines
        ctx.strokeStyle = i%5===0 ? '#555' : '#999'; // Lighter color for minor ticks
        ctx.stroke();
        ctx.restore();
      }
      
      // Draw all numbers from 1 to 12
      ctx.fillStyle = '#111';
      ctx.font = 'bold ' + (r*0.22) + 'px Arial'; // Slightly smaller font
      ctx.textBaseline = 'middle'; 
      ctx.textAlign = 'center';
      
      // Position numbers in a circle
      const numbers = [12, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11];
      const angleStep = (2 * Math.PI) / 12; // 30 degrees in radians
      
      // Adjust radius for better number placement
      const numRadius = r * 0.75;
      
      numbers.forEach((num, index) => {
        const angle = (index * angleStep) - (Math.PI / 2);
        const x = Math.cos(angle) * numRadius;
        const y = Math.sin(angle) * numRadius;
        ctx.fillText(num.toString(), x, y);
      });
    }
    
    function drawHand(angle, length, width, color){
      ctx.save();
      ctx.rotate(angle);
      ctx.beginPath();
      ctx.moveTo(0, 0);
      ctx.lineTo(0, -length);
      ctx.lineWidth = width;
      ctx.lineCap = 'round';
      ctx.strokeStyle = color;
      ctx.stroke();
      ctx.restore();
    }
    
    function update(){
      ctx.clearRect(-canvas.width, -canvas.height, canvas.width*2, canvas.height*2);
      drawFace();
      drawTicks();
      
      var now = new Date();
      var second = now.getSeconds();
      var minute = now.getMinutes();
      var hour = now.getHours() % 12;
      
      // Smooth movement for hour and minute hands
      hour = (hour * Math.PI/6) + (minute * Math.PI/(6*60));
      minute = (minute * Math.PI/30) + (second * Math.PI/(30*60));
      var secA = second * Math.PI/30;
      
      // Draw hands with colors matching dashboard
      drawHand(hour, r*0.5, 6, '#222');     // Hour hand
      drawHand(minute, r*0.7, 4, '#222');   // Minute hand
      drawHand(secA, r*0.78, 2, '#ff9d00'); // Second hand in orange
      
      // Update digital clock (12-hour format with AM/PM)
      var h = now.getHours();
      var ampm = h >= 12 ? 'PM' : 'AM';
      h = h % 12;
      if(h === 0) h = 12;
      var timeStr = h + ':' + (now.getMinutes() < 10 ? '0' : '') + now.getMinutes() + ' ' + ampm;
      var digitalEl = document.getElementById('macClockDigital');
      if(digitalEl) digitalEl.textContent = timeStr;
    }
    
    // Start the clock
    setInterval(update, 1000);
    update();
  }

  // Initialize clock
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initClock);
  } else {
    initClock();
  }
})();
</script>
              </div>
            </div>
          </div>
          <!-- Modern Flat Date Picker Calendar -->
         <!-- Calendar Widget -->
<!-- Calendar Widget -->
<div id="calendar-widget" class="col-xs-4 draggable-widget" style="width: 200px; padding: 0; margin: 0;">
  <div class="box box-solid" style="background: rgba(255, 255, 255, 0.8); border: 1px solid #e0e0e0; border-radius: 8px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); margin: 0 auto; width: 100%;">
    <div class="box-header with-border" style="background: #f8f8f8; border-bottom: 1px solid #e0e0e0; border-radius: 8px 8px 0 0; padding: 0px 10px;">
      <div style="display: flex; justify-content: space-between; align-items: center;">
        <h3 class="box-title" style="margin: 0; font-size: 12px; font-weight: 700; color: #000 !important; text-transform: uppercase; letter-spacing: 0.5px;">
          <span id="current-month"><?php echo date('M Y'); ?></span>
        </h3>
        <div style="display: flex; gap: 10px;">
          <span style="cursor: pointer; font-size: 20px; font-weight: 700; color: #000 !important;" onclick="changeMonth(-1)">‹</span>
          <span style="cursor: pointer; font-size: 20px; font-weight: 700; color: #000 !important;" onclick="changeMonth(1)">›</span>
        </div>
      </div>
    </div>
    <div class="box-body" style="padding: 6px 0px 8px 8px;">
      <table style="width: 100%; border-collapse: collapse; font-size: 12px; table-layout: fixed; margin: 0 auto;">
        <thead>
          <tr>
            <?php 
            $days = ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'];
            foreach($days as $day) {
              echo "<th style='padding: 2px 0; color: #000; font-weight: 700;'>$day</th>";
            }
            ?>
          </tr>
        </thead>
        <tbody id="calendar-body" style="font-size: 12px; font-weight: 700; color:#000;">
          <?php
          $firstDay = date('w', strtotime('first day of this month'));
          $daysInMonth = date('t');
          $currentDay = date('j');
          $currentMonth = date('n');
          $currentYear = date('Y');
          echo '<tr style="height: 18px;">';
          // Empty cells for days before the 1st of the month
          for($i = 0; $i < $firstDay; $i++) {
            echo '<td style="padding: 1px; color: #000;"><span style="display: inline-block; width: 18px; height: 16px; line-height: 16px; text-align: center; font-weight: 700;"></span></td>';
          }
          // Calendar days
          for($day = 1; $day <= $daysInMonth; $day++) {
            if(($day + $firstDay - 1) % 7 == 0 && $day != 1) {
              echo '</tr><tr style="height: 18px;">';
            }
            $isToday = ($day == $currentDay && $currentMonth == date('n') && $currentYear == date('Y'));
            $dayStyle = $isToday ? 'background-color: #FFA62A; color: black; border-radius: 50%;' : '';
            $dayClass = $isToday ? 'current-day' : '';
            echo "<td style='padding: 1px;'><span class='day-cell $dayClass' style='display: inline-block; width: 16px; height: 16px; line-height: 16px; text-align: center; font-size: 12px; font-weight: 700; $dayStyle'>{$day}</span></td>";
          }
          
          // Fill remaining cells
          $remainingDays = (7 - (($daysInMonth + $firstDay) % 7)) % 7;
          for($i = 0; $i < $remainingDays; $i++) {
            echo '<td style="padding: 1px; color: #000 !important;"><span style="display: inline-block; width: 16px; height: 16px; line-height: 16px; text-align: center; font-weight: 700;"></span></td>';
          }
          echo '</tr>';
          ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<style>
.day-cell {
  transition: all 0.2s ease;
}
.day-cell:hover {
  background-color: #f0f0f0;
  cursor: pointer;
  border-radius: 50%;
}
.current-day {
  font-weight: 700;
}
</style>

<script>
(function() {
  let currentDate = new Date();

  function updateCalendar() {
    const monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun",
      "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
    
    const monthEl = document.getElementById('current-month');
    if (!monthEl) return;
    
    monthEl.textContent = 
      `${monthNames[currentDate.getMonth()]} ${currentDate.getFullYear()}`;
      
    const firstDay = new Date(currentDate.getFullYear(), currentDate.getMonth(), 1).getDay();
    const daysInMonth = new Date(currentDate.getFullYear(), currentDate.getMonth() + 1, 0).getDate();
    const today = new Date();
    const isCurrentMonth = currentDate.getMonth() === today.getMonth() && 
                          currentDate.getFullYear() === today.getFullYear();
    
    let calendarBody = document.getElementById('calendar-body');
    if (!calendarBody) return;
    
    calendarBody.innerHTML = '';
    
    let date = 1;
    for (let i = 0; i < 6; i++) {
      if (date > daysInMonth && i > 0) break;
      
      let row = document.createElement('tr');
      row.style.height = '18px';
      
      for (let j = 0; j < 7; j++) {
        const cell = document.createElement('td');
        cell.style.padding = '1px';
        
        if (i === 0 && j < firstDay) {
          cell.innerHTML = '<span style="display: inline-block; width: 16px; height: 16px; line-height: 16px; text-align: center; font-weight: 700;"></span>';
          cell.style.color = '#000 !important';
        } else if (date > daysInMonth) {
          cell.innerHTML = '<span style="display: inline-block; width: 16px; height: 16px; line-height: 16px; text-align: center; font-weight: 700;"></span>';
          cell.style.color = '#000 !important';
        } else {
          const isToday = isCurrentMonth && date === today.getDate();
          const dayStyle = isToday ? 'background-color: #FFA62A; color: white; border-radius: 50%;' : '';
          const dayClass = isToday ? 'current-day' : '';
          cell.innerHTML = `<span class="day-cell ${dayClass}" style="display: inline-block; width: 16px; height: 16px; line-height: 16px; text-align: center; font-size: 12px; font-weight: 700; ${dayStyle}">${date}</span>`;
          date++;
        }
        
        row.appendChild(cell);
      }
      
      calendarBody.appendChild(row);
    }
  }

  window.changeMonth = function(offset) {
    currentDate.setMonth(currentDate.getMonth() + offset);
    updateCalendar();
  };

  // Initialize calendar when DOM is ready
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', updateCalendar);
  } else {
    updateCalendar();
  }
})();
</script>

    <!-- Weather Widget -->
<div id="weather-widget" class="col-xs-4 draggable-widget" style="width: 200px; padding: 0; margin: 0;">
  <div class="box box-solid" style="background: linear-gradient(180deg, #19497e 55%, #7e97b5 100%) !important; border-radius: 24px !important; margin: 0 auto; width: 100%; color: #fff; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.25), inset 0 1px 0 rgba(255,255,255,0.25); border: 1px solid rgba(255,255,255,0.25);">
    <div class="box-body" style="padding: 10px 5px; text-align: center; position: relative; overflow: hidden; min-height: 212px;">
      <!-- Weather Icon -->
      <div style="position: relative; width: 100%; height: 90px; margin: 5px 0 0px;" id="weather-icon">
        <img src="images/nav_icon/weather.svg" alt="Weather" style="width: 120px; height: auto; position: absolute; left: 26px; top: 0px; filter: drop-shadow(0 6px 12px rgba(0,0,0,0.25));">
      </div>
      <!-- Location and Date -->
      <div style="font-size: 20px; font-weight: 700; margin: 0px 0 0px; letter-spacing: 0.2px;" id="location">Loading...</div>
      <div style="font-size: 13px; opacity: 0.92; margin-bottom: 0px; font-weight: 700;" id="date-time">-- F | --</div>
      <!-- Temperature -->
      <div style="font-size: 56px; font-weight: 800; margin: 6px 0 2px; line-height: 1; letter-spacing: -1px;" id="temperature">--°</div>
    </div>
  </div>
</div>

<script>
(function() {
  // Store latest Celsius temperature for subtitle updates
  if (typeof window.__weatherTempC === 'undefined') {
    window.__weatherTempC = null;
  }

  // Fetch weather from wttr.in for a fixed city (Surat)
  function getWeather() {
    fetchWeatherWttr('Surat');
  }

  // Fetch wttr.in JSON
  async function fetchWeatherWttr(city) {
    const url = `https://wttr.in/${encodeURIComponent(city)}?format=j1`;
    try {
      const response = await fetch(url);
      const data = await response.json();
      updateWeatherUIWttr(data, city);
    } catch (error) {
      console.error('Error fetching weather:', error);
      const loc = document.getElementById('location');
      if (loc) loc.textContent = 'Weather Unavailable';
    }
  }

  // Update UI with wttr.in data
  function updateWeatherUIWttr(data, fallbackCity) {
    const area = (data.nearest_area && data.nearest_area[0]) || null;
    const cityName = area?.areaName?.[0]?.value || fallbackCity || 'City';
    const country = area?.country?.[0]?.value || '';
    const curr = (data.current_condition && data.current_condition[0]) || {};

    const locEl = document.getElementById('location');
    if (locEl) locEl.textContent = `${cityName}, ${country}`.trim();

    const days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
    const now = new Date();
    const dayName = days[now.getDay()];

    const tempC = Number(curr.temp_C);
    const tempF = Number(curr.temp_F);
    window.__weatherTempC = isNaN(tempC) ? null : tempC;
    const tempText = isNaN(tempC) ? '--' : Math.round(tempC);
    const fText = isNaN(tempF) ? '--' : tempF.toFixed(1);
    const tempEl = document.getElementById('temperature');
    if (tempEl) tempEl.textContent = `${tempText}°`;
    const dtEl = document.getElementById('date-time');
    if (dtEl) dtEl.textContent = `${fText} F | ${dayName}`;

    const desc = (curr.weatherDesc && curr.weatherDesc[0]?.value) || '';
    const main = desc.includes('cloud') ? 'Clouds' : (desc.includes('rain') ? 'Rain' : (desc.includes('snow') ? 'Snow' : (desc.includes('thunder') ? 'Thunderstorm' : (desc.includes('clear') ? 'Clear' : 'Clear'))));
    updateWeatherIcon(main, desc.toLowerCase());

    const humEl = document.getElementById('humidity');
    if (humEl) humEl.textContent = `${curr.humidity || '--'}%`;
    const windEl = document.getElementById('wind');
    if (windEl) windEl.textContent = `${curr.windspeedKmph || '--'} km/h`;
    const presEl = document.getElementById('pressure');
    if (presEl) presEl.textContent = `${curr.pressure || '--'} hPa`;
  }

  // Update weather icon based on conditions
  function updateWeatherIcon(main, description) {
    const sun = document.getElementById('weather-sun');
    const cloud = document.getElementById('weather-cloud');
    const rain = document.getElementById('weather-rain');
    const clear = document.getElementById('weather-clear');
    // If legacy icon elements are not present (using static SVG), do nothing
    if (!sun || !cloud || !rain || !clear) return;
    
    // Hide all icons first
    sun.style.display = 'none';
    cloud.style.display = 'none';
    rain.style.display = 'none';
    clear.style.display = 'none';
    
    // Show appropriate icon based on weather condition
    if (main === 'Clear') {
      clear.style.display = 'block';
    } else if (main === 'Clouds') {
      if (description.includes('few') || description.includes('scattered')) {
        sun.style.display = 'block';
        cloud.style.display = 'block';
      } else {
        cloud.style.display = 'block';
      }
    } else if (main === 'Rain' || main === 'Drizzle') {
      rain.style.display = 'block';
      cloud.style.display = 'block';
    } else if (main === 'Thunderstorm') {
      rain.style.display = 'block';
      rain.textContent = '⛈️';
      cloud.style.display = 'block';
    } else if (main === 'Snow') {
      rain.style.display = 'block';
      rain.textContent = '❄️';
    } else {
      clear.style.display = 'block'; // Default to sun
    }
  }

  // Update time every minute
  function updateTime() {
    const now = new Date();
    const dateTimeElement = document.getElementById('date-time');
    if (dateTimeElement) {
      const dayName = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'][now.getDay()];
      let fText = '--';
      if (typeof window.__weatherTempC === 'number') {
        fText = `${((window.__weatherTempC * 9/5) + 32).toFixed(1)} F`;
      }
      dateTimeElement.textContent = `${fText} | ${dayName}`;
    }
  }

  // Initialize weather widget
  function initWeather() {
    getWeather();
    updateTime();
    setInterval(updateTime, 60000); // Update time every minute
    setInterval(getWeather, 1800000); // Update weather every 30 minutes
  }

  // Wait for DOM to be ready
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initWeather);
  } else {
    initWeather();
  }
})();
</script>
<style>
.draggable-widget{cursor: grab}
.draggable-widget.dragging{outline:2px dashed rgba(255,255,255,0.9); outline-offset:2px; cursor: grabbing; z-index: 9999}
</style>
<script>
(function(){
  function initDraggableWidgets() {
    var els = document.querySelectorAll('.draggable-widget');
    if (els.length === 0) {
      // Retry if widgets not ready yet
      if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initDraggableWidgets);
      } else {
        setTimeout(initDraggableWidgets, 100);
      }
      return;
    }

    function applySaved(el){
      var key = 'pos:'+el.id;
      var v = localStorage.getItem(key);
      if(!v) return;
      try{
        var p = JSON.parse(v);
        el.style.position = 'fixed';
        el.style.left = (p.left||0)+'px';
        el.style.top = (p.top||0)+'px';
      }catch(e){}
    }
    function makeDraggable(el){
      applySaved(el);
      var startX=0,startY=0,origX=0,origY=0,active=false,holdTimer=null,holdDelay=10000,hasMoved=false; // 10s long-press
      function beginDrag(e){
        active=true;
        el.classList.add('dragging');
        el.style.position='fixed';
        var rect = el.getBoundingClientRect();
        origX = rect.left; origY = rect.top;
        startX = (e.touches?e.touches[0].clientX:e.clientX);
        startY = (e.touches?e.touches[0].clientY:e.clientY);
        document.addEventListener('mousemove', onMove);
        document.addEventListener('mouseup', onUp);
        document.addEventListener('touchmove', onMove, {passive:false});
        document.addEventListener('touchend', onUp);
        showResetNear(el);
      }
      function onDown(e){
        hasMoved=false;
        startX = (e.touches?e.touches[0].clientX:e.clientX);
        startY = (e.touches?e.touches[0].clientY:e.clientY);
        holdTimer = setTimeout(function(){ beginDrag(e); }, holdDelay);
      }
      function onMove(e){
        // Allow user to move inside widget before activation without canceling long-press
        var cx = (e.touches?e.touches[0].clientX:e.clientX);
        var cy = (e.touches?e.touches[0].clientY:e.clientY);
        if(!active){
          return; // do not cancel long-press on movement
        }
        // Do not block mouse interactions; only prevent default on touch to avoid page scroll
        if(e.type.indexOf('touch')===0 && e.cancelable) e.preventDefault();
        var dx = cx - startX;
        var dy = cy - startY;
        var left = origX + dx;
        var top = origY + dy;
        el.style.left = left + 'px';
        el.style.top = top + 'px';
        moveResetNear(el);
      }
      function onUp(){
        if(holdTimer){ clearTimeout(holdTimer); holdTimer=null; }
        if(!active) return;
        active=false;
        el.classList.remove('dragging');
        var rect = el.getBoundingClientRect();
        localStorage.setItem('pos:'+el.id, JSON.stringify({left: rect.left, top: rect.top}));
        document.removeEventListener('mousemove', onMove);
        document.removeEventListener('mouseup', onUp);
        document.removeEventListener('touchmove', onMove);
        document.removeEventListener('touchend', onUp);
        hideReset();
      }
      el.addEventListener('mousedown', onDown);
      el.addEventListener('touchstart', onDown, {passive:true});
    }
    els.forEach(makeDraggable);
    // Reset handler
    var resetBtn = document.getElementById('reset-widgets');
    function clearOne(id){ localStorage.removeItem('pos:'+id); var el=document.getElementById(id); if(el){ el.style.position=''; el.style.left=''; el.style.top=''; }}
    if(resetBtn){
      resetBtn.addEventListener('click', function(){
        clearOne('clock-widget');
        clearOne('calendar-widget');
        clearOne('weather-widget');
        // Ensure they render back in the original stacked flow
        window.location.reload();
      });
    }
    // Utilities to show/hide and follow the dragged widget
    function showResetNear(el){
      if(!resetBtn) return;
      var r = el.getBoundingClientRect();
      resetBtn.style.display = 'block';
      resetBtn.style.left = (r.right - 90) + 'px';
      resetBtn.style.top = (r.top - 10) + 'px';
    }
    function moveResetNear(el){
      if(resetBtn && resetBtn.style.display === 'block'){
        var r = el.getBoundingClientRect();
        resetBtn.style.left = (r.right - 90) + 'px';
        resetBtn.style.top = (r.top - 10) + 'px';
      }
    }
    function hideReset(){ if(resetBtn) resetBtn.style.display = 'none'; }
  }

  // Initialize draggable widgets
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initDraggableWidgets);
  } else {
    initDraggableWidgets();
  }
})();
</script>
          </div>
        <!-- End Clock/Calendar/Weather Left Column -->

	</section>
	
    <!-- /.content -->
  <!-- /.content-wrapper -->
  <script>
(function() {
  // Wait for jQuery to be available
  function initAjaxCalls() {
    if (typeof jQuery === 'undefined' || typeof $ === 'undefined') {
      // Retry after a short delay if jQuery is not yet loaded
      setTimeout(initAjaxCalls, 100);
      return;
    }

    jQuery(document).ready(function($) {
      try {
        // First AJAX call
        var form_data = new FormData();
        form_data.append("action_type", 'load_auto');
        
        $.ajax({
          type: "POST",
          url: "process_fy_year.php",
          data: form_data,
          dataType: "JSON",
          processData: false,
          contentType: false,
          success: function(data) {
            // Handle success if needed
          },
          error: function(xhr, status, error) {
            console.error('Error in process_fy_year.php:', error);
            // Silently fail - don't break the page if this fails
          }
        });
      } catch (e) {
        console.error('Error setting up process_fy_year.php call:', e);
      }

      try {
        // Second AJAX call
        var action_type = "auto_data_fill";
        $.ajax({
          type: "POST",
          url: "process_equipment.php",
          data: '&action_type=' + action_type,
          success: function(data) {
            // Handle success if needed
          },
          error: function(xhr, status, error) {
            console.error('Error in process_equipment.php:', error);
            // Silently fail - don't break the page if this fails
          }
        });
      } catch (e) {
        console.error('Error setting up process_equipment.php call:', e);
      }
    });
  }

  // Start initialization
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initAjaxCalls);
  } else {
    initAjaxCalls();
  }
})();
</script>
  <?php include "include/footer.php";?>
