<h2>Booking Confirmed!</h2>
<p>Hello {{ $rental->user->name }},</p>
<p>You have successfully rented the car: <strong>{{ $rental->car->name }}</strong>.</p>
<p><strong>Start Date:</strong> {{ $rental->start_date }}</p>
<p><strong>End Date:</strong> {{ $rental->end_date }}</p>
<p><strong>Total Cost:</strong> ${{ $rental->total_cost }}</p>
<p>Payment Mode: By Cash</p>
