<x-mail::message>
# New Form Submission

Your form received a new submission.

<x-mail::table>
| Field         | Value         |
| ------------- |:-------------:|
@foreach($fields as $field)
| {{ $field->name }}      | {{ $field->value }}      |
@endforeach
</x-mail::table>

<x-mail::button :url="$url">
View submission
</x-mail::button>

</x-mail::message>
