@extends('layouts.app')

@section('content')
  <div class="container">
    <h2>My Ratings</h2>

    @if($ratings->isEmpty())
    <p>No ratings yet.</p>
    @else
    <table class="table">
    <thead>
      <tr>
      <th>Student</th>
      <th>Teaching Quality</th>
      <th>Communication</th>
      <th>Discipline</th>
      <th>Method</th>
      <th>Result</th>
      <th>Comment</th>
      <th>Average</th>
      </tr>
    </thead>
    <tbody>
      @foreach($ratings as $rating)
      <tr>
      <td>{{ $rating->student->user->name ?? '-' }}</td>
      <td>{{ $rating->quality_teaching }}</td>
      <td>{{ $rating->communication }}</td>
      <td>{{ $rating->discipline }}</td>
      <td>{{ $rating->teaching_method }}</td>
      <td>{{ $rating->teaching_result }}</td>
      <td>{{ $rating->comment }}</td>
      <td>
      {{
      number_format(
      ($rating->quality_teaching +
      $rating->communication +
      $rating->discipline +
      $rating->teaching_method +
      $rating->teaching_result) / 5,
      2
      )
        }}
      </td>
      </tr>
    @endforeach
    </tbody>
    </table>
    @endif
  </div>
@endsection