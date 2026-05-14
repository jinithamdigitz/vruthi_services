<h2>Enquiry List</h2>

<table border="1">

<tr>
<th>Name</th>
<th>Location</th>
<th>Contact</th>
<th>Email</th>
<th>Message</th>
<th>Action</th>
</tr>

@foreach($enquiries as $data)

<tr>

<td>{{ $data->name }}</td>
<td>{{ $data->location }}</td>
<td>{{ $data->contact_number }}</td>
<td>{{ $data->email }}</td>
<td>{{ $data->message }}</td>

<td>
<a href="/enquiry-edit/{{$data->id}}">Edit</a>

<a href="/enquiry-delete/{{$data->id}}">
Delete
</a>
</td>

</tr>

@endforeach

</table>