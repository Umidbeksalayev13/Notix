
 <script src='assets/js/index.global.js'></script>
<script>

  document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
      headerToolbar: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
      },
      height: 'auto',
      navLinks: false,
      businessHours: true,
      editable: false,
      selectable: true,
      selectMirror: true,
      dayMaxEvents: true,
      weekends: true,
      slotLabelFormat: {
        hour: '2-digit',
        minute: '2-digit',
        hour12: false
      },
      eventTimeFormat: {
        hour: '2-digit',
        minute: '2-digit',
        hour12: false
      },

      // Dynamic event loading
      events: function(fetchInfo, successCallback, failureCallback) {
        // Format dates for the API request
        var startDate = fetchInfo.start.toISOString().split('T')[0];
        var endDate = fetchInfo.end.toISOString().split('T')[0];

        // Make AJAX request to get events
        fetch('/calendar?start_date=' + startDate + '&end_date=' + endDate)
          .then(response => {
            if (!response.ok) {
              throw new Error('Network response was not ok');
            }
            return response.json();
          })
          .then(data => {
            // Pass the events to FullCalendar
            successCallback(data);
          })
          .catch(error => {
            console.error('Error fetching events:', error);
            failureCallback(error);
          });
      },

      // Optional: Add loading indicator
      loading: function(bool) {
        if (bool) {
          // Show loading indicator
          document.getElementById('calendar').style.opacity = '0.5';
        } else {
          // Hide loading indicator
          document.getElementById('calendar').style.opacity = '1';
        }
      },

      // Optional: Handle event click
      eventClick: function(info) {
        console.log('Event clicked:', info.event);
        // You can add custom event click handling here
      }
    });

    calendar.render();
  });
  </script>

@stack('style')
@include('layouts.header')
 <!-- partial -->

        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
                <div class="row">
              <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex justify-content-between">
                      <p class="card-title">Kalendar menyusi</p>

                    </div>
                    <div id='calendar'></div>

                    <div id="sales-chart-legend" class="chartjs-legend mt-4 mb-2"></div>
                    <canvas id="sales-chart"></canvas>
                  </div>
                </div>
              </div>
                </div>
          </div>


                <!-- content-wrapper ends -->

@include('layouts.footer')






{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Panel') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("Siz tashrif buyurdingiz!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
 --}}
