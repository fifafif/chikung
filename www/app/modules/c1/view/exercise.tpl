<h2>Cvik - {$exercise->name}</h2>

<p>{$exercise->description}</p>

<p>
    <iframe width="560" height="315" src="{$exercise->video}" frameborder="0" allowfullscreen></iframe>
    
    <!-- <iframe src="https://player.vimeo.com/video/180548609?badge=0" width="640" height="360" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe></p> -->
</p>

<hr />

<a href={link a="c1::Course:showDay" id=$exercise->c1day_id} class="btn-grey">zpatky</a>