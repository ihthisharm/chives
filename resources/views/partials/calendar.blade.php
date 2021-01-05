<?php
    $weekday_of_first = date('w', strtotime(date('Y-m-01'))) + 1;
    $holidays = [5, 6, 12, 13, 19, 20, 26, 27, 33, 34, 40, 41];
    $weeks = [];
    $end_of_month = date('t');
    for ($i = 1; $i < $weekday_of_first; $i++) { 
        array_push($weeks, '' ); 
    } 
    for ($i=1; $i <=$end_of_month; $i++) {
        array_push($weeks, $i); 
    } 
    $weeks=array_chunk($weeks, 7, true) 
?> 
<div class="card disabled">
    <div class="card-header bg-primary d-flex justify-content-between align-items-center pt-3 pb-0">
        <h5 class="card-title text-white"><?php echo date('F'); ?></h5>
        <h5 class="card-title text-white"><?php echo date('Y'); ?></h5>
    </div>
    <div class="card-body text-center">
        <div class="d-flex justify-content-between px-2">
            <span>S</span>
            <span>M</span>
            <span>T</span>
            <span>W</span>
            <span>T</span>
            <span class="text-danger">F</span>
            <span class="text-danger">S</span>
        </div>
        <hr class="my-0">
        <div>
            @foreach ($weeks as $week => $days)
                <div class="d-flex justify-content-between px-2">
                    @foreach ($days as $key => $day)
                        @if( $day <= date('d', strtotime(date('Y-m-d'))) && $day !== '')
                            @if (in_array($key, $holidays) && $day == date('d', strtotime($today)))
                                <a class='day text-white bg-danger mt-3 px-1'
                                    href="{{ route('attendances.show', date('Y-m-' . $day)) }}">
                                    {{ $day }}
                                </a>
                            @elseif ($day == date('d',  strtotime($today)))
                                <a class='day text-white bg-primary text-center mt-3 px-1'
                                    href="{{ route('attendances.show', date('Y-m-' . $day)) }}">
                                    {{ $day }}
                                </a>
                            @elseif (in_array($key, $holidays))
                                <a class='day text-danger text-center mt-3 px-1'
                                    href="{{ route('attendances.show', date('Y-m-' . $day)) }}">
                                    {{ $day }}
                                </a>
                            @else
                                <a class='day text-center mt-3 px-1'
                                    href="{{ route('attendances.show', date('Y-m-' . $day)) }}">
                                    {{ $day }}
                                </a>
                            @endif
                        @else
                        <span class='text-center mt-3 px-1 text-muted'>{{ $day }}</span>   
                        @endif
                    @endforeach
                </div>
                <hr class="my-0">
            @endforeach
        </div>
        <div class="text-muted pt-3">
            <h6><?php echo date('l, d F Y', strtotime($today)); ?>
            </h6>
        </div>
    </div>
    </div>
