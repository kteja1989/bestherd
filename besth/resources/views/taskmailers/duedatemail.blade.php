<!DOCTYPE html>
<html>
<head>
	<title>Meissa - BEST</title>
</head>
<body>

<center>
<h4 style="padding: 23px;background: #b3deb8a1;border-bottom: 6px green solid;">
	<a href="https://www.meissasoftwares.in">Meissa-BEST: Friendly reminder...</a>
</h4>
</center>

<p>Date: {{ date('d-F-Y H:i:s') }}</p>

<p>Dear <strong> {{ $name }} </strong></p>

<p>Friendly reminder on due dates</strong></p>

<div id="email" style="width:200px;">
    <table class="table-auto" role="presentation" border="0" width="100%">
      <thead>
        <tr>
          <th width="20%">Date</th>
          <th width="40%">Event</th>
          <th width="40%">Description</th>
        </tr>
      </thead>
      <tbody>
        @foreach($events as $row)
        <tr>
          <td>{{ date('d-m-Y', strtotime($row->start_date)) }}</td>
          <td>{{ ucfirst($row->title) }}</td>
          <td>{{ ucfirst($row->description) }}</td>
        </tr>
        @endforeach
        <tr>
          <td colspan="3">Auto generated, do not reply to this mail</td>
        </tr>
      </tbody>
    </table>
</div>
<p>
With best wishes
</p>

<p>
<strong>Team Meissa-BEST </strong>
</p>

</body>
</html>
