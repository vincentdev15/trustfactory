<x-mail::message>

Here is the sales report for {{ $date->format('Y-m-d') }}.

<x-mail::table>
| Product       | Total sold    | Total revenue |
| ------------- | :-----------: | ------------: |
@foreach ($articles as $article)
| {{ $article->product }} | {{ $article->total_sold }} | {{ $article->total_revenue }} |
@endforeach
| | {{ $articles->sum('total_sold') }} | {{ $articles->sum('total_revenue') }} |
</x-mail::table>

</x-mail::message>
