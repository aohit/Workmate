  <canvas id="pieChart"></canvas>

  <div class="row d-flex align-items-center">
      <div class="col-sm-4">{{ $totalkeyCount }} <br>
         Goals  </div>
      <div class="col-sm-4"> {{ $thisWeekDueCount }} <br>
          Due This Week </div>
      <div class="col-sm-4"> {{ $totalDueCount }} <br>
          Overdue
      </div>

      <div class="progress p-0" style="height: 21px">
          <div class="progress-bar" role="progressbar" aria-valuenow="" aria-valuemin="0"
              aria-valuemax="{{ $target }}" style="width:{{ $totalProgressBar }}%">
              {{ $totalProgressBar }}%
          </div>
      </div>
  </div>
