<h1>home page</h1>
<ul>
    @foreach ($learner as $each)
        <h1><li><b>First Name</b>:{{ $each['firstName']}} <b> Last Name</b>: {{ $each['lastName'] }}</li></h1>
    @endforeach
</ul>


<hr>
<h1>1 to 100</h1>
@for($i=0; $i<=10; $i++)
    Item Number {{$i}} <br/>
@endfor

<hr>
<h1>Row PHP</h1>
@php
$num = 10;
$num2 = 2;
echo $num3 = $num + $num2;
@endphp
