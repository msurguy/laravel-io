<div class="categories">
    <h4>Categories</h4>
    <ul>
        <li><a href="{{ action('ForumController@getIndex') }}">All Threads</a></li>
        <li><a href="{{ action('ForumController@getIndex') }}?tags=installation,configuration">Installation / Configuration</a></li>
        <li><a href="{{ action('ForumController@getIndex') }}?tags=authentication,security">Authentication / Security</a></li>
        <li><a href="{{ action('ForumController@getIndex') }}?tags=requests,input">Requests / Input / Responses</a></li>
        <li><a href="{{ action('ForumController@getIndex') }}?tags=session,cache">Session / Cache</a></li>
        <li><a href="{{ action('ForumController@getIndex') }}?tags=database,eloquent">Database / Eloquent</a></li>
        <li><a href="{{ action('ForumController@getIndex') }}?tags=packages,ioc">Packages / IoC </a></li>
        <li><a href="{{ action('ForumController@getIndex') }}?tags=views,blade,forms">Views / Blade / Forms</a></li>
        <li><a href="{{ action('ForumController@getIndex') }}?tags=mail,queues">Mail / Queues</a></li>
        <li><a href="{{ action('ArticlesController@getIndex') }}?tags=meetups">Local Community Meetups</a></li>
        <li><a href="{{ action('ForumController@getIndex') }}?tags=laravelio">Laravel.io Site and Community</a></li>
    </ul>
</div>

<div class="new-post">
    <h4>Create a Thread</h4>
    <p>Forum threads are a way to begin a discussion over a specific topic. Is there a topic that you&#39;d like to discuss that you don&#39;t see in the forum?</p>
    <a class="button full" href="{{ action('ForumController@getCreateThread') }}">Create a Thread</a>
</div>
