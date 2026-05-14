<h2>Edit Enquiry</h2>

<form action="/enquiry-update/{{$enquiry->id}}" method="POST">

@csrf

<input type="text"
name="name"
value="{{$enquiry->name}}">

<input type="text"
name="location"
value="{{$enquiry->location}}">

<input type="text"
name="contact_number"
value="{{$enquiry->contact_number}}">

<input type="email"
name="email"
value="{{$enquiry->email}}">

<textarea name="message">
{{$enquiry->message}}
</textarea>

<button type="submit">
Update
</button>

</form>