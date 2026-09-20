<h2>Car Rental Confirmation</h2>
<p>Hello {{ $rental->user->name }},</p>
<p>Your booking for <strong>{{ $rental->car->name }}</strong> has been confirmed.</p>
<ul>
    <li><strong>Start Date:</strong> {{ $rental->start_date }}</li>
    <li><strong>End Date:</strong> {{ $rental->end_date }}</li>
    <li><strong>Total Cost:</strong> ${{ $rental->total_cost }}</li>
    <li><strong>Payment Mode:</strong> Cash on Hand</li>
</ul>
